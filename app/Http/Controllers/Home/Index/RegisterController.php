<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
}
