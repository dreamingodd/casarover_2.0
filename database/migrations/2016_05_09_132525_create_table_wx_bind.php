<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWxBind extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_bind', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wx_user_id')->unsigned()->references('id')->on('wx_user');
            $table->bigInteger('wx_casa_id')->unsigned()->references('id')->on('wx_casa');
            $table->smallInteger('bind_status');
            $table->string('casa_name', '64');
            $table->softDeletes();
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
        Schema::dropIfExists('wx_bind');
    }
}
