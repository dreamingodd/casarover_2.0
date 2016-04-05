<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Casa;

class CasaController extends Controller
{
    public function getCasasById($cityid=8)
    {
        $area = Area::find($cityid);
        $casas = $area->casas;
        if(!count($casas))
        {
            $arealast = Area::where('parentid',$cityid)->where('islast',1)->get();
            if(count($arealast))
            {
                $areaIds = array();
                foreach($arealast as $area)
                {
                    array_push($areaIds,$area->id);
                }
                $casas = Casa::whereIn('dictionary_id',$areaIds)->get();
            }
        }
        return response()->json($casas);
    }
}
