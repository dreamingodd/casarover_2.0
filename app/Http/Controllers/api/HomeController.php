<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //首页民宿推荐内容
    public function getCasasByCityId($cityid = 1)
    {
//        测试数据
        $id = time();
        $pic = 'assets/images/fang.png';
        $name = time();
        $brief = '这个是简介内容';
        $the = compact('id','pic','name','name','brief');
        $casas = ['casas'=>[$the,$the]];
        return response()->json($casas);
    }
}
