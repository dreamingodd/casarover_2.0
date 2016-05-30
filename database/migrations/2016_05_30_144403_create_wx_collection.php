<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_collection', function(Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->bigInteger('wx_user_id')->unsigned()->references('wx_user')->on('id');
            $t->bigInteger('wx_casa_id')->unsigned()->references('wx_casa')->on('id');
            $t->integer('collection')->default(0);
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
        //
    }
}
