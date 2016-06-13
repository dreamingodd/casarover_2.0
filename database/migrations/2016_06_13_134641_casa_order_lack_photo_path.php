<?php

use App\Entity\Order;
use App\Entity\CasaOrder;
use App\Entity\Wx\WxCasa;
use Illuminate\Database\Migrations\Migration;

class CasaOrderLackPhotoPath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // gather the wx_order_temp, get casa image then put them into casa_order.
        $tempOrders = DB::table('wx_order_temp')->get();
        foreach ($tempOrders as $o) {
            $wc = WxCasa::find($o->wx_casa_id);
            $orderPhotoPath = "";
            if ($wc) {
                $orderName = '民宿订单-' . WxCasa::find($o->wx_casa_id)->name;
                $orderPhotoPath = 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'
                        . WxCasa::find($o->wx_casa_id)->thumbnail();
                // echo $orderName . '   ' . $orderPhotoPath . "\n";
            }
            $order = Order::find($o->id);
            $order->photo_path = $orderPhotoPath;
            $order->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
