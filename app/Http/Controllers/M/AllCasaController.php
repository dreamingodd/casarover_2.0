<?php

namespace App\Http\Controllers\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Casa;

class AllCasaController extends Controller
{
    public function index($cityId=7,$areas=0)
    {
        //if not select area then show all casa belog this city
        if(!$areas)
        {
            $lastarea = Area::where('parentid',$cityId)->where('islast',1)->get();
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
            $banner = 0;
        }
        else
        {
            //if selected area show result by area id
            $areaIds = explode(',',$areas);
            $casas = Casa::whereIn('dictionary_id',$areaIds)->where('deleted',0)->simplePaginate(6);
            $casas = $this->addField($casas);
            $banner = $this->banner($areas);
        }
        return response()->json(['code'=>0,'msg'=>'ok','result'=> compact('banner','casas')]);
    }

    private function banner($id)
    {
        $area = Area::find($id);
        $title = $area->value;
        if(isset($area->contents[1])){
            $brief = $area->contents[1]->text;
            if(isset($area->contents[1]->attachments[0])){
                $img = $area->pic = config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath;
                $banner = ['title'=>$title,'brief'=>$brief,'img'=>$img];
            }else{
                return 0;
            }
        }else{
            return 0;
        }
        return $banner;
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
