<?php

namespace App\Http\Controllers\Admin\pic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Intervention\Image\ImageManager;
use Config;
use Illuminate\Pagination\LengthAwarePaginator;
class spicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spic = DB::table('spic')->paginate(3);
         return view('Admin.spic.index',['spic'=>$spic]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Admin.spic.sadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  --------------------------普通上传--------------------------------------------
        // 1. 判断文件是否上传
        if($request->hasFile('pic')){

        // 2. 获取文件后缀名
        $extension = $request->file('pic')->getClientOriginalExtension(); 
        
        // 3. 随机文件名称
        $fileName = 'ljl'.rand(1,9999);
        
        // 4. 移动上传的文件到指定目录
        $request->file('pic')->move(Config::get('app.app_upload'),$fileName.'.'.$extension);

        // 实例化图片类
        $image = new ImageManager();

        // 设置图片属性           图片地址
        $image->make(Config::get('app.app_upload')."/".$fileName.".".$extension)->resize(520,280)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        }else{
            return back()->with('error','请选择图片');
        }

        // 拼装数据
       
        $res['name'] = $request->input('name');
        $res['spic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        $res['created_at'] = time();
        $res['updated_at'] = time();
       
        if(empty($res['name'])){

            return back()->with('error','名称不能为空');
        }
        // dd($res);
        $data = DB::table('spic')->insert($res);
        
        if($data){

             return redirect('/Admin/spic')->with('success','添加成功');
        
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
         $res = DB::table('spic')->where('id','=',$id)->first();
            // dd($res);
         return view('Admin.spic.edit',['res'=>$res]);
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
        if(empty($data['name'])){
            return back()->with('error','名字不能为空');
        }
        // 1. 判断文件是否上传
        if($request->hasFile('spic')){

        // 2. 获取文件后缀名
        $extension = $request->file('spic')->getClientOriginalExtension(); 
        
        // 3. 随机文件名称
        $fileName = 'ljl'.rand(1,9999);
        
        // 4. 移动上传的文件到指定目录
        $request->file('spic')->move(Config::get('app.app_upload'),$fileName.'.'.$extension);

        // 实例化图片类
        $image = new ImageManager();

        // 设置图片属性           图片地址
        $image->make(Config::get('app.app_upload')."/".$fileName.".".$extension)->resize(520,280)->save(Config::get('app.app_upload').'/'."s_".$fileName.".".$extension);
        
        }else{
            return back()->with('error','请选择图片');
        }
        $data['spic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        // dd($data);
        $res = DB::table('spic')->where('id','=',$id)->update($data);
        
        if($res){

                return redirect('/Admin/spic')->with('success','修改成功');
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
        $res = DB::table('spic')->where('id','=',$id)->delete();
       
       if($res){
       
            return redirect('/Admin/spic')->with('success','删除成功');
       
       }else{

            return back()->with('error','删除失败');

       }
    
    }
}
