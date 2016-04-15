<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxReservationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_casa', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 128);
            $table->text('desc');
            $table->text('spec');
            $table->text('rule');
            // if
            $table->bigInteger('casa_id')->nullable()->references('id')->on('casa');
            // else
            $table->bigInteger('area_id')->nullable()->references('id')->on('area_dictionary');
            $table->bigInteger('attachment_id')->nullable()->references('id')->on('attachment');

            $table->double('score');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('wx_casa_content', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wx_casa_id')->references('id')->on('casa');
            $table->bigInteger('content_id')->references('id')->on('content');
        });

        Schema::create('wx_room', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 128);
            $table->double('price');

            $table->bigInteger('wx_casa_id')->references('id')->on('wx_casa');

            $table->timestamps();
        });

        Schema::create('wx_room_content', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wx_room_id')->unsigned()->references('id')->on('wx_room');
            $table->bigInteger('content_id')->unsigned()->references('id')->on('content');
        });

        Schema::create('wx_order', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->smallInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('wx_order_item', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->smallInteger('quantity');
            $table->bigInteger('wx_order_id')->unsigned();
            $table->foreign('wx_order_id')->references('id')->on('wx_order');
            $table->bigInteger('wx_room_id')->unsigned();
            $table->foreign('wx_room_id')->references('id')->on('wx_room');
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
        /*
        drop table if exists wx_order_item;
        drop table if exists wx_order;
        drop table if exists wx_room_content;
        drop table if exists wx_room;
        drop table if exists wx_casa_content;
        drop table if exists wx_casa;

        */
        Schema::dropIfExists('wx_order_item');
        Schema::dropIfExists('wx_order');
        Schema::dropIfExists('wx_room_content');
        Schema::dropIfExists('wx_room');
        Schema::dropIfExists('wx_casa_content');
        Schema::dropIfExists('wx_casa');
    }
}
