<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //商品类别管理
        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 1,
            'name' => '手机 电话卡',
            'alias' => '手机 电话卡',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 2,
            'name' => '电视 盒子',
            'alias' => '电视 盒子',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 3,
            'name' => '笔记本 平板',
            'alias' => '笔记本 平板',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 4,
            'name' => '家电 插线板',
            'alias' => '家电 插线板',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 5,
            'name' => '出行 穿戴',
            'alias' => '出行 穿戴',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 6,
            'name' => '智能 路由器',
            'alias' => '智能 路由器',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 7,
            'name' => '电源 配件',
            'alias' => '电源 配件',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 8,
            'name' => '个护 儿童',
            'alias' => '个护 儿童',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 9,
            'name' => '耳机 音箱',
            'alias' => '耳机 音箱',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Categories')->insert([
            'id' => 10,
            'name' => '生活 箱包',
            'alias' => '生活 箱包',
            'pid' => 0,
            'path' => '0,',
            'describe' => '',
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
