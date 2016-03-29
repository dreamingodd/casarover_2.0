<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('level',4)->get();
        return view('backstage.area',compact('areas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $areaId = $id;
        return view('site.area',compact('areaId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Area::find($id);
        return view('backstage.areaEdit',compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 区域的简介是没有图片的所以先进行存储
     * 之后的攻略和head-img进行绑定
     * 下面的景点介绍是一张图片一个content相应的进行绑定
     */
    public function update(Request $request,$id)
    {
        $area = Area::findOrFail($id);
        $photoArr = explode(';',$request->photos);
        if(count($photoArr) < 5)
        {
            abort(404,'图片数量不足');
        }
        array_unshift($photoArr,'123');
        $area->contents()->delete();
        for($i=0;$i<5;$i++)
        {
            $key = 'content'.$i;
            $content = new \App\Content(['text' => $request->$key]);
            $area->contents()->save($content);
        }
        for($i=1;$i< 5;$i++)
        {
            $pic = new \App\Attachment(['filepath' => $photoArr[$i]]);
            $area->contents[$i]->attachments()->delete();
            $area->contents[$i]->attachments()->save($pic);
        }
        $area->value = $request->name;
        $area->position = $request->position;
        $area->tier = $request->tier;
        $area->save();
        return redirect()->route('back.areas.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return $id;
    }
}
