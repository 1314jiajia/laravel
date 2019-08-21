<?php

namespace App\Http\Controllers\Home\cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取session中的信息
        $info = session('cart');
        $req  = [];
        if(!empty($info)){
            
            // 遍历出session中的所有商品 
            foreach ($info as $key => $value) {

                // 根据id获取到商品数据
               $res = DB::table('shop')->where('id','=',$value['id'])->first();
               $data['num']   = $value['num'];
               $data['id']    = $value['id'];
               $data['pic']   = $res->pic;
               $data['name']  = $res->name;
               $data['price'] = $res->price;
               $req[] = $data;
            }
           
        }

        // dd($res);
        return view('Home.cart.cart',['info'=>$info,'req'=>$req]);
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
        // 获取所有商品
        $data = $request->except('_token');
       
        // 如果有重复商品就拒绝添加到session 
        if(!$this->repeat($data['id'])){

            // 将所哟商品添加到购物车中
            $request->session()->push('cart',$data);
        }
        
        // 跳转到购物车界面
        return redirect('/Home/cart');    
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
        // 获取到session中的所有商品
        $info = session('cart');
        
        // 遍历
        foreach($info as $k => $v){
               
                // 判断选中的id是否在session中 
                if($v['id'] == $id){

                    // 删除session中选中的数据 
                    unset($info[$k]);
                }
        }

        // 重新写入session
        session(['cart'=>$info]); 

        return redirect('/Home/cart');
    }

    // 商品去重
    public function repeat($id)
    {
        // 获取到所有session
           $goods = session('cart');
        
        // 判断session是否为空
            if(!empty($goods)){

                // 循环session数据
                foreach($goods as $v){

                    // 判断session中有相同的id
                    if($v['id']==$id){
                        return true;
                    }
                }
            }
       
    }

    public function delAll(Request $request)
    {
        if(!empty($request->session('crat'))){
            $request->session()->pull('cart');
        }
        session('crat');
        return redirect('/Home/cart');
    }
   
    //购物车数量减减
    public function reduce(Request $request)
    {

    }

     // 购物车数量加加
    public function add($id)
    {
        
    }

}
