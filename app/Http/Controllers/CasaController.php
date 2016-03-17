<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CasaController extends Controller
{
    public function casaList() {
        return view('backstage/casaList');
    }
}
