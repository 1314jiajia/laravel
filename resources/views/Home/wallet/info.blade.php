@extends('Home.wallet.wallet')
@section('body')
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr>

						<!--头像 -->
						<div class="user-infoPic">

							<div class="info-m" >
								<br/>
								<div style="color: red;text-align: center;"><b>用户名：<i >{{session('email')}}</i></b></div>
								<br/>
								<div class="vip">
                                      <span></span><a href="#">会员专享</a>
								</div>
							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal" action="/Home/geren/{{$res->id}}" method="post">
									{{ csrf_field() }}
								  {{ method_field('PUT') }}

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="{{$res->name}}" name="name">
                                         
									</div>
								</div>

								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">邮箱</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="{{$res->email}}" type="text" name="email">

									</div>
								</div>
								<!-- <div class="am-form-group">
									<label for="user-email" class="am-form-label">地址</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="" type="text" name="address">

									</div>
								</div> -->
								
								<input type="submit" name="" >
								

							</form>
						</div>

					</div>
</body>
</html>
	
@endsection
@section('title','个人信息')