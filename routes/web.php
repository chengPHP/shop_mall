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
    Route::resource('goods','GoodsController');

    //会员等级管理
    Route::resource('rank','RankController');

    //会员管理
    Route::resource('member','MemberController');

});

//文件管理模块路由开始
//-------------------------------------------------------------------------
Route::group(['prefix' => 'file', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::post('image_upload', 'FileController@imageUpload')->name('image.upload');
    Route::post('file_upload', 'FileController@fileUpload')->name('file.upload');
    Route::post('video_upload', 'FileController@videoUpload')->name('video.upload');
});