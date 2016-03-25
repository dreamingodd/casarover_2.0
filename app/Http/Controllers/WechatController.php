<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WechatArticle;
use App\WechatSeries;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    private $articles;
    private $series; 
    public function wechatList($type, $deleted=0) {
        $this->articles = WechatArticle::where('type', $type)->where('deleted', $deleted)->get();
        if($deleted == '1')
        $this->articles = WechatArticle::where('deleted', $deleted)->get();
        return view('backstage.wechatArticleList', ['wechatArticles' => $this->articles]);
    }
    public function del($id, $deleted) {
        $article = WechatArticle::find($id);
        $article->deleted = $deleted;
        $article->save();
        $deleted = $deleted==0?1:0;
        $this->wechatList(1, $deleted);
        return view('backstage.wechatArticleList', ['wechatArticles' => $this->articles]);
    } 
    public function wechatEdit($id=0) {
        $this->series = wechatSeries::all();
        $article = WechatArticle::find($id);
        if($id==0)
        return view('backstage.wechatArticleEdit',['wechatSeries' => $this->series]);
        else 
        return view('backstage.wechatArticleEdit',['wechatArticles' => $this->articles,'wechatSeries' => $this->series]);
    }
    public function participateList() {
         return view('backstage.participateList');
     }
 	public function wechatSeriesList() {
        $this->series = wechatSeries::all();
         return view('backstage.wechatSeriesList',['wechatSeries' => $this->series]);
     }
	public function wechatSeriesEdit() {
         return view('backstage.wechatSeriesEdit');
     }
     public function asd()
     {
         $results =   WechatArticle::where('deleted',1)->get();
         dd($results);
     }

}