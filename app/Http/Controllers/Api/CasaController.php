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
                $casas = Casa::whereIn('dictionary_id',$areaIds)->get();
            }
        }
        return response()->json($casas);
    }

    public function save(Request $request)
    {
        $areaIds = Area::find($request->city)->casaRecoms;
        $this->reset($areaIds);
        if(!count($areaIds))
        {
            $arealast = Area::where('parentid', $request->city)->where('islast', 1)->get();
            $this->reset($arealast);
        }
        foreach($request->casa as $casa)
        {
            $data = Casa::find($casa);
            $area = $data->area;
            $data->areaRecoms()->save($area);
        }
        return response()->json(['msg'=>'ok']);
    }

//    对area_casa中的进行重置
    public function reset($areaIds)
    {
      foreach($areaIds as $areaId)
      {
          foreach($areaId->casaRecoms as $delId)
          {
              $delId->pivot->delete();
          }
      }
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
