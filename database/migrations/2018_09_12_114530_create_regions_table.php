<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 全国省市区表 地区列表
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable()->comment('地区编号');
            $table->string('name')->nullable()->comment('名称');
            $table->integer('pid')->nullable()->comment('父级id');
            $table->string('path')->nullable()->comment('父级路径id');
            $table->tinyInteger('status')->nullable()->comment('状态 -1|软删除 0|禁用 1|启用');
            $table->timestamps();
            $table->index(['name','region_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region');
    }
}
