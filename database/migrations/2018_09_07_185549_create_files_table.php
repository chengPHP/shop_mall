<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string("type")->comment("文件类型");
            $table->string("name")->comment('文件名称');
            $table->string("old_name")->comment("文件原始名称");
            $table->integer("width")->default(0)->comment('宽');
            $table->integer("height")->default(0)->comment('高');
            $table->string("suffix")->comment("文件后缀名");
            $table->string("file_path")->comment("文件存储路径");
            $table->string("path")->comment("文件所在路径");
            $table->integer("size")->default(0)->comment("文件大小");
            $table->string("ip")->default(0)->comment("上传ip");
            $table->integer("user_id")->default()->comment("上传用户id");
            $table->string("remark")->default(0)->comment("文件描述");
            $table->string("upload_mode")->default(0)->comment("上传模式 file:文件上传 image:图片上传 video:视频上传");
            $table->string("uniqid")->default(0)->comment("文件唯一识别号");
            $table->string("url")->default(0)->comment("访问url");
            $table->softDeletes();
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
        Schema::dropIfExists('files');
    }
}
