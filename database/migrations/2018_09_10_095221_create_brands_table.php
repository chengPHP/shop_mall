<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default()->comment('品牌名称');
            $table->string('brand_logo')->default()->comment('上传该公司logo图片');
            $table->string('brand_desc')->default()->comment('品牌描述');
            $table->string('site_url')->default()->comment('品牌网址');
            $table->string('sort_order')->default()->comment('品牌在前台页面的显示顺序,数字越大越靠后');
            $table->string('is_show')->default()->comment('该品牌是否显示 0|否 1|显示');
            $table->integer('status')->default()->comment('状态 -1|软删除 0|禁用 1|启用');
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
        Schema::dropIfExists('brands');
    }
}
