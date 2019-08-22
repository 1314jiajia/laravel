<?php

namespace App\Http\Controllers\Home\cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *  购物车商品显示
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
    // 购物车单挑删除
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

    // 购物车删除所有数据
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
           $id = $request->input('id');

           $res = DB::table('shop')->where('id','=',$id)->first();
        // 获取session中所有的商品数据
           $goods = session('cart');
        // 遍历
            foreach ($goods as $key => $value) {
                    
                    // session中的id一样就减减
                    if ($value['id'] == $id) {

                        $goods[$key]['num'] -= 1 ;
                        
                        // 其他情况
                        if($goods[$key]['num'] <= 1){

                            $goods[$key]['num'] = 1;
                        }

                        // 把数据重新写入session
                        session(['cart'=>$goods]);
                        // echo $goods[$key]['num'];
                        // 获取购物车商品数量
                        $data['num'] = $goods[$key]['num'];
                       
                        // 总计价格 (单价乘以数量)
                        $data['tot'] = $goods[$key]['num']*$res->price;
                        
                        // 转换json格式返回
                        echo json_encode($data);
                    }

             } 
    }

     // 购物车数量加加
    public function add(Request $request)
    {
            $id = $request->input('id');
            $res = DB::table('shop')->where('id','=',$id)->first();
            // 获取到session中的所有商品
             $goods = session('cart');
             
             foreach ($goods as $key => $value) {
                 
                 if( $value['id'] == $id ){

                    $goods[$key]['num'] += 1;
                    
                    if($goods[$key]['num'] >= $res->num){

                        $goods[$key]['num'] = $res->num;   
                    }
                    session(['cart'=>$goods]);
                    $data['num'] = $goods[$key]['num'];
                    $data['tot'] = $goods[$key]['num']*$res->price;
                    echo json_encode($data);
                 }

             }
    }

    // 计算总数和总价格
    public function checkeds()
    {   
        // 获取到数值中的值?       
        if(!empty( $arr = $_GET['arr'])){
      
        // 总件数
         $zsum  = 0;

        // 价格总计
        $zmoney = 0; 

        // 遍历选中的数据$v 就是勾选商品的ID
        foreach($arr as $id){
            // 获取session中的数据
             $data = session('cart');
           
            // 遍历session中的数据 
             foreach($data as $key => $value){

                // 判断选中的商品在不在session中
                    if($value['id'] == $id){
                        
                        // 获取数量
                        $num = $data[$key]['num'];
                       
                        // 根据选中的ID去拿数据
                        $res = DB::table('shop')->where('id','=',$id)->first();

                        //  根据数据去拿单价
                        $price = $res->price;

                        // 获取总计
                        $zj = $num*$price;

                        // // 获取总件数
                        $zsum+= $num;

                        $zmoney+= $zj;
                    }
             }   
            
        } 
                        // 把商品的总件数和总钱数放在数组中
                        $info['zsum'] = $zsum; 
                        $info['zmoney'] = $zmoney; 
                        echo json_encode($info);
             }else{
                        // 没有勾选商品是给默认值
                        $info['zsum'] = 0; 
                        $info['zmoney'] = 0; 
                        echo json_encode($info);
                        
                }

    }


}
