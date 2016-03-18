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
        $casas = Casa::all()->sort(function ($c1, $c2){
            return $this->compareCasaCode($c1->code, $c2->code);
        });
        $areaService = app("AreaService");
        foreach($casas as $casa) {
            $casa->area_name = $areaService->getLeafFullName($casa->dictionary_id);
        }
        return view('backstage.casaList', ['casas' => $casas, 'deleted' => $deleted]);
    }

    /**
     * Sort casa collection by this code.
     * For instance, solve the problem which 2-101 precede 2-20.
     * @param $c1 Casa
     * @param $c2 Casa
     * @return -1, 0, 1
     */
    private function compareCasaCode($c1, $c2) {
        if (!strstr($c1, "-")) {
            return -1;
        }
        if (!strstr($c2, "-")) {
            return 1;
        }
        $c1_nums = explode("-", $c1);
        $c2_nums = explode("-", $c2);
        $c1_city = $c1_nums[0];
        $c1_casa = $c1_nums[1];
        $c2_city = $c2_nums[0];
        $c2_casa = $c2_nums[1];
        if ($c1_city < $c2_city) {
            return -1;
        } else if ($c1_city > $c2_city) {
            return 1;
        } else {
            if ($c1_casa < $c2_casa) {
                return -1;
            } else if ($c1_casa > $c2_casa) {
                return 1;
            } else return 0;
        }
    }
}
