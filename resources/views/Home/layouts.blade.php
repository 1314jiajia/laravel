<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>淘宝首页</title>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    

    <!--scroll-head-->
    <div class="scroll-head"></div>
    <!--top-->
    <div class="top-wrapper">
        <div class="top-info">
            <div class="top-left">
            
                <img height="34px" a-float-left src="img/qqq.gif" />
         
                <div data-toggle="hidden-box" id="nav-box1" class="user-box">
                    <img class="my-head" src="img/user-head.jpg" />
                  <p style="height: 10px; clear: both;">&nbsp;</p>
                    <div class="my-card">
                        <div class="cards-info">
                            <ul>
                                <li><img src="img/icon.png" /></li>
                                <li><img src="img/icon.png" /></li>
                            </ul>
                        </div>
                        <div class="toggle-box">
                            <div class="toggle">
                                 <i style="vertical-align: top" class="fa fa-angle-left arrow-left"></i>
                                 <i style="vertical-align: top" class="fa fa-angle-right arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-toggle="hidden-box" id="nav-box2" class="msg-box">
                    <h1>未读新消息<a href="#" class="fa fa-pencil-square-o pencil"></a></h1>
                    <div class="read-info">
                        <h2><span class="orange">&nbsp;&nbsp;|</span>&nbsp;你的书架&nbsp;<span style="font-weight: lighter">收到了<span class="orange">1</span>本书</span><span class="fa fa-times close-msg"></span></h2>
                        <img src="img/book-1.png" />
                        <div style="float: right">
                            <p>
                                全中国最穷的小伙子发财日记<br/>
                                掏彩票公共账号
                            </p>
                            <h3><a href="#">去看看</a></h3>
                        </div>
                    </div>
                    <div class="msg-setting">
                        <a href="#" class="fa fa-cog"></a>
                        <a href="#" class="fa fa-pencil-square-o"></a>
                        <a style="margin-left: 70px" href="#">买家消息&nbsp;|&nbsp;</a>
                        <a href="#">卖家消息</a>
                    </div>
                </div>
            </div>
            <!--top-right-->
            <div class="top-right">
                <div data-toggle="arrowdown" id="arrow3" class="user-name">
                    <a href="/Home/wallet">个人中心</a>
                   
                </div>
              
                <div data-toggle="hidden-box" id="nav-box7" class="nav-box">
                    <div class="sub-nav top-sub-nav">
                       
                       
                    </div>
                </div>
            </div>
        </div>
        <!--scroll-top-->
        <div class="scroll-search">
            <div class="search-litter">
                <img class="scroll-logo" src="img/logo.png" />
                <!--scroll-search-->
                <div class="search-wrapper-scroll">
                    <div class="search-box-scroll">
                        <div data-toggle="arrowdown" id="arrow9" class="search-toggle-scroll">
                            宝贝<span class="down-icon"></span>
                        </div>
                        <input class="search-in-scroll" type="text" placeholder="    搜‘健康椅’试试，办公好选择" />
                        <input type="button" class="search-but-scroll" value="搜索">
                        <div data-toggle="hidden-box" id="nav-box9" class="search-toggle-box-scroll">店铺</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--top-main-->
    <div class="top-main">
        <img src="img/logo.gif" />
        <div class="search-wrapper">
            <div class="search-box">
                <div data-toggle="arrowdown" id="arrow8" class="search-toggle">
                    宝贝<span class="down-icon"></span>
                </div>
                <input class="search-in" type="text" placeholder="    搜‘健康椅’试试，办公好选择">
                <input type="button" class="search-but" value="搜索">
                <div data-toggle="hidden-box" id="nav-box8" class="search-toggle-box">店铺</div>
            </div>
            <a class="a-float-left hight-search" href="#">高级<br/>搜索</a>
            <!--other-search-->
            <div class="other-search">
                <a href="#">女士凉鞋</a>
                <a href="#">男士T恤</a>
                <a href="#">连衣裙</a>
                <a href="#">时尚女包</a>
                <a href="#">女士T恤</a>
                <a href="#">雪纺衫</a>
                <a href="#">中老年女装</a>
                <a href="#">风衣</a>
                <a href="#">童装</a>
                <a href="#">孕妇装</a>
                <a href="#">运动套装</a>
                <a href="#">打底裤</a>
                <a href="#">蚊帐</a>
                <a href="#" class="more-other">更多<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!--two-code-->
        <div class="two-code">
            <h3>手机淘宝</h3>
            <img src="img/code.png" />
            <div class="close-code"><i class="fa fa-times"></i></div>
        </div>
    </div>
    <!--content-top-->
    <div class="content-top">
        <!--sidebar-->
        <div class="sidebar">
            <h3>商品服务分类</h3>
            <!--sidebar-info-->
            <div class="sidebar-info">
                @foreach( $res as $value)
               
                <ul class="side-li">
                    <li class="s_1"><h3>{{ $value->name }}<span class="fa fa-angle-right fa-loc"></span></h3></li>  
                </ul>
                    @if(count($value->suv))
                <!--hidden-li-box-->
                <ul class="hiden-box">
                     
                          @foreach($value->suv as $v)

                        <div class="sub-nav-right">
                             
                            <div class="cell-box">
                        
                                <h1>{{ $v->name }}</h1>
                            @foreach($v->suv as $row)
                                <div class="a-box">
                               {{ $row->name }}
                                </div>
                            
                            @endforeach
                            </div>
                        </div>
                   @endforeach  
                </ul>
                @endif
                @endforeach
            </div>
        </div>

        <!--right-con-->
        <div class="right-con">
            <div class="nav">
                <a id="spe-a1" href="#">天猫</a>
                <a id="spe-a2" href="#">聚划算</a>
                <a id="spe-a3" href="#">二手</a>
                <span class="line-a">|</span>
                <a href="#">拍卖</a>
                <a href="#">一淘</a>
                <a href="#">电器城</a>
                <a href="#">Hitao粉妆</a>
                <a href="#">旅行</a>
                <a href="#">云手机</a>
                <a href="#">特色中国</a>
                <img style="cursor: pointer" src="img/ad.gif" />
                <span class="keep-a" href="#"><a href="#">消费者保障</a></span>
            </div>
            <!--show-box-->
            <div class="show-box">
                <!--content-->
                <div class="content">
                    <ul class="imgBox">
                       @foreach($pic as $p)
                        <li><a href="#"><img src="{{$p->pic}}"></a></li>
                       @endforeach
                    </ul>
                    <div class="currentNum">
                        <span class="imgNum mark-color"></span>
                        <span class="imgNum"></span>
                        <span class="imgNum"></span>
                        <span class="imgNum"></span>
                        <span class="imgNum"></span>
                    </div>
                    <div class="control to-left"><i class="fa fa-angle-left"></i></div>
                    <div class="control to-right"><i class="fa fa-angle-right"></i></div>
                </div>
               <a style="float: left" href="#"><img src="img/6.6.jpg" /></a>
                <!--content-down-->
                <div class="content-down">
                    <ul class="imgBox1">
                        @foreach($spic as $sp)
                        <li>
                            <a href="#"><img src="{{$sp->spic}}" /></a>
                            
                        </li>
                        @endforeach

                       
                    </ul>
                    <div class="currentNum-down">
                        <span class="imgNum1 mark-color"></span>
                        <span class="imgNum1"></span>
                        <span class="imgNum1"></span>
                        <span class="imgNum1"></span>
                        <span class="imgNum1"></span>
                    </div>
                    <div class="control1 to-left1"><i class="fa fa-angle-left"></i></div>
                    <div class="control1 to-right1"><i class="fa fa-angle-right"></i></div>
                </div>
                <a style="float: left" href="#"><img src="img/15.jpg" /></a>
            </div>
            <!--right-sidbar-->
            <div class="right-sidebar">
                <div class="info-box">
                    <ul class="tab-nav">
                        <li id="li-1" class="li-nav li-nav-hover li-border">公告</li>
                        <li id="li-2" class="li-nav">规则</li>
                        <li id="li-3" class="li-nav">论坛</li>
                        <li id="li-4" class="li-nav">安全</li>
                        <li style="border-right: none" id="li-5" class="li-nav">公益</li>
                    </ul>
                    <div id="box-1" style="display: block" class="hiddenBox">

                        <a href="#">淘宝2014:开放多样性</a>
                        <a href="#">舌尖中国二季 天猫首尝</a>
                        <a href="#">阿里通信自建计费系统</a>
                        <a href="#">来往首届419宇宙节</a>
                    </div>
                    <div id="box-2" class="hiddenBox">

                        <a href="#">[重要] 淘点点规范</a>
                        <a href="#">[重要] 虚假交易新规&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href="#">[重要] 新增认证规则</a>
                        <a href="#">[重要] 购买刀具实名</a>
                    </div>
                    <div id="box-3" class="hiddenBox">
                        <a href="#">[优化] 称谓滥用将整改</a>
                        <a href="#">[热点] 如何赢取新商机</a>
                        <a href="#">[话题] 同城交易避处罚</a>
                        <a href="#">[聚焦] 新消保法全解析</a>
                    </div>
                    <div id="box-4" class="hiddenBox">

                        <a href="#">个人重要信息要管牢！</a>
                        <a href="#">卖家防范红包欺诈提醒</a>
                        <a href="#">更换收货地址的陷阱！</a>
                        <a href="#">注意骗子的技术升级了</a>
                    </div>
                    <div id="box-5" class="hiddenBox">
                        <a href="#">[优化] 称谓滥用将整改</a>
                        <a href="#">[热点] 如何赢取新商机</a>
                        <a href="#">[话题] 同城交易避处罚</a>
                        <a href="#">[聚焦] 新消保法全解析</a>
                    </div>
                </div>
                <!--user-info-->
                <div class="user-info">
                    <div class="gold-top">
                        <img width="62px" height="62px" src="img/user-head.jpg" />
                        @if(session('email'))
                        <div class="inner-user">
                            <h3>{{ session('email') }}</h3>
                            <a class="get-gold" href="#"><span class="glods"></span><span class="get-money">领淘金币抵钱</span></a>
                            <a class="vip-home" href="/Home/Login">退出</a>
                        </div>
                        @else
                         <div class="inner-user">
                            
                            <a class="get-gold" href="#"><span class="glods"></span><span class="get-money">领淘金币抵钱</span></a>
                            
                        </div>
                        @endif
                    </div>
                    <!--login-->
                    <div class="login"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="login-btn" href="/Home/Login/create"></i>登陆</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="login-btn free" href="/Home/index/create">注册</a>
                      
                    </div>
                </div>
                <!--service-->
                <div class="service">
                    <h3>便民服务</h3>
                    <div id="service-1" class="service-cell service-z">
                        <h5 class="service-i"><img src="img/phone.png" /></h5>
                        <h6>话费</h6>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div id="service-2" class="service-cell service-z">
                        <h5 class="service-i"><img src="img/game.png" /></h5>
                        <h6>游戏</h6>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div id="service-3" class="service-cell service-z">
                        <h5 class="service-i"><img src="img/plane.png" /></h5>
                        <h6>旅行</h6>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div id="service-4" class="service-cell service-z">
                        <h5 class="service-i"><img src="img/save.png" /></h5>
                        <h6>保险</h6>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/18.png" /></h5>
                        <h6>彩票</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/move.png" /></h5>
                        <h6>电影</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/eat.png" /></h5>
                        <h6>点外卖</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/money.png" /></h5>
                        <h6>理财</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/book.png" /></h5>
                        <h6>电子书</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/miusc.png" /></h5>
                        <h6>音乐</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/bag.png" /></h5>
                        <h6>水电煤</h6>
                    </div>
                    <div class="service-cell">
                        <h5 class="service-i"><img src="img/....png" /></h5>
                        <h6>请期待</h6>
                    </div>
                </div>
                <!--service-box-->
                <div id="service-box-1" class="service-box">
                    <div class="service-head">
                        <a href="#">话费充值</a>
                        <a href="#">流量充值</a>
                        <span class="fa fa-times"></span>
                    </div>
                    <div class="feihua-in">
                        <span>号码</span>
                        <input class="tell-num" type="text"  placeholder="手机号、固话号"/>
                    </div>
                    <div class="feihua-in">
                        <span>面值</span>
                        <input class="money-in" type="text" value="50" />
                        <span class="fa fa-angle-down sel-money"></span>
                    </div>
                    <div class="gary-text"><span>售价&nbsp;￥&nbsp;</span><span class="orange">49-49.8</span></div>
                    <div style="margin-top: 10px">
                        <a href="#" class="now-chongzhi">立即充值</a>
                        <a href="#" class="now-chongzhi dingqi">定期充值</a>
                        <a href="#">3G急速上网卡</a>
                    </div>
                </div>
                <div id="service-box-2" class="service-box">
                    <div class="service-head">
                        <a href="#">话费充值</a>
                        <a href="#">流量充值</a>
                        <span class="fa fa-times"></span>
                    </div>
                    <div class="feihua-in">
                        <span>号码</span>
                        <input class="tell-num" type="text"  placeholder="手机号、固话号"/>
                    </div>
                    <div class="feihua-in">
                        <span>面值</span>
                        <input class="money-in" type="text" value="50" />
                        <span class="fa fa-angle-down sel-money"></span>
                    </div>
                    <div class="gary-text"><span>售价&nbsp;￥&nbsp;</span><span class="orange">49-49.8</span></div>
                    <div style="margin-top: 10px">
                        <a href="#" class="now-chongzhi">立即充值</a>
                        <a href="#" class="now-chongzhi dingqi">定期充值</a>
                        <a href="#">3G急速上网卡</a>
                    </div>
                </div>
                <div id="service-box-3" class="service-box">
                    <div class="service-head">
                        <a href="#">话费充值</a>
                        <a href="#">流量充值</a>
                        <span class="fa fa-times"></span>
                    </div>
                    <div class="feihua-in">
                        <span>号码</span>
                        <input class="tell-num" type="text"  placeholder="手机号、固话号"/>
                    </div>
                    <div class="feihua-in">
                        <span>面值</span>
                        <input class="money-in" type="text" value="50" />
                        <span class="fa fa-angle-down sel-money"></span>
                    </div>
                    <div class="gary-text"><span>售价&nbsp;￥&nbsp;</span><span class="orange">49-49.8</span></div>
                    <div style="margin-top: 10px">
                        <a href="#" class="now-chongzhi">立即充值</a>
                        <a href="#" class="now-chongzhi dingqi">定期充值</a>
                        <a href="#">3G急速上网卡</a>
                    </div>
                </div>
                <div id="service-box-4" class="service-box">
                    <div class="service-head">
                        <a href="#">话费充值</a>
                        <a href="#">流量充值</a>
                        <span class="fa fa-times"></span>
                    </div>
                    <div class="feihua-in">
                        <span>号码</span>
                        <input class="tell-num" type="text"  placeholder="手机号、固话号"/>
                    </div>
                    <div class="feihua-in">
                        <span>面值</span>
                        <input class="money-in" type="text" value="50" />
                        <span class="fa fa-angle-down sel-money"></span>
                    </div>
                    <div class="gary-text"><span>售价&nbsp;￥&nbsp;</span><span class="orange">49-49.8</span></div>
                    <div style="margin-top: 10px">
                        <a href="#" class="now-chongzhi">立即充值</a>
                        <a href="#" class="now-chongzhi dingqi">定期充值</a>
                        <a href="#">3G急速上网卡</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--main-->

    <!--main-bottom-->


      @foreach($res as $v)
    <div class="main-bottom">

        <div class="sub-bottom-nav">
           <h1>{{$v->name}}</h1>
         
        </div>
             @foreach($shop as $cont)
             @foreach($cont as $info)
             @if($info->cid == $v->id)
        <div class="single-sale" >
            <div style="margin-top:20px;text-align: center; padding-left: 5px; position: absolute;">
              <a href="/Home/index/{{$info->sid}}">
                <img  style="width: 200px;height:200px " src="{{ $info->pic }}" /></a>
                        <br/><h1> {!! $info->description !!}</h1>
                        <br/>
                        <span>价格:{{$info->price}}</span>
             </div>
       </div>
             @endif
            @endforeach
            @endforeach

    </div>

  @endforeach



    <!--ad-->
    <div class="ad">
        <!-- <img src="img/ad.jpg" />
        <img src="img/ad1.jpg" /> -->
    </div>
    <!--help-->
    <div class="help">
        <div class="help-info">
            <h1><img src="img/help4.png"><span class="help-text">消费者保障</span></h1>
            <a class="help-a" href="#">保障范围</a>
            <a class="help-a" href="#">退货退款流程</a>
            <a class="help-a" href="#">服务中心</a>
            <a class="help-a" href="#">更多特色服务</a>
        </div>
        <div class="help-info">
            <h1><img src="img/help1.png"><span class="help-text">新手上路</span></h1>
            <a class="help-a" href="#">新手专区</a>
            <a class="help-a"v href="#">消费警示</a>
            <a class="help-a" href="#">交易安全</a>
            <a class="help-a margin-r" href="#">24小时在线帮助</a>
        </div>
        <div class="help-info">
            <h1><img src="img/help2.png"><span class="help-text">付款方式</span></h1>
            <a class="help-a-litter" href="#">支付宝快捷支付</a>
            <a class="help-a-litter" href="#">支付宝卡（现金）付款</a>
            <a class="help-a-litter" href="#">支付宝余额付款</a>
            <a class="help-a" href="#">货到付款</a>
        </div>
        <div class="help-info">
            <h1><img src="img/help3.png"><span class="help-text">淘宝特色</span></h1>
            <a class="help-a" href="#">淘宝指数</a>
            <a class="help-a" href="#">淘公仔</a>
            <a class="help-a" href="#">手机淘宝</a>
            <a class="help-a" href="#">旺信</a>
        </div>
    </div>
    <!--footer-->
    <div class="footer">
        <div class="footer-right">
            <br/>
            <h2>友情链接</h2>
            <div class="footer-nav">
                @foreach($link as $v)
                <a href="http://{{$v->link}}">{{$v->name}}</a>|
                @endforeach
            </div>
            <div class="about-tao">
                <a href="#">关于淘宝</a>
                <a href="#">合作伙伴</a>
                <a href="#">营销中心</a>
                <a href="#">廉正举报</a>
                <a href="#">联系客服</a>
                <a href="#">开放平台</a>
                <a href="#">诚征英才</a>
                <a href="#">联系我们</a>
                <a href="#">网站地图</a>
                <a href="#">法律声明</a>
                <span class="gary-text">&copy; 2014 Taobao.com 版权所有</span>
            </div>
            <p class="gary-text"><span>网络文化经营许可证：文网文[2010]040号</span>|<span>增值电信业务经营许可证：浙B2-20080224-1</span>|<span>信息网络传播视听节目许可证：1109364号</span></p>
            <div class="some-info">
                <img src="img/some.png" />
            </div>
        </div>
        <div class="tao-man">
            <img src="img/tao-man.png" />
        </div>
    </div>

    <!--backtoTop1-->
    <!--兼容所有现代浏览器同时包括 ie6/7/8/9 （ie6会有一点点抖动）-->
    <div class="backtoTop" id="backToTop1">
        <div id="backToTop-up" class="up-back"><i class="fa fa-angle-up"></i></div>
        <div id="backToTop-down" class="down-back"><i class="fa fa-angle-down"></i></div>
    </div>


    <script src="js/jquery_1.9.js"></script>
    <script src="js/main.js"></script>
    <script src="js/img-show.js"></script>

</body>
</html>