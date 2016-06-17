<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** 申请使用表 */
class CreateOpportunityApply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('wx_vacation_card');
        Schema::dropIfExists('wx_vacation_card_casa');
        Schema::dropIfExists('wx_vacation_opportunity');
        Schema::create('opportunity_apply', function(Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->bigInteger('user_id')->references('user')->on('id');
            $t->bigInteger('order_item_id')->referrences('order_item')->on('order_item_id');
            $t->tinyInteger('status');
            $t->softDeletes();
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
        Schema::dropIfExists('opportunity_apply');
        // restore vacation tables, please refer to 20160601 and 20160606.
    }
}
