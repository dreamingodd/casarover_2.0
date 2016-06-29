<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Casa;
use DB;

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
                $casas = Casa::whereIn('dictionary_id',$areaIds)->where('deleted',0)->get();
            }
        }
        return response()->json($casas);
    }
    /**
     * Get (just) id, code, name of all of the casas.
     */
    public function getSlimCasas() {
        $slimCasas = DB::table('casa')->select('id', 'code', 'name')->get();
        usort($slimCasas, 'App\Common\CommonTools::sortCasaCode');
        return response()->json($slimCasas);
    }

//    民宿大全部分
}
