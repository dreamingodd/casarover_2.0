<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxRoom;

class WxSiteController extends Controller
{
    public function index() {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        foreach ($wxCasas as $casa) {
            $this->convertToViewCasa($casa);
        }
        return view('wx.wxIndex', compact('wxCasas'));
    }

    public function casa($id) {
        return view('wx.wxCasaDetail');
    }

    public function user() {
        return view('wx.wxUser');
    }

    public function order() {
        return view('wx.wxPay');
    }

    private function convertToViewCasa(WxCasa $casa) {
        $casa->cheapestPrice = DB::table('wx_room')->where('wx_casa_id', $casa->id)->min('price');
        if (empty($casa->casa_id)) {
            $casa->thumbnail = $casa->attachment->filepath;
        } else {
            $casa->thumbnail = $casa->casa->attachment->filepath;
        }
    }
}
