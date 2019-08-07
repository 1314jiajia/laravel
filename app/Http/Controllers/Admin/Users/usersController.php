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
        // $res = DB::table('admin_data_users')->where('id','=',$id)->first();

        // return view('Admin.users.edit',['res'=>$res]);
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
            // $res = $request->all();
            // dd($res);
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
}
