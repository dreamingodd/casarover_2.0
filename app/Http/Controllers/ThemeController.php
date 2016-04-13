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
        $theme = Theme::find($id);
        $others = Theme::whereNotIn('id',[$id])->get();
        return view('site.theme',compact('theme','others'));
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
    //主题文章
    public function article()
    {
        $themes = Theme::where('status',1)->get();
        return view('backstage.themeArticle',compact('themes'));
    }

    public function articleCreate()
    {
        $themes = Theme::where('status',1)->get();
        return view('backstage.themeArticleEdit',compact('themes'));
    }

    public function articleStore(Request $request)
    {
        $theme = Theme::find($request->theme);
        $content = new \App\Content(['name' => $request->name,'text' => $request->text]);
        $theme->contents()->save($content);
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $theme->contents[0]->attachments()->save($pic);
        dd($request);
    }
    public function articleEdit($id)
    {
        $theme = Theme::find($id);
//        $theme
        return view('backstage.themeArticleEdit');
    }

}
