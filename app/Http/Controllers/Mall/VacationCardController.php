<?php

namespace App\Http\Controllers\Mall;

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
use Mockery\CountValidator\Exception;
use Session;
use App\Entity\VacationCard;
use Carbon\Carbon;

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
    /** @var int STYLE_QUANTITY */
    const STYLE_QUANTITY = 3;

    /** 后台选择参与活动的民宿 */
    public function back()
    {
        $casas = WxCasa::all();
        return view('backstage.vacationCasalist',compact('casas'));
    }
    /** 后台获取已经选中的 */
    public function casalist()
    {
        $casalist = Product::where('type',Product::TYPE_VACATION_CARD)->get();
        foreach($casalist as $list)
        {
            $list->orig = $list->stock->orig;
            $list->surplus = $list->stock->surplus;
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
                'name' => $casa->name
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
            Log::error($e);
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
        $product->price = $request->price;
        $product->stock->orig = $request->orig;
        $product->stock->surplus = $request->surplus;
        $product->stock->save();
        $result = $product->save();
        if($result)
        {
            return response()->json(['msg'=>'ok']);
        }
    }
    /**
     * 前台获取
     */
    public function index()
    {
        $user = User::find(Session::get('user_id'));
        //当库存为0的时候不上线
        $casas = DB::table('product')->join('stocks','product.id','=','stocks.product_id')
                ->where('type',Product::TYPE_VACATION_CARD)->where('surplus', '>',0)->get();
        return view('wx.cardCustomize',compact(['casas', 'user']));
    }

    /**
     * casalist for vue
     */
    public function showlist()
    {
        $casas = Product::where('type', Product::TYPE_VACATION_CARD)->where('price', '>', 0)->get();
        foreach($casas as $casa)
        {
            $casa->headImg = 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'
                    . $casa->wxCasa->thumbnail();
            $casa->orig = $casa->stock->orig;
            $casa->room = 0;
            $casa->surplus = $casa->stock->surplus;
        }
        return response()->json($casas);
    }
    //casa message for vue
    public function show($id)
    {
        $product = Product::find($id);
        $wxCasa = WxCasa::find($product->parent_id);
        $contents = $wxCasa->contents;
        $wxCasa->rooms = $wxCasa->getRooms();
        foreach($contents as $content){
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
                return response()->json(['msg' => '至少' . self::LEAST_CASA_COUNT . '家']);
            }
            $userCheckResult =
                    $this->checkThenSaveUsernameAndCellphone(Session::get('user_id'), $request->username, $request->cellphone);
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
            Log::error($e);
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
            'photo_path' => Config::get('vacationcard.card_images')[mt_rand(0, self::STYLE_QUANTITY)],
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
            $number = $casa["room"];
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
        if(count($num) < self::LEAST_CASA_COUNT)
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
                'quantity' => $casa["room"]
            ]);
            Opportunity::create([
                'order_item_id' => $item->id,
                'left_quantity' => $casa["room"]
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
