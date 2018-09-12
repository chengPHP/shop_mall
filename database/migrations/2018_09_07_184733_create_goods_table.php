<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 商品表
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->default()->comment("商品名称");
            $table->integer("category_id")->nullable()->comment("商品所属分类id");
            $table->string("sn")->nullable()->comment("商品的唯一货号");
            $table->string("name_style")->nullable()->comment("商品名称显示的样式；包括颜色和字体样式；格式如#ff00ff+strong");
            $table->integer("click_number")->default(0)->comment("商品点击数");
            $table->integer("brand_id")->nullable()->comment('品牌id，取值于brand 的brand_id');
            $table->string("provider_name")->nullable()->comment('供货人的名称');
            $table->integer("number")->default(0)->comment('商品库存数量');
            $table->string("weight")->default(0)->comment('商品的重量，以千克为单位');
            $table->string("market_price")->default(0)->comment('市场售价');
            $table->string("shop_price")->default(0)->comment('本店售价');
            $table->string("promote_price")->default(0)->comment('促销价格');
            $table->string("promote_start_date")->default()->comment('促销价格开始日期');
            $table->string("promote_end_date")->default()->comment('促销价格结束日期');
            $table->integer("warn_number")->default(0)->comment('商品报警数量');
            $table->string("keywords")->default()->comment('商品关键字，放在商品页的关键字中，为搜索引擎收录用');
            $table->string("brief")->default()->comment('商品的简短描述');
            $table->text("describe")->nullable()->comment('商品的详情描述');
            $table->string("goods_thumb")->default()->comment('商品在前台显示的微缩图片，如在分类筛选时显示的小图片');
            $table->string("img")->default()->comment('商品的实际大小图片，如进入该商品页时介绍商品属性所显示的大图片');
            $table->string("original_img")->default()->comment('应该是上传的商品的原始图片');
            $table->integer("is_real")->default(1)->comment('是否是实物 1|是 0|否 比如虚拟卡就为0,不是实物');
            $table->string("extension_code")->default()->comment('商品的扩展属性，比如像虚拟卡');
            $table->string("is_on_sale")->default(1)->comment('该商品是否开放销售 1|是 0|否');
            $table->string("is_alone_sale")->default(1)->comment('是否能单独销售 1|是 0|否 如果不能单独销售，则只能作为某商品的配件或者赠品销售');
            $table->string("integral")->default()->comment('购买该商品可以使用的积分数量，估计应该是用积分代替金额消费');
            $table->string("add_time")->default()->comment('商品的添加时间');
            $table->string("sort_order")->default()->comment('商品的显示顺序');
            $table->string("is_best")->default(0)->comment('是否是精品 0|否 1|是');
            $table->string("is_new")->default(0)->comment('是否是新品 0|否 1|是');
            $table->string("is_hot")->default(0)->comment('是否是特价促销 0|否 1|是');
            $table->integer("bonus_type_id")->default()->comment('购买该商品所能领到的红包类型');
            $table->string("last_update")->default()->comment('最近一次更新商品配置的时间');
            $table->string("seller_note")->default()->comment('商品的商家备注，仅商家可见');
            $table->string("give_integral")->default(0)->comment('购买该商品时每笔成功交易赠送的积分数量');
            $table->string("suppliers_id")->default()->comment('商品供应商id');
            $table->integer("status")->default(1)->comment('状态：-1|已删除 0|下架 1|上架');
            $table->string("storage_time")->default()->comment('入库时间');
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
        Schema::dropIfExists('goods');
    }
}
