<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use DB;
use App\Entity\Wx\WxCasa;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
use Illuminate\Support\Str;

class WxCasaController extends BaseController
{
    public function index() {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        return view('wx.wxIndex', compact('wxCasas'));
    }
    public function showList($deleted = 0) {
        $wxCasas = null;
        if ($deleted) {
            $wxCasas = WxCasa::onlyTrashed()->orderBy('id', 'desc')->get();
        } else {
            $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        }
        foreach ($wxCasas as $casa) {
            $rooms = $casa->wxRooms;
            $casa->roomString = "";
            for ($i = 0; $i < count($rooms); $i++) {
                $room = $rooms[$i];
                $casa->roomString .= ($room->name . "&nbsp;&nbsp;¥" . $room->price . "<BR />");
            }
        }
        return view('backstage.wxList', compact('wxCasas'));
    }
    public function show($id = 0) {
        if ($id == 0) {
            return view('backstage.wxEdit');
        }
        $wxCasa = WxCasa::find($id);
        return view('backstage.wxEdit', compact('wxCasa'));
    }

    /**
     * Add or update a wx casa.
     */
    public function edit(Request $request) {
        // request validation will not restore the user-input data.
        // $this->validate($request, [
        //     'brief' => 'required',
        // ]);
        DB::beginTransaction();
        try {
            if ($request->input('id') == 0) {
                $wxCasa = new WxCasa;
            } else {
                $wxCasa = WxCasa::find($request->input('id'));
                $wxCasa->attachment()->delete();
                foreach ($wxCasa->contents as $content) {
                    $content->attachments()->delete();
                    DB::delete('delete from content_attachment where content_id='.$content->id);
                }
                $wxCasa->contents()->delete();
                DB::delete('delete from wx_casa_content where wx_casa_id='.$wxCasa->id);
            }
            $wxCasa->name = $request->input('name');
            $wxCasa->brief = $request->input('brief');
            $wxCasa->phone = $request->input('phone');
            $wxCasa->desc = $request->input('desc');
            $wxCasa->spec = $request->input('spec');
            $wxCasa->rule = $request->input('rule');
            $wxCasa->casa_id = $request->input('casa_id');
            // 简介显示图片
            $mainPhotoPath = $request->input('main_photo');
            // 图文内容
            $rawContents = json_decode($request->input('contents'));
            $contents = $this->createContents($rawContents);

            if (!empty($mainPhotoPath)) {
                $content->attachments()->delete();
                $wxCasa->attachment()->associate($this->createAttachment($mainPhotoPath));
            }
            $wxCasa->save();
            $wxCasa->contents()->saveMany($contents);

            DB::commit();
            return redirect('/back/wx');
        } catch (\Excpetion $ex) {
            DB::rollback();
            dd($ex);
        }
    }

    public function del($id) {
        WxCasa::find($id)->delete();
        return redirect('/back/wx');
    }

    public function restore($id) {
        WxCasa::onlyTrashed()->find($id)->restore();
        return redirect('/back/wx/trash/1');
    }
}
