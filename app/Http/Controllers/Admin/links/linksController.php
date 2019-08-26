<?php

namespace App\Http\Controllers\Admin\links;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class linksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('links')->paginate(3);
        // dd($res);
        return view('Admin.links.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.links.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $data = $request->except(['_token']);
            if(empty($data['name'])){
                    return back()->with('error','名称不能为空');
            }
             if(empty($data['link'])){
                    return back()->with('error','链接不能为空');
            }
            $data['created_at'] = time();
            $data['updated_at'] = time();
                
            $res = DB::table('links')->insert($data);
            
            if($res){

                return redirect('/Admin/links')->with('success','链接添加成功'); 
            }else{
                return back()->with('error','链接添加失败');
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
        $res = DB::table('links')->where('id','=',$id)->first();
        return view('Admin.links.edit',['res'=>$res]);
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
        // dd($data);
        if(empty($data['name'])){
            return back()->with('error','名称不能为空');
        }
        if(empty($data['link'])){
            return back()->with('error','名称不能为空');
        }
        
        $res = DB::table('links')->where('id','=',$id)->update($data);
        
        if($res){
        
            return redirect('/Admin/links')->with('success','添加成功');
        
        }else{

            return back()->with('error','添加失败');
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
        $res = DB::table('links')->where('id','=',$id)->delete();
        
        if($res){

            return redirect('/Admin/links')->with('success','删除成功');
        
        }else{

            return back()->with('error','删除失败');
        }

    }
}
