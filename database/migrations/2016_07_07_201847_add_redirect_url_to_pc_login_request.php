<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRedirectUrlToPcLoginRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('wx_room');
        Schema::table('pc_login_request', function(Blueprint $t) {
            $t->string('redirect_url', 1024)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pc_login_request', function(Blueprint $t) {
            $t->dropColumn('redirect_url');
        });

    }
}
