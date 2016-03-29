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
    protected $fillable = array('id', 'type', 'name');
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
        if ($id!=0){    
            if($article->type==1){
                $fname='探庐系列';
                $sname=wechatSeries::find($article->series)->name; 
            }
            else if($article->type==2){
                $fname='民宿推荐';
                $sname='';
            }
            else if($article->type==3){
                $fname='主题民宿';
                $sname='';
            }
            $wechatadd=$article->address;
            $title=$article->title;
            $brief=$article->brief;
        }
        if($id==0)
        return view('backstage.wechatArticleEdit',['wechatSeries' => $this->series,'fname'=>'一级标签','sname'=>'二级标签','wechatadd'=>'','title'=>'','brief'=>'']);
        else 
        return view('backstage.wechatArticleEdit',['article' => $article,'wechatSeries' => $this->series,'fname'=>$fname,'sname'=>$sname,'wechatadd'=>$wechatadd,'title'=>$title,'brief'=>$brief]);
    }
    public function wechatEdits($id=0) {
        return 0;
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
     public function wechatSeriesEdits(Requests\FormRequest $request) {
         $repeat=wechatSeries::where('name', $request->name)->first();
         if($repeat==null) {
             wechatSeries::insert(['type' => '1', 'name' => $request->name]);
             return redirect('back/wechatSeriesList');
         }
     }

}