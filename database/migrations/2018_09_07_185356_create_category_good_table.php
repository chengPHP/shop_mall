<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 商品和商品类别的关联表
     */
    public function up()
    {
        Schema::create('category_good', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('good_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_good');
    }
}
