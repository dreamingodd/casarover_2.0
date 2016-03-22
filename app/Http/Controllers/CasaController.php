<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Casa;
use App\Services\AreaService;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CasaController extends Controller
{
    public $casa;
    public $casas;

    public function show($id) {
        $this->casa = Casa::find($id);
        return view('casa', ['casa' => $this->casa]);
    }
    public function edit($id) {
        dd(Config::get('casarover.oss_external'));
        $this->casa = Casa::find($id);
        return view('backstage.casaEdit', ['casa' => $this->casa]);
    }

    public function showList($deleted=0)
    {
        // dd(get_class_methods('App\http\Controllers\CasaController'));
        $this->casas = Casa::all()->sort('App\Common\CommonTools::sortCasaCode');
        $areaService = app("AreaService");
        foreach ($this->casas as $casa) {
            $casa->area_name = $areaService->getLeafFullName($casa->dictionary_id);
        }
        return view('backstage.casaList', ['casas' => $this->casas, 'deleted' => $deleted]);
    }

    public function del($id, $deleted) {
        $casa = Casa::find($id);
        $casa->deleted = $deleted;
        $casa->save();
        if ($deleted == 1) {
            $this->showList(0);
            return view('backstage.casaList', ['casas' => $this->casas, 'deleted' => 0]);
        } else {
            $this->showList(1);
            return view('backstage.casaList', ['casas' => $this->casas, 'deleted' => 1]);
        }
    }

}
