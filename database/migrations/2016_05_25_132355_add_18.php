<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add18 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_user_casa_18', function(Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->bigInteger('wx_user_id')->unsigned()->references('wx_user')->on('id');
            $t->bigInteger('wx_casa_id')->unsigned()->references('wx_casa')->on('id');
            $t->integer('vote')->default(0);
            $t->softDeletes();
            $t->timestamps();
        });
        Schema::create('wx_vote', function(Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->bigInteger('18_id')->unsigned()->references('wx_user_casa_18')->on('id');
            $t->bigInteger('wx_user_id')->unsigned()->references('wx_user')->on('id');
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
        Schema::dropIfExists('wx_vote');
        Schema::dropIfExists('wx_user_casa_18');
    }
}
