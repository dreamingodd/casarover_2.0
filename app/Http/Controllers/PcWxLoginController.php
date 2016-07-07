<?php

namespace App\Http\Controllers;

use Config;
use App\Common\QrImageGenerator;
use App\Entity\PcLoginRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PcWxLoginController extends Controller
{

    public function login()
    {
        $plr = new PcLoginRequest();
        $plr->save();
        $plr->code = $plr->id . '-' . mt_rand(1000, 9999);
        $plr->save();
        $now = new Carbon();
        $qrFile = public_path() . "/assets/phpqrcode/temp/pclogin_" . $plr->code ."_" . $now->format("Ymd") . ".png";
        $qrPath = env('ROOT_URL') . "/assets/phpqrcode/temp/pclogin_" . $plr->code ."_" . $now->format("Ymd") . ".png";
        QrImageGenerator::generate(env('ROOT_URL') . '/wx/pc-wx-login/option/' . $plr->code, $qrFile);
        return view('pcWxLogin', compact(['qrPath']));
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
    public function approve()
    {

    }
    public function reject()
    {

    }
    public function check()
    {

    }
}
