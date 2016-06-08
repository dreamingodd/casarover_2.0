<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * wx_vacation_card
 * wx_vacation_opportunity
 */
class AddUpdateWxVacationCardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wx_vacation_card', function(Blueprint $t) {
            $t->tinyInteger('type')->after('name');
        });
        Schema::table('wx_order_item', function(Blueprint $t) {
            $t->tinyInteger('type')->after('id');
            $t->string('name', 128)->after('id');
        });
        Schema::create('wx_vacation_opportunity', function(Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('name', 64);
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
        //
    }
}
