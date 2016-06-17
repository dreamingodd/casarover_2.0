<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintToWx18 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('wx_user_casa_18')->truncate();
        DB::table('wx_vote')->truncate();
        Schema::table('wx_user_casa_18', function(Blueprint $t) {
            $t->unique(['user_id', 'wx_casa_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wx_user_casa_18', function(Blueprint $t) {
            $t->dropUnique('wx_user_casa_18_user_id_wx_casa_id_unique');
        });
    }
}
