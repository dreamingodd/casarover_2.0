<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVcOrderRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vc_order_relation', function(Blueprint $t) {
            $t->engine = "InnoDB";
            $t->bigIncrements('id');
            $t->bigInteger('vacation_card_order_id')->references('vacation_card_order')->on('order_id');
            $t->bigInteger('casa_order_id')->references('casa_order_id')->on('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vc_order_relation');
    }
}
