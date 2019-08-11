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


	 public static function getPid($pid)
     {
    	$res = DB::table('admin_index_Classify')->where('pid','=',$pid)->get();
    	// dd($res);
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    	$res = self::getPid(0);
        // dd($res);
        return view('Home.layouts',['res'=>$res]);
       
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
                    if(empty($res)){
                        echo "邮件已发送,需登录激活";
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
            $message->subject('这个是用户激活你要是激活了你就给我发个邮件好不好呀'); 
            //接收方
            $message->to($email); 
          
         });
    
    }

   
    public function activate(Request $request)
    { 
  
        //获取id和token 
        $id=$request->input('id'); 
         $data['status'] = 1;
        $res = DB::table('register')->where('id','=',$id)->update($data);
        if($res){
            return '激活成功';
        }
   }
}
