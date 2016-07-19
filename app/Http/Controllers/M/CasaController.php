<?php

namespace App\Http\Controllers\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Casa;
use App\Area;

class CasaController extends Controller
{
    public function show($id)
    {
        $casa = Casa::find($id);
        $city = Area::find($casa->area->id)->supArea;
        // $casas = $this->guessCasas($city);
        $casa->details = $casa->contents;
        foreach ($casa->details as $key ) {
            $key->imgs = $key->attachments;
            foreach ($key->imgs as $key ) {
                $key->src = config('config.photo_folder').$key->filepath;
            }
        }
        $casa->tags;
        return $this->jsondata(0,'成功',compact('casa'));
    }
    /**
     * 这个应该写成一个全局的帮助函数
     * @param int $code
     * @param string $msg
     * @param string $data
     */
    public function jsondata($code=0, $msg='成功', $data)
    {
        $result =  ['code'=>$code,'msg'=>$msg,'result'=>$data];
        return response()->json($result);
    }
}
