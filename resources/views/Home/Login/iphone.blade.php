 <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>手机注册</title>
    <link href="/Home/css/admin_login.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <div style="background-image: url(/images/1.jpg); height: 940px ;margin-top: -120px">
<div class="admin_login_wrap">
    <h1 align='center'>手机注册</h1>
    <div class="adming_login_border">
        <div class="admin_input1">

            <form action="/Home/Pwd" method="post">

              @if(session('error'))
                {{ session('error') }}
              @endif
              
              @if(session('success'))

                {{ session('success')}}
              
              @endif
              {{ csrf_field() }}
             
                <ul class="admin_items1">
                  
                    <li>
                         <!-- <label for="pwd" style="margin-left: 0px;padding-top: 20px">电话</label> -->
                       <input type="text" name="email" value="请输入手机号"  size="24" class="admin_input_style" />
                       
                    </li>
                   
                    <li>
                        
                        <input type = "text" name="code" value="" id="code" size="10" class="admin_input_style" style="width:180px"/>
                        <button id = 'code'style="margin-left: 30px;" >验证码</button>
                    </li><br/>
                   
                    <li>
                        <input type="submit" tabindex="3" value="注册" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
     </div>
</div>
</body>

</html>