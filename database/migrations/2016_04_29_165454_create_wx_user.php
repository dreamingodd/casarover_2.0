<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('openid', 128)->unique();
            $table->string('unionid', 128)->unique();
            $table->string('realname', 64);
            $table->string('nickname', 64);
            $table->string('cellphone', 32);
            $table->smallInteger('sex')->default(0);
            $table->string('headimgurl', 512);
            $table->timestamps();
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
