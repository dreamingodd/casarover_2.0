<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Casa;
use App\Area;
use App;

class HomeController extends Controller
{
    //首页民宿推荐内容
    public function getCasasByCityId($cityid)
    {
        $area = Area::find($cityid);
        $casas = $area->casaRecoms;
        if(!count($casas))
        {
            $arealast = Area::where('parentid',$cityid)->where('islast',1)->get();
            if(count($arealast))
            {
                $reconId = array();
                foreach($arealast as $area)
                {
                    foreach(Area::find($area->id)->casaRecoms as $area)
                    {
                        array_push($reconId,$area->pivot->casa_id);
                    }
                }
                $casas = Casa::whereIn('id',$reconId)->get();
            }
        }
        foreach($casas as $casa)
        {
            $casa->pic = config('casarover.photo_folder').$casa->attachment->filepath;
            $casa->brief = $casa->contents[0]->text;
        }
        return response()->json($casas);
    }
}
