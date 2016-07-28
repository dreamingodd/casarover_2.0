<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function(Blueprint $t) {
            $t->bigIncrements('id');
            $t->bigInteger('dealer_id')->unsigned()->references('dealer')->on('id');
            $t->string('client_order_id', 64)->unique();
            $t->string('code', 32);
            $t->string('key', 32);
            $t->double('price');
            $t->double('left');
            $t->tinyInteger('type');
            $t->tinyInteger('status');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
