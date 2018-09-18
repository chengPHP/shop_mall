<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 快递物流数据表
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable()->comment('所属订单号');
            $table->text('record')->nullable()->comment('物流信息');
            $table->string('duty_name')->nullable()->comment('负责人');
            $table->string('duty_phone')->nullable()->comment('负责人联系电话');
            $table->dateTime('update_time')->nullable()->comment('更新时间');
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
        Schema::dropIfExists('logistics');
    }
}
