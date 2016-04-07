<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WechatArticle;
use App\WechatSeries;
use App\Attachment;
use App\Http\Requests;

class CasaSeriesController extends Controller
{
      public function casas($type, $deleted=0) {
          $articles = WechatArticle::where('type', $type)->where('deleted', $deleted)->get();
          $series=WechatSeries::all();
          $attachment=Attachment::all();
        return view('site.casaseries',['articles'=>$articles ,'attachments'=>$attachment,'series'=>$series]);
}
}
