<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Entity\Wx\WxCasa;

class WxCasaController extends Controller
{
    public function showList() {
        $wxCasas = WxCasa::all();
        return view('wx.wxIndex', compact('wxCasas'));
    }
    public function show() {

    }
    public function edit() {

    }
}
