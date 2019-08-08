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
    public function index()
    {
    	$data = DB::table('user')->get();
        return view('Admin.huiyuan.index',['data'=>$data]);
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
        $res = DB::table('user')->where('id','=',$id)->delete();
    	
    	if($res){

    		return redirect('/Admin/huiyuan')->with('success','删除成功');
    
    	}else{

    		return back()->with('error','删除失败');
    	}
    }
}
