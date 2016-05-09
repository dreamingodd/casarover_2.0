<?php

namespace App\Http\Controllers\Wx;

use Log;
use Session;
use Exception;
use App\Entity\Wx\WxBind;
use App\Entity\Wx\WxUser;
use App\Entity\Wx\WxOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * This class is userd to bind the relationship between the merchant and their casa.
 */
class WxBindController extends Controller
{

    public function index() {
        $userId = Session::get('wx_user_id');
        $user = WxUser::find($userId);
        $wxBind = $user->wxBind();
        if (empty($wxBind)) {
            // 未申请
            return view('wx.bindApply', compact('user'));
        } elseif ($wxBind->status == WxBind::BIND_STATUS_APPLYING) {
            // 审核中
            return view('wx.bindWait');
        } elseif ($wxBind->status == WxBind::BIND_STATUS_COMFIRMED) {
            // 管理订单
            $wxCasaId = $wxBind->wx_casa_id;
            // Gets all payed orders.
            $orders = WxOrder::where('wx_casa_id', $wxCasaId)
                            ->where('pay_status', WxOrder::PAY_STATUS_YES)
                            ->orderBy('id', 'desc')->get();
            return view('wx.merchant');
        }
        Log::error("Error: Unpredicted condition!");
        return "Error: Unpredicted condition!";
    }

    public function apply(Request $request) {
        try {
            // update user.
            $userId = $request->input('userId');
            $user = WxUser::find($userId);
            $user->realname = $request->input('realname');
            $user->cellphone = $request->input('cellphone');
            $user->save();
            // insert a bind object.
            $wxBind = new WxBind();
            $wxBind->wx_user_id = $userId;
            $wxBind->casa_name = $request->input('casaName');
            $wxBind->status = WxBind::STATUS_APPLYING;
            $wxBind->save();
            return view('wx.bindWait');
        } catch (Exception $e) {
            Log::error($e);
            return "<p style='font-size: 100px;'>System Error!</p>";
        }
    }

    /** The followings are backstage related. ********************************/
    public function bindList() {
        $wxBinds = WxBind::orderBy("id", "desc")->get();
        // dd($wxBinds->first()->wxUser);
        return view('backstage.wxBindList', compact('wxBinds'));
    }

    public function bind($userId, $casaId) {

    }
    /** The Above are backstage related. *************************************/
}
