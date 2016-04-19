<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WechatArticle;
use App\Http\Requests;
use App\Casa;
use App\Area;
use App\Option;
use App\Theme;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $casas = Option::all();
        foreach($casas as $casa)
        {
            $casa->pic = config('casarover.photo_folder').$casa->attachment->filepath;
        }
        $citys = Area::where('status',1)->get();

        $theme = Theme::where('status',1)->get();
        $themeNum = count($theme);
        $status = $themeNum >2 ? true:false;
        if(strpos($request->url(), 'mobile'))
            return  view('mobile.home',compact('casas','citys','status'));
        else
            return view('site.home',compact('casas','citys','status'));
    }

    public function slide()
    {
        $slides = Option::all();
        return view('backstage.slide',compact('slides'));
    }

    public function create()
    {
        $casas = Casa::all();
        return view('backstage.slideEdit',compact('casas'));
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
        $pic = new \App\Attachment(['filepath' => $request->photo]);
        $pic = $slide->attachment()->save($pic);
        $slide->attachment_id = $pic->id;
        $slide->save();
        return redirect('back/slide');
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
        return redirect('back/slide');
    }

    public function del(Request $request)
    {
        Option::destroy($request->id);
        return redirect('back/slide');
    }
}
