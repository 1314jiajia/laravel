<?php

namespace App\Http\Controllers\Admin\Classify;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\AdminModels\classifyModel;
// use App\AdminModel\classifyModel;
use DB;

class ClassifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // 获取搜索关键词
        $k = $request->input('keywords');
      
        // 按条件查询回去所有参数
       $res = DB::table('admin_index_Classify')->select(DB::raw("*,concat(path,',',id) as paths "))->orderBy('paths')->where('name','like','%'.$k.'%')->paginate(7);
        foreach($res as $k=>$v){
            // 字符串转数组
            $arr = explode(',',$v->path);

            // 获取逗号的值
            $len = count($arr)-1;
            $res[$k]->name = str_repeat("--|",$len).$v->name;
        }
        // dd($res);
       return view('Admin.classify.index',['res'=>$res,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param ljl  
     *  $[name] [description]
     */
    public function create()
    {
        // 获取到数据分配到添加下面
        // 调用排序方法在最下面
         $res = $this->getpaths();
        // 添加分类页面
        return view('Admin.classify.add',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

  
        if(empty($res['name'])){
            return back()->with('error','分类名称不能为空');
        }
          // 获取添加数据
          $res = $request->except('_token');
          // $res['status'] = '1';
         
          // 获取pid
          $pid = $request->input('pid');
         
          if($pid==0){
              
              // 添加父级元素
              $res['path'] = '0';
                // dd($res);
          }else{
              
              // 获取父类信息
              $info = DB::table('admin_index_Classify')->where('id','=',$pid)->first(); 
             // dd($res);
              // 拼接路径  ,path路径链接上id
              $res['path'] = $info->path.','.$info->id;
             
              // dd($res);
        }

        $info = DB::table('admin_index_Classify')->insert($res);
        if($info){
            
            return  redirect('/classify')->with('success','添加成功');
        }else{
            
            return  back()->with('error','添加失败');

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
        //根据pid查询到父级元素下面的子类个数
         $res = DB::table('admin_index_Classify')->where('pid','=',$id)->count();
         // 判断要删除的类别下面是否还有别的子类
         if($res>0){
         
            return '请先删除下面的子类';
         
         }

            $res = DB::table('admin_index_Classify')->where('id','=',$id)->delete();
            if($res){
                
               return  redirect('/classify')->with('success','删除成功');
            
            }else{

              return back()->with('error','删除失败');
            }
         

         
    }

    // 排序
    public function getpaths()
    {
          // 按条件查询回去所有参数
       $res = DB::table('admin_index_Classify')->select(DB::raw("*,concat(path,',',id) as paths "))->orderBy('paths')->get();
        foreach($res as $k=>$v){
            // 字符串转数组
            $arr = explode(',',$v->path);

            // 获取逗号的值
            $len = count($arr)-1;
            $res[$k]->name = str_repeat("--|",$len).$v->name;
        }
        return $res;
    }
}
