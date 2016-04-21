<?php

namespace App\Http\Controllers\Api;

use App\WechatSeries;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function setchange(Request $request)
    {
        $series = WechatSeries::find($request->id);
        if($series->thumbnail)
        {
            $series->status = $series->status == 1 ? 0 : 1;
            $series->save();
            $msg = 'ok';
        }
        else
        {
            $msg = '修改失败，请上传介绍图片';
        }
        return response()->json(['msg'=>$msg]);
    }
}
