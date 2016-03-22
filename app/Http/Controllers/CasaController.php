<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Common\CommonTools;
use App\Casa;
use App\Tag;
use App\Services\AreaService;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CasaController extends Controller
{
    private $casa;
    private $casas;

    public function edit(Request $request) {
        $casa_info = json_decode($request->all()['casa_JSON_str']);
        $casa = Casa::find($casa_info->id);
        $casa->name = $casa_info->name;
        $casa->code = $casa_info->code;
        $casa->save();
        return "success";
    }
    public function show($id) {
        $this->casa = Casa::find($id);
        // get add the tags which are not inserted by user.
        $officialTags = Tag::where('type', '<>', 'custom')->get();
        foreach ($officialTags as $oTag) {
            foreach ($this->casa->tags as $tag) {
                if ($tag->type != 'custom' && $oTag->name == $tag->name) {
                    $oTag->selected = 1;
                }
            }
        }
        // convert the array to one string splitted by comma(,).
        $customTagsStrArray = array();
        foreach ($this->casa->tags as $tag) {
            if ($tag->type == 'custom') {
                array_push($customTagsStrArray, $tag->name);
            }
        }
        $this->casa->customTagsStr = CommonTools::arrayToComma($customTagsStrArray);
        return view('backstage.casaEdit', ['casa' => $this->casa, 'officialTags' => $officialTags]);
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
