<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Exception;
use DB;
use Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;

class WxOrderController extends Controller
{
    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            //$wxOrder->status = WxOrder::STATUS_PAYING;
            $wxOrder->save();
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
            foreach ($reservedRooms as $reservedRoom) {
                $wxOrderItem = new WxOrderItem();
                $wxOrderItem->wx_order_id = $wxOrder->id;
                $wxOrderItem->wx_room_id = $reservedRoom['id'];
                $wxOrderItem->quantity = $reservedRoom['quantity'];
                $wxOrderItem->save();
            }
            DB::commit();
            return response()->json(['orderId' => $wxOrder->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
        }
    }
}
