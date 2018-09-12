<?php

use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //会员等级管理
        \Illuminate\Support\Facades\DB::table('ranks')->insert([
            'id' => 1,
            'name' => '注册会员',
            'code' => '00001',
            'min_points' => '0',
            'max_points' => '1999',
            'discount' => '10',
            'special_rank' => 0,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('ranks')->insert([
            'id' => 2,
            'name' => '铜牌会员',
            'code' => '00002',
            'min_points' => '2000',
            'max_points' => '9999',
            'discount' => '9.5',
            'special_rank' => 0,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('ranks')->insert([
            'id' => 3,
            'name' => '银牌会员',
            'code' => '00003',
            'min_points' => '10000',
            'max_points' => '29999',
            'discount' => '9',
            'special_rank' => 0,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('ranks')->insert([
            'id' => 4,
            'name' => '金牌会员',
            'code' => '00004',
            'min_points' => '30000',
            'max_points' => '99999',
            'discount' => '8.5',
            'special_rank' => 0,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('ranks')->insert([
            'id' => 5,
            'name' => '钻石会员',
            'code' => '00005',
            'min_points' => '100000',
            'max_points' => '9999999',
            'discount' => '8',
            'special_rank' => 0,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
