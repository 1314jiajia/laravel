<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link href="/Home/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1 align='center'>注册</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="/Home/index" method="post">
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
                   <!--   <li>
                        <label for="pwd">确认密码：</label>
                        <input type="password" name="rpwd" value="" size="35" class="admin_input_style" />
                    </li> -->
                    <li>
                        <label for="pwd">验证码：</label>
                        <input type="text" name="code" value="" id="pwd" size="15" class="admin_input_style" />
                        <img onclick="this.src='/code/captcha/{tmp}&rnd='+Math.random()" width="120px" height="40px" style="vertical-align:top;" src="/code/captcha/{tmp}">
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    
</div>
</body>
</html>