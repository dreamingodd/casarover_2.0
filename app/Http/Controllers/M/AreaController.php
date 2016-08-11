<?php

namespace App\Http\Controllers\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;

class AreaController extends Controller
{
    public function show($id)
    {
        $area = Area::find($id);
        $area->headImg = config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath;
        $area->title = $area->value;
        $area->brief = $area->contents['0']->text;
        $area->guides = $area->contents['1']->text;
        $area->map = 'http://restapi.amap.com/v3/staticmap?location='.$area->position.
                     '&zoom=14&size=450*300&markers=mid,,A:'.$area->position.'&key=2886eb6e218fcd008bbdb478c16756dc';
        $spots = [];
        for($i=2; $i<count($area->contents); $i++){
            $newValue = ['text'=>$area->contents[$i]->text, 'pic'=>config('casarover.oss_external').'/area/'.$area->contents[$i]->attachments[0]->filepath];
            array_push($spots, $newValue);
        }
        $area->spots = $spots;
        $area->casa = $area->casas()->take(3)->get();
        foreach ($area->casa as $casa) {
            $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
        }
        return response()->json(['code'=>0,'msg'=>'ok','result'=>$area]);
    }
}
