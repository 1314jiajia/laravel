<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }
   
    
    /**
     * Show the form for creating a new resource.
     *  登录界面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.Login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $pwd = $request->input('pwd');
        $code = $request->input('code');
        // dd($pwd);
        // 根据名字去查一条数据
        if(empty($email)){
            return back()->with('error','邮箱不能为空');
        }
        $res = DB::table('register')->where('email','=',$email)->first();
        // dd($res);
       if(!Hash::check($pwd,$res->pwd)){

            return back()->with('error','密码不正确');

       }else{

            // 当前用户信息写入session
            session(['email'=>$email]);
            session(['user_id'=>$res->id]);

            return redirect('/Home/index');
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

    // 前台用户退出
    public function logout( Request $request)
    {   
        // 清空所有的session信息
        $request->session()->pull('email');
        $request->session()->pull('cart');
        $request->session()->pull('NewGoods');
        return redirect('/Home/Login/create');
    }

}
