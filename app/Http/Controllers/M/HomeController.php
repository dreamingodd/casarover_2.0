<?php

namespace App\Http\Controllers\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Option;
use App\Theme;
use App\WechatSeries;
use App\WechatArticle;

class HomeController extends Controller
{
    public function home()
    {
        return view('mobile');
    }
    public function index()
    {
        $slides = Option::where('type',1)->get();
        foreach($slides as $casa)
        {
            $casa->img = config('config.photo_folder').$casa->attachment->filepath;
            $casa->url = 'casa/'.$casa->casa_id;
        }
        // // 民宿推荐
        // $cityid = 9;
        // $area = Area::find($cityid);
        // $casas = $area->casaRecoms;
        // foreach($casas as $casa)
        // {
        //     $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
        //     $casa->brief = $casa->contents[0]->text;
        // }
        // // 主题推荐
        // $themes = Theme::where('status',1)->take(6)->get();
        // foreach($themes as $theme)
        // {
        //     $theme->pic = config('config.image_folder').$theme->attachment->filepath;
        // }
        // // 探庐系列
        // $series = WechatSeries::where('status',1)->take(6)->get();
        // foreach($series as $serie)
        // {
        //     $serie->pic = config('config.image_folder').$serie->thumbnail->filepath;
        // }
        $areas = $this->areas(7);
        return $this->jsondata(0,'成功',compact('slides','areas'));
    }

    private function areas($id)
    {
        $result = [];
        $areas = Area::where('parentid',$id)->get();
        foreach($areas as $area)
        {
            if(!empty($area->contents[1]))
            {
                if(!empty($area->contents[1]->attachments[0]))
                {
                    $mess = $area->contents[0]->text;
                    $pic = config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath;
                    $area->banner = ['id'=>$area->id,'title'=>$area->value,'brief'=>$mess,'img'=>$pic];
                    array_push($result, $area->banner);
                }
            }
        }
        return $result;
    }

    public function hotlists()
    {
        // 民宿推荐
        $cityid = 9;
        $area = Area::find($cityid);
        $casas = $area->casaRecoms;
        foreach($casas as $casa)
        {
            $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
            $casa->brief = $casa->contents[0]->text;
        }
        return $this->jsondata(0, 'ok', $casas);
    }

    public function themes()
    {
        // 主题推荐
        $themes = Theme::where('status',1)->get();
        foreach($themes as $theme)
        {
            $theme->pic = config('config.image_folder').$theme->attachment->filepath;
        }
        return $this->jsondata(0, 'ok', $themes);
    }

    public function series()
    {
        // 探庐系列
        $series = WechatSeries::where('status',1)->get();
        foreach($series as $serie)
        {
            $serie->pic = config('config.image_folder').$serie->thumbnail->filepath;
        }
        return $this->jsondata(0, 'ok', $series);
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
