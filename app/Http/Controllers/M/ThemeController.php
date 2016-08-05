<?php

namespace App\Http\Controllers\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Theme;

class ThemeController extends Controller
{
    public function show($id)
    {
        $theme = Theme::find($id);
        $others = Theme::whereNotIn('id',[$id])->orderBy('id','asc')->where('status',1)->get();
        $contents = $theme->contents()->orderBy('display_order','asc')->get();
        foreach ($contents as $content) {
            if(count($content->attachments)){
                $content->img = config('config.image_folder').$content->attachments[0]->filepath;
            }
        }
        foreach($others as $otherTheme)
        {
            $otherTheme->pic = config('config.image_folder').$otherTheme->attachment->filepath;
        }

        return $this->jsondata(0, 'ok',compact('theme','contents','others'));
    }

    public function jsondata($code=0, $msg='成功', $data)
    {
        $result =  ['code'=>$code,'msg'=>$msg,'result'=>$data];
        return response()->json($result);
    }
}
