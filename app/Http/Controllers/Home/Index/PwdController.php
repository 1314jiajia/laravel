<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Hash;
class PwdController extends Controller
{	
	// 加载修改密码界面
    public function index(Request $request)
    {	
    	$id = $request->input('id');
    	// dd($id);
    	return view('Home.message.doForget',['id'=>$id]);
    }
      

	// 邮箱找回密码界面
    public function create()
    {
    	return view('Home.Login.Forget');
    }

    // 邮箱修改密码
    public function store(Request $request)
    {
    	$email = $request->input('email');
        if(empty($email)){
            return back()->with('error','邮箱不能为空');
        }

        // 邮箱正则
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
       
        if(!preg_match($pattern,$email)){
             return back()->with('error','邮箱根式不正确');
         }
        
        // 根据邮箱查询出数据库中的数据
        $res = DB::table('register')->where('email','=',$email)->first();
       
        // 调用邮箱接口 
        $req = $this->sendView($res->id,$email);
 		
 		// 调转邮箱登录重置
        if($req){

        	return redirect('https://mail.qq.com');
        }

    }


     // 发送视图给邮箱
    public function sendView($id,$email)
    {
        //邮件消息生成器 $message 
        Mail::send('Home.message.restPwd',['id'=>$id],function($message)use($email){ 
            //发送主题 
            $message->subject('密码找回'); 
            //接收方
            $message->to($email); 
          
         });

        return true;
    }

    // 更新数据库中的密码
    public function rePassword(Request $request)
    {	
    	
    	$id = $request->input('id');
    	
    	// 获取输入框中的密码
    	$data['pwd'] = $request->input('password');
    	$res['rpwd'] = $request->input('repassword');

    	if(empty($data['pwd'])){

    		return back()->with('error','密码不能为空');
    	}

    	if($data['pwd']!== $res['rpwd']){

    		return back()->with('error','两次密码不一致');
    	}

    	// 密码加密
    	$data['pwd'] = Hash::make($data['pwd']);
    	
    	// 更新密码
    	$res = DB::table('register')->where('id','=',$id)->update($data);
    	// dd('密码已重置请,重新登录');
    	if($res){

    		return redirect('Home/Login/create');
    	
    	}else{

    		return back()->with('error','密码重置失败');
    	}
    }

    // 短信注册页面
    
    // public function Meassage()
    // {
    // 	return view('Home.Login.iphone');
    // }


}
