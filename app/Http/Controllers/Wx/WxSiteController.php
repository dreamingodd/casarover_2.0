<?php

namespace App\Http\Controllers\Wx;


use DB;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxUser;

class WxSiteController extends Controller
{
    public function index()
    {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        foreach ($wxCasas as $casa) {
            $this->convertToViewCasa($casa);
        }
        return view('wx.wxIndex', compact('wxCasas'));
    }

    public function casa($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        return view('wx.wxCasaDetail', compact('wxCasa'));
    }

    public function user()
    {
        return view('wx.wxUser');
    }

    public function order($id)
    {
        $wxCasa = WxCasa::find($id);
        return view('wx.wxOrder', compact('wxCasa'));
    }

    private function convertToViewCasa(WxCasa $casa)
    {
        $casa->cheapestPrice = DB::table('wx_room')->where('wx_casa_id', $casa->id)->min('price');
        if (empty($casa->casa_id)) {
            $casa->thumbnail = $casa->attachment->filepath;
        } else {
            $casa->thumbnail = $casa->casa->attachment->filepath;
        }
    }
    public function orderdetails()
    {
        return view('wx.wxOrderDetail');
    }
    public function confirm()
    {
        return view('wx.wxConfirm');
    }
    public function bill()
{
    return view('wx.wxBill');
}
}
