<?php

namespace App\Http\Controllers\Mall;

use DB;
use Log;
use Exception;
use App\Entity\Order;
use App\Entity\VacationCard;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Entity\OpportunityApply;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use Session;


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

            if ($applicantId == $ownerId) {
                // 自己的卡，直接创建订单！
                $this->createCasaOrder();
                return redirect('/wx/order/detail/153')->with(['msg' => '订单已创建，请使用电话预约完成预定！']);
            } else {
                // 别人的卡，提交申请
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
                    'card_user_id' => $ownerId,
                    'order_item_id' => $orderItem->id,
                    'quantity' => $request->number,
                    'status' => 0
                ]);
                //跳转到我的申请列表
                return redirect('/wx/user/card/myapply/list')->with(['msg' => '申请已提交']);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            return $e;
        }
    }

    /**
     * 被申请的列表
     */
    public function cardApplyList()
    {
        $applyList = OpportunityApply::where('card_user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        //为了判断是否显示同意和否定按钮
        $isMe = 0;
        $applyList = $this->turnApplyList($applyList);
        return view('wx.cardApply',compact('applyList','isMe'));
    }

    /**
     * 用户自己申请的列表
     */
    public function myCardApplyList()
    {
        $applyList = $applyList = OpportunityApply::where('user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        $applyList = $this->turnApplyList($applyList);
        $isMe = 1;
        return view('wx.cardApply',compact('applyList','isMe'));
    }
    /**
     * Approve another user's apply for opportunity and create a payed by vacation card order.
     * @param int $id
     */
    public function applyApprove($id)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('id', $id)->first();
        $result = $this->checkLeftNums($apply, $id);
        if($result)
        {
            $apply->status = 1;
            $apply->save();
            //创建申请的订单


            return redirect('/wx/user/card/apply/list')->with(['msg' => '操作成功']);
        }
        else
        {
          return redirect('/wx/user/card/apply/list')->with(['msg' => '房间剩余数量不足']);
        }
    }
    /**
     * Reject another user's apply for opportunity.
     * @param int $id
     */
    public function applyReject($id)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('id', $id)->first();
        $apply->status = 2;
        $apply->save();
        return redirect('/wx/user/card/apply/list');
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
    /***/
    private function statusToWord($code)
    {
        switch($code)
        {
            case 0: $result = '申请中'; break;
            case 1: $result = '申请通过';break;
            case 2: $result = '申请已被拒绝';break;
        }
        return $result;
    }
    /***/
    private function checkLeftNums($apply,$id)
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
     *
     */
    private function createCasaOrder($userId, $name, $wxCasaId) {
        $order = new Order();

    }
}
