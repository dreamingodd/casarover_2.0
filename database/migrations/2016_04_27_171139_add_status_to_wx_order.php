<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToWxOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wx_order', function (Blueprint $table) {
            $table->smallInteger('consume_status')->default(0)->after('status');
            $table->smallInteger('reserve_status')->default(0)->after('status');
            $table->smallInteger('pay_status')->default(0)->after('status');
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
