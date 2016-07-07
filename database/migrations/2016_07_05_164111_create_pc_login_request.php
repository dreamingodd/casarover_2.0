<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcLoginRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Recently no errors detected, the deprecated tables should be destoryed.
        Schema::dropIfExists('wx_order_item_temp');
        Schema::dropIfExists('wx_order_temp');
        Schema::create('pc_login_request', function (Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->string('code', '32');
            $t->index('code');
            $t->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('pc_login_request');
    }
}
