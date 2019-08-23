<?php

namespace App\Http\Controllers\Home\order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\address\AddressController;
use DB;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 购物车结算页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Home.order.index');
    }

    /**
     * Show the form for creating a new resource.
     * 获取到勾选商品放在session中给结算页使用
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         
    }

    /**
     * Store a newly created resource in storage.
     *  调用支付宝方法goodPay()
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 地址
        $data = $request->except('_token');
        
        // 订单编号
        $data['order_num'] = time()+mt_rand(1,9999);
        
        //用户id
        $data['user_id'] = session('user_id');
        $data['status'] = 0;
        $data['created_at'] = time();
        $data['updated_at'] = time();
        // dd($data);
        // 订单表
        $id = DB::table('orders')->insertGetId($data);
        // dd($id);
        // order_id
        if($id){
            // 添加订单详情表(获取到购买商品)
            $goods = session('NewGoods');
            // dd($goods);
            $tot = 0;
            $arrOrder = [];
            foreach ($goods[0] as $key => $value) {
                // 获取商品数据
                $res = DB::table('shop')->where('id','=',$value['id'])->first();
                // 拼装数据
                $info['order_id'] = $id;
                $info['goods_id'] = $value['id'];
                $info['num'] = $value['num'];
                $info['name'] = $res->name;
                $info['pic'] = $res->pic;
                $info['created_at'] = time();
                $info['updated_at'] = time();
                // 总计
                $tot += $info['num'] * $res->price; 
                $arrOrder[] = $info;
               
            }
            // dd($arrOrder);
             if(DB::table('order_goods')->insert($arrOrder)){
                   
                    // 把需要显示的订单信息存储在session中
                        // 订单编号
                        session(['order_id'=>$id]);
                        
                        // 地址id
                        session(['address_id'=>$data['address_id']]);

                        // 金额
                        session(['tot'=>$tot]);
                    
                    // 获取支付需要的对接参数
                   
                    // 订单编号
                    $out_trade_no = $data['order_num'];
                   
                    // 订单名称
                    $subject = '这里可以自定义';
                    
                    // 金额
                    $total_fee = '0.01';
                    
                    // 描述
                    $body = 'rookie';
                   
                    // 调用支付方法
                    goodPay($out_trade_no,$subject,$total_fee,$body);
             }
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

    // 购物车结算操作
    public function Settlement(Request $request)
    {       // 后取到勾选id
            $arr = $_GET['arr'];
            $data = [];
            // 遍历勾选商品id
            foreach($arr as $id){

                // 获取session中的数据
                $goods = session('cart');

                // 遍历session中的数据
                foreach($goods as $k => $v){

                    // 如果session中的id等于选中的id
                    if($v['id'] == $id){

                        // 拿到勾选商品的数量和id
                        $data[$k]['num'] = $goods[$k]['num'];
                        $data[$k]['id']  = $id;
                    }   
                }
            }
            
            // 把所有商品放入数组中
            $request->session()->push('NewGoods',$data);
            
            // 转换格式
            echo json_encode($data);
    }


    // 结算页面
    public function yemian()
    {   
        $goods = session('NewGoods');
       
        // var_dump($goods);die;
        $info = [];
       
        // 总计
        $tot = 0;
        foreach($goods[0] as $k => $v){
 
            // 根据ID去查询数据
            $res = DB::table('shop')->where('id','=',$v['id'])->first();
 
            // 获取页面上需要的数据
                $data['num']   = $v['num'];
                $data['pic']   = $res->pic;               
                $data['name']  = $res->name;
                $data['price'] = $res->price;
            // 总计
                $tot = $res->price*$v['num'];
                $info[] = $data;

            // 获取到用户的所有地址
            $addre = AddressController::addressAll(session('user_id'));    

            // 获取到当前登录的用户信息
            $user = DB::table('address')->where('user_id','=',session('user_id'))->first();
        }
        // dd($info);
        return view('Home.order.index',['info'=>$info,'tot'=>$tot,'addre'=>$addre,'user'=>$user]);
       
    }

    // 支付
    public function ShopPay(Request $request)
    {
        // 修改订单状态
           $order_id = session('order_id');
           $address_id = session('address_id');
           $tot = session('tot');
           $data['status'] = 1;
        // 修改数据库状态
           DB::table('orders')->where('id','=',$order_id)->update($data);
        
        // 获取用户信息
           $info = DB::table('address')->where('id','=',$address_id)->first(); 
        
        // 返回支付成功页面
           return view('Home.order.ok',['info'=>$info,'tot'=>$tot]);

         // 清除购物车,商品信息
            $request->session()->pull('cart');
            $request->session()->pull('NewGoods');
    }
}
