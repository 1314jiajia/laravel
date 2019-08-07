<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class classifyModel extends Model
{
   protected $table = 'admin_index_Classify';

   public $timestamps = false;

   protected $filable = ['name','pid','path'];
   // 分类表
  
}
