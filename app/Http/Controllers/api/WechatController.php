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
        $series->status = $series->status == 1 ? 0 : 1;
        $series->save();
        return response()->json(['msg'=>'ok']);
    }
}
