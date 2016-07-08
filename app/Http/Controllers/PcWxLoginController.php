<?php

namespace App\Http\Controllers;

use Log;
use Config;
use stdClass;
use Session;
use App\Common\QrImageGenerator;
use App\Entity\PcLoginRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PcWxLoginController extends Controller
{

    public function login(Request $request)
    {
        $plr = new PcLoginRequest();
        $plr->redirect_url = "/" . $request->redirect_url;
        $plr->save();
        $plr->code = $plr->id . '-' . mt_rand(1000, 9999);
        $plr->save();
        $now = new Carbon();
        $qrFile = public_path() . "/assets/phpqrcode/temp/pclogin_" . $plr->code ."_" . $now->format("Ymd") . ".png";
        $qrPath = env('ROOT_URL') . "/assets/phpqrcode/temp/pclogin_" . $plr->code ."_" . $now->format("Ymd") . ".png";
        QrImageGenerator::generate(env('ROOT_URL') . '/wx/pc-wx-login/option/' . $plr->code, $qrFile);
        return view('pcWxLogin', compact(['qrPath', 'plr']));
    }
    public function option($code)
    {
        $plr = PcLoginRequest::where('code', $code)->first();
        if ($plr) {
            $time = $plr->created_at;
            $now = new Carbon();
            if ($now->timestamp - $time->timestamp >= Config::get('casarover.pc_wx_expire_duration')) {
                $plr = null;
            }
        }
        return view('pcWxLoginOption', compact(['plr']));
    }

    /** User click confirm */
    public function approve($code)
    {
        $plr = PcLoginRequest::where('code', $code)->first();
        if ($plr) {
            $plr->status = PcLoginRequest::STATUS_APPROVED;
            $plr->user_id = Session::get('user_id');
            $plr->save();
            return view('pcWxLoginOption', compact(['plr']));
        } else {
            return "<h1>登录请求查找失败！</h1>";
        }
    }

    /** User click cancel */
    public function reject($code)
    {
        $plr = PcLoginRequest::where('code', $code)->first();
        if ($plr) {
            $plr->status = PcLoginRequest::STATUS_REJECTED;
            $plr->save();
            return view('pcWxLoginOption', compact(['plr']));
        } else {
            return "<h1>登录请求查找失败！</h1>";
        }
    }

    /** Loop check request status,  */
    public function check($code)
    {
        $plr = PcLoginRequest::where('code', $code)->first();
        if ($plr) {
            $data = new stdClass();
            $now = new Carbon();
            while ($now->timestamp - $plr->created_at->timestamp < Config::get('casarover.pc_wx_expire_duration')) {
                $plr = PcLoginRequest::where('code', $code)->first();
                if ($plr->status == PcLoginRequest::STATUS_APPROVED) {
                    // Actual Login action takes place.
                    Session::put('user_id', $plr->user_id);
                    Session::save();
                    $data->msg = "approved";
                    $data->redirect_url = urlencode($plr->redirect_url);
                    return response()->json($data);
                } else if ($plr->status == PcLoginRequest::STATUS_REJECTED) {
                    $data->msg = "rejected";
                    return response()->json($data);
                }
                sleep(2);
                // Refresh now.
                $now = new Carbon();
            }
            Log::info("timeout");
            $data->msg = "timeout";
            return response()->json($data);
        } else {
            return "<h1>登录请求查找失败！</h1>";
        }
    }
}
