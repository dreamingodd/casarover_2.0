<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDealerModeShowCommission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer', function(Blueprint $t){
            $t->tinyInteger('show_commission')->default(0)->after('dev_key');
            $t->tinyInteger('coupon_mode')->default(0)->after('dev_key');
            $t->tinyInteger('deal_mode')->default(0)->after('dev_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealer', function(Blueprint $t){
            $t->dropColumn('deal_mode');
            $t->dropColumn('coupon_mode');
            $t->dropColumn('show_commission');
        });
    }
}
