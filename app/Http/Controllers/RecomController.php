<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;

class RecomController extends Controller
{
    public function index()
    {
        $areas = Area::where('level',4)->get();
        return view('backstage.recom',compact('areas'));
    }
}
