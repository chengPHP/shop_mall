<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable()->comment('订单id');
            $table->integer('good_id')->nullable()->comment('对应商品ID');
            $table->integer('attr_id')->nullable()->comment('对应商品SKU ID');
            $table->integer('amount')->nullable()->comment('数量');
            $table->decimal('price')->nullable()->comment('单价');
            $table->integer('rating')->nullable()->comment('用户打分');
            $table->text('review')->nullable()->comment('用户评价');
            $table->dateTime('reviewed_at')->nullable()->comment('评价时间');
            $table->timestamps();
            $table->index(['order_id','good_id','attr_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
