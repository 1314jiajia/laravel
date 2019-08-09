@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>修改添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/huiyuan/{{ $res->id }}" method="post" class="mws-form"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">姓名:</label> 
       <div class="mws-form-item"> 
        <input value="{{ $res->name }}" type="text" class="small" name="name" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">电话:</label> 
       <div class="mws-form-item"> 
       <input value="{{ $res->tel }}" type="text" class="small" name="tel" /> 
        
       </div> 
      </div>
       <div class="mws-form-row"> 
       <label class="mws-form-label">地址:</label> 
       <div class="mws-form-item"> 
       <input value="{{ $res->address }}" type="text" class="small" name="address" /> 
        
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
@section('title','会员修改')