<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //首页民宿推荐内容
    public function getCasasByCityId($cityid)
    {
//        测试数据
        $id = $cityid;
        $pic = 'assets/images/fang.png';
        $name = $cityid;
        $brief = '这个是简介内容';
        $the = compact('id','pic','name','name','brief');
        $casas = [$the,$the,$the,$the,$the,$the];
        return response()->json($casas);
    }
}
