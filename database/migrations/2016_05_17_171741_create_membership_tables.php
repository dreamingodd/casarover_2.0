<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_membership', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wx_user_id')->unsigned()->references('id')->on('wx_user');
            $table->smallInteger('level');
            $table->integer('score');
            $table->integer('accumulated_score');
            $table->timestamps();
        });

        Schema::create('wx_score_activity', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 24);
            $table->integer('score');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('wx_score_variation', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wx_membership_id')->unsigned()->references('id')->on('wx_menbership');
            $table->bigInteger('wx_order_id')->unsigned()->references('id')->on('wx_order');
            $table->integer('wx_score_activity_id')->unsigned()->references('id')->on('wx_score_activity');
            // 1 - order, 2 - activity
            $table->smallInteger('type');
            $table->string('name', '64');
            $table->integer('score');
            $table->timestamps();
        });

        // 第一个活动就是探盟的名片二维码
        $now = date('Y-m-d H:i:s', time());
        DB::table('wx_score_activity')->insert([
            'name' => '扫名片二维码送积分',
            'score' => 500,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wx_score_variation');
        Schema::dropIfExists('wx_score_activity');
        Schema::dropIfExists('wx_membership');
    }
}
