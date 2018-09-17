<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'cheng'],function () {
    Auth::routes();
    //退出登录
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

//后台
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function () {

    Route::get('home', 'HomeController@index');
    //后台用户管理
    Route::resource('user','UserController');


    //商品类别管理
    Route::resource('category','CategoryController');
    //品牌管理
    Route::resource('brand','BrandController');
    //商品管理
    Route::resource('good','GoodController');
    //颜色管理
    Route::resource('color','ColorController');


    //会员等级管理
    Route::resource('rank','RankController');
    //会员管理
    Route::resource('member','MemberController');
    //城市管理
    Route::resource('region','RegionController');


});

//文件管理模块路由开始
//-------------------------------------------------------------------------
Route::group(['prefix' => 'file', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::post('image_upload', 'FileController@imageUpload')->name('image.upload');
    Route::post('file_upload', 'FileController@fileUpload')->name('file.upload');
    Route::post('video_upload', 'FileController@videoUpload')->name('video.upload');
});

//前台
Route::group(['namespace'=>'Home'], function () {
    //商品列表页
    Route::get('/','IndexController@index')->name('/');

    //商品详情页
//    Route::resource('good','GoodController');
    Route::get('good/{id}','GoodController@show');
    Route::post('add_good_to_car','GoodController@add_good_to_car');

    //订单中心
    Route::resource('member/order','OrderController');
    //我的购物车
    Route::resource('member/cart','CartController');
//    Route::get('member/my_shop_cart','MemberController@my_shop_cart');
    //删除购物车指定商品
//    Route::post('member/delete_cart_shop','MemberController@delete_cart_shop');
    //收件地址管理
    Route::resource('member/address','AddressController');


    //会员注册
    Route::get('to_register','RegisterController@to_register');
    Route::post('do_register','RegisterController@do_register');

    //会员登录
    Route::get('to_login','LoginController@to_login');
    Route::post('do_login','LoginController@do_login');
    //退出登录
    Route::get('out_login','LoginController@out_login');


});