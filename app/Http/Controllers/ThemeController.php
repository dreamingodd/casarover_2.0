<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Theme;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::where('status',1)->get();
        return view('backstage.theme',compact('themes'));
    }

    public function show($id)
    {
        abort(503,'this is');
    }
    public function create()
    {
        return view('backstage.themeEdit');
    }

    public function store(Request $request)
    {
      if($request->id != "")
      {
       return $this->update($request);
      }
        $theme = new Theme;
        $theme->name = $request->name;
        $theme->brief = $request->brief;
        $theme->status = 1;
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $theme->attachment()->save($pic);
        $theme->attachment_id = $pic->id;
        $theme->save();
        return redirect('back/theme');
    }

    public function update($request)
    {
        $theme = Theme::find($request->id);
        $theme->name = $request->name;
        $theme->brief = $request->brief;
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $theme->attachment()->delete();
        $theme->attachment()->save($pic);
        $theme->attachment_id = $pic->id;
        $theme->save();
        return redirect('back/theme');
    }
//    后台编辑
    public function edit($id)
    {
        $theme = Theme::find($id);
        return view('backstage.themeEdit',compact('theme'));
    }

    public function del(Request $request)
    {
        $theme = Theme::find($request->id);
        $theme->status=0;
        $theme->save();
        return redirect('back/theme');
    }

    public function articleEdit()
    {
        return view('backstage.themeArticleEdit');
    }

}
