<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ThemeController extends Controller
{
//    后台编辑
    public function edit()
    {
        return view('backstage.themeEdit');
    }
}
