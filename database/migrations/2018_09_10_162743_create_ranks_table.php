<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 会员等级配置信息
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable()->comment('会员等级名称');
            $table->string("code")->nullable()->comment('会员等级编号');
            $table->integer("min_points")->nullable()->comment('该等级的最低积分');
            $table->integer("max_points")->nullable()->comment('该等级的最高积分');
            $table->string("discount")->nullable()->comment('该会员等级的商品折扣');
            $table->string("show_price")->nullable()->comment('是否在不是该等级会员购买页面显示该会员等级的折扣价格 1|显示 0|不显示');
            $table->tinyInteger("special_rank")->nullable()->comment('是否是特殊会员等级组 0|不是 1|是');
            $table->integer("status")->nullable()->comment('等级状态 -1|软删除 0|禁用 1|启用');
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
        Schema::dropIfExists('user_ranks');
    }
}
