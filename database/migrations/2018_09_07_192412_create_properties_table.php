<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 商品各个版本各个属性表
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->default()->comment("商品id");
            $table->string('spec')->default()->comment("商品版本");
            $table->string('color_id')->default()->comment("商品颜色id");
            $table->string('price')->default()->comment("商品价格");
            $table->string('stock')->default(0)->comment("商品库存量");
            $table->integer('status')->default(1)->comment("状态 -2|软删除 -1|已下架 0|暂时缺货 1|上架");
            $table->string('storage_time')->default()->comment("入库时间");
            $table->integer('user_id')->default()->comment("上传者id");
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
        Schema::dropIfExists('properties');
    }
}
