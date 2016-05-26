<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use DB;

class ActivityController extends Controller
{
    public function index()
    {
        $data = WxCasa::where('activ',1)->get();
        foreach ($data as $casa) {
            $this->convertToViewCasa($casa);
        }
        return view('activity.index',compact('data'));
    }
    private function convertToViewCasa(WxCasa $casa)
    {
        $casa->cheapestPrice = DB::table('wx_room')->where('wx_casa_id', $casa->id)->min('price');
        if (empty($casa->casa_id)) {
            if (!empty($casa->attachment->filepath)) {
                $casa->thumbnail = $casa->attachment->filepath;
            }
        } else {
            if (!empty($casa->casa->attachment->filepath)) {
                $casa->thumbnail = $casa->casa->attachment->filepath;
            }
        }
    }

    public function show($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('activity.casa',compact('wxCasa'));
    }

    public function person()
    {
        return view('activity.person');
    }

    public function rank($id=0)
    {
        return view('activity.rank');
    }

    public function datesleep()
    {
        return view('activity.datesleep');
    }

    //后台活动index
    public function selcasas()
    {
        $casas = WxCasa::all();
        return view('backstage.selCasas',compact('casas'));
    }
    //已选择列表
    public function sellist()
    {
        $data = WxCasa::where('activ',1)->get();
        return response()->json($data);
    }
    //后台添加
    public function add($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = 1;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }
    //后台删除
    public function del($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = null;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }

}
