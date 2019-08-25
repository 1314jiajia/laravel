<?php

namespace App\Http\Controllers\Home\wallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class walletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home.wallet.wallet');
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    // 订单页面 
    public function orders()
    {   
        $id = session('user_id');
        // dd($id);
        $res = DB::table('orders')->where('user_id','=',$id)->get();
        // dump($res);
        foreach($res as $k => $orde){
            $res[$k]->goods = DB::table('order_goods')->where('order_id','=',$orde->id)->get();
            
        }
        
        // dd($res);
    	return view('Home.wallet.order',['res'=>$res]);
    }
}
