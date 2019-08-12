<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('admin_data_users')->get();

        return view('Admin.users.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $request->except('_token');

        if(empty($res['userName'])){
            return back()->with('error','名称不能为空');
        }
        if(empty($res['pwd'])){
            return back()->with('error','密码不能为空');
        }
        $res['created_at'] = time();
        $res['updated_at'] = time();
        $res['pwd'] = Hash::make($res['pwd']);
        $info = DB::table('admin_data_users')->insert($res);
        // dd($info);
        if($info){
            return redirect('/Admin/users')->with('success',"添加成功");
        }else{
           return back()->with('error','添加失败');
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
        $res = DB::table('admin_data_users')->where('id','=',$id)->first();
        // dd($res);
        return view('Admin.users.edit',['res'=>$res]);
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
            $data = $request->except(['_method','_token']);
            $res  = DB::table('admin_data_users')->where('id','=',$id)->update($data); 
            if($res){

                return redirect('Admin/users')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('admin_data_users')->delete($id);
        if($res){
             return redirect('/Admin/users')->with('success',"删除成功");
        }else{
             return redirect('/Admin/users')->with('error',"删除失败");
        }
    }


    // 分配角色
    public function userRole($id)
    {
        $rid = [];
        // 根据id获取用户信息
        $user = DB::table('admin_data_users')->where('id','=',$id)->first();
        
        // role 获取角色信息
        $role = DB::table('role')->get();
        // 获取登录用的所有权限
        $data = DB::table('user_role')->where('uid','=',$id)->get();
        if(empty($data)){
           
            return view('Admin.role.edit',['user'=>$user,'role'=>$role,'rid'=>[]]);
        
        }else{
        
            foreach($data as $v){

                $rid[] = $v->rid;

            }
            // 返回带有权限的视图
            return view('Admin.role.edit',['user'=>$user,'role'=>$role,'rid'=>$rid]);
        }
        
        
    }

    public function saveRole(Request $request)
    {

            // dd($request->all());
            // 获取到用户的uid
            $uid =  $request->input('uid');
            
            // 获取到用户权限
            
            $rid = $_POST['rid'];
        
            // 删除掉原有的权限
            DB::table('user_role')->where('uid','=',$uid)->delete();

            // 把所有的信息循环入库
            foreach($rid as $v){
                $data['uid'] = $uid;
                $data['rid'] = $v;

                // 存入数据库 
               $res = DB::table('user_role')->insert($data);
               // dd($res);
            } 
            if($res){

                return redirect('/Admin/users')->with('success','角色分配成功');
            
            }else{

                return back()->with('error','角色分配失败');
            }
    }
}






