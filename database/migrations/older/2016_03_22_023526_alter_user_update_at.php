<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserUpdateAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('casa', function (Blueprint $table) {
            // DB::statement("origin sql statement")
            $table->renameColumn('update_time', 'updated_at');
            $table->integer('updated_by')->nullable()
                    ->reference('id')->on('user')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('casa', function (Blueprint $table) {

        });
    }
}
