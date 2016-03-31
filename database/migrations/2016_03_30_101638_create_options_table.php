<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('options')) {
            return;
        }
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('brief')->nullable();
            $table->integer('attachment_id');
            $table->integer('casa_id');
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
        Schema::drop('options');
    }
}
