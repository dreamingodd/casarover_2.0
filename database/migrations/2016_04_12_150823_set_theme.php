<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetTheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 修改description 为brief
         * 添加 attachment_id
         */
        Schema::table('theme',function($table)
        {
            $table->string('description',128)->nullable()->change();
            $table->renameColumn('description','brief');
            $table->bigInteger('attachment_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
        Schema::rename('theme', 'themes');
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
