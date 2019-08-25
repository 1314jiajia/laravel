@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>链接添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/links" method="post" class="mws-form" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名称:</label> 
       <div class="mws-form-item"> 
        <input value="" type="text" class="small" name="name"  /> 
       </div> 
      </div> 
  
        <div class="mws-form-row"> 
       <label class="mws-form-label">链接地址:</label> 
       <div class="mws-form-item"> 
       <input value="" type="text" class="small" name="link" /> 
        
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
@section('title','链接添加')