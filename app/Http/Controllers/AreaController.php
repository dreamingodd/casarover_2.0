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
     */
    public function update(Request $request,$id)
    {
//        $img = ['filepath' => 'casa_123.png'];
//        $area = Area::findOrFail($id)->contents[2]->attachments[0]->update($img);
//        return response()->json($area);
        $text = new \App\Content(['text' => $request->brief]);
//        $text = ['text' => $request->brief];
////        $img = new \App\Attachment(['filepath' => 'casa_123123.png']);
//        $img = ['filepath' => 'casa_123.png'];
        $area = Area::findOrFail($id);
        $area->value = $request->name;
        $area->position = $request->position;
        $area->tier = $request->tier;
////        dd($img);
        $area->contents()->save($text);
//        $area->attachment()->update($img);
//
//        $area->contents()->update($text);
        return redirect()
            ->route('back.areas.index');
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
