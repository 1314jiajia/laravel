@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>文章修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/Article/{{ $res->id }}" method="post" class="mws-form"> 
       {{ csrf_field() }} 
      {{ method_field('PUT') }}
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">标题:</label> 
       <div class="mws-form-item"> 
        <input value="{{ $res->title }}" type="text" class="small" name="title" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容:</label> 
       <div class="mws-form-item"> 
    	   <textarea rows="12" cols="60" name='content' >
           {{ $res->content }}
        </textarea> 
        
       </div> 
      </div> 
      
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="修改" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
    </form> 
   </div> 
  </div>

@endsection
@section('title','文章修改')