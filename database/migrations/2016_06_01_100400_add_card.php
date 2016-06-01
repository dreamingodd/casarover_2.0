<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_vacation_card', function(Blueprint $t) {
            $t->increments('id')->unsighed();
            $t->string('name', 64);
            $t->softDeletes();
            $t->timestamps();
        });

        Schema::create('wx_vacation_card_casa', function(Blueprint $t) {
            $t->bigIncrements('id')->unsighed();
            $t->integer('wx_vacation_card_id')->unsigned()->references('wx_vacation_card')->on('id');
            $t->bigInteger('wx_casa_id')->unsigned()->references('wx_casa')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wx_vacation_card');
        Schema::dropIfExists('wx_vacation_card_casa');
    }
}
