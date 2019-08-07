<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use DB;
class classifyModel extends Model
{
	// 分类列表添加
    public function add($data)
    {
    	 $res = DB::table('admin_index_Classify')->insert($data);
    	 dd('添加成功');
    }
}
