<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Gregwar\Captcha\CaptchaBuilder; 
use Gregwar\Captcha\PhraseBuilder;
use Mail;

class IndexController extends Controller
{

    // 获取无限极分类
	 public static function getPid($pid)
     {
    	$res = DB::table('admin_index_Classify')->where('pid','=',$pid)->get();
    	
    	// 声明空数组
    	$data = [];

    	// 循环
    	foreach($res as $v){
    		 // 
    		 $v->suv = self::getPid($v->id);
    		 // dd($v);
    		 $data[] = $v;
    	}
    	return $data;


     }


    /**
     * Display a listing of the resource.
     *  前台页面遍历
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    	$res = self::getPid(0);
        $shop = '';
        // 所有顶级分类
        $admin_index_classify = DB::table('admin_index_classify')->where('pid','=',0)->get();
       
            // dd($admin_index_classify);
            // 获取到顶级分类下面的所有商品
            foreach($admin_index_classify as $v){
                $shop[] = DB::table('shop')->join('admin_index_classify','shop.cate_id','=','admin_index_classify.id')->select('admin_index_classify.name as cname','admin_index_classify.id as cid','shop.name as sname','shop.id as sid','shop.price','shop.pic','shop.description')->where('shop.cate_id','=',$v->id)->get();
            }
            $link = DB::table('links')->get();
             return view('Home.layouts',['res'=>$res,'shop'=>$shop,'link'=>$link]);
       
        // dd($shop);
        // dd($admin_index_classify);
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.register.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        if(empty($email)){
            return back()->with('error','邮箱不能为空');
        }

        // 邮箱正则
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
       
        if(!preg_match($pattern,$email)){
             return back()->with('error','邮箱根式不正确');
         }

        // 手机号正则 
        // $tal = "/^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/";
        // if(!preg_match($tel,$email)){
        //      return back()->with('error','手机号不正确');
        //  }
        // 输入的验证码
        $data['code']  = $request->input('code');

        // session中的验证码
        $data['Scode'] = session('Scode');
   
        if($data['Scode'] == $data['code']){

            $data = $request->except(['_token','code','Scode']);
            $data['pwd'] = Hash::make($data['pwd']); 
            $data['status'] = 0;
            $data['name']='jl'.mt_rand(1,9999);
            $data['created_at'] = time();
            $data['updated_at'] = time();
          
           
           // dd($data); 
            $id = DB::table('register')->insertGetId($data);
               // dd($id);

                if($id){
                    
                    $res = $this->sendView($id,$data['email']);
                    // dd($res);
                    // 返回成功直接到邮箱登录界面去激活
                    if(empty($res)){
                       return redirect('https://mail.qq.com/cgi-bin/loginpage');
                    }else{
                        return back()->with('error','重新发送');
                    }

                }else{
                    return back()->whit('error','注册失败');
                }
            
         }else{

             return back()->with('error','验证码错误');
        } 
    }

    /**
     * Display the specified resource.
     * 商品详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $info = DB::table('shop')->where('id','=',$id)->first();
        // dd($info);
        return view ('Home.Login.details',['info'=>$info]);
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
        // dd($request->all());
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

    // 验证码
    public function captcha($tmp)
    {   
        // 清除操作
        ob_clean();
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
         // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 50, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('Scode', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }


    // 邮件发送
        
    public function sendView($id,$email)
    {
        //邮件消息生成器 $message 
        Mail::send('Home.message.page',['id'=>$id],function($message)use($email){ 
            //发送主题 
            $message->subject('这个是我发给的邮件'); 
            //接收方
            $message->to($email); 
          
         });
    
    }

    // 用户邮箱激活 
    public function activate(Request $request)
    { 
  
        //获取id 
        $id=$request->input('id'); 
        $data['status'] = 1;
        $res = DB::table('register')->where('id','=',$id)->update($data);
        // 激活成功之间调整到首页
        if($res){
            return redirect('/Home/index');
        }
    }

  

}
