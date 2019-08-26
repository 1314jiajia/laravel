<?php

namespace App\Http\Controllers\Admin\pic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Config;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
class picController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $pic = DB::table('pic')->paginate(4);
         return view('Admin.pic.index',['pic'=>$pic]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.pic.add');
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
        $res['pic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        $res['created_at'] = time();
        $res['updated_at'] = time();
       
        if(empty($res['name'])){

            return back()->with('error','名称不能为空');
        }
        // dd($res);
        $data = DB::table('pic')->insert($res);
        
        if($data){

             return redirect('/Admin/pic')->with('success','添加成功');
        
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
        $res = DB::table('pic')->where('id','=',$id)->first();
        // dd($res);
        return view('Admin.pic.edit',['res'=>$res]);
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
        // dd($id);
        $data = $request->except(['_token','_method']);
        if(empty($data['name'])){
            return back()->with('error','名字不能为空');
        }
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
        $data['pic'] = trim(Config::get('app.app_upload')."/"."s_".$fileName.".".$extension,'.'); 
        // dd($data);
        $res = DB::table('pic')->where('id','=',$id)->update($data);
        
        if($res){

                return redirect('/Admin/pic')->with('success','修改成功');
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
       $res = DB::table('pic')->where('id','=',$id)->delete();
       
       if($res){
       
            return redirect('/Admin/pic')->with('success','删除成功');
       
       }else{

            return back()->with('error','删除失败');

       }
    
    }

}
