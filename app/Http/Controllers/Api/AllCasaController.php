<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Casa;
class AllCasaController extends Controller
{
    //use page is allcasa
    public function getAreasByCityId($id)
    {
        $areas = Area::where('parentid',$id)->get();
        foreach($areas as $area)
        {
            if(!empty($area->contents[1]))
            {
                if(!empty($area->contents[1]->attachments[0]))
                {
                    $area->mess = $area->contents[0]->text;
                    $area->pic = config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath;
                }
            }
        }
        return response()->json($areas);
    }
    //default city is 7 => 杭州
    public function getCasas($city=7,$areas=0)
    {
        //if not select area then show all casa belog this city
        if(!$areas)
        {
            $lastarea = Area::where('parentid',$city)->where('islast',1)->get();
            if(count($lastarea))
            {
                $areaIds = [];
                foreach($lastarea as $area)
                {
                    array_push($areaIds,$area->id);
                }
                $casas = Casa::whereIn('dictionary_id',$areaIds)->where('deleted',0)->simplePaginate(6);
                $casas = $this->addField($casas);
            }
        }
        else
        {
            //if selected area show result by area id
            $areaIds = explode(',',$areas);
            $casas = Casa::whereIn('dictionary_id',$areaIds)->where('deleted',0)->simplePaginate(6);
            $casas = $this->addField($casas);
        }
        return response()->json($casas);
    }
    //add some field which page need
    private function addField($data)
    {
        foreach($data as $casa)
        {
            if($casa->attachment)
            {
                $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
            }
            $casa->tags;
        }
        return $data;
    }
}