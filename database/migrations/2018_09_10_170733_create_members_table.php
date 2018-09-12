<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->nullable()->comment('会员昵称');
            $table->integer('member_head')->nullable()->comment('会员头像');
            $table->string('name')->nullable()->comment('会员名称');
            $table->string('password')->comment('会员密码');
            $table->string('phone')->nullable()->comment('手机号');
            $table->string('email')->nullable()->comment('邮箱地址');
            $table->string('password_question')->nullable()->comment('密码提问');
            $table->string('password_answer')->nullable()->comment('密码回答');
            $table->string('sex')->default(0)->comment('性别 0|保密 1|男 2|女');
            $table->string('birthday')->nullable()->comment('出生日期 1996-01-03');
            $table->string('user_money')->default(0)->comment('会员现有资金');
            $table->string('frozen_money')->default(0)->comment('会员冻结资金');
            $table->integer('pay_points')->default(0)->comment('消费积分');
            $table->integer('rank_id')->nullable()->comment('会员等级id');
            $table->integer('rank_points')->default(0)->comment('会员等级积分');
            $table->integer('address_id')->nullable()->comment('收货地址信息id');
            $table->dateTime('reg_time')->nullable()->comment('会员注册时间');
            $table->dateTime('last_login')->nullable()->comment('最后一次登录时间');
            $table->string('last_ip')->nullable()->comment('最后一次ip');
//            $table->integer('visit_count')->nullable()->comment('会员登记id,取值user_rank');
//            $table->integer('user_rank')->nullable()->comment('会员登记id,取值user_rank');
            $table->tinyInteger('is_special')->default(0)->comment('是否特殊 0|否 1|是');
            $table->integer('recommend_id')->nullable()->comment('推荐人会员id');
            $table->string('msn')->nullable()->comment('msn账号');
            $table->string('qq')->nullable()->comment('qq账号');
            $table->string('office_phone')->nullable()->comment('办公电话');
            $table->string('home_phone')->nullable()->comment('家庭电话');
            $table->string('mobile_phone')->nullable()->comment('移动电话');
            $table->tinyInteger('is_validated')->default(1)->comment('是否生效 0|否 1|是');
            $table->string('credit_line')->nullable()->comment('最大消费');
            $table->integer('status')->default(1)->comment('会员当前状态 -1|软删除 0|禁用 1|启用');
            $table->timestamps();
            $table->index(['name','phone','email','rank_id','status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_users');
    }
}
