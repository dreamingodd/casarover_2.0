<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {

        $casas = new \stdClass();
        $first = new \stdClass();
        $first->id = 1;
        $first->name='白乐桥';
        $first->pic='assets/images/head.png';
        $second = new \stdClass();
        $second->id = 2;
        $second->name='花千骨';
        $second->pic='assets/images/head2.png';
        $casas = array('casas'=>array($first,$second),'citys'=>array('杭州','上海','嘉兴'));
        return view('site.home',$casas);
    }
}
