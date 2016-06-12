<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Trying to integrate user tables.
 */
class UserRefactor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user');
        Schema::rename('wx_user', 'user');
        Schema::table('user', function (Blueprint $t) {
            // Casarover:0, Wechat:1, QQ:2
            $t->tinyInteger('type')->after('id');
        });
        Schema::table('wx_order', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
        Schema::table('wx_vote', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
        Schema::table('wx_membership', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
        Schema::table('wx_user_casa_18', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
        Schema::table('wx_bind', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
        Schema::table('wx_collection', function(Blueprint $t) {
            $t->renameColumn('wx_user_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wx_order', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('wx_vote', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('wx_membership', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('wx_user_casa_18', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('wx_bind', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('wx_collection', function(Blueprint $t) {
            $t->renameColumn('user_id', 'wx_user_id');
        });
        Schema::table('user', function (Blueprint $t) {
            // Casarover:0, Wechat:1, QQ:2
            $t->dropColumn('type');
        });
        Schema::rename('user', 'wx_user');
        Schema::create('user', function(Blueprint $t) {
            $t->bigIncrements('id');
        });
    }
}
