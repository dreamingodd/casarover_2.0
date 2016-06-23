<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOpportunityApply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_apply',function(Blueprint $table){
            $table->bigInteger('card_user_id')->after('user_id')->references('user')->on('id');
            $table->smallInteger('quantity')->after('order_item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_apply',function(Blueprint $table){
            $table->dropColumn('card_user_id');
            $table->dropColumn('quantity');
        });
    }
}
