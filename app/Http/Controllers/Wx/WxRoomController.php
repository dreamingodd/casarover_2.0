<?php

namespace App\Http\Controllers\Wx;

use DB;
use Exception;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Entity\Product;
use App\Entity\Wx\WxCasa;

/**  */
class WxRoomController extends Controller
{
    /**
     * Get the rooms(products) of a wx casa.
     * @param int $id
     */
    public function show($id) {
        $wxCasaId = $id;
        $rooms = WxCasa::find($wxCasaId)->rooms();
        return view('backstage.wxRoom', compact('rooms', 'wxCasaId'));
    }

    /**
     * Edit the rooms(products) of a wx casa.
     * @param Request $request
     */
    public function edit(Request $request) {
        DB::beginTransaction();
        try {
            $wxCasaId = $request->input('wxCasaId');
            $rawRooms = json_decode($request->input('wxRooms'));
            $wxCasa = WxCasa::find($wxCasaId);
            $rooms = $this->createRooms($rawRooms);
            $wxCasa->products()->saveMany($rooms);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
        return redirect('/back/wx');
    }

    /** Temporarily unused. */
    // /**
    //  * @param int $id
    //  */
    // public function date($id) {
    //     $date = WxRoomDate::where('room_id',$id)->get();
    //     $wxRoom = Product::find($id);
    //     return view('backstage.wxRoomDate',compact('date','wxRoom'));
    // }

    // /**
    //  * @param Request $request
    //  * @param int $id
    //  */
    // public function postdate(Request $request , $id) {
    //     $save= $request->all();
    //     $count=count($save['year']);
    //     $rooms = Product::find($id);
    //     $casaId=$rooms->wxCasa->id;
    //     for($i=0;$i<$count;$i++){
    //         $date=WxRoomDate::where('room_id',$id)->where('year',$save['year'][$i])->where
    //         ('month',$save['month'][$i])->first();
    //         if(!$date){
    //         $date= new WxRoomDate;
    //         }
    //         $date->room_id=$save['room_id'];
    //         $date->year=$save['year'][$i];
    //         $date->month=$save['month'][$i];
    //         $date->day=$save['day'][$i];
    //         $date->save();
    //     }
    //     return redirect("/back/wx/room/$casaId");
    // }

    /**
     * Create rooms(products) according to the json data array.
     * @param array $rawRooms
     */
    private function createRooms($rawRooms) {
        $rooms = array();
        foreach ($rawRooms as $rawRoom) {
            $room = $this->createRoom($rawRoom);
            array_push($rooms, $room);
        }
        return $rooms;
    }

    /**
     * Create room(product type is TYPE_CASA_ROOM) according to the json data.
     * @param object $rawRoom
     */
    private function createRoom($rawRoom) {
        $room = null;
        if (isset($rawRoom->id)) {
            $room = Product::find($rawRoom->id);
        } else {
            $room = new Product();
        }
        $room->name = $rawRoom->name;
        $room->price = $rawRoom->price;
        $room->save();
        return $room;
    }
}
