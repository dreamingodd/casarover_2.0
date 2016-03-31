<?php

namespace App\Http\Controllers;


use App\Http\Requests;

class backcontroller extends Controller
{
    public function sucess($type=0,$id=0) {
        return view('backstage.sucess');
}
    public function fail() {
        return view('backstage.fail');
    }
}
