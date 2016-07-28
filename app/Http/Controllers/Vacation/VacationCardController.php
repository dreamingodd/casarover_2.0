<?php

namespace App\Http\Controllers\Vacation;

use App\Entity\Opportunity;
use App\Entity\OrderItem;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Entity\Wx\WxCasa;
use App\Entity\Product;
use App\Entity\Order;
use App\Entity\Stock;
use App\Entity\User;
use DB;
use Log;
use Config;
use Exception;
use Session;
use App\Entity\VacationCard;
use Carbon\Carbon;
use App\Attachment;

/**
 * Class VacationCardController
 * @package App\Http\Controllers\Mail
 * 探庐者度假卡
 * 自定义包含的民宿
 */
class VacationCardController extends BaseController
{
    /** @var string CARDNO_PREFIX 1 */
    const CARDNO_PREFIX = "1";
    /** @var int LEAST_CASA_COUNT 3 */
    const LEAST_CASA_COUNT = 3;

    /** 后台选择参与活动的民宿 */
    public function back()
    {
        $casas = WxCasa::all();
        return view('backstage.vacationCasalist',compact('casas'));
    }
    /** 后台获取已经选中的 */
    public function casalist()
    {
        $casalist = Product::where('type',Product::TYPE_VACATION_CARD)->orderBy('parent_id')->get();
        foreach($casalist as $vacaProduct)
        {
            // orig:原价 stock:度假卡产品
            $vacaProduct->orig = $vacaProduct->stock->orig;
            $vacaProduct->surplus = $vacaProduct->stock->surplus;
            $vacaProduct->isWhole = $vacaProduct->stock->is_whole;
            $casa = WxCasa::find($vacaProduct->parent_id);
            $vacaProduct->casaName = $casa->name;
        }
        return response()->json($casalist);
    }

    public function create($id)
    {
        $casa = WxCasa::find($id);
        DB::beginTransaction();
        try
        {
            $product = Product::create([
                'parent_id' => $id,
                'attachment_id' => $casa->attachment_id,
                'type' => Product::TYPE_VACATION_CARD,
                'name' => ''
            ]);
            Stock::create([
                'product_id' => $product->id,
                'surplus' => 0
            ]);
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            Log::error(get_class() . ' - ' . $e);
        }
        return response()->json(['msg'=>'ok']);
    }

    public function del($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['msg'=>'ok']);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock->orig = $request->orig;
        $product->stock->surplus = $request->surplus;
        $product->stock->is_whole = $request->isWhole;
        $product->stock->save();
        $result = $product->save();
        if($result)
        {
            return response()->json(['msg' => $request->is_whole]);
        }
    }
    /**
     * 前台获取
     */
    public function index()
    {
        return view('wx.cardCasaList');
    }

    /**
     * casalist for vue
     */
    public function showlist(Request $request)
    {
        // 价格为0的时候不上线，包幢为1
        // $casas = DB::table('product')->join('stocks','product.id','=','stocks.product_id')->select('product.*','stocks.is_whole')
        //         ->where('type',Product::TYPE_VACATION_CARD)->where('price','>',0)->where('is_whole',$request->type)->get();

        $casas = DB::table('wx_casa')->join('product','product.parent_id','=','wx_casa.id')
                ->join('stocks','stocks.product_id','=','product.id')
                ->select('wx_casa.id','wx_casa.name')->where('product.type',Product::TYPE_VACATION_CARD)
                ->where('is_whole',$request->type)
                ->where('price','>',0)
                ->distinct()->get();
        foreach($casas as $casa)
        {
            $casa->headImg = config('config.photo_folder')
                    . wxCasa::find($casa->id)->thumbnail();
        }
        return response()->json($casas);
    }
    //casa message for vue
    public function show(Request $request,$id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        $wxCasa->products = $wxCasa->products()->join('stocks','product.id','=','stocks.product_id')->select('product.*','stocks.is_whole')
            ->where('is_whole',$request->type)->get();
        foreach($wxCasa->products as $product){
            $product->number = 0;
            $product->headImg = config('config.photo_folder').wxCasa::find($product->parent_id)->thumbnail();
        }
        foreach($wxCasa->contents as $content){
            $content->imgs = $content->attachments;
        }
        return response()->json($wxCasa);
    }

    /**
     * 用户自定义了度假卡内容，下单的动作.
     * 生成类型为度假卡的订单.
     * @param Request $request
     */
    public function buy(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $casas = $request->casas;
            if (!$this->checkNumber($casas)) {
                return response()->json(['msg' => '至少' . self::LEAST_CASA_COUNT . '间']);
            }
            $userCheckResult =
                    $this->checkThenSaveUsernameAndCellphone(Session::get('user_id'), $request->user["realname"],
                     $request->user["cellphone"], $request->user["address"]);
            if (!$userCheckResult) {
                return response()->json(['msg' => '用户信息缺失！']);;
            }
            $userId = Session::get('user_id');
            $type = Product::TYPE_VACATION_CARD;
            $total = $this->roomTotal($casas);
            //1: 在order 中存入信息
            $order = $this->createOrder($userId, $total);
            //2：在order_item 存入信息  在opportunity中存入机会次数
            $this->saveOrderItem($order, $casas);
            //3: 在vacation_card_order中存入度假卡的信息
            $cardNo = sprintf(self::CARDNO_PREFIX . "%05d", $order->id) . mt_rand(0,9);
            $this->saveVacationCard($order->id, $cardNo);
            DB::commit();
            return response()->json(['orderId' => $order->id]);
        }
        catch(Exception $e)
        {
            DB::rollback();
            Log::info(get_class() . ' - ' . $e);
            return $e;
            //不一定是什么错误，但是前台能做的就是重试。
            return response()->json(['code' => 503, 'msg' => '网络错误，请刷新重试']);
        }
    }
    /**
     * Card list belong to current user
     */
    public function cards()
    {
        $userId = Session::get('user_id');
        $cards = Order::where('user_id', $userId)
                      ->where('type', Order::TYPE_VACATION_CARD)
                      ->where('status', Order::STATUS_PAYED)
                      ->orderBy('id', 'desc')
                      ->get();
        foreach($cards as $card)
        {
            $card->number = $card->VacationCard->card_no;
            $card->startDate = Carbon::parse($card->VacationCard->start_date)->format('Y-m-d');
            $card->expireDate = Carbon::parse($card->VacationCard->expire_date)->format('Y-m-d');
        }
        return view('wx.cards', compact('cards'));
    }

    // show casalist belong card by card number
    public function cardCasa($cardNo)
    {
        $card = VacationCard::where('card_no',$cardNo)->first();
        $cardCasas = Order::find($card->order_id)->orderItems;
        return view('wx.cardCasa',compact('cardCasas'));
    }


    /**
     * Create basic order, store basic order information which will be consider as a normal order.
     * @param int $userId
     * @param int $total
     */
    private function createOrder($userId, $total)
    {
        $order = Order::create([
            'user_id' => $userId,
            'type' => Order::TYPE_VACATION_CARD,
            'name' => "度假卡",
            'photo_path' => Config::get('vacationcard.card_images')
                    [mt_rand(0, count(Config::get('vacationcard.card_images')) - 1)],
            'total' => $total,
            'status' => Order::STATUS_UNPAYED
        ]);
        $order->order_id = config('casarover.wx_shopid') . '-' . $order->id;
        $order->save();
        return $order;
    }

    /**
     * Calculate the total price inclusive of everything.
     * The result(total) is considered safe and will be store in database.
     * @param array $casas selected
     */
    private function roomTotal($casas)
    {
        $total = 0;
        foreach($casas as $casa)
        {
            // the specific price is gotten from database.
            $price = Product::find($casa["id"])->price;
            $number = $casa["number"];
            $total += $price * $number;
        }
        return $total;
    }

    /**
     * Check whether fits LEAST_CASA_COUNT.
     * @param array $casas selected casas
     */
    private function checkNumber($casas)
    {
        $num = $casas;
        $getNum = 0;
        foreach ($num as $value) {
            $getNum += $value["number"];
        }
        if($getNum < self::LEAST_CASA_COUNT)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * .
     * @param mixed $order
     * @param array $casas
     */
    private function saveOrderItem($order, $casas)
    {
        foreach($casas as $casa)
        {
            $product = Product::find($casa["id"]);
            $item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $casa["id"],
                'name' => $product->name,
                'photo_path' => $casa["headImg"],
                'price' => $product->price,
                'quantity' => $casa["number"]
            ]);
            Opportunity::create([
                'order_item_id' => $item->id,
                'left_quantity' => $casa["number"]
            ]);
        }
    }

    /**
     * Persist card information in vacation_card_order, it's actually an order,
     * while which also pretend to be a customize vacation card bound to it's owner(user).
     * @param int $orderId
     * @param string $cardNo
     */
    private function saveVacationCard($orderId, $cardNo)
    {
        $days = config('vacationcard.validDays');
        $start = Carbon::now();
        $end = Carbon::now()->addDays($days);
        VacationCard::create([
            'order_id' => $orderId,
            'card_no' => $cardNo,
            'start_date' => $start,
            'expire_date' => $end
        ]);
    }
}
