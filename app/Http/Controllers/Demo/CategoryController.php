<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
   public function index()
   {
	    $category = Category::with('allChildrenCategorys')->find(5);
	   
	    $res = $category->allChildrenCategorys->toArray();
	    // var_dump($res);
	    // $arr = json_decode($res);
	  	// dd($arr);
	  	dd($res);
	}
}
