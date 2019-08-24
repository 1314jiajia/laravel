<?php

namespace App\Http\Controllers\Admin\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Admin\Classify\ClassifyController;
use Storage;
use DB;
use Config;
use Markdown;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = DB::table('shop')->get();
        return view('Admin.shop.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // 调用静态方法获取到类别
        $cate = ClassifyController::getpaths();
        // dd($cate);
        return view('Admin.shop.add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     * 添加商品,图片存储在七牛
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

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
        $image->make(env('QINIU_DOMAIN').$newfile)->resize(200,200)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        }else{

            return back()->with('error','请选择上传文件');
        
        }

        $data['name']        = $request->input('name');
        $data['cate_id']     = $request->input('cate_id');
        // markdown 格式
        $data['description'] = Markdown::convertToHtml($request->input('description'));
        $data['num']   = $request->input('num');
        $data['price'] = $request->input('price');
        $data['pic']   = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        $data['created_at'] = time();
        $data['updated_at'] = time();
       // dd($data);
        if(empty($data['name'])){
            return back()->with('error','商品名称不能为空');
        }

        if(empty($data['cate_id'])){
            return back()->with('error','请选择商品类型');
        }

        if(empty($data['description'])){
            return back()->with('error','描述不能为空');
        }
        
        if(empty($data['num'])){
            return back()->with('error','数量不能为空');
        }

        if(empty($data['price'])){
            return back()->with('error','价格不能为空');
        }

        $res = DB::table('shop')->insert($data);

        if($res){

            return redirect('/Admin/shop')->with('success','商品添加成功');
        
        }else{
        
            return back()->with('error','商品添加失败');
        
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
        $data = DB::table('shop')->where('id','=',$id)->first();
        
        // 分类列表
        $cate = ClassifyController::getpaths();
        return view('Admin.shop.edit',['data'=>$data,'cate'=>$cate]);
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
 
       $data = $request->except(['_token','_method']);
       $data['pic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.');
       $data['created_at'] = time();
       $data['updated_at'] = time();
       $res = DB::table('shop')->where('id','=',$id)->update($data);
       
       if($res){
        
            return redirect('/Admin/shop')->with('success','修改成功');
       
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
        $data = DB::table('shop')->where('id','=',$id)->delete();
        
        if($data){
        
            return redirect('/Admin/shop')->with('success','商品删除成功');
        
        }else{
        
            return back()->with('error','商品删除失败');
        
        }
    }
}
