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
}
