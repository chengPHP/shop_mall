<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 订单数据表
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->unique()->nullable()->comment('订单流水号');
            $table->integer('member_id')->nullable()->comment('会员用户id');
            $table->integer('address_id')->nullable()->comment('收货地址id');
            $table->decimal('total_amount')->nullable()->comment('订单总金额');
            $table->text('remark')->nullable()->comment('订单备注');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_method')->nullable()->comment('支付方式');
            $table->string('payment_no')->nullable()->comment('支付平台订单号');
            $table->tinyInteger('refund_status')->nullable()->comment('退款状态 0|未退款 1|已申请退款 2|退款中 3|退款成功 4|拒绝退款');
            $table->string('refund_no')->nullable()->comment('退款单号');
            $table->tinyInteger('closed')->default(0)->comment('订单是否已关闭 0|否 1|是');
            $table->tinyInteger('evaluate_id')->nullable()->comment('评价id');
            $table->tinyInteger('ship_status')->nullable()->comment('物流状态 0|未发货 1|已发货 2|已收货');
            $table->text('ship_data')->nullable()->comment('物流数据');
            $table->text('extra')->nullable()->comment('其他额外的数据');
            $table->timestamps();
            $table->index(['member_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
