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
//     return view('/Admin/login');
// });
// 前台路由
Route::resource('/Home/index','Home\Index\IndexController');

// 后台登录
	Route::resource('/Admin/Login','Admin\Login\LoginController');

// 后台路由组
// Route::group(['middleware'=>'adminLogin'],function(){

	// 管理员管理
	Route::resource('/Admin/users','Admin\Users\usersController');

	// 后台首页
	Route::resource('/Admin/index','Admin\Index\IndexController');
	

	// 无限极分类管理(递归)
	Route::resource('/classify','Admin\Classify\ClassifyController');
	// 分配角色
	Route::get('role/{id}','Admin\Users\usersController@userRole');
	// 保存角色
	Route::post('/saveRole','Admin\Users\usersController@saveRole');

	// 角色管理
	Route::resource('/Admin/role','Admin\Role\RoleController');

	// 权限管理
	Route::resource('/Admin/auth','Admin\Auth\AuthController');

	// 会员管理
	Route::resource('/Admin/huiyuan','Admin\huiyuan\UserController');

	// 文章管理
	Route::resource('/Admin/Article','Admin\Article\ArticleController');

// });