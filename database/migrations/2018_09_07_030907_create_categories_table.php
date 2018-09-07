<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->defalut()->comment("类别名称");
            $table->string('alias')->defalut()->comment("别名");
            $table->integer('pid')->defalut(0)->comment("父级id");
            $table->string('path')->defalut('0,')->comment("父级路径");
            $table->string('describe')->defalut()->comment("描述内容");
            $table->string('status')->defalut("1")->comment("类别状态 -1|软删除 0|已禁用 1|启用");
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
        Schema::dropIfExists('categories');
    }
}
