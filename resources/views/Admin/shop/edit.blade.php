@extends('Admin.layouts')
@section('body')

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>商品修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/shop/{{$data->id}}" method="post" class="mws-form" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名称:</label> 
       <div class="mws-form-item"> 
        <input value="{{ $data->name }}" type="text" class="small" name="name" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label" >类别:</label> 
       <div class="mws-form-item"> 
    	
        <select name = 'cate_id' class="small">
          <option value="{{ $data->id }}">请选择</option>
          @foreach($cate as $v)
              <option value="{{ $v->id }}">{{ $v->name }}</option>
          @endforeach
        </select>
       </div> 
      </div>
      
       <div class="mws-form-row"> 
       <label class="mws-form-label">描述:</label> 
       <div class="mws-form-item"> 
       <input value="{{ $data->description }}" type="text" class="small" name="description" /> 
        
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">数量:</label> 
       <div class="mws-form-item"> 
       <input value="{{ $data->num }}" type="text" class="small" name="num" /> 
        
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">价格:</label> 
       <div class="mws-form-item"> 
       <input value="{{ $data->price }}" type="text" class="small" name="price" /> 
        
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">图片:</label> 
       <div class="mws-form-item"> 
        <img   src="{{ $data->pic }} " style="height: 200px" >
       <input value="{{ $data->pic }}" type="file" class="small" name="pic" /> 
        
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
@section('title','商品修改')