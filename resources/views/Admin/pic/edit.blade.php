@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>轮播图修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/pic/{{$res->id}}" method="post" class="mws-form" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名称:</label> 
       <div class="mws-form-item"> 
        <input value="{{$res->name}}" type="text" class="small" name="name"  /> 
       </div> 
      </div> 
  
        <div class="mws-form-row"> 
       <label class="mws-form-label">图片修改:</label> 
       <div class="mws-form-item"> 
        <img src="{{$res->pic}}" style="height:100px" >
       <input value="" type="file" class="small" name="pic" /> 
        
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
@section('title','轮播图修改')