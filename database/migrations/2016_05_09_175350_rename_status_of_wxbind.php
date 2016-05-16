<?php

use Illuminate\Database\Migrations\Migration;

class RenameStatusOfWxbind extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wx_bind', function($table){
            $table->renameColumn('bind_status', 'status');
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
