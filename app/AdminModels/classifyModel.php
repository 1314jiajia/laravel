<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class classifyModel extends Model
{
   protected $table = 'article';

   public $timestamps = true;

   protected $filable = ['id','title','content','pic','author','created_at','updated_at'];
   // 分类表
  
}
