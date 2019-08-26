@extends('Home.wallet.wallet')
@section('body')
	<div class="main-wrap">
					<div class="user-address">
						<!--标题 --><br/><br/>
						<span class="new-option-r"><i class="am-icon-check-circle"></i>收货地址</span>
						<br/><br/>
						<hr>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails" >
							@foreach($res as $v)
							@if(session('user_id') == $v->user_id )
							<li class="user-addresslist defaultAddr">
								
								<p class="new-tit new-p-re">
									<span class="new-txt">{{$v->name}}</span>
									<span class="new-txt-rd2">{{ $v->tel}}</span>
								</p>
								<br/>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：{{$v->AddressFetails}}</span>
										
								</div>
								<div class="new-addr-btn">

									<form action="/Home/geren/{{ $v->id }}" method="post" enctype="multipart/form-data">
									<br/>
									<span class="new-addr-bar">❤|</span>
									
									<button type="submit"><i class="am-icon-trash"></i>删除</button>
									  {{csrf_field()}}
							            {{method_field("DELETE")}}
							           
							          </form>
								</div>

							          
							</li>
							@endif
						@endforeach
							
						</ul>
						<div class="clear"></div>
						<!--例子-->
						<div class="" id="doc-modal-1">

							<div class="add-dress">

								
								<hr>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									
								</div>

							</div>

						</div>

					</div>

					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
	{{csrf_field()}}
@endsection
@section('title','收货地址')