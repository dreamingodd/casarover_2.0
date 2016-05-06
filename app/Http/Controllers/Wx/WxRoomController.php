<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxRoom;
use App\Entity\Wx\WxRoomDate;

class WxRoomController extends Controller
{
    public function show($id) {
        $wxRooms = WxCasa::find($id)->wxRooms;
        $wxCasaId = $id;
        return view('backstage.wxRoom', compact('wxRooms', 'wxCasaId'));
    }
    public function edit(Request $request) {
        $wxCasaId = $request->input('wxCasaId');
        $rawRooms = json_decode($request->input('wxRooms'));
        $wxCasa = WxCasa::find($wxCasaId);
        $wxRooms = $this->createRooms($rawRooms);
        $wxCasa->wxRooms()->saveMany($wxRooms);
        return redirect('/back/wx');
    }
    public function date($id) {
        $date=WxRoomDate::where('room_id',$id)->get();
        $wxRoom = WxRoom::find($id);
        return view('backstage.wxRoomDate',compact('date','wxRoom'));
    }
    public function postdate(Request $request , $id) {
        $save= $request->all();
        $count=count($save['year']);
        $wxRooms = WxRoom::find($id);
        $casaId=$wxRooms->wxCasa->id;
        for($i=0;$i<$count;$i++){
            $date=WxRoomDate::where('room_id',$id)->where('year',$save['year'][$i])->where
            ('month',$save['month'][$i])->first();
            if(!$date){
            $date= new WxRoomDate;
            }
            $date->room_id=$save['room_id'];
            $date->year=$save['year'][$i];
            $date->month=$save['month'][$i];
            $date->day=$save['day'][$i];
            $date->save();
        }
        return redirect("/back/wx/room/$casaId");
    }
    private function createRooms($rawRooms) {
        $rooms = array();
        foreach ($rawRooms as $rawRoom) {
            $room = $this->createRoom($rawRoom);
            array_push($rooms, $room);
        }
        return $rooms;
    }

    private function createRoom($rawRoom) {
        $room = null;
        if (isset($rawRoom->id)) {
            $room = WxRoom::find($rawRoom->id);
        } else {
            $room = new WxRoom();
        }
        $room->name = $rawRoom->name;
        $room->price = $rawRoom->price;
        $room->save();
        return $room;
    }
}
