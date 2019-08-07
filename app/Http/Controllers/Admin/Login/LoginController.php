<?php

namespace App\Http\Controllers\Admin\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param 后台账号退出
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 销毁session,pull里面的参数是存储session的名称
        $request->session()->pull('adminUser');
        // 权限
        $request->session()->pull('nodelist');

        // 返回登录界面
        return redirect('Admin/Login/create');
        
    }

    /**
     * Show the form for creating a new resource.
     * @param 后台登录界面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 登录页面
        return view('Admin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param 用户登录验证
     */
    public function store(Request $request)
    {
       
        $res = $request->except('_token');
        
        if(!$res['userName']){

            return back()->with('error','账号不能为空');
        }
        
        if(!$res['pwd']){
        
            return back()->with('error','密码不能为空');
        
        }
       // dd($res['userName']);
       $info = DB::table('admin_data_users')->where('userName','=',$res['userName'])->first();
        
        if($info){
          
            $pwd = Hash::check($res['pwd'],$info->pwd);

            if($pwd){

                // 把用户名写入session
                session(['adminUser'=>$res['userName']]);
                // 权限管理
                // 获取登录用户的所有权限(DB)
                $list = DB::select("select n.name, n.controller,n.method from user_role as ur,role_node as rn,node as n where ur.rid = rn.rid and rn.nid = n.id and uid = {$info->id}");
                // dd($list);
                
                // 初始化权限
                $nodelist['IndexController'][] = 'index';
                foreach($list as $v){
                    $nodelist[$v->controller][] = $v->method; 
                // 添加方法名称
                    if($v->method == 'create'){
                        $nodelist[$v->controller][] = 'store';
                    }

                    if($v->method == 'edit'){
                        $nodelist[$v->controller][] = 'update';
                    }


                }
                // dd($nodelist);
                // 当前用户存入session
                session(['nodelist'=> $nodelist]);
                return redirect('/Admin/index')->with('success','登录成功');
            
            }else{
             
               return back()->with('error','密码不正确');
            
            }
           
        }else{
         
            return back()->with('error','用户名不存在');
        
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
}
