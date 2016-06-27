<?php

namespace App\Http\Controllers\Mall;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\OrderItem;
use Session;
use App\Entity\User;
use App\Entity\OpportunityApply;
use App\Entity\VacationCard;


class VacationOpportunityController extends Controller
{
    //enter card number
    public function cardEntry()
    {
        return view('wx.cardEntry');
    }
    /**
    * check card number
    */
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
    // book page
    public function book($id)
    {
        $casa = OrderItem::find($id);
        //如果是本人进入这个页面，显示为提交，value == 1
        $loginUserId = Session::get('user_id');
        //test
        $loginUserId =3;
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
          //跳转到我的申请列表
          return redirect('/wx/user/card/myapply/list')->with(['msg' => '申请已提交']);
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
    //我的申请列表
    public function myCardApplyList()
    {
        $applyList = $applyList = OpportunityApply::where('user_id',Session::get('user_id'))->orderBy('id','desc')->get();
        $applyList = $this->turnApplyList($applyList);
        $isMe = 1;
        return view('wx.cardApply',compact('applyList','isMe'));
    }
    //对信息进行转换
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

    public function applyAgree($id)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('id',$id)->first();
        $result = $this->checkLeftNums($apply,$id);
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
    //拒绝申请
    public function applyRefuse($id)
    {
        $apply = OpportunityApply::where('user_id',Session::get('user_id'))->where('id',$id)->first();
        $apply->status = 2;
        $apply->save();
        return redirect('/wx/user/card/apply/list');
    }
}
