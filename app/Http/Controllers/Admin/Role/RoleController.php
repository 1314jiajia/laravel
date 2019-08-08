<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$role = DB::table('role')->get();
    	return view('Admin.role.index',['role'=>$role]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	// 角色添加视图
        return view('Admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['status'] = '1';
        // 添加到数据库
        $res = DB::table('role')->insert($data);
       	
       	if($res){

       		return redirect('/Admin/role')->with('success','角色添加成功');
       
       }else{
       		return back()->with('error','角色添加失败');
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
    {		$nids=[];
    		// 获取当前修改的角色信息
    		$res = DB::table('role')->where('id','=',$id)->first();
    		
    		// 获取所有权限信息
    		$auth = DB::table('node')->get();
    		
    		// 获取当前用户权限
    		$data = DB::table('role_node')->where('rid','=',$id)->get();
    		if(empty($data)){

    			return view('Admin.role.auth',['res'=>$res,'auth'=>$auth,'nids'=>[]]);
    		}else{
    			foreach($data as $v){
    				$nids[] = $v->nid;
    			}

    			return view('Admin.role.auth',['res'=>$res,'auth'=>$auth,'nids'=>$nids]);
    		}
      		
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
            // if(!$_POST['nids']){

            // }
        	$rid = $request->input('rid');
            if(isset($_POST['nids'])){
            	// 获取所有权限
        		$nids = $_POST['nids'];

        		// 删除原有的权限
        		DB::table('role_node')->where('rid','=',$rid)->delete();

                    foreach($nids as $v){
        			// nid 是权限id
        			$data['nid'] = $v;
        			// role_node表中的 rid 是node表中的id
        			$data['rid'] = $rid;
     				
     				// 执行添加
     				$res = DB::table('role_node')->insert($data);

        		}
        		if($res){

        			return redirect('/Admin/role')->with('success','权限添加成功'); 
        		
        		}else{

        			return back()->with('error','权限添加失败');
        		}

        }else{
            return back()->with('error','权限不能为空');
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
       	$res = DB::table('role')->where('id','=',$id)->delete();
    	
    	if($res){
    		return redirect('/Admin/role')->with('success','角色删除成功');
    	}else{
    		return redirect('/Admin/role')->with('error','角色删除失败');
    	}
    }
    	
}
