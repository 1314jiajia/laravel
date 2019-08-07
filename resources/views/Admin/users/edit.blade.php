@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>管理员修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/users/{{ $res->id }}/edit" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">管理员名称:</label> 
       <div class="mws-form-item"> 
        <input value="{{ $res->userName}}" type="text" class="small" name="userName" /> 
       </div> 
      </div> 
     
        {{ csrf_field() }}
      	{{ method_field('PUT') }}
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="修改" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
    </form> 
   </div> 
  </div>

@endsection
@section('title','会员添加')