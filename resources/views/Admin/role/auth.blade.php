@extends('Admin.layouts')
@section('body')

<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>权限信息</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/role/{{ $res->id }}" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">权限信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前用户: &nbsp;&nbsp;&nbsp;{{ $res->name }}&nbsp;&nbsp;&nbsp;的角色信息</h4> 
          
          <ul class="mws-form-list inline">
            @foreach($auth as $v)  
            <li><input type="checkbox" name="nids[]" value="{{ $res->id }}" 
              @if(in_array($v->id,$nids)) checked
              @endif
             <label>{{ $v->name }}</label></li>  
          @endforeach
          </ul>
          
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="rid" value="{{ $res->id}}">
       <input value="分配角色" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>

@endsection
@section('title','分配管理员角色')