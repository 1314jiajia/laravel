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
Route::group(['Middleware'=>'HomeLogin'],function(){

	// 前台购物车
	Route::resource('/Home/cart','Home\cart\CartController');
	// 购物车订单 
	Route::resource('/Home/order','Home\order\orderController');
	
	
	// 个人中心
	Route::resource('/Home/wallet','Home\wallet\walletController');
	// 个人中心订单管理
	Route::get('/Home/wallet','Home\wallet\walletController@orders');
	// 商品地址
	Route::resource('/Home/address','Home\address\AddressController');
	// (个人中心地址也在这个路由中)	
	Route::get('/Home/addre','Home\address\AddressController@addre');
	// ajax获取城市级联
	Route::get('/Home/address','Home\address\AddressController@address');
	//全部地址
	Route::get('/addressAll','Home\address\AddressController@addressAll');
	// 购物车结算
	Route::get('/Settlement','Home\order\orderController@Settlement');
	// 购物车结算页面
	Route::get('/yemian','Home\order\orderController@yemian');
	// 支付
	Route::get('/ShopPay','Home\order\orderController@ShopPay');
	// 删除购物车全部商品
	Route::get('/delAll','Home\cart\CartController@delAll');
	// Ajax 操作加按钮
	Route::get('/add','Home\cart\CartController@add');
	// Ajax 操作减按钮
	Route::get('/reduce','Home\cart\CartController@reduce');
	// 勾选商品按钮操作
	Route::get('/checkeds','Home\cart\CartController@checkeds');
	//Ajax收货地址切换
	Route::get('/changes','Home\address\AddressController@changes');

	
});



// 前台路由
// 首页
Route::resource('/Home/index','Home\Index\IndexController');

// 个人中心修改
Route::resource('/Home/geren','Home\Index\gerenController');


// 用户邮箱激活
Route::get('/activate','Home\Index\IndexController@activate');

// 前台用户登录
Route::resource('/Home/Login','Home\Index\LoginController');

// 用户退出
Route::get('/Home/Login','Home\Index\LoginController@logout');

// 密码找回
Route::resource('/Home/Pwd','Home\Index\PwdController');

// 密保找回
Route::post('/Home/Pwd','Home\Index\PwdController@Secretprotection');

// 密码重置路由 
Route::post('/rePassword/{id}','Home\Index\PwdController@rePassword');

// 前台验证码 
Route::get('/code/captcha/{tmp}', 'Home\Index\IndexController@captcha');

// 后台登录
	Route::resource('/Admin/Login','Admin\Login\LoginController');

// 后台路由组
// Route::group(['middleware'=>'adminLogin'],function(){

	// 管理员管理
	Route::resource('/Admin/users','Admin\Users\usersController');
	
	// 友情链接添加
	Route::resource('/Admin/links','Admin\links\linksController');

	// 轮播图
	Route::resource('/Admin/pic','Admin\pic\picController');
	// 子轮播轮播图
	Route::resource('/Admin/spic','Admin\pic\spicController');

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

	// 商品管理
	Route::resource('/Admin/shop','Admin\Shop\ShopController');

// });


// 前台登录短信验证
Route::resource('/Home/message','Home\Index\RegisterController');

// 测试邮件字符串发送
// Route::get("/send","Home\Index\RegisterController@send");
// 手机号唯一
Route::get("/checkphone","Home\Index\RegisterController@checkphone");
// 调用短信接口
Route::get("/registersendphone","Home\Index\RegisterController@registersendphone");
// 注册页面
Route::get("/phone","Home\Index\RegisterController@phone");

// 短信验证码
Route::get("/checkcode","Home\Index\RegisterController@checkcode");

// 测试邮件视图发送registersendphone
// Route::get("/sendView","Home\Index\RegisterController@sendView");

// laravel 无限极分类测试
Route::get('/category','Demo\CategoryController@index');