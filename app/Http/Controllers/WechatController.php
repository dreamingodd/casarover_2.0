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
        $this->series = WechatSeries::all();
        $article = WechatArticle::find($id);
        $seriesID=0;
        if ($id!=0){
            if($article->type==1){
                $fname='探庐系列';
                $fid = 1;
                //解决系列名字删除不能正常显示的问题
                $sname= WechatSeries::find($article->series) == null? '暂无':WechatSeries::find($article->series)->name;
                $seriesID=WechatSeries::find($article->series) == null? 0:WechatSeries::find($article->series)->id;
            }
            else if($article->type==2){
                $fname='民宿推荐';
                $fid = 2;
                $sname='';
            }
            else if($article->type==3){
                $fname='主题民宿';
                $fid = 3;
                $sname='';
            }
            $filepath=Attachment::find($article->attachment_id)->filepath;
            $wechatadd=$article->address;
            $title=$article->title;
            $brief=$article->brief;
        }
        if($id == 0){
            return view('backstage.wechatArticleEdit',['id'=>0,'wechatSeries' => $this->series,'fname'=>'一级标签','sname'=>'二级标签','wechatadd'=>'','title'=>'','brief'=>'','seriesID'=>0]);
        }
        else
        {
            return view('backstage.wechatArticleEdit',['id'=>$id,'wechatSeries' => $this->series,'fid'=>$fid,'fname'=>$fname,'sname'=>$sname,'wechatadd'=>$wechatadd,'title'=>$title,'brief'=>$brief,'filepath'=>$filepath,'seriesID'=>$seriesID]);
        }
    }
    public function wechatEdits($id=0,Requests\wechatArticleEditRequset $request) {
        $save=$request->all();
        $type = $save['type'];
        if($id!=0){
            $article = WechatArticle::find($id);
            $attachment= Attachment::where('id',$article->attachment_id)->first();
            $attachment->filepath=$save['filepath'];
            $attachment->save();
            $article->type=$type;
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
            $article = new WechatArticle;
            $article->type=$type;
            $article->series=$save['series'];
            $article->address = $save['address'];
            $article->title = $save['title'];
            $article->brief = $save['brief'];
            $article->attachment_id = $attachment;
            $article->save();
//            WechatArticle::insert(['address' =>$save['address'],'title'=>$save['title'],'brief'=>$save['brief'],'attachment_id'=>$attachment]);
        }
        return view('backstage.sucess',['type'=>1,'id'=>$id]);
//        return redirect('back/wechatEdit/'.$id);
    }
    public function participateList() {
        return view('backstage.participateList');
    }
    public function wechatSeriesList() {
        $this->series = WechatSeries::all();
        return view('backstage.wechatSeriesList',['wechatSeries' => $this->series]);
    }
    public function wechatSeriesCreate()
    {
        return view('backstage.wechatSeriesEdit');
    }
    public function wechatSeriesEdit($id) {
        $series = WechatSeries::find($id);
        return view('backstage.wechatSeriesEdit',compact('series'));
    }
    public function wechatSeriesStore(Request $request)
    {
        if($request->id != "")
        {
            return $this->wechatSeriesUpdate($request);
        }
        $wechatSerie = new WechatSeries();
        $wechatSerie->type = 1;
        $wechatSerie->name = $request->name;
        $wechatSerie->brief = $request->brief;
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $thumbnail = new \App\Attachment(['filepath' => $request->thumbnail]);
        $wechatSerie->thumbnail()->save($thumbnail);
        $wechatSerie->attachment()->save($pic);
        $wechatSerie->attachment_id = $pic->id;
        $wechatSerie->thumb_id = $thumbnail->id;
        $wechatSerie->save();
        return redirect('back/wechatSeriesList');
    }
    public function wechatSeriesUpdate($request)
    {
        $wechatSerie = WechatSeries::find($request->id);
        $wechatSerie->type = 1;
        $wechatSerie->name = $request->name;
        $wechatSerie->brief = $request->brief;
        $pic = new \App\Attachment(['filepath' => $request->pic]);
        $thumbnail = new \App\Attachment(['filepath' => $request->thumbnail]);
        $wechatSerie->thumbnail()->delete();
        $wechatSerie->thumbnail()->save($thumbnail);
        $wechatSerie->attachment()->delete();
        $wechatSerie->attachment()->save($pic);
        $wechatSerie->attachment_id = $pic->id;
        $wechatSerie->thumb_id = $thumbnail->id;
        $wechatSerie->save();
        return redirect('back/wechatSeriesList');
    }

    public function wechatSeriesDel(Request $request)
    {
        $content = WechatSeries::find($request->id);
        $content->delete();
        return redirect('back/wechatSeriesList');
    }

}
