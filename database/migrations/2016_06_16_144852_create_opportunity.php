<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** Create table to store left quantity of vacation card casa. */
class CreateOpportunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunity', function(Blueprint $t){
            $t->bigInteger('order_item_id')->primary()->references('order_item')->on('id');
            $t->smallInteger('left_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunity');
    }
}
