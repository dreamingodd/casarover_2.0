<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Casa;
use App\Area;
use App\WechatSeries;
use App\WechatArticle;
use App\Theme;
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
    //主题推荐
    public function getThemes()
    {
        $themes = Theme::where('status',1)->take(6)->get();
        foreach($themes as $theme)
        {
            $theme->pic = config('casarover.image_folder').$theme->attachment->filepath;
        }
        return response()->json($themes);
    }
    //探庐系列
    public function getSeries()
    {
        $series = WechatSeries::where('status',1)->take(6)->get();
        foreach($series as $serie)
        {
            $serie->pic = config('casarover.image_folder').$serie->thumbnail->filepath;
        }
        return response()->json($series);
    }
}
