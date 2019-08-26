@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>链接修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/links/{{$res->id}}" method="post" class="mws-form" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名称:</label> 
       <div class="mws-form-item"> 
        <input value="{{$res->name}}" type="text" class="small" name="name"  /> 
       </div> 
      </div> 
  
        <div class="mws-form-row"> 
       <label class="mws-form-label">链接地址:</label> 
       <div class="mws-form-item"> 
       <input value="{{$res->link}}" type="text" class="small" name="link" /> 
        
       </div> 
      </div> 
      	{{csrf_field()}}
        {{ method_field('PUT') }}
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="修改" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
    </form> 
   </div> 
  </div>

@endsection
@section('title','链接添加')