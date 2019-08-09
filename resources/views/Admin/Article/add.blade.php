@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>文章添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/Article" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">标题:</label> 
       <div class="mws-form-item"> 
        <input value="" type="text" class="small" name="title" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容:</label> 
       <div class="mws-form-item"> 
    	   <textarea rows="12" cols="60" name ='content' >
          
        </textarea> 
        
       </div> 
      </div> 
      	{{csrf_field()}}
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="添加" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
    </form> 
   </div> 
  </div>

@endsection
@section('title','文章添加')