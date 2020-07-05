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

// Route::get('/', function () {
//     return view('welcome');
// });


// //用户添加路由
// Route::get('user/add','UserController@add');
// //用户执行添加路由
// Route::post('user/store','UserController@store');

// Route::get('user/index','UserController@index');

// Route::get('user/edit/{id}','UserController@edit');

// Route::post('user/update/','UserController@update');

// Route::get('user/del/{id}','UserController@del');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
{
	/***admin***/
Route::get('login','LoginController@login');
//验证登录
Route::post('dologin','LoginController@dologin');
//验证码
Route::get('code','LoginController@code');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'islogin'],function()
{
	//首页
Route::get('index','LoginController@index');

Route::get('welcome','LoginController@welcome');
//退出
Route::get('logout','LoginController@logout');


//后台用户模块路由
Route::resource('user','UserController');
Route::post('user/delall','UserController@delAll');
});

