<?php

namespace App\Http\Controllers\Admin\huiyuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
    	
    	
    	// 获取总页数
    	$page = DB::table('user')->count();
    	
    	// 获取每页几条
    	$tot = 7;
    	
    	// 最大页数
    	$maxpage = ceil($page/$tot);
    	
    	// 循环页数显示
    	for($i=1;$i<=$maxpage;$i++){
    		// 当前页
    		$p[$i] = $i;
    	}
    	// 获取当前页
    	$pages = $request->input('pages');
    		
    	//判断当前页是否为空,空的时候赋值为1
    	if(empty($pages)){

    		$pages = 1;
    	
    	}
    	
    	// 获取偏移量 当前页减一乘以每条显示的页数
    	$offset = ($pages-1)*$tot;
    	// dd($offset);
    	
    	// 获取当前页数据
    	$data = DB::select("select id,name,tel,address from user limit $offset,$tot ");
        // dd($data);
        // 判断是否是ajax数据
    	if($request->ajax()){
    		return view('Admin.huiyuan.page',['data'=>$data]);
    	}
    	
        return view('Admin.huiyuan.index',['data'=>$data,'p'=>$p,'pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.huiyuan.add');
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
       // dd($res);
        if(!empty($res['name'])){
            return back()->with('error','姓名不能为空');
        }
         if(!empty($res['tel'])){
            return back()->with('error','电话不能为空');
        }
         if(!empty($res['address'])){
            return back()->with('error','地址不能为空');
        }
       $res['created_at'] = time();
       $res['updated_at'] = time();
       // dd($res);
       $data = DB::table('user')->insert($res);
       if($data){
       		return redirect('/Admin/huiyuan')->with('success','添加成功');
       }else{
       		return redirect('/Admin/huiyuan')->with('error','添加失败');
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
    	$res = DB::table('user')->where('id','=',$id)->first();
    	
        return view('Admin.huiyuan.edit',['res'=>$res]);
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
        $data = $request->except(['_token','_method']);
        $data['created_at'] = time();
        $data['updated_at'] = time();
        // dd($data);
        $res = DB::table('user')->where('id','=',$id)->update($data);
        if($res){

        	return redirect('Admin/huiyuan')->with('success','修改成功');
        
        }else{

        	return back()->with('error','删除失败');
       
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
        $res = DB::table('user')->where('id','=',$id)->delete();
    	
    	if($res){

    		return redirect('/Admin/huiyuan')->with('success','删除成功');
    
    	}else{

    		return back()->with('error','删除失败');
    	}
    }
}
