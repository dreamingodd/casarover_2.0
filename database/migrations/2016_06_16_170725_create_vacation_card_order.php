<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**  */
class CreateVacationCardOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_card_order', function(Blueprint $t){
            $t->bigInteger('order_id')->primary()->references('order')->on('id');
            $t->string('card_no', 20);
            $t->tinyInteger('style');
            $t->timestamp('expire_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vacation_card_order');
    }
}
