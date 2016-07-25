<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer', function(Blueprint $t) {
            $t->bigIncrements('id')->unsigned();
            $t->string('name', 128)->unique();
            $t->string('code', 24)->unique();
            $t->string('key', 32);
            $t->string('dev_key', 32);
            $t->timestamps();
        });
        Schema::table('wx_bind', function(Blueprint $t) {
            $t->bigInteger('dealer_id')->unsigned()->references('dealer')->on('id')->after('wx_casa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealer');
        Schema::table('wx_bind', function(Blueprint $t){
            $t->dropColumn('dealer_id');
        });
    }
}
