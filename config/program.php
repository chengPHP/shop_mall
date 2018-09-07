<?php
/**
 * Created by PhpStorm.
 * User: CCM
 * Date: 2018/8/3
 * Time: 13:41
 * 全局公共配置参数
 */
return [
    //后台每个页面数据显示条数
    'PAGE_SIZE' => 5,
    'title' => 'CCM 个人博客',
    //短信验证码有效时间 单位：S
    'ACTIVE_TIME' => '60',
    //无权限默认跳转页面
    'no_permission_to_view' => 'admin.500',

    //返回状态码
    'status' => [
        'errors' => 0,
        'right' => 1
    ]
];