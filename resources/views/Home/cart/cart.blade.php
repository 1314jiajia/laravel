<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>购物车页面</title>

    <link href="/Home/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/Home/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/Home/xiangmv/css/cartstyle.css" rel="stylesheet" type="text/css" />
    <link href="/Home/xiangmv/css/optstyle.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/Home/xiangmv/js/jquery.js"></script>

  </head>

  <body>

    <!--顶部导航条 -->
    <div class="am-container header">
      <ul class="message-l">
      
      </ul>
      <ul class="message-r">

     <!--    <div class="topMessage home">
          <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
          <div class="menu-hd MyShangcheng"><a href="/homeperson" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
          <div class="menu-hd"><a id="mc-menu-hd" href="/homecart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
          <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
      </ul>
       -->
      </div>

      <!--悬浮搜索框-->

      <div class="nav white">
        <div class="logo"><img src="/Home/xiangmv/images/logo.png" /></div>
        <div class="logoBig">
          <!-- <li><img src="/Home/xiangmv/images/logobig.png" /></li> -->
        </div>

        <div class="search-bar pr">
          <a name="index_none_header_sysc" href="#"></a>
         <h1>最时尚的购物车</h1>
        </div>
      </div>

      <div class="clear"></div>
     
      <!--购物车 -->
      <div class="concent">
        <div id="cartTable">
          <div class="cart-table-th">
            <div class="wp">
              <div class="th th-chk">
                <div id="J_SelectAll1" class="select-all J_SelectAll">

                </div>
              </div>
              <div class="th th-item">
                <div class="td-inner">商品信息</div>
              </div>
              <div class="th th-price">
                <div class="td-inner">单价</div>
              </div>
              <div class="th th-amount">
                <div class="td-inner">数量</div>
              </div>
              <div class="th th-sum">
                <div class="td-inner">金额</div>
              </div>
              <div class="th th-op">
                <div class="td-inner">操作</div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
          @if($req)
          @foreach($req as $data)
          <tr class="item-list">
            <!-- 购物车遍历开始 -->
            <div class="bundle  bundle-last">
              <div class="clear"></div>
              <div class="bundle-main">                
                <ul class="item-content clearfix">
                  <li class="td td-chk">
                    <div class="cart-checkbox ">
                      <input class="check" id="J_CheckBox_170037950254" name="items" value="{{ $data['id'] }}" type="checkbox">
                      <label for="J_CheckBox_170037950254"></label>
                    </div>
                  </li>
                  <li class="td td-item">
                    <div class="item-pic">
                      <a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
                        <img src="{{ $data['pic']}}" style="height:100px" class="itempic J_ItemImg"></a>
                    </div>
                    <div class="item-info">
                      <div class="item-basic-info">
                        <a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $data['name']}}</a>
                      </div>
                    </div>
                  </li>
                  <li class="td td-info">
                    <div class="item-props item-props-can">
                      <!-- <span class="sku-line">描述：描述xxx</span>
                      <span class="sku-line">包装：裸装</span> -->
                      <i class="theme-login am-icon-sort-desc"></i>
                    </div>
                  </li>
                  <li class="td td-price">
                    <div class="item-price price-promo-promo">
                      <div class="price-content">
                        <div class="price-line">
                          <em class="J_Price price-now" style="color: red" tabindex="0">单价{{$data['price']}}</em>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-amount">
                    <div class="amount-wrapper ">
                      <div class="item-amount ">
                        <div class="sl">
                          <a href="javascript:void(0)" class="btn btn-info updatee" name="{{ $data['id']}}">-</a>
                          <input class="text_box" type="text" value="{{ $data['num']}}" style="width:30px;" />
                          <a href="javascript:void(0)" class="btn btn-info update" name="{{ $data['id']}}">+</a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-sum">
                    <div class="td-inner">
                      总计 &nbsp;<em tabindex="0" class="J_ItemSum number"> {{$data['price']*$data['num']}}</em>
                    </div>
                  </li>
                  <li class="td td-op">
                    <div class="td-inner">
                    <!--   <a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a> -->
                     <form action="/Home/cart/{{$data['id']}}" method="post">
                        <button type="submit" class="delete">删除</button>
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                   </form>
                    </div>
                  </li>
                </ul>

              </div>
            </div>
          </tr>
          @endforeach
          <!-- 购物车遍历结束 -->
          <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <div class="float-bar-wrapper">
          <div id="J_SelectAll2" class="select-all J_SelectAll">
            <div class="cart-checkbox">
              <input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
              <label for="J_SelectAllCbx2"></label>
            </div>
            <span onclick = quanxuan()>全选</span>
          </div>
          <div class="operations">  
            <a href="/delAll" hidefocus="true" class="deleteAll">清理购物车</a>
            <a href="/Home/index" hidefocus="true" class="J_BatchFav" style="color: red;">继续购物</a>
          </div>
          <div class="float-bar-right">
            <div class="amount-sum">
              <span class="txt">已选商品</span>
              <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
              <div class="arrow-box">
                <span class="selected-items-arrow"></span>
                <span class="arrow"></span>
              </div>
            </div>
            <div class="price-sum">
              <span class="txt">合计:</span>
              <strong class="price">¥<em id="J_Total">0元</em></strong>
            </div>
            <div class="">
              {{csrf_field()}}
                <input type="submit" value="结算" id="jsbtn" style="background-color:#e54346;width:180px;height:52px;color:#fff">
            </div>
          </div>
        


        </div>
        @else
              <br/>
              <p style="text-align: center; font-size: 20px">购物车内暂时没有商品，登录后将显示您之前加入的商品或</p>
              <br/>
                   <a href="/Home/index" style="color: red; text-align: center;font-size: 30px" hidefocus="true" class="J_BatchFav">继续购物</a>  
        @endif
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
              <em>© 2015-2025 Hengwang.com 版权所有</em>
            </p>
          </div>
        </div>

      </div>

      <!--操作页面-->

      <div class="theme-popover-mask"></div>

      <div class="theme-popover">
        <div class="theme-span"></div>
        <div class="theme-poptit h-title">
          <a href="javascript:;" title="关闭" class="close">×</a>
        </div>
        <div class="theme-popbod dform">
          <form class="theme-signin" name="loginform" action="" method="post">

            <div class="theme-signin-left">

              <li class="theme-options">
                <div class="cart-title">颜色：</div>
                <ul>
                  <li class="sku-line selected">12#川南玛瑙<i></i></li>
                  <li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
                </ul>
              </li>
              <li class="theme-options">
                <div class="cart-title">包装：</div>
                <ul>
                  <li class="sku-line selected">包装：裸装<i></i></li>
                  <li class="sku-line">两支手袋装（送彩带）<i></i></li>
                </ul>
              </li>
              <div class="theme-options">
                <div class="cart-title number">数量</div>
                <dd>
                  <input class="min am-btn am-btn-default" name="" type="button" value="-" />
                  <input class="text_box" name="" type="text" value="1" style="width:30px;" />
                  <input class="add am-btn am-btn-default" name="" type="button" value="+" />
                  <span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
                </dd>

              </div>
              <div class="clear"></div>
              <div class="btn-op">
                <div class="btn am-btn am-btn-warning">确认</div>
                <div class="btn close am-btn am-btn-warning">取消</div>
              </div>

            </div>
            <div class="theme-signin-right">
              <div class="img-info">
                <img src="/Home/xiangmv/images/kouhong.jpg_80x80.jpg" />
              </div>
              <div class="text-info">
                <span class="J_Price price-now">¥39.00</span>
                <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
              </div>
            </div>

          </form>
        </div>
      </div>
    <!--引导 -->
    <div class="navCir">
      <li><a href="/Home/index"><i class="am-icon-home "></i>首页</a></li>
      <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
      <li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>  
      <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>         
    </div>
  </body>
    <script type="text/javascript">
     
      $('.updatee').click(function(){
         reduce = $(this);
          // 拿到id
          var id = $(this).attr('name');

    
          // Ajax 实现减减
          $.get('/reduce',{id:id},function(data){
            // alert(data);
            
            // 当前位置在减号上面,直接找到显示数值的框,并赋值val
            reduce.next('input').val(data.num);
            
            // 获取祖先下级的li中的em
            reduce.parents('li').next('li').find('em').html(data.tot);
          
          },'json');
      });
      // 加加
      $('.update').click(function(){
         add = $(this);
          // 拿到id
          var id = $(this).attr('name');

    
          // Ajax 实现减减
          $.get('/add',{id:id},function(data){
            // alert(data);
            
            // 当前位置在减号上面,直接找到显示数值的框,并赋值val
            add.prev('input').val(data.num);
            
            // 获取祖先下级的li中的em
            add.parents('li').next('li').find('em').html(data.tot);
          
          },'json');
      });
      
  // 选择所有的checkbox框
    arr=[];
  //选择要购买的商品
  $("input[name='items']").change(function(){
    
    //判断
    if($(this).attr("checked")){
      id=$(this).val();
      // alert(id);
      //把勾选的商品id 添加到arr数组里
      arr.push(id);
    }else{
      //获取没有选中的id
      nid=$(this).val();
      // alert(id1);
      //删除没有选中的商品id
      //找到元素的索引
      Array.prototype.indexOf = function(val) {
        for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
        }
        return -1;
      };
      //通过元素的索引 利用js固有的函数删除元素
      Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
        this.splice(index, 1);
        }
      };
      //移除
      arr.remove(nid);
    }

        // Ajax 获取选中数据
        $.getJSON('/checkeds',{arr:arr},function(data){
              // alert(data);
           
            // 总件数
            $('#J_SelectedItemsCount').html(data.zsum);
             // 总钱数
             $('#J_Total').html(data.zmoney);            

        });
      });

  // 订单结算操作
  $('#jsbtn').click(function(){

      if($("input[name='items']").is(':checked')){
            
            //发送ajax请求
            $.get('/Settlement',{arr:arr},function(data){
                if(data){

                  //  有订单数据直接跳转到结算页面
                   window.location ='/yemian';
                }
               
            },'json');
              

      }else{
          alert('没有可结算商品');
      }
  });
 




    </script>
</html>