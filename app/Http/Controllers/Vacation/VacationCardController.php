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
use App\Entity\Coupon;
use App\Entity\Dealer;

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
        return view('vacation');
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
        // $wxCasa
        $wxCasa->headImg = config('config.photo_folder').$wxCasa->attachment->filepath;
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        $wxCasa->products = $wxCasa->products()->join('stocks','product.id','=','stocks.product_id')
            ->select('product.*','stocks.is_whole','stocks.surplus','stocks.orig')
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
                return response()->json(['msg' => '请至少选择' . self::LEAST_CASA_COUNT . '间']);
            }
            if(!$this->checkStocks($casas)) {
                return response()->json(['msg' => '有个房间卖光啦，请重新选择一下吧']);
            }
            if (empty($request->user["realname"]) || empty($request->user["cellphone"]) ) {
                return response()->json(['msg' => '用户信息缺失！']);
            }
            $userId = Session::get('user_id');
            $user = User::find($userId);
            if ($user->realname != $request->user["realname"] or
                  $user->cellphone != $request->user["cellphone"]) {
                $user->realname = $request->user["realname"];
                $user->cellphone = $request->user["cellphone"];
                $user->save();
            }
            $type = Product::TYPE_VACATION_CARD;
            if($request->coupons){
                $couponTotal = $this->couponsToal($request->coupons);
                if(!$couponTotal){
                    throw new Exception("充值卡号或密码错误或包含测试卡", 1);
                }
            }else{
                $couponTotal=0;
            }
            $roomstotal = $this->roomTotal($casas);
            $total = $roomstotal - $couponTotal;
            $total = sprintf("%.2f", $total);
            if($total < 0 && abs($total) > config('config.coupon_largest_diff')){
                throw new Exception("订单金额过少", 1);
            }elseif($total < 0){
                $total = 0;
            }
            //1: 在order 中存入信息
            $order = $this->createOrder($userId, $total);
            $dealer = $request->dealer;
            if($dealer){
                $dealerId = Dealer::where('code',$dealer)->first()->id;
                if($dealerId){
                    // 存入经销商和订单的关系
                    app('DealerVacationRelationService')->add($dealerId, $order->id);
                }
            }
            if($request->coupons){
                foreach($request->coupons as $coupon){
                    $coupon = Coupon::find($coupon["id"]);
                    if(!$coupon->vacation_card_order_id){
                        $coupon->vacation_card_order_id = $order->id;
                        $coupon->save();
                    }else{
                        throw new Exception("度假卡已被使用请联系工作人员", 1);
                    }

                }
            }
            //2：在order_item 存入信息  在opportunity中存入机会次数
            $this->saveOrderItem($order, $casas);
            //3: 在vacation_card_order中存入度假卡的信息
            $cardNo = sprintf(self::CARDNO_PREFIX . "%05d", $order->id) . mt_rand(0,9);
            $this->saveVacationCard($order->id, $cardNo);
            DB::commit();
            if($order->total == 0){
                app('CouponService')->consumeCouponIfUsed($order->id);
                app('ProductService')->minus($order->id);
            }
            return response()->json(['orderId' => $order->id, 'total' => $order->total]);
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
        if($total == 0){
            $order->status = Order::STATUS_PAYED;
        }
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

    private function couponsToal($coupons)
    {
        $total = 0;
        foreach($coupons as $coupon)
        {
            if($coupon["isuse"] == true)
            {
                $checkResult = $this->checkCouponNoAndPwd($coupon["number"],$coupon["password"]);
                if($checkResult)
                {
                    if($checkResult->status == Coupon::STATUS_TEST){
                        return false;
                        bread;
                    }
                    $total += $checkResult->left;
                }
                else
                {
                    return false;
                    break;
                }
            }
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
            if($value['is_whole'] == 1){
                return true;
            }
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
    // 检查库存限制，感觉会出现问题
    private function checkStocks($casas)
    {
        foreach ($casas as $casa) {
            if(Stock::where('product_id',$casa["id"])->first()->surplus <= 0){
                return false;
            }
        }
        return true;
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

    public function checkCoupon(Request $request)
    {
        $number = $request->number;
        $pwd = $request->password;
        $result = $this->checkCouponNoAndPwd($number, $pwd);
        if($result){
            $result->name = '充值卡';
            $result->number = $result->code;
            $result->password = $result->key;
            $result->left = $result->left;
            $result->isuse = true;
            if($result->status == 1){
                return response()->json(['code'=>2,'result'=>'','msg'=>'已被使用']);
            }
            if($result->vacation_card_order_id){
                return response()->json(['code'=>2,'result'=>'','msg'=>'已被其他订单使用，若是未付款请联系工作人员']);
            }
            if($result->status == 2){
                return response()->json(['code'=>2,'result'=>$result,'msg'=>'测试卡，不能使用']);
            }
            return response()->json(['code'=>0,'result'=>$result,'msg'=>'ok']);
        }else{
            return response()->json(['code'=>2,'result'=>'','msg'=>'卡号或密码错误']);
        }
    }

    private function checkCouponNoAndPwd($number,$pwd)
    {
        $coupon = Coupon::where(['code'=>$number,'key'=>$pwd])->first();
        if($coupon){
            return $coupon;
        }else{
            return false;
        }
    }
}
