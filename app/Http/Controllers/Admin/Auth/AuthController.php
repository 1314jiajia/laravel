<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $res = DB::table('node')->get();
       return view('Admin.Auth.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Auth.add');
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
       $res  = DB::table('node')->insert($data);
        if($res){
            return redirect('/Admin/auth')->with('success','权限添加成功');
        }else{
            return back()->with('error','权限添加失败');
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
        $res = DB::table('node')->where('id','=',$id)->first();
        // dd($res);
        return view('Admin.Auth.edit',['res'=>$res]);
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
       $res  = DB::table('node')->where('id','=',$id)->update($data);
       if($res){
            
            return redirect('/Admin/auth')->with('success','修改成功');
       
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
        $res = DB::table('node')->where('id','=',$id)->delete();

        if($res){
        
            return redirect('/Admin/auth')->with('success','删除成功');
        
        }else{
        
            return back()->with('error','删除失败');
        
        }

    }
}
