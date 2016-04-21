<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxRoom;

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
