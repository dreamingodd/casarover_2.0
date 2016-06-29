<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;
use App\Casa;
use DB;

class RecomController extends Controller
{
    public function index()
    {
        $areas = Area::where('level',3)->whereNotIn('value', ['朱家角','黄浦区','其他'])->orwhere('value','上海') ->get();
        return view('backstage.recom',compact('areas'));
    }

    public function update(Request $request)
    {
        if($request->city == '')
        {
            return '至少要选择一个呀';
        }
        $citys = explode(',',$request->city);
        // reset
        Area::where('status',1)->update(['status'=>0]);
        foreach($citys as $city)
        {
            $city = Area::find($city);
            $city->status = 1;
            $city->save();
        }
        return redirect('back/recom');
    }

    //set recom casa for every city
    public function casa()
    {
        $areas = Area::where('level',3)->whereNotIn('value', ['朱家角','黄浦区','其他'])->orwhere('value','上海') ->get();
        return view('backstage.recomCasa',compact('areas'));
    }
    //update recom casa belong city
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
    private function reset($areaIds)
    {
        foreach($areaIds as $areaId)
        {
            foreach($areaId->casaRecoms as $delId)
            {
                $delId->pivot->delete();
            }
        }
    }
}
