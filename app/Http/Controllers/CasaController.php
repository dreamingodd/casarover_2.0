<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Log;
use App\Casa;
use App\Area;
use App\Tag;
use App\Content;
use App\Attachment;
use App\Common\CommonTools;
use App\Option;

class CasaController extends BaseController
{
    private $casa;
    private $casas;

    /**
     * Add or update a casa.
     */
    public function edit(Request $request) {
        $casaData = json_decode($request->all()['casa_JSON_str']);
        // dd($casaData);

        DB::beginTransaction();
        try {
            if (empty($casaData->id)) {
                $casa = new Casa;
            } else {
                $casa = Casa::find($casaData->id);
                $casa->attachment()->delete();
                DB::delete('delete from casa_tag where casa_id='.$casa->id);
                foreach ($casa->contents as $content) {
                    $content->attachments()->delete();
                    DB::delete('delete from content_attachment where content_id='.$content->id);
                }
                $casa->contents()->delete();
            }
            // basic information
            $this->updateSimpleCasa($casa, $casaData);
            // main photo
            $attachment = $this->createAttachment($casaData->main_photo);
            $casa->attachment()->associate($attachment);
            // tags
            $officialTags = $this->getOfficalTags($casaData->tags);
            $customTags = $this->getCustomTags($casaData->user_tags);
            $tags = array_merge($officialTags, $customTags);
            // contents
            $contents = $this->createContents($casaData->contents);
            $casa->save();
            $casa->tags()->saveMany($tags);
            $casa->contents()->saveMany($contents);
            DB::commit();
            return redirect('/back/casaList');
        } catch(\PDOException $e) {
            DB::rollback();
            // SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry
            if (strpos($e->getMessage(), 'Duplicate entry') > 0) {
                return "民宿编码（".$casaData->code."）已存在，请换一个!";
            }
            dd($e);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error(get_class() . ' - ' . $e);
            dd($e);
        }
    }
    /**
     * Show details in backstage.
     */
    public function show($id=0) {
        $areaService = app("AreaService");
        $officialTags = Tag::where('type', '<>', 'custom')->get();
        $areaHierarchyJson = json_encode($areaService->getAreaHierarchy());
        if ($id == 0) {
            // new casa
            return view('backstage.casaEdit', compact('officialTags', 'areaHierarchyJson'));
        } else {
            $this->casa = Casa::find($id);
            $this->casa->area_name = $areaService->getLeafFullName($this->casa->dictionary_id);
            // get add the tags which are not inserted by user.
            foreach ($officialTags as $oTag) {
                foreach ($this->casa->tags as $tag) {
                    if ($tag->type != 'custom' && $oTag->name == $tag->name) {
                        $oTag->selected = 1;
                    }
                }
            }
            // convert the array to one string splitted by comma(,).
            $customTagsStrArray = array();
            foreach ($this->casa->tags as $tag) {
                if ($tag->type == 'custom') {
                    array_push($customTagsStrArray, $tag->name);
                }
            }
            $this->casa->customTagsStr = CommonTools::arrayToComma($customTagsStrArray);
            $casa = $this->casa;
            return view('backstage.casaEdit', compact('casa', 'officialTags', 'areaHierarchyJson'));
        }
    }

    public function showList($deleted=0)
    {
        // dd(get_class_methods('App\http\Controllers\CasaController'));
        $this->casas = Casa::all()->sort('App\Common\CommonTools::sortCasaCode');
        $areaService = app("AreaService");
        foreach ($this->casas as $casa) {
            $casa->area_name = $areaService->getLeafFullName($casa->dictionary_id);
        }
        return view('backstage.casaList', ['casas' => $this->casas, 'deleted' => $deleted]);
    }

    public function del($id, $deleted) {
        //移动到回收站
        $casa = Casa::find($id);
        $casa->deleted = $deleted;
        $casa->save();
        if ($deleted == 1) {
            return redirect('/back/casaList');
        } else {
            $this->showList(1);
            return redirect('/back/casaList/1');
        }
    }
    public function realDel($id)
    {
        $casa = Casa::find($id);
        $casa->delete();
        return redirect('/back/casaList/1');
    }
   public function casaInfo($id,Request $request)
   {
       $casa = Casa::find($id);
       $city = Area::find($casa->area->id)->supArea;
       $casas = $this->guessCasas($city);
       return view('site.casa',compact('casa','city','casas'));
   }
    private function guessCasas($city)
    {
        //       推荐的民宿
        $arealast = Area::where('parentid',$city->id)->where('islast',1)->get();
        if(count($arealast))
        {
            $areaIds = array();
            foreach($arealast as $area)
            {
                array_push($areaIds,$area->id);
            }
            $numbers = Casa::whereIn('dictionary_id',$areaIds)->where('deleted',0)->get();
            $num = count($numbers) > 4? 4:count($numbers);
            $casas = $num ==1?$numbers:$numbers->random($num);
            foreach($casas as $casa)
            {
                if($casa->attachment)
                {
                    $casa->pic = config('config.photo_folder').$casa->attachment->filepath;
                }
                if(isset($casa->tags[0]))
                {
                    $casa->tip = $casa->tags[0]->name;
                }
                else
                {
                    $casa->tip = '民宿';
                }
            }
        }
        return $casas;
    }
    /**
     * 民宿大全
     * 这里传入信息，所有城市，被选中城市，轮播图信息
     * 其他下面显示的部分是由vue进行处理
    **/
   public function allcasa(Request $request, $cityId = 7)
   {
       $citys = Area::where('level','3')->whereNotIn('value', ['朱家角','黄浦区','其他'])->orwhere('value','上海')->get();
       //应该是指定三个，后面应该是相互联系的
       $slides = Option::where('type',2)->get();
       foreach($slides as $slide)
       {
           $slide->pic = config('config.photo_folder').$slide->attachment->filepath;
       }
       //默认被选中的city 为杭州
       $sel = $cityId;
       return view('site.allcasa',compact('citys','slides','sel'));
   }

    private function updateSimpleCasa($casa, $casaData) {
        // basic information
        $casa->code = $casaData->code;
        $casa->name = $casaData->name;
        $casa->link = $casaData->link;
        $casa->dictionary_id = $casaData->area;
    }
    /**
     * Convert the various tag data that are received from edit page
     * to Tags which are from the database.
     */
    private function getOfficalTags(Array $tagIds) {
        $tags = array();
        foreach ($tagIds as $id) {
            $tag = Tag::find($id);
            array_push($tags, $tag);
        }
        return $tags;
    }
    /**
     * Convert the various tag data that are received from edit page
     * to Tags which are from the database.
     */
    private function getCustomTags(Array $tagNames) {
        $tags = array();
        foreach ($tagNames as $name) {
            $tag = Tag::where('name', $name)->get()->first();
            if (empty($tag)) {
                $tag = new Tag;
                $tag->name = $name;
                $tag->type = 'custom';
                $tag->save();
            }
            array_push($tags, $tag);
        }
        return $tags;
    }
}
