<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitesController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function test() {
        $name = $_GET['name'];
        return view('test')->with('name', $name);
    }
    public function test1() {
        return view('test_post_direct');
    }
    public function test2() {
        return view('test_array')->with('name',[
            '1'=>'testXXX',
            '0'=>'testYYY'
        ]);
    }
}
