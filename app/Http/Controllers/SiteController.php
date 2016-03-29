<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WechatArticle;
use App\Http\Requests;
use App\Casa;

class SiteController extends Controller
{
    public function index()
    {
        $casas = Casa::take(3)->get();
        foreach($casas as $casa)
        {
            $casa->pic = config('casarover.photo_folder').$casa->attachment->filepath;
        }
        $citys = ['杭州','上海','嘉兴'];
        return view('site.home',compact('casas','citys'));
    }
}
