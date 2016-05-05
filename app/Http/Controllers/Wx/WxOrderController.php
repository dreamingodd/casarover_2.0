<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;

use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxUser;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;

class WxOrderController extends Controller
{
    public function create(Request $request) {

        DB::beginTransaction();
        try {
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            $wxOrder->wx_user_id = WxUser::find(Session::get('wx_user_id'))->id;
            $wxOrder->save();
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
            $total = 0;
            foreach ($reservedRooms as $reservedRoom) {
                $wxOrderItem = new WxOrderItem();
                $wxOrderItem->wx_order_id = $wxOrder->id;
                $wxOrderItem->wx_room_id = $reservedRoom['id'];
                $wxOrderItem->price = WxRoom::find($reservedRoom['id'])->price;
                $wxOrderItem->quantity = $reservedRoom['quantity'];
                $wxOrderItem->save();
                $total += $wxOrderItem->price * $wxOrderItem->quantity;
            }

            // update order info
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
            $wxOrder->total = $total;
            $wxOrder->save();
            DB::commit();
            return response()->json(['orderId' => $wxOrder->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
        }
    }
}
