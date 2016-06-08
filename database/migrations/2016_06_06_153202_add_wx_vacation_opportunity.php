<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * wx_vacation_card
 * wx_vacation_opportunity
 */
class AddWxVacationOpportunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('wx_vacation_opportunity');
    }
}
