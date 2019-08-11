<?php

namespace App\Http\Controllers\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('Article')->get();

        return view('Admin.Article.index',['res'=>$res]);
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
        
        $res = $request->except('_token');

        $res['created_at'] = date('Y-m-d H:i:s');
        $res['updated_at'] = date('Y-m-d H:i:s');

        if(!empty($res['title'])){

            return back()->with('error','标题不能为空');
        }

        if(!empty($res['content'])){

            return back()->with('error','内容不能为空');
        }

        $data = DB::table('Article')->insert($res);
        
        if($data){

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
        $res = $request->except(['_token','_method']);
        $res['created_at'] = date('Y-m-d H:i:s');
        $res['updated_at'] = date('Y-m-d H:i:s');

        $data = DB::table('Article')->where('id','=',$id)->update($res);
       
        if($data){

            return redirect('/Admin/Article')->with('success','修改成功');
        
        }else{

            return back()->with('error','删除失败');
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
                
             return  $res = DB::table('Article')->where('id','=',$v)->delete();
            }

          
    } 





}
