<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;
use App\Casa;
use App\Option;

class SlideController extends Controller
{
    // home page slide
    public function slide()
    {
        $slides = Option::where('type',1)->get();
        $type =1;
        return view('backstage.slide',compact('slides','type'));
    }
    // slide for allcasa page
    public function areaSlide()
    {
        $slides = Option::where('type',2)->get();
        $type=2;
        return view('backstage.slide',compact('slides','type'));
    }

    public function create($type)
    {
        $casas = Casa::all();
        return view('backstage.slideEdit',compact('casas','type'));
    }

    public function store(Request $request)
    {
        if(($request->id != '' ))
        {
            return $this->update($request);
        }
        $slide = new Option;
        $slide->title = $request->title;
        $slide->brief = $request->brief;
        $slide->casa_id = $request->casa;
        $slide->type = $request->type;
        $pic = new \App\Attachment(['filepath' => $request->photo]);
        $pic = $slide->attachment()->save($pic);
        $slide->attachment_id = $pic->id;
        $slide->save();
        return $this->switchslide($request->type);
    }

    public function edit($id)
    {
        $slide = Option::find($id);
        $casas = Casa::all();
        return view('backstage.slideEdit',compact('slide','casas'));
    }

    public function update($request)
    {
        $slide = Option::find($request->id);
        $slide->title = $request->title;
        $slide->brief = $request->brief;
        $slide->casa_id = $request->casa;
        $pic = new \App\Attachment(['filepath' => $request->photo]);
        $slide->attachment()->delete();
        $pic = $slide->attachment()->save($pic);
        $slide->attachment_id = $pic->id;
        $slide->save();
        return $this->switchslide($slide->type);
    }

    public function del(Request $request)
    {
        Option::destroy($request->id);
        return $this->switchslide($request->type);
    }

    private function switchslide($type)
    {
        $backurl = $type == 1? '/back/slide':'/back/areaslide';
        return redirect($backurl);
    }
}
