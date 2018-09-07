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

});