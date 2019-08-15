<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Home.Login.iphone');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.message.page');
    }

    /**
     * Store a newly created resource in storage.
     *    // 手机注册
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              $res = $request->except(['_token','repassword','code']);
              $data['name']   = 'ljl'.time();
              $data['pwd']    = hash::make($res['pwd']);
              $data['email']  = 'ljl@Google.com';
              $data['status'] = 1;
              $data['created_at'] = time();
              $data['updated_at'] = time();
              $data['phone'] = $res['phone'];

              $info = DB::table('register')->insert($data);
             
              if($info){

                    return redirect('/Home/index');
              
              }else{

                    return back()->with('error','注册失败，请重新注册');
              }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 测试邮件发送
    public function send()
    {
        //邮件消息生成器 $message 
        Mail::raw('这里是文件内容', function ($message) { 
        //发送主题 
        $message->subject('这里是文件主题'); 
        //接收方
         $message->to("799975420@qq.com"); });
    }

     // 测试邮件视图发送
    public function sendView($email,$id,$token)
    {
        //邮件消息生成器 $message 
        Mail::send('Home.message.page',['id'=>$id,'token'=>$token],function($message)use($email){ 
            //发送主题 
            $message->subject('这里是文件主题'); 
            //接收方
            $message->to("799975420@qq.com"); 

         });
    
    }

    public function jihuo(Request $request)
    { 
  
        //获取id和token 
        $id=$request->input('id'); 
        $token=$request->input('token');
    }

    // 判断手机号是否唯一
    public function checkphone( Request $request)
    {
        $p = $request->input('p');
        
        // 获取到电话的一列pluck 
        $plucks = DB::table('register')->pluck('phone')->toArray();

        // 判断手机号是否在这个数组中
        if(in_array($p,$plucks)){

            return 1;
        
        }else{

            return 0;
        }

    }
    
    // 调用短信接口  
    public function registersendphone( Request $request)
    {   
        // 电话号码
        $phone = $request->input('pp');
        
        echo $data = sendsphone($phone);
        
    }

    // 手机短信注册页面
    public function phone()
    {
        return view('Home.Login.iphone');
    }

    // 手机验证
   public function checkcode( Request $request)
   {    
         $code=$request->input("code");

        if(isset($_COOKIE['pcode']) && !empty($code)){
           
            //获取系统的校验码
            $pcode=$request->cookie("pcode");
           
            //和系统的校验码做对比
            if($code==$pcode){
                
                echo 1;//校验码ok

            }else{
           
                echo 2;//校验码有误
           
            }

        }else if(empty($code)){

                echo 3;//校验码为空
        }else{
                echo 4;//校验码过期
        }



   }
}
