<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Rename wx_order to wx_order_temp.
 * Create order and son-table wx_order.
 */
class WxOrderRefactoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Make the wx_order, wx_order_item temperary which will be eventually destroyed.
        Schema::rename('wx_order', 'wx_order_temp');
        Schema::rename('wx_order_item', 'wx_order_item_temp');

        // new tables.
        Schema::create('order', function(Blueprint $t) {
            $t->bigIncrements('id');
            $t->bigInteger('user_id');
            $t->string('order_id', 64);
            $t->tinyInteger('type')->default(0);
            $t->tinyInteger('pay_type')->default(0);
            $t->string('pay_id');
            $t->string('name', 100);
            $t->string('photo_path', 1024);
            $t->double('total');
            $t->tinyInteger('status');
            $t->softDeletes();
            $t->timestamps();
        });
        Schema::create('product', function(Blueprint $t) {
            $t->bigIncrements('id');
            $t->bigInteger('parent_id');
            $t->bigInteger('attachment_id')->references('attachment')->on('id');
            $t->tinyInteger('type')->default(0);
            $t->string('name', 100);
            $t->double('price');
            $t->softDeletes();
            $t->timestamps();
        });
        Schema::create('order_item', function(Blueprint $t) {
            $t->bigIncrements('id');
            $t->bigInteger('order_id')->references('order')->on('id');
            $t->bigInteger('product_id')->references('product')->on('id');
            $t->string('name', 100);
            $t->string('photo_path', 1024);
            $t->double('price');
            $t->smallInteger('quantity');
        });
        Schema::create('casa_order', function(Blueprint $t) {
            $t->bigInteger('order_id')->primary()->references('order')->on('id');
            $t->tinyInteger('reserve_status')->default(0);
            $t->timestamp('reserve_date')->nullable()->default(null);
            $t->string('reserve_comment', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casa_order');
        Schema::dropIfExists('order_item');
        Schema::dropIfExists('product');
        Schema::dropIfExists('order');
        Schema::rename('wx_order_temp', 'wx_order');
        Schema::rename('wx_order_item_temp', 'wx_order_item');
    }
}
