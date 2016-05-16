<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Casa;
class AllCasaController extends Controller
{
    //选择条件下面的联动
    public function getAreasByCityId($id)
    {
        $areas = Area::where('parentid',$id)->get();
        foreach($areas as $area)
        {
            if(!empty($area->contents[1]))
            {
                if(!empty($area->contents[1]->attachments[0]))
                {
                    $area->mess = $area->contents[1]->text;
                    $area->pic = config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath;
                }
            }
        }
        return response()->json($areas);
    }
    //默认城市是7代表杭州
    public function getCasas($city=7,$areas=0)
    {
        //        如果没有传入区域的值，那么就直接显示城市下面的所有民宿
        if(!$areas)
        {
            $arealast = Area::where('parentid',$city)->where('islast',1)->get();
            if(count($arealast))
            {
                $areaIds = array();
                foreach($arealast as $area)
                {
                    array_push($areaIds,$area->id);
                }
                $casas = Casa::whereIn('dictionary_id',$areaIds)->simplePaginate(6);
                foreach($casas as $casa)
                {
                    if($casa->attachment)
                    {
                        $casa->pic = config('casarover.photo_folder').$casa->attachment->filepath;
                    }
                    if(isset($casa->tags[0]))
                    {
                        $casa->tip = $casa->tags[0]->name;
                    }
                    else
                    {
                        $casa->tip = '民宿';
                    }
                }
            }
        }
        else
        {
            //如果已经传入了区域那么就可以直接查询结果
            $areaIds = explode(',',$areas);
            $casas = Casa::whereIn('dictionary_id',$areaIds)->simplePaginate(6);
            foreach($casas as $casa)
            {
                if($casa->attachment)
                {
                    $casa->pic = config('casarover.photo_folder').$casa->attachment->filepath;
                }
                if(isset($casa->tags[0]))
                {
                    $casa->tip = $casa->tags[0]->name;
                }
                else
                {
                    $casa->tip = '民宿';
                }
            }
        }
        return response()->json($casas);
    }

}
