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

class WxOrderController extends Controller
{
    public function create(Request $request) {

        DB::beginTransaction();
        try {
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            $wxOrder->wx_user_id = WxUser::find(Session::get('wx_user_id'))->id;
            $wxOrder->save();
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
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
