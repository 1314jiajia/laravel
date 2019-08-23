<?php

namespace App\Http\Controllers\Home\address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     * 添加新地址到数据库
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->except('_token');
       $data['user_id'] = session('user_id');
       $data['created_at'] = time();
       $data['updated_at'] = time();
       $res = DB::table('Address')->insert($data);
       if($res){

            return redirect('/yemian');
       }else{
            return back();
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

    // 返回城市级联数据
    public function address(Request $request)
    {   
        // 获取到第一级的城市upid
        $upid = $request->input('upid');

        // 获取到所有的级联城市
        $data = DB::table('district')->where('upid','=',$upid)->get();

        //转换格式返回数据
        echo json_encode($data);
    }

    // 获取到用户的所有收货地址
    public static function addressAll($userid)
    {
    
        $user_address = DB::table('Address')->where('user_id','=',$userid)->get();
          
        return $user_address;
    }


    // 收货地址切换
    public function changes(Request $request)
    {
        // 获取ajax穿过来的id
        $id  = $request->input('id');
        $res = DB::table('address')->where('id','=',$id)->first();
        echo json_encode($res);
    }

}
