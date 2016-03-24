<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WechatArticle;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function wechatList($type, $deleted=0) {
        $articles = WechatArticle::where('type', $type)->where('deleted', $deleted)->get();
        if($deleted == '1')
        $articles = WechatArticle::where('deleted', $deleted)->get();
        return view('backstage.wechatArticleList', ['wechatArticles' => $articles]);
    }
     public function wechatEdit() {
        return view('backstage.wechatArticleEdit');
    }
    public function participateList() {
         return view('backstage.participateList');
     }
 	public function wechatSeriesList() {
         return view('backstage.wechatSeriesList');
     }
	public function wechatSeriesEdit() {
         return view('backstage.wechatSeriesEdit');
     }
    public function wechatSeriesEdits(Request $request) {
        dd(1);
        // return view('backstage.wechatSeriesEdits');
     }
    // public function del($id, $deleted) {
    //     $articles = WechatArticle::find($type);
    //     $articles->deleted = $deleted;
    //     $articles->save();
    //     if ($deleted == 1) {
    //         $this->showList(0);
    //         return view('backstage.wechatArticleList', ['articles' => $this->articles, 'deleted' => 0]);
    //     } else {
    //         $this->showList(1);
    //         return view('backstage.wechatArticleList', ['articles' => $this->articles, 'deleted' => 1]);
    //     }
    // }

}