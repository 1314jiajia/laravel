<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link href="/Home/css/admin_login.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <div style="background-image: url(/images/1.jpg); height: 940px ;margin-top: -120px">
<div class="admin_login_wrap">
    <h1 align='center'>登录</h1>
    <div class="adming_login_border">
        <div class="admin_input">

            <form action="/Home/Login" method="post">

              @if(session('error'))
                {{ session('error') }}
              @endif
              
              @if(session('success'))

                {{ session('success')}}
              
              @endif
              {{ csrf_field() }}
             
                <ul class="admin_items">
                   
                    <li>
                        <label for="user">邮箱:</label>
                        <input type="text" name="email" value=""  size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="pwd" value=""  size="35" class="admin_input_style" />
                    </li>
                   <!--  <li>
                        <label for="pwd">验证码：</label>
                        <input type="text" name="code" value="" id="pwd" size="15" class="admin_input_style" />
                        <img onclick="this.src='/code/captcha/{tmp}&rnd='+Math.random()" width="120px" height="40px" style="vertical-align:top;" src="/code/captcha/{tmp}">
                    </li><br/> -->
                    <a class="pass-fgtpwd pass-link" href="/Home/Pwd/create">忘记密码？</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="pass-sms-btn pass-link"href="/Home/message" title="短信快捷登录" data-type="sms" id="">短信快捷登录</a><br/><br/>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
     </div>
</div>
</body>

</html>