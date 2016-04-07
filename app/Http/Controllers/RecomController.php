<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;

class RecomController extends Controller
{
    public function index()
    {
        $areas = Area::where('level',3)->orwhere('value','上海') ->get();
        return view('backstage.recom',compact('areas'));
    }

    public function update(Request $request)
    {
        if($request->city == '')
        {
            return '至少要选择一个呀';
        }

        $citys = explode(',',$request->city);
//        验证应该转到表单验证里面
//        重置
        Area::where('status',1)->update(['status'=>0]);
        foreach($citys as $city)
        {
            $city = Area::find($city);
            $city->status = 1;
            $city->save();
        }
        return redirect('back/recom');
    }

    public function casa()
    {
        $areas = Area::where('level',3)->orwhere('value','上海') ->get();
        return view('backstage.recomCasa',compact('areas'));
    }

}
