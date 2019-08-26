<?php

namespace App\Http\Controllers\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Intervention\Image\ImageManager; // 图片处理
use Config;
use App\Services\OSS;//导入OSS类
use Storage; // 七牛类
use Illuminate\Support\Facades\Redis; // redis 缓存类
use App\AdminModels\classifyModel;   // 模型类


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // 声明空数组
        $arr = [];

        // 存放key
        $redisKey = 'Article:ArticleKey';

        // 存放数据
        $redisInfo = 'Article:ArticleInfo';

        // 如果不存在去数据库拿给redis
        if(Redis::exists($redisKey)){

            // 取出文章中的所有id
            $listKey = Redis::lrange($redisKey,0,-1);

            // 遍历id,$v就是ID
            foreach($listKey as $v){

                $arr[] = Redis::hgetall($redisInfo.$v);
            }   
            // dd($arr);

        }else{

             // 第一次去数据库中去拿
             $arr = classifyModel::get()->toArray();
             
             // DB用法
             // $arr = DB::table('Article')->get()->toArray();
              
             //    foreach($arr as $k=>$v){
             //        $ll[$k] = (array)$v;
             //    }
             //     dd($ll);
            
             foreach($arr as $v){   
                 
                // 把key写入redis
                Redis::lpush($redisKey,$v['id']);

                // 把数据存入redis,需要有id区分数据
                Redis::hmset($redisInfo.$v['id'],$v);

             }

            
        }

       
        return view('Admin.Article.index',['res'=>$arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Article.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //--------------------------普通上传--------------------------------------------
        // 1. 判断文件是否上传
        // if($request->hasFile('pic')){

        // // 2. 获取文件后缀名
        // $extension = $request->file('pic')->getClientOriginalExtension(); 
        
        // // 3. 随机文件名称
        // $fileName = 'ljl'.rand(1,9999);
        
        // // 4. 移动上传的文件到指定目录
        // $request->file('pic')->move(Config::get('app.app_upload'),$fileName.'.'.$extension);

        // // 实例化图片类
        // $image = new ImageManager();

        // // 设置图片属性           图片地址
        // $image->make(Config::get('app.app_upload')."/".$fileName.".".$extension)->resize(100,100)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        // }

        // // 拼装数据
        // $res['title'] = $request->input('title');
        // $res['content'] = $request->input('content');
        // $res['created_at'] = date('Y-m-d H:i:s');
        // $res['updated_at'] = date('Y-m-d H:i:s');
        // $res['pic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        // $res['author'] = $request->input('author');
      
        // if(empty($res['title'])){

        //     return back()->with('error','标题不能为空');
        // }

        // if(empty($res['content'])){

        //     return back()->with('error','内容不能为空');
        // }
        // // dd($res);
        // $data = DB::table('Article')->insert($res);
        
        // if($data){

        //      return redirect('/Admin/Article')->with('success','添加成功');
        
        // }else{

        //     return back()->with('error','添加失败');
        // }

        //---------------------------------------阿里云图片上传,需要手动创建文件夹?----------------------------------------
        // 1. 判断文件是否上传
        // if($request->hasFile('pic')){

        // // 2. 获取文件后缀名
        // $extension = $request->file('pic')->getClientOriginalExtension(); 
        
        // // 3. 随机文件名称
        // $fileName = 'ljl'.rand(1,9999);
        // // 获取上传文件
        // $file     = $request->file('pic');
        
        // // 文件名称 
        // $newfile  = $fileName.'.'.$extension;
        
        // // 文件路径
        // $filepath = $file->getRealPath();
        
        // // 上传阿里云
        // OSS::upload($newfile, $filepath);
        
        // // 实例化图片类
        // $image = new ImageManager();
        // $dir = Config::get('app.app_upload');
        // 判断文件夹是否存在
        // if(!file_exists($dir)){
        //     mkdir($dir);
        // }
        // // 设置图片属性           图片连接+文件名
        // $image->make(env('AliUrl').$newfile)->resize(100,100)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        // }

        // // 拼装数据
        // $res['title']   = $request->input('title');
        // $res['content'] = $request->input('content');
        // $res['created_at'] = date('Y-m-d H:i:s');
        // $res['updated_at'] = date('Y-m-d H:i:s');
        // $res['pic']    = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        // $res['author'] = $request->input('author');
      
        // if(empty($res['title'])){

        //     return back()->with('error','标题不能为空');
        // }

        // if(empty($res['content'])){

        //     return back()->with('error','内容不能为空');
        // }
        // // dd($res);
        // $data = DB::table('Article')->insert($res);
        
        // if($data){

        //      return redirect('/Admin/Article')->with('success','添加成功');
        
        // }else{

        //     return back()->with('error','添加失败');
        // }

        // // -------------------------七牛云图片上传-----------------------

         // 1. 判断文件是否上传
        if($request->hasFile('pic')){

        // 2. 获取文件后缀名
        $extension = $request->file('pic')->getClientOriginalExtension(); 
        
        // 3. 随机文件名称
        $fileName = 'ljl'.rand(1,9999);
        // 获取上传文件
        $file     = $request->file('pic');
        
        // 文件名称 
        $newfile  = $fileName.'.'.$extension;
        
       
        // 上传七牛
        \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(), 'r'));
        
        // 实例化图片类
        $image = new ImageManager();

        // 拼装本地图片地址
        $dir = Config::get('app.app_upload');
        
        // 判断文件夹是否存在
        if(!file_exists($dir)){
            mkdir($dir);
        }
        // 设置图片属性           图片连接+文件名
        $image->make(env('QINIU_DOMAIN').$newfile)->resize(100,100)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        }

        // 拼装数据
        $res['id']=$request->input("id");
        $res['title']   = $request->input('title');
        $res['content'] = $request->input('content');
        $res['created_at'] = date('Y-m-d H:i:s');
        $res['updated_at'] = date('Y-m-d H:i:s');
        $res['pic']    = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        $res['author'] = $request->input('author');
        
        if(empty($res['title'])){

            return back()->with('error','标题不能为空');
        }

        if(empty($res['content'])){

            return back()->with('error','内容不能为空');
        }
            
        $id = DB::table('Article')->insertGetId($res);
        // $res['id']= $id;
        // dd($res);
        // $info = classifyModel::create($res);
        
        // $id = $info->id;
        if($id){
            
                // 1.存放key
                $redisKey = 'Article:ArticleKey';

                // 2.存放数据
                $redisInfo = 'Article:ArticleInfo';
               

                // 1.1 插入一条id,就是上面的key ,$data是添加返回的id
                Redis::rpush($redisKey,$id);

                $res['id']= $id;
                // dump($res);die;
                // 2.2 存入数据
                Redis::hmset($redisInfo.$id,$res);
               // dd($aa);
             return redirect('/Admin/Article')->with('success','添加成功');
        
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
        $res = DB::table('Article')->where('id','=',$id)->first();
        return view('Admin.Article.edit',['res'=>$res]);
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
                // 1. 判断文件是否上传
        if($request->hasFile('pic')){

        // 2. 获取文件后缀名
        $extension = $request->file('pic')->getClientOriginalExtension(); 
        
        // 3. 随机文件名称
        $fileName = 'ljl'.rand(1,9999);
        
        // 4. 移动上传的文件到指定目录
        $request->file('pic')->move(Config::get('app.app_upload'),$fileName.'.'.$extension);
        $dir = Config::get('app.app_upload');
        if(!file_exists($dir)){
            mkdir($dir);
        }
        // 实例化图片类
        $image = new ImageManager();

        // 设置图片属性           图片地址
        $image->make(Config::get('app.app_upload')."/".$fileName.".".$extension)->resize(100,100)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        }else{
          return back()->with('error','请上传图片');
        }
        $res = $request->except(['_token','_method']);
        $res['created_at'] = date('Y-m-d H:i:s');
        $res['updated_at'] = date('Y-m-d H:i:s');
        $res['pic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        // 1.存放key
        //     $redisKey = 'Article:ArticleKey';

        // 2.存放数据
             $redisInfo = 'Article:ArticleInfo';
      
         // 修改redis中的数据
         Redis::hmset($redisInfo.$id,$res);

        $data = DB::table('Article')->where('id','=',$id)->update($res);
        
        if($data){

            return redirect('/Admin/Article')->with('success','修改成功');
        
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
        $res = DB::table('Article')->where('id','=',$id)->delete();
        
        if($res){

            return redirect('/Admin/Article')->with('success','删除成功');
        
        }else{

            return back()->with('error','删除失败');
        }
    }

    // Ajax删除
    public function AjaxDel(Request $request)
    {
            // 获取到删除数据的id
            $arr = $request->input('arr');
            // echo json_encode($id);
            // 循环数值id进行删除
            foreach($arr as $v){
                
              $res = DB::table('Article')->where('id','=',$v)->delete();
                // 1.存放key
                $redisKey = 'Article:ArticleKey';

                // 2.存放数据
                $redisInfo = 'Article:ArticleInfo';

                // 删除id
                Redis::lrem($redisKey,1,$v);

                // 删除数据
                Redis::del($redisInfo.$v);


            }

            // 给 Ajax 返回
            echo 1;       
    } 


}
