<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderIdToCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupon', function(Blueprint $t){
            $t->bigInteger('vacation_card_order_id')->unsigned()->after('dealer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupon', function(Blueprint $t){
            $t->dropColumn('vacation_card_order_id');
        });
    }
}
