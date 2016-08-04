<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WechatArticle;
use App\WechatSeries;
use App\Attachment;
use App\Http\Requests;

class CasaSeriesController extends Controller
{
    public function casas($type,$series=0,Request $request)
    {
        $articles = WechatArticle::where('type', $type)->where('series', $series)->where('deleted', 0)->get();
        $serie = WechatSeries::find($series);
        if(strpos($request->url(), 'mobile'))
            return  view('mobile.casaseries',compact('serie','articles'));
        else
            return view('site.casaseries',compact('serie','articles'));
    }

    public function serie($id)
    {
        $articles = WechatArticle::where('type', 1)->where('series', $id)->where('deleted', 0)->get();
        $serie = WechatSeries::find($id);
        $serie->img = config('config.image_folder').$serie->attachment->filepath;
        foreach($articles as $article)
        {
            $article->img = config('config.photo_folder').$article->attachment->filepath;
        }
        return $this->jsondata(0, 'ok', compact('articles','serie'));
    }

    /**
     * 这个应该写成一个全局的帮助函数
     * @param int $code
     * @param string $msg
     * @param string $data
     */
    public function jsondata($code=0, $msg='成功', $data)
    {
        $result =  ['code'=>$code,'msg'=>$msg,'result'=>$data];
        return response()->json($result);
    }
}
