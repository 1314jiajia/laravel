@extends('Admin.layouts')
@section('body')
<div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>权限修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/auth/{{$res->id}}" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">权限名称:</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="name" value="{{ $res->name }}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器名称:</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="controller" value="{{ $res->controller }}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">方法名称:</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="method" value="{{ $res->method }}"/> 
       </div> 
      </div> 
        {{ method_field('PUT') }}
        {{csrf_field()}}
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="修改" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
    </form> 
   </div> 
  </div>

@endsection
@section('title','权限修改')