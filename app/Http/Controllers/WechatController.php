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
        return view('backstage.wechatArticleList', ['wechatArticles' => $articles]);
    }
}
