<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">


		<link href="/Home/password/xiangmv/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Home/password/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="/Home/password/xiangmv/

		css/orstyle.css" rel="stylesheet" type="text/css">

		<link href="/Home/password/xiangmv/css/personal.css" rel="stylesheet" type="text/css">

		<script src="/Home/password/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"  type="text/javascript"></script>
		<script src="/Home/password/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.js"  type="text/javascript"></script>	
		
<title>个人中心 @yield('title')</title>
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							@if( session('email') )
								<div class="menu-hd" style="margin-top: 20px">
									<b style="color: red"> Hello, {{ session('email') }}</b>
									<a href="/Home/index/create" target="_top">免费注册</a>
								</div>
							@else
							<div class="topMessage">
								<div class="menu-hd">
									<a href="/Home/Login/create" target="_top" class="h">亲，请登录</a>
									<br/>
									<a href="/Home/index/create" target="_top">免费注册</a>
								</div>
							</div>
							@endif
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/Home/index"  class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><i class="am-icon-user am-icon-fw"></i>个人中心</div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<!-- <li><img src="/Home/password/xiangmv/images/logobig.png" /></li> -->
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>

		<div class="nav-table">
			<div class="long-title"><span class="all-goods">全部分类</span></div>
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="/Home/index">首页</a></li>
					<li class="qc"><a href="#">闪购</a></li>
					<li class="qc"><a href="#">限时抢</a></li>
					<li class="qc"><a href="#">团购</a></li>
					<li class="qc last"><a href="#">大包装</a></li>
				</ul>
				<div class="nav-extra">
					
				</div>
			</div>
		</div>
		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					 @if(session('success'))       
                    <div class="mws-form-message success" style=" color: red; text-align: center; font-size: 20px">
                       {{ session('success') }}
                    </div>
               		@endif  
                        
	                @if(session('error'))
	                    <div class="mws-form-message error"style=" color: red; text-align: center; font-size: 20px">
	                        {{ session('error')}}
	                    </div>
	                @endif

						 @section('body')
		                    welcome
		                @show
						
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>

						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person active">
						<i class="am-icon-user"></i>个人中心
					</li>
					<li class="person">
						
						<ul>
							<li> <a href="/Home/geren">个人信息</a></li>
							<li> <a href="/Home/Pwd">密码重置</a></li>
							<li> <a href="/Home/geren/create">地址管理</a></li>
							
						</ul>
					</li>
					<li class="person">
						<p><i class="am-icon-balance-scale"></i>我的交易</p>
						<ul>
							<li><a href="/Home/wallet">订单管理</a></li>
							
						</ul>
					</li>
					
				</ul>

			</aside>
		</div>

	</body>

</html>