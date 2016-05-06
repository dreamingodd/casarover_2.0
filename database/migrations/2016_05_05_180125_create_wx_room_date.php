<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxRoomDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_room_date', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('room_id', 128);
            $table->string('year', 32);
            $table->string('month', 32);
            $table->string('weekday', 128);
            $table->string('weekend', 128);
            $table->string('holiday', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
