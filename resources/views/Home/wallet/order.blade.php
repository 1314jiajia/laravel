			@extends('Home.wallet.wallet')
			@section('body')

			<div class="user-order">

			<!--标题 -->
			<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
			</div>
			<hr>

			<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs="">

			<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
			<li class="am-active"><a href="#tab1">所有订单</a></li>
			<li class=""><a href="#tab2">待付款</a></li>
			<li class=""><a href="#tab3">待发货</a></li>
			<li class=""><a href="#tab4">待收货</a></li>
			<li class=""><a href="#tab5">待评价</a></li>
			</ul>

			<div class="am-tabs-bd" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
	<div class="am-tab-panel am-fade am-active am-in" id="tab1" >
			<div class="order-top" >
				<div class="th th-item" >
					商品
				</div>
				<div class="th th-price" >
					单价
				</div>
				<div class="th th-number">
					数量
				</div>
				<div class="th th-operation">
					商品操作
				</div>
				<div class="th th-amount">
					合计
				</div>
				<div class="th th-status">
					交易状态
				</div>
				<div class="th th-change">
					交易操作
				</div>
			</div>

			<div class="order-main">
			<div class="order-list">
			@foreach($res as $k => $v)	
			

			<div class="order-status5">


			<div class="order-title">

				<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
				<span>成交时间：{{date('Y-m-d H:i:s',$v->created_at)}}</span>
				<!--    <em>店铺：小桔灯</em>-->
			</div>
			<div class="order-content">
				<div class="order-left">
					@foreach($v->goods as $g)
					<ul class="item-list">
						
						<li class="td td-item">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="{{$g->pic}}" class="itempic J_ItemImg">
								</a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#">
										<p>{{$g->name}}</p>
										<p class="info-little">颜色：12#川南玛瑙
											<br>包装：裸装 </p>
									</a>
								</div>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price">
								333.00
							</div>
						</li>
						<li class="td td-number">
							<div class="item-number">
								<span>×</span>2
							</div>
						</li>
						<li class="td td-operation">
							<div class="item-operation">
								
							</div>
						</li>
						
					</ul>
					@endforeach
				</div>
				<div class="order-right">
					<li class="td td-amount">
						<div class="item-amount">
							合计：676.00
							<p>含运费：<span>10.00</span></p>
						</div>
					</li>
					<div class="move-right">
						<li class="td td-status">
							<div class="item-status">
								<p class="Mystatus">交易成功</p>
								<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
								<p class="order-info"><a href="logistics.html">查看物流</a></p>
							</div>
						</li>
						<li class="td td-change">
							<div class="am-btn am-btn-danger anniu">
								删除订单</div>
						</li>
					</div>
				</div>
			</div>

			</div>


			@endforeach
			</div>

			</div>

	</div>

<!-- start 代付款 -->
	<div class="am-tab-panel am-fade" id="tab2">
				<div class="order-top" >
				<div class="th th-item" >
					商品
				</div>
				<div class="th th-price" >
					单价
				</div>
				<div class="th th-number">
					数量
				</div>
				<div class="th th-operation">
					商品操作
				</div>
				<div class="th th-amount">
					合计
				</div>
				<!-- <div class="th th-status">
					交易状态
				</div> -->
				<div class="th th-change">
					交易操作
				</div>
	</div>

	<div class="order-main">
	<div class="order-list">
	@foreach($res as $k => $v)	
	@if($v->status == 1)

	<div class="order-status5">


			<div class="order-title">

				<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
				<span>成交时间：{{date('Y-m-d H:i:s',$v->created_at)}}</span>
				<!--    <em>店铺：小桔灯</em>-->
			</div>
			<div class="order-content">
				<div class="order-left">
					@foreach($v->goods as $g)
					<ul class="item-list">
						
						<li class="td td-item">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="{{$g->pic}}" class="itempic J_ItemImg">
								</a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#">
										<p>{{$g->name}}</p>
										<p class="info-little">颜色：12#川南玛瑙
											<br>包装：裸装 </p>
									</a>
								</div>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price">
								333.00
							</div>
						</li>
						<li class="td td-number">
							<div class="item-number">
								<span>×</span>2
							</div>
						</li>
						<li class="td td-operation">
							<div class="item-operation">
								
							</div>
						</li>
						
					</ul>
					@endforeach
				</div>
				<div class="order-right">
					<li class="td td-amount">
						<div class="item-amount">
							合计：676.00
							<p>含运费：<span>10.00</span></p>
						</div>
					</li>
					<div class="move-right">
						<li class="td td-status">
							<div class="item-status">
								<!-- <p class="Mystatus"> </p> -->
								<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p> -->
								<!-- <p class="order-info"><a  href="logistics.html">查看物流</a></p> -->
							</div>
						</li>
						<li class="td td-change">
							<div class="am-btn am-btn-danger anniu">
								删除订单</div>
						</li>
					</div>
				</div>
				</div>

				</div>

				@endif
				@endforeach
		</div>
    </div>
  </div>
<!-- end代付款 -->

<!-- start 代发货 -->
	<div class="am-tab-panel am-fade" id="tab3">

			<div class="order-top">
				<div class="th th-item">
				商品
				</div>
				<div class="th th-price">
				单价
				</div>
				<div class="th th-number">
				数量
				</div>
				<div class="th th-operation">
				商品操作
				</div>
				<div class="th th-amount">
				合计
				</div>
				<div class="th th-status">
				交易状态
				</div>
				<div class="th th-change">
				交易操作
				</div>
			</div>

			<div class="order-main">
			<div class="order-list">
				@foreach($res as $k => $v)	
				@if($v->status == 2)
	
	<div class="order-status5">


			<div class="order-title">

				<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
				<span>成交时间：{{date('Y-m-d H:i:s',$v->created_at)}}</span>
				<!--    <em>店铺：小桔灯</em>-->
			</div>
			<div class="order-content">
				<div class="order-left">
					@foreach($v->goods as $g)
					<ul class="item-list">
						
						<li class="td td-item">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="{{$g->pic}}" class="itempic J_ItemImg">
								</a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#">
										<p>{{$g->name}}</p>
										<p class="info-little">颜色：12#川南玛瑙
											<br>包装：裸装 </p>
									</a>
								</div>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price">
								333.00
							</div>
						</li>
						<li class="td td-number">
							<div class="item-number">
								<span>×</span>2
							</div>
						</li>
						<li class="td td-operation">
							<div class="item-operation">
								
							</div>
						</li>
						
					</ul>
					@endforeach
				</div>
				<div class="order-right">
					<li class="td td-amount">
						<div class="item-amount">
							合计：676.00
							<p>含运费：<span>10.00</span></p>
						</div>
					</li>
					<div class="move-right">
						<li class="td td-status">
							<div class="item-status">
								<p class="Mystatus">交易成功</p>
								<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
								<p class="order-info"><a href="logistics.html">查看物流</a></p>
							</div>
						</li>
						<li class="td td-change">
							<div class="am-btn am-btn-danger anniu">
								删除订单</div>
						</li>
					</div>
				</div>
				</div>

				</div>
					@endif
			@endforeach
			</div>
		</div>
	</div>
<!-- end 代发货 -->

<!-- start 待收货 -->
	<div class="am-tab-panel am-fade" id="tab4">

			<div class="order-top">
					<div class="th th-item">
					商品
					</div>
					<div class="th th-price">
					单价
					</div>
					<div class="th th-number">
					数量
					</div>
					<div class="th th-operation">
					商品操作
					</div>
					<div class="th th-amount">
					合计
					</div>
					<div class="th th-status">
					交易状态
					</div>
					<div class="th th-change">
					交易操作
					</div>
			</div>

			<div class="order-main">
			<div class="order-list">
			@foreach($res as $k => $v)	
				@if($v->status == 3)
				<div class="order-status5">


			<div class="order-title">

				<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
				<span>成交时间：{{date('Y-m-d H:i:s',$v->created_at)}}</span>
				<!--    <em>店铺：小桔灯</em>-->
			</div>
			<div class="order-content">
				<div class="order-left">
					@foreach($v->goods as $g)
					<ul class="item-list">
						
						<li class="td td-item">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="{{$g->pic}}" class="itempic J_ItemImg">
								</a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#">
										<p>{{$g->name}}</p>
										<p class="info-little">颜色：12#川南玛瑙
											<br>包装：裸装 </p>
									</a>
								</div>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price">
								333.00
							</div>
						</li>
						<li class="td td-number">
							<div class="item-number">
								<span>×</span>2
							</div>
						</li>
						<li class="td td-operation">
							<div class="item-operation">
								
							</div>
						</li>
						
					</ul>
					@endforeach
				</div>
				<div class="order-right">
					<li class="td td-amount">
						<div class="item-amount">
							合计：676.00
							<p>含运费：<span>10.00</span></p>
						</div>
					</li>
					<div class="move-right">
						<li class="td td-status">
							<div class="item-status">
								<p class="Mystatus">交易成功</p>
								<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
								<p class="order-info"><a href="logistics.html">查看物流</a></p>
							</div>
						</li>
						<li class="td td-change">
							<div class="am-btn am-btn-danger anniu">
								删除订单</div>
						</li>
					</div>
				</div>
				</div>

				</div>
			@endif
			@endforeach
</div>
	</div>
		</div>

<!-- end 代收货 -->

		<div class="am-tab-panel am-fade" id="tab5">
	<div class="order-top">

				<div class="th th-item">
						商品
				</div>
				<div class="th th-price">
						单价
				</div>
				<div class="th th-number">
					数量
				</div>
				<div class="th th-operation">
					商品操作
				</div>
				<div class="th th-amount">
					合计
				</div>
				<div class="th th-status">
					交易状态
				</div>
				<div class="th th-change">
					交易操作
				</div>
	</div>

			<div class="order-main">
			<div class="order-list">
			<!--不同状态的订单	-->
			@foreach($res as $k => $v)	
				@if($v->status == 4)
			<div class="order-status5">


			<div class="order-title">

				<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
				<span>成交时间：{{date('Y-m-d H:i:s',$v->created_at)}}</span>
				<!--    <em>店铺：小桔灯</em>-->
			</div>
			<div class="order-content">
				<div class="order-left">
					@foreach($v->goods as $g)
					<ul class="item-list">
						
						<li class="td td-item">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="{{$g->pic}}" class="itempic J_ItemImg">
								</a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#">
										<p>{{$g->name}}</p>
										<p class="info-little">颜色：12#川南玛瑙
											<br>包装：裸装 </p>
									</a>
								</div>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price">
								333.00
							</div>
						</li>
						<li class="td td-number">
							<div class="item-number">
								<span>×</span>2
							</div>
						</li>
						<li class="td td-operation">
							<div class="item-operation">
								
							</div>
						</li>
						
					</ul>
					@endforeach
				</div>
				<div class="order-right">
					<li class="td td-amount">
						<div class="item-amount">
							合计：676.00
							<p>含运费：<span>10.00</span></p>
						</div>
					</li>
					<div class="move-right">
						<li class="td td-status">
							<div class="item-status">
								<p class="Mystatus">交易成功</p>
								<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
								<p class="order-info"><a href="logistics.html">查看物流</a></p>
							</div>
						</li>
						<li class="td td-change">
							<div class="am-btn am-btn-danger anniu">
								删除订单</div>
						</li>
					</div>
				</div>
				</div>

				</div>
		@endif
		@endforeach

		</div>

		</div>

		</div>
	</div>

	</div>
</div>

@endsection
@section('title','订单管理')