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
        return response()->json($contents);
    }
}
