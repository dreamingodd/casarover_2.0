<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** Need is_whole column to show whether product is 包幢 or not. */
class AddIswholeToStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('wx_room_date');
        Schema::dropIfExists('wx_room_content');
        Schema::table('stocks', function(Blueprint $t) {
            $t->tinyInteger('is_whole')->default(0)->after('surplus');
            $t->string('description', 500)->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function(Blueprint $t) {
            $t->dropColumn('is_whole');
            $t->dropColumn('description');
        });
    }
}
