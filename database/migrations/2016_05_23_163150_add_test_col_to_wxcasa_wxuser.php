<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestColToWxcasaWxuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wx_user', function(Blueprint $t) {
            $t->tinyInteger('test')->default(0)->after('headimgurl');
        });
        Schema::table('wx_casa', function(Blueprint $t) {
            $t->tinyInteger('test')->default(0)->after('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wx_user', function(Blueprint $t) {
            $t->dropColumn('test');
        });
        Schema::table('wx_casa', function(Blueprint $t) {
            $t->dropColumn('test');
        });
    }
}
