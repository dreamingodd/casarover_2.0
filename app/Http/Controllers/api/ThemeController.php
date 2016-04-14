<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Theme;

class ThemeController extends Controller
{
//    通过主题的id展示下属的所有文章
    public function getThemeArticle($id)
    {
        $theme = Theme::find($id);
        $contents = $theme -> contents;
        foreach($contents as $content)
        {
            if($content->themeCasa)
            {
                $content->houseName = $content->themeCasa->name;
            }
            else
            {
                $content->houseName = '暂无';
            }
        }
        return response()->json($contents);
    }
}
