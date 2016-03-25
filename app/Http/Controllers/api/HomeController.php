<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Casa;
use App\Area;

class HomeController extends Controller
{
    //首页民宿推荐内容
    public function getCasasByCityId($cityid)
    {
        $area = Area::find($cityid);
        $casas = $area->casas;
        return response()->json($casas);
    }
}
