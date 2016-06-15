<?php

use App\Entity\CasaOrder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** */
class CasaOrderLackCasaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // migrate data to new tables;
        Schema::table('casa_order', function(Blueprint $t) {
            $t->bigInteger('wx_casa_id')->after('order_id')->references('wx_casa')->on('id');
        });
        // gather the wx_order_temp, get wx_casa_ids then put them into casa_order.
        $tempOrders = DB::table('wx_order_temp')->get();
        foreach ($tempOrders as $tempOrder) {
            $order = CasaOrder::find($tempOrder->id);
            $order->wx_casa_id = $tempOrder->wx_casa_id;
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
        // Schema::table('casa_order', function(Blueprint $t) {
        //     $t->dropColumn('wx_casa_id');
        // });
    }
}
