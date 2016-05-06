<?php

namespace App\Http\Controllers\Wx;


use DB;
use Session;
use App\Entity\Wx\WxUser;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxOrder;

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
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('wx.wxCasaDetail', compact('wxCasa'));
    }

    public function user()
    {
        $wxUser = WxUser::find(Session::get('wx_user_id'));
        $orders = WxOrder::where('wx_user_id', Session::get('wx_user_id'))->orderBy('id', 'desc')->get();
        return view('wx.wxUser', compact('orders', 'wxUser'));
    }

    public function order($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxUser = WxUser::find(Session::get('wx_user_id'));
        return view('wx.wxOrder', compact('wxCasa', 'wxUser'));
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
