<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDealerVacation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_vacation_relation', function(Blueprint $t) {
            $t->engine = "InnoDB";
            $t->bigIncrements('id');
            $t->bigInteger('dealer_id')->references('dealer')->on('id');
            $t->bigInteger('vacation_card_order_id')->references('vacation_card_order')->on('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealer_vacation_relation');
    }
}
