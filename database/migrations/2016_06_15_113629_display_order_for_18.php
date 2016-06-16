<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** */
class DisplayOrderFor18 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wx_casa', function(Blueprint $t) {
            $t->double("display_order")->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wx_casa', function(Blueprint $t) {
            $t->dropColumn('display_order');
        });
    }
}
