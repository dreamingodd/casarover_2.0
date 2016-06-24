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
use App\Entity\OpportunityApply;

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
        //当价格为0的时候不上线
        $casas = Product::where('type', Product::TYPE_VACATION_CARD)->where('price','>',0)->get();
        $user = User::find(Session::get('user_id'));
        return view('wx.cardCustomize',compact(['casas', 'user']));
    }

    /**
     * 前台购买，民宿列表
     */
    public function showlist()
    {
        $casas = Product::where('type', Product::TYPE_VACATION_CARD)->where('price', '>', 0)->get();
        foreach($casas as $casa)
        {
            $casa->headImg = 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/' . $casa->img->filepath;
            // 原价
            $casa->orig = $casa->stock->orig;
            $casa->room = 0;
            $casa->surplus = $casa->stock->surplus;
        }
        return response()->json($casas);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $wxCasa = WxCasa::find($product->parent_id);
        $contents = $wxCasa->contents;
        $wxCasa->rooms = $wxCasa->rooms()->where('type',Product::TYPE_UNKNOWN)->get();
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
        $casas = $request->casas;
        $username = $request->username;
        $cellphone = $request->cellphone;
        if (!$this->checkNumber($casas)) {
            return response()->json(['msg' => '至少' . self::LEAST_CASA_COUNT . '家']);
        }
        $userCheckResult =
                $this->checkThenSaveUsernameAndCellphone($userId, $request->realname, $request->cellphone);
        if (!$userCheckResult) {
            return response()->json(['msg' => '用户信息缺失！']);;
        }
        $userId = Session::get('user_id');
        $type = Product::TYPE_VACATION_CARD;
        $total = $this->roomTotal($casas);
        DB::beginTransaction();
        try
        {
            //1: 在order 中存入信息
            $order = $this->createOrder($userId, $photo_path, $total);
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
            //不一定是什么错误，但是前台能做的就是重试。
            return response()->json(['code' => 503, 'msg' => '网络错误，请刷新重试']);
        }
    }
    public function card()
    {
        $userId = Session::get('user_id');
        $cards=Order::where('user_id', $userId)->where('type', Order::TYPE_VACATION_CARD)->get();
        foreach($cards as $card)
        {
            $card->number = $card->VacationCard->card_no;
            $card->startDate = Carbon::parse($card->VacationCard->start_date)->format('Y-m-d');
            $card->expireDate = Carbon::parse($card->VacationCard->expire_date)->format('Y-m-d');
        }
        return view('wx.cards', compact('cards'));
    }
    /**
     * @param int $id
     */
    public function cardCasa($cardNo)
    {
        $card = VacationCard::where('card_no',$cardNo)->first();
        $cardCasas = Order::find($card->order_id)->orderItems;
        return view('wx.cardCasa',compact('cardCasas'));
    }
    public function cardCasaJson($cardNo)
    {
        $card = VacationCard::where('card_no',$cardNo)->first();
        if($card)
        {
            return response()->json(['code'=>0,'msg'=>'存在']);
        }
        else
        {
            return response()->json(['code'=>503,'msg'=>'卡号错误']);
        }
    }

    public function book($id)
    {
        $casa = OrderItem::find($id);
        //如果是本人进入这个页面，显示为预订，value == 1
        $loginUserId = Session::get('user_id');
        //test
//        $loginUserId =3;
        $isMe = $casa->order->user_id == $loginUserId? 1: 0;
        $user = User::find(Session::get('user_id'));
        return view('wx.cardBook',compact('casa','isMe','user'));
    }
    //预订成功
    public function booksuccess(Request $request)
    {
        $casa = OrderItem::find($request->id);
        //更新user的信息
        $user = User::find(Session::get('user_id'));
        $user->realname = $request->name;
        $user->cellphone = $request->tel;
        $user->save();
        //生成order
//        $userid = Session::get('user_id');
//        $order = $this->createOrder($userid,Order::TYPE_OPPORTUNITY,$casa->name,$casa->photo_path,0,0);
        //存储orderItem
//        $order = OrderItem::create([
//            'order_id' => $order->id,
//            'product_id' => $casa->product_id,
//            'name' => $casa->name,
//            'photo_path' => $casa->photo_path,
//            'price' => 0,
//            'quantity' => $request->number
//        ]);
        //存储opportunity_apply
        //被申请人的id
//        $user_id = $casa->order->user_id;
        /**
         * 申请人user_id
         * 被申请人card_user_id
         * 图片 photo_path
         * 卡拥有者民宿 order_item_id
         * 申请数量 quantity
         * 状态 status
         */
        OpportunityApply::create([
            'user_id' => Session::get('user_id'),
            'card_user_id' => $casa->order->user->id,
            'order_item_id' => $casa->id,
            'quantity' => $request->number,
            'status' => 0
        ]);
//        $user = User::find(Session::get('user_id'));
//        $order = OrderItem::find($order->id);
//        跳转到我的申请列表
        return view('wx.cardApply');
    }
    //被申请的列表
    public function cardApplyList()
    {
        $applyList = OpportunityApply::where('card_user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        //为了判断是否显示同意和否定按钮
        $isMe = 0;
        $applyList = $this->turnApplyList($applyList);
        return view('wx.cardApply',compact('applyList','isMe'));
    }

    public function myCardApplyList()
    {
        $applyList = $applyList = OpportunityApply::where('user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        $applyList = $this->turnApplyList($applyList);
        $isMe = 1;
        return view('wx.cardApply',compact('applyList','isMe'));
    }

    private function turnApplyList($applyList)
    {
        foreach($applyList as $apply)
        {
            $orderItem = OrderItem::find($apply->order_item_id);
            $user = User::find($apply->card_user_id);
            $apply->casaname = $orderItem->name;
            $apply->quantity = $apply->quantity;
            $apply->username = $user->realname;
            $apply->cellphone = $user->cellphone;
            $apply->casapic = $orderItem->photo_path;
            $apply->statusWords = $this->statusToWord($apply->status);
        }
        return $applyList;
    }

    public function applyAgree($orderItemId)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('order_item_id',$orderItemId)->first();
        $result = $this->checkLeftNums($apply,$orderItemId);
        if($result)
        {
            $apply->status = 1;
            $apply->save();
        }
        else
        {
            //返回数量不足的提示
        }
    }

    private function checkLeftNums($apply,$oderItemId)
    {
        $left_num = OrderItem::find($oderItemId)->opportunity->left_quantity;
        if($left_num > $apply->quantity)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    //拒绝申请
    public function applyRefuse($id)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('order_item_id',$orderItemId)->first();
        $apply->status = 2;
        $apply->save();
    }

    private function statusToWord($code)
    {
        switch($code)
        {
            case 0: $result = '申请中'; break;
            case 1: $result = '申请通过';break;
            case 2: $result = '申请被拒绝';break;
        }
        return $result;
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
            'photo_path' => Config::get('vacationcard.card_images')[mt_rand(0, STYLE_QUANTITY)],
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
