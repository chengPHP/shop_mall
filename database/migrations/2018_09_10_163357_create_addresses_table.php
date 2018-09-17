<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 收货人的地址信息列表
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_name')->nullable()->comment("名称");
            $table->string('member_id')->nullable()->comment('会员表id');
            $table->string('consignee')->nullable()->comment("收货人姓名");
            $table->string('email')->nullable()->comment('收货人的email');
            $table->string('province')->nullable()->comment("省");
            $table->string('city')->nullable()->comment("市");
            $table->string('district')->nullable()->comment("区");
//            $table->integer('region_id')->nullable()->comment("收货人所属地址id");
            $table->string('address')->nullable()->comment("收货人的详细地址");
            $table->string('zipcode')->nullable()->comment("收货人的邮编");
            $table->string('tel')->nullable()->comment("收货人的电话");
            $table->string('phone')->nullable()->comment("收货人的手机号");
            $table->string('sign_building')->nullable()->comment("收货地址的标志性建筑名");
            $table->string('best_time')->nullable()->comment("收货人的最佳收货时间");
            $table->tinyInteger('status')->default(1)->comment('状态 -1|删除 0|禁用 1|启用');
            $table->timestamps();
            $table->index(['region_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
