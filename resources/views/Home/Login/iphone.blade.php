 <!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/Home/password/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/Home/password/xiangmv/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/Home/password/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/Home/password/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Home/password/xiangmv/css/bootstrap.min.css">

  </head>
<body>
    <!-- <div style="background-image: url(/images/1.jpg); height: 940px ;margin-top: -120px"> -->
  <div class="am-tab-panel" style="margin-top: 300px">
                  <form method="post" action="/Home/message" id="ff">
                 <div class="user-phone" style="margin-top:20px">
                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                    <input type="tel" name="phone" id="phone" placeholder="请输入手机号" class="ll"reminder="请输入正确的手机号"><span></span>
                 </div>                                     
                    <div class="verification" style="margin-top:20px">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码"  style="width:140px" class="ll" reminder="请输入验证码"><span></span>
                      <a href="javascript:void(0)"class="btn btn-info" style="float:right" id="ss">获取</a>
                    </div>
                 <div class="user-pass" style="margin-top:20px">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="pwd" id="password" placeholder="设置密码" class="ll" reminder="请输入正确的密码"><span></span>
                 </div>                   
                 <div class="user-pass" style="margin-top:20px">
                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码" class="ll" reminder="请再次重复密码"><span></span>
                 </div> 
                    <div class="am-cf">
                      {{csrf_field()}}
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>
                    </form>
                
                  <hr>
                </div>
<!-- </div> -->
</body>
  <script type="text/javascript">
    // alert($);
        //手机号 失去焦点事件
  $("input[name='phone']").blur(function(){
    o=$(this);
    //获取手机号
    p=$(this).val();
    //正则校验 match 匹配正则规则 如果匹配到的话 返回true 否则返回null
    if(p.match(/^\d{11}$/)==null){
      // alert("手机号格式不对");
      $(this).next("span").css('color',"red").html('手机号码不合法');
      $(this).addClass("cur");
      Phone=false;
    }else{
      // alert('ok');
      //校验手机号是否唯一
      $.get("/checkphone",{p:p},function(data){
        // alert(data);
        //Ajax 里不能解析$(this)
        if(data==1){
          //手机号已经被注册
          //把按钮禁用
          $("#ss").attr("disabled",true);
          o.next("span").css('color',"red").html("手机号已经注册");
          o.addClass("cur");
          Phone=false;

        }else{
          $("#ss").attr("disabled",false);

          //手机号可用
          o.next("span").css('color',"green").html("手机号可用");
          o.addClass("curs");
          Phone=true;

        }
      })
    }
  });

  //获取按钮
  $("#ss").click(function(){
    oo=$(this);
    //获取手机号
    pp=$("input[name='phone']").val();

    //Ajax
    $.get("/registersendphone",{pp:pp},function(data){
      // alert(data.code);die;
      if(data.code==000000){
        m=60;
        //按钮的倒计时
        mytime=setInterval(function(){
          m--;
          //赋值给按钮
          oo.html(m);
          //禁用按钮
          oo.attr("disabled",true);
          //判断
          if(m<1){
            //清除定时器
            clearInterval(mytime);
            oo.html("发送");
            oo.attr("disabled",false);
          }
        },1000);
      }
    },'json');
  });

  //检测短信校验码
  $("input[name='code']").blur(function(){
    pp=$(this);
    //获取写入的校验码
    code=$(this).val();
    //Ajax
    $.get("/checkcode",{code:code},function(data){
      if(data==1){
        //校验码ok
        pp.next("span").css('color',"green").html("校验码一致");
        pp.addClass("curs");
        Code=true;
      }else if(data==2){
        //校验码有误
        pp.next("span").css('color',"red").html("校验码有误");
        pp.addClass("cur");
        Code=false;
      }else if(data==3){
         //校验码为空
        pp.next("span").css('color',"red").html("校验码为空");
        pp.addClass("cur");
        Code=false;
      }else if(data ==4){
         //校验码过期
        pp.next("span").css('color',"red").html("校验码过期");
        pp.addClass("cur");
        Code=false;
      }
    });
  });

  //表单提交
  $("#ff").submit(function(){
    
    // 比对状态码
    if(Phone && Code){

      return true;//阻止表单提交
    
    }else{
    
      return false;
    
    }

  });
     
  </script>
</html>