<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable()->comment('所属订单id');
            $table->string('refund_reason')->nullable()->comment('申请退款理由');
            $table->string('refuse_reason')->nullable()->comment('拒绝退款理由');
            $table->timestamps();
            $table->index(['order_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_orders');
    }
}
