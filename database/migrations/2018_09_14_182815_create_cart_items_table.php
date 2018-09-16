<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 购物车数据表
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->comment('会员用户id');
            $table->integer('good_id')->nullable()->comment('商品id');
            $table->integer('attr_id')->nullable()->comment('商品sku id');
            $table->integer('amount')->nullable()->comment('商品数量');
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
        Schema::dropIfExists('cart_items');
    }
}
