<?php

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\CasaOrder;
use App\Entity\OrderItem;
use App\Entity\Wx\WxCasa;
use Illuminate\Database\Migrations\Migration;

/**
 *
 */
class OrderDataMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // migrate data to new tables;
        DB::beginTransaction();
        try {
            $orders = DB::table('wx_order_temp')->get();
            $orderItems = DB::table('wx_order_item_temp')->get();
            $wxRooms = DB::table('wx_room')->get();
            foreach ($orders as $o)
            {
                $wc = WxCasa::find($o->wx_casa_id);
                $orderName = "";
                $orderPhotoPath = "";
                if ($wc) {
                    $orderName = '民宿订单-' . WxCasa::find($o->wx_casa_id)->name;
                    $orderPhotoPath = 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'
                    . WxCasa::find($o->wx_casa_id)->thumbnail();
                    // echo $orderName . '   ' . $orderPhotoPath . "\n";
                }
                Order::create([
                    'id' => $o->id,
                    'user_id' => $o->user_id,
                    'order_id' => $o->order_id,
                    'type' => Order::TYPE_CASA,
                    'pay_type' => Order::PAY_TYPE_WX,
                    'pay_id' => $o->wxpay_id,
                    'name' => $orderName,
                    'photo_path'=> $orderPhotoPath,
                    'total' => $o->total,
                    'status' => $o->pay_status,
                    'deleted_at' => $o->deleted_at,
                    'created_at' => $o->created_at,
                    'updated_at' => $o->updated_at,
                ]);
                $co = new CasaOrder();
                $co->order_id = $o->id;
                $co->reserve_date = null;
                $co->reserve_comment = $o->reserve_time;
                if ($o->consume_status == 1) {
                    $co->reserve_status = CasaOrder::RESERVE_STATUS_CONSUMED;
                } else if ($o->reserve_status == 1) {
                    $co->reserve_status = CasaOrder::RESERVE_STATUS_YES;
                }
                $co->save();
            }
            // product
            foreach ($wxRooms as $r)
            {
                $p = new Product();
                $p->id = $r->id;
                $p->parent_id = $r->wx_casa_id;
                $p->type = Product::TYPE_CASA_ROOM;
                $p->name = $r->name;
                $p->price = $r->price;
                $p->save();
            }
            foreach ($orderItems as $o)
            {
                $oi = new OrderItem();
                $oi->id = $o->id;
                $oi->order_id = $o->wx_order_id;
                $oi->product_id = $o->wx_room_id;
                $oi->name = Product::find($oi->product_id)->name;
                $oi->price = $o->price;
                $oi->quantity = $o->quantity;
                $oi->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('order_item')->truncate();
        DB::table('product')->truncate();
        DB::table('casa_order')->truncate();
        DB::table('order')->truncate();
    }
}
