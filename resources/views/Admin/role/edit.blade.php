@extends('Admin.layouts')
@section('body')

<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>分配管理员角色</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/saveRole" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">角色信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前用户: &nbsp;&nbsp;&nbsp;{{$user->userName}}&nbsp;&nbsp;&nbsp;的角色信息</h4> 
          @foreach($role as $row)
          <ul class="mws-form-list inline">
            <li><input type="checkbox" name="rid[]" value=" {{ $row->id}}" @if (in_array($row->id,$rid)) checked @endif >
             <label>{{$row->name}}</label></li>  
          </ul>
          @endforeach
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{ csrf_field() }}
        <input type="hidden" name="uid" value="{{ $user->id }}">
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