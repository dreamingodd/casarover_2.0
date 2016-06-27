<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertOpportunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity',function(Blueprint $table){
            $table->dropPrimary('opportunity_order_item_id_primary');
        });
        Schema::table('opportunity',function(Blueprint $table){
            $table->bigIncrements('id')->first();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('opportunity',function(Blueprint $table){
          $table->dropColumn('id');
      });
      Schema::table('opportunity',function(Blueprint $table){
          $table->primary('order_item_id');
      });
    }
}
