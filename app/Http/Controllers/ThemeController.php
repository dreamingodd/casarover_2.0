<?php

namespace App\Http\Controllers;

use App\Casa;
use App\Content;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Theme;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all()->sortByDesc('id');
        return view('backstage.theme',compact('themes'));
    }

    public function show($id,Request $request)
    {
        $theme = Theme::find($id);
        $others = Theme::whereNotIn('id',[$id])->orderBy('id','asc')->where('status',1)->get();
        $contents = $theme->contents()->orderBy('display_order','asc')->get();
        foreach($others as $otherTheme)
        {
            $otherTheme->pic = config('config.image_folder').$otherTheme->attachment->filepath;
        }
        return view('site.theme',compact('theme','contents','others'));
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
        $theme->status = 0;
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
    //后台编辑
    public function edit($id)
    {
        $theme = Theme::find($id);
        return view('backstage.themeEdit',compact('theme'));
    }

    public function del(Request $request)
    {
        $theme = Theme::find($request->id);
        $theme->delete();
        return redirect('back/theme');
    }
    //主题文章
    public function article()
    {
        $themes = Theme::all();
        return view('backstage.themeArticle',compact('themes'));
    }

    public function articleCreate()
    {
        $themes = Theme::all();
        $casas = Casa::all();
        return view('backstage.themeArticleEdit',compact('themes','casas'));
    }

    public function articleStore(Request $request)
    {
        if(!isset($request->casa))
        {
            $request->casa = null;
        }
        if($request->id != "")
        {
            return $this->articleUpdate($request);
        }
        $theme = Theme::find($request->theme);
        $contentData = ['name' => $request->name,'text' => $request->text,'house' => $request->casa,'display_order'=>$request->order];
        $content = new \App\Content($contentData);
        $newContent = $theme->contents()->save($content);
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $newContent->attachments()->save($pic);
        return redirect('back/theme/article');
    }

    public function articleUpdate($request)
    {
        $theme = Theme::find($request->theme);
        $contentData = ['name' => $request->name,'text' => $request->text,'house' => $request->casa,'display_order'=>$request->order];
        $content = new \App\Content($contentData);
        $beforecontent = Content::find($request->id);
        $beforecontent->delete();
        $newContent = $theme->contents()->save($content);
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $newContent->attachments()->save($pic);
        return redirect('back/theme/article');
    }
    public function articleEdit($id)
    {
        $themes = Theme::where('status',1)->get();
        $article = Content::find($id);
        //这个应该变成vue去处理
        $casas = Casa::all();
        $casa = Casa::find($article->house);
        return view('backstage.themeArticleEdit',compact('themes','article','casas','casa'));
    }

    public function articleDel(Request $request)
    {
        $content = Content::find($request->id);
        $content->delete();
        return redirect('back/theme/article');
    }

}
