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
Route::get('/activate','Home\Index\IndexController@activate');

// 前台验证码 
Route::get('/code/captcha/{tmp}', 'Home\Index\IndexController@captcha');
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

	// 文章类ajax删除
	Route::get('/ArticleDel','Admin\Article\ArticleController@AjaxDel');

// });


	// 前台登录短信验证
	// Route::resource('/Home/index','Home\Index\RegisterController');

	// 测试邮件字符串发送
	// Route::get("/send","Home\Index\RegisterController@send");

	// 测试邮件视图发送
	// Route::get("/sendView","Home\Index\RegisterController@sendView");