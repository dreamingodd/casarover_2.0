<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use DB;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxCard;
use App\Entity\Wx\WxCardCasa;
use App\Http\Controllers\BaseController;

class WxCasaController extends BaseController
{
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
        // 不知道为什么倒序了.....
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
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
                $wxCasa->attachment()->associate($this->createAttachment($mainPhotoPath));
            }
            $wxCasa->save();
            $wxCasa->contents()->saveMany($contents);

            DB::commit();
            return redirect('/back/wx');
        } catch (\Exception $ex) {
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

    public function testModeChange($id, $test) {
        $casa = WxCasa::find($id);
        $casa->test = $test;
        $casa->save();
        return redirect('/back/wx');
    }

    public function setTest($id) {
        $casa = WxCasa::find($id);
        $casa->test = 1;
        $casa->save();
        return redirect('/back/wx');
    }

    public function unsetTest($id) {
        $casa = WxCasa::find($id);
        $casa->test = 0;
        $casa->save();
        return redirect('/back/wx');
    }

    public function vacation() {
        $cards = WxCard::all();
        return view('backstage.wxVacation',compact('cards'));
    }
    public function vacationEdit($id=0){
        $casas=WxCasa::all();
        if($id==0){
            return view('backstage.vacationEdit',compact('casas','id'));
        }
        else{
            $card = WxCard::find($id);
            $wxcasas= WxCardCasa::where('wx_vacation_card_id',$id)->get();
            return view('backstage.vacationEdit',compact('card','casas','wxcasas','id'));
        }
    }
    public function vacationEdited(Request $request,$id=0){
        $save=$request->all();
            if($id == 0)
                $wxcard=new WxCard();
            else
                $wxcard=WxCard::find($id);
            $wxcard->name=$save['name'];
            $wxcard->brief=$save['brief'];
            $wxcard->save();
        return redirect("back/vacation");
    }
    public function vacationDel($id){
        WxCard::find($id)->delete();
        return redirect("back/vacation");
    }
}
