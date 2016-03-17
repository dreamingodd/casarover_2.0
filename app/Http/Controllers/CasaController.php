<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Casa;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CasaController extends Controller
{
    public function casaList($deleted=0)
    {
        $casas = Casa::all();
        return view('backstage.casaList', ['casas' => $casas, 'deleted' => $deleted]);
    }
}
