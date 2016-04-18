<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use DB;
use App\Entity\Wx\WxCasa;
use App\Http\Controllers\BaseController;
use App\Http\Requests;

class WxCasaController extends BaseController
{
    public function index() {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        return view('wx.wxIndex', compact('wxCasas'));
    }
    public function showList() {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
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
            }
            $wxCasa->name = $request->input('name');
            $wxCasa->brief = $request->input('brief');
            $wxCasa->phone = $request->input('phone');
            $wxCasa->desc = $request->input('desc');
            $wxCasa->spec = $request->input('spec');
            $wxCasa->rule = $request->input('rule');
            $wxCasa->casa_id = $request->input('casa_id');
            // 简介显示图片
            $wxCasa->attachment()->delete();
            $mainPhotoPath = $request->input('main_photo');
            $content = $request->input('text');
            // contents 内容
            $wxCasa->attachment()->associate($this->createAttachment($mainPhotoPath));
            dd($content);
            $wxCasa->save();

            DB::commit();
            return redirect('/back/wx');
        } catch (\Excpetion $ex) {
            DB::rollback();
            dd($ex);
        }
    }
}
