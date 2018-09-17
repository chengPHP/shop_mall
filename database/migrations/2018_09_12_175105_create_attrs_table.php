<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 商品SKU
     */
    public function up()
    {
        Schema::create('attrs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->nullable()->comment('所属商品id');
            $table->string('model_number')->nullable()->comment('版本、型号');
            $table->string('color_id')->nullable()->comment('所属颜色id');
            $table->string('price')->nullable()->comment('商品原价格 单位:元');
            $table->string('promote_price')->nullable()->comment('优惠价格 单位:元');
            $table->integer('stock')->default(0)->comment('商品库存量');
//            $table->integer('good_id')->nullable()->comment("所属商品id");
            $table->integer('status')->default()->comment('状态 -1|下架 0|暂时缺货 1|正常 2|新品');
            $table->timestamps();
//            $table->integer(['color_id','good_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_attrs');
    }
}
