<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;
use App\Option;

class SiteController extends Controller
{
    // website index
    public function index()
    {
        // get slide data
        $casas = Option::where('type',1)->get();
        foreach($casas as $casa)
        {
            $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
        }
        // get recommend city
        $citys = Area::where('status',1)->get();
        return view('site.home',compact('casas','citys'));
    }

    // about us
    public function about()
    {
        return view('site.about');
    }
}
