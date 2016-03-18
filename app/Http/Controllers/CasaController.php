<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Casa;
use App\Services\AreaService;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CasaController extends Controller
{
    public function casaList($deleted=0)
    {
        $casas = Casa::all();
        $areaService = app("AreaService");
        foreach($casas as $casa) {
            $casa->area_name = $areaService->getLeafFullName($casa->dictionary_id);
        }
        return view('backstage.casaList', ['casas' => $casas, 'deleted' => $deleted]);
    }
}
