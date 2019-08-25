<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class gerenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $email = session('email');

        $res = DB::table('register')->where('email','=',$email)->first();
        // dd($res);
        return view('Home.wallet.info',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $res  = DB::table('address')->get();
        // dump($res);
        return view('Home.wallet.addre',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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
        $res = DB::table('register')->where('id','=',$id)->update($data);
        
        if($res){
            return redirect('/Home/geren')->with('success','修改成功');
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
        $res = DB::table('address')->where('id','=',$id)->delete($id);
        if($res){
            return redirect('/Home/geren/create')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
