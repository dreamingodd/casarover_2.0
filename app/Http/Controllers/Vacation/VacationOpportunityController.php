<?php

namespace App\Http\Controllers\Vacation;

use DB;
use Log;
use Session;
use Exception;
use App\Entity\Order;
use App\Entity\CasaOrder;
use App\Entity\Opportunity;
use App\Entity\VacationCard;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Entity\OpportunityApply;
use App\Entity\Wx\WxCasa;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;


/**
 * The nights of casas on the card is consuming or lending in this Controller.
 */
class VacationOpportunityController extends BaseController
{
    /** enter card number
     */
    public function cardEntry()
    {
        return view('wx.cardEntry');
    }
    /**
    * check card number
    * @param string $cardNo
    */
    public function cardCasaJson($cardNo)
    {
        $card = VacationCard::where('card_no', $cardNo)->first();
        if($card)
        {
            return response()->json(['code'=>0,'msg'=>'存在']);
        }
        else
        {
            return response()->json(['code'=>503,'msg'=>'卡号错误']);
        }
    }
    /**
     * book page
     * @param int $id
     *
     */
    public function prepareBook($id)
    {
        $casa = OrderItem::find($id);
        //如果是本人进入这个页面，显示为提交，value == 1
        $loginUserId = Session::get('user_id');
        $isMe = $casa->order->user_id == $loginUserId ? 1: 0;
        // dd($casa->order->user_id);
        $user = User::find(Session::get('user_id'));
        return view('wx.cardBook', compact('casa','isMe','user'));
    }

    /**
     * Apply for user's card.
     * 2 conditions:
     * a) Apply for one's own.
     * b) Apply for other's.
     * @param Request $request
     */
    public function book(Request $request)
    {
        DB::beginTransaction();
        try {
            $applicantId = Session::get('user_id');
            //更新user的信息
            $userCheckResult =
                    $this->checkThenSaveUsernameAndCellphone($applicantId, $request->name, $request->tel);
            if (!$userCheckResult) return "用户信息缺失！";

            $orderItem = OrderItem::find($request->id);
            $ownerId = $orderItem->order->user->id;
            $quantity = $request->number;

            if ($applicantId == $ownerId) {
                // 自己的卡，直接创建订单！
                $order = $this->createCasaOrder($applicantId,
                                                $quantity,
                                                $orderItem);
                // 同时把机会减掉
                $this->consumeOpportunity($orderItem->id, $quantity);
                DB::commit();
                return redirect('/wx/order/detail/' . $order->id)
                        ->with(['msg' => '订单已创建，请使用电话预约完成预定！']);
            } else {
                // 别人的卡，提交申请
                /**申请人user_id
                 * 被申请人owner_id
                 * 图片 photo_path
                 * 卡拥有者民宿 order_item_id
                 * 申请数量 quantity
                 * 状态 status
                 */
                OpportunityApply::create([
                    'user_id' => Session::get('user_id'),
                    'owner_id' => $ownerId,
                    'order_item_id' => $orderItem->id,
                    'quantity' => $request->number,
                    'status' => 0
                ]);
                DB::commit();
                //跳转到我的申请列表
                return redirect('/wx/user/card/apply/list')->with(['msg' => '申请已提交']);
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error(get_class() . ' - ' . $e);
            return $e;
        }
    }

    /**
     * 被申请的列表
     */
    public function appliedList()
    {
        $applyList = OpportunityApply::where('owner_id',Session::get('user_id'))->orderBy('id','desc')->get();
        //为了判断是否显示同意和否定按钮
        $isMe = 0;
        $applyList = $this->turnApplyList($applyList);
        return view('wx.cardApplyList',compact('applyList','isMe'));
    }

    /**
     * 用户自己申请的列表
     */
    public function applyList()
    {
        $applyList = $applyList = OpportunityApply::where('user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        $applyList = $this->turnApplyList($applyList);
        $isMe = 1;
        return view('wx.cardApplyList',compact('applyList','isMe'));
    }
    /**
     * Approve another user's apply for opportunity and create a payed by vacation card order.
     * @param int $id
     */
    public function applyApprove($id)
    {
        $apply = OpportunityApply::find($id);
        $result = $this->checkLeftNums($apply, $id);
        if($result)
        {
            $apply->status = 1;
            $apply->save();
            //创建申请的订单
            $order = $this->createCasaOrder($apply->user_id,
                                            $apply->quantity,
                                            OrderItem::find($apply->order_item_id));
            return redirect('/wx/user/card/applied/list')->with(['msg' => '操作成功']);
        } else {
          return redirect('/wx/user/card/applied/list')->with(['msg' => '房间剩余数量不足']);
        }
    }
    /**
     * Reject another user's apply for opportunity.
     * @param int $id
     */
    public function applyReject($id)
    {
        $apply = OpportunityApply::find($id);
        $apply->status = 2;
        $apply->save();
        return redirect('/wx/user/card/applied/list');
    }

    /**
     * 对信息进行转换
     * @param array $applyList
     */
    private function turnApplyList($applyList)
    {
        foreach($applyList as $apply)
        {
            $orderItem = OrderItem::find($apply->order_item_id);
            $user = User::find($apply->owner_id);
            $apply->casaname = $orderItem->name;
            $apply->quantity = $apply->quantity;
            $apply->username = $user->realname;
            $apply->cellphone = $user->cellphone;
            $apply->casapic = $orderItem->photo_path;
            $apply->statusWords = $this->statusToWord($apply->status);
        }
        return $applyList;
    }
    /***/
    private function statusToWord($code)
    {
        switch($code)
        {
            case 0: $result = '申请中'; break;
            case 1: $result = '已通过';break;
            case 2: $result = '申请已被拒绝';break;
        }
        return $result;
    }
    /***/
    private function checkLeftNums($apply, $id)
    {
        $orderItemId = OpportunityApply::find($id)->order_item_id;
        $left_order = OrderItem::find($orderItemId);
        $left_num = $left_order->opportunity->left_quantity;
        if($left_num >= $apply->quantity)
        {
            $left_order->opportunity->left_quantity = 0;
            $left_order->opportunity->save();
            return 1;
        }
        else
        {
            return 0;
        }
    }
    /**
     * Create a card payed order including an Order, an OrderItem(just one) and a casa order.
     */
    private function createCasaOrder($userId, $quantity, OrderItem $orderItem) {
        // 1.base order
        $order = new Order();
        $wxCasa = WxCasa::find($orderItem->product->parent_id);
        $order->user_id = $userId;
        $order->type = Order::TYPE_CASA;
        $order->name = Order::CASA_ORDER_PREFIX . $wxCasa->name;
        $order->pay_type = Order::PAY_TYPE_CARD;
        $order->status = Order::STATUS_PAYED;
        $order->photo_path = $orderItem->photo_path;
        $order->total = $orderItem->price * $quantity;
        $order->save();
        $order->generateOrderId();
        $order->save();
        // 2.order item
        $newOi = new OrderItem();
        $newOi->order_id = $order->id;
        $newOi->product_id = $orderItem->product_id;
        $newOi->name = $orderItem->name;
        $newOi->photo_path = $orderItem->photo_path;
        $newOi->price = $orderItem->price;
        $newOi->quantity = $quantity;
        $newOi->save();
        // dd($newOi);
        // 3.casa order.
        $casaOrder = new CasaOrder();
        $casaOrder->order_id = $order->id;
        $casaOrder->wx_casa_id = $wxCasa->id;
        $casaOrder->save();
        return $order;
    }
    /**
     * Consume the opportunities, will go wrong if the $quantity exceed maximum.
     */
    private function consumeOpportunity($orderItemId, $quantity) {
        $opp = Opportunity::where('order_item_id', $orderItemId)->get()->first();
        $opp->left_quantity -= $quantity;
        if ($opp->left_quantity < 0) {
            throw Exception('Exceed left quantity of card opportunity!');
        }
        $opp->save();
    }

}
