<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\WechatArticle;
use App\WechatSeries;
use App\Attachment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    private $articles;
    private $series;
    protected $fillable = array('id', 'type', 'name');

    /**
     * 微信公众号-探
     * @param type 文章类型
     * @param series 探庐系列
     */
    public function index($type=2, $series=0) {
        $this->articles = WechatArticle::where('type', $type)
                                       ->where('series', $series)
                                       ->where('deleted', 0)
                                       ->orderBy('id', 'desc')->get();
        $this->series = WechatSeries::all();
        return view('site.wechat', ['wechatArticles' => $this->articles, 'wechatSeries' => $this->series]);
    }

    public function wechatList($type, $deleted=0) {
        $this->articles = WechatArticle::where('type', $type)->where('deleted', $deleted)->get();
        if ($deleted == '1') {
            $this->articles = WechatArticle::where('deleted', $deleted)->get();
        }
        return view('backstage.wechatArticleList', ['wechatArticles' => $this->articles]);
    }
    public function del($id, $deleted) {
        $article = WechatArticle::find($id);
        $article->deleted = $deleted;
        $article->save();
        $deleted = $deleted == 0 ? 1 : 0;
        $this->wechatList(1, $deleted);
        return view('backstage.wechatArticleList', ['wechatArticles' => $this->articles]);
    }
    public function wechatEdit($id=0) {
        $article = new WechatArticle;
        if ($id != 0) {
            $article = WechatArticle::find($id);
        }
        $wechatSeries = wechatSeries::all();
        return view('backstage.wechatArticleEdit', compact('article', 'wechatSeries'));
    }
    public function wechatEdits($id=0,Requests\wechatArticleEditRequset$request) {
        $save=$request->all();
       if($id!=0){
           $article = WechatArticle::find($id);
           $attachment= $article->attachment;
           $attachment->filepath=$save['filepath'];
           $attachment->save();
           $article->type=$save['type'];
           $article->series=$save['series'];
           $article->address=$save['address'];
           $article->title=$save['title'];
           $article->brief=$save['brief'];
           $article->attachment_id=$attachment->id;
           $article->save();
       }
        else {
            Attachment::create(['filepath' => $save['filepath']]);
            $attachment= Attachment::all()->last()->id;
            WechatArticle::insert(['address' =>$save['address'],'title'=>$save['title'],'brief'=>$save['brief'],
                'attachment_id'=>$attachment]);
        }
        return view('backstage.sucess',['type'=>1,'id'=>$id]);
//        return redirect('back/wechatEdit/'.$id);
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
     public function wechatSeriesEdits(Requests\wechatSeriesEditRequset $request) {
             wechatSeries::insert(['type' => '1', 'name' => $request->name]);
             return view('backstage.sucess',['type'=>1,'id'=>0]);
     }
    public function book(){
        return view('wechat.book');
    }

}
