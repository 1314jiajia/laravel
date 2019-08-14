@extends('Admin.layouts')
@section('body')
<script type="text/javascript" charset="utf-8" src="/static/ueditor/utf8-php/ueditor.config.js"></script>
   <script type="text/javascript" charset="utf-8" src="/static/ueditor/utf8-php/ueditor.all.min.js"></script>
   <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败--> 
   <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加 载的中文，那最后就是中文--> 
   <script type="text/javascript" charset="utf-8" src="/static/ueditor/utf8-php/lang/zh-cn/zh-cn.js"> </script>

  <div class="mws-panel grid_5"> 
   <div class="mws-panel-header"> 
    <span>文章添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form action="/Admin/Article" method="post" class="mws-form" enctype="multipart/form-data"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">标题:</label> 
       <div class="mws-form-item"> 
        <input value="" type="text" class="small" name="title" /> 
       </div> 
      </div> 
       <div class="mws-form-row"> 
       <label class="mws-form-label">作者:</label> 
       <div class="mws-form-item"> 
        <input value="" type="text" class="small" name="author" /> 
       </div> 
      </div> 
        <div class="mws-form-row"> 
         <label class="mws-form-label">图片:</label> 
           <div class="mws-form-item"> 
            <input  type="file" class="small" name="pic" /> 
           </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容:</label> 
       <div class="mws-form-item"> 
    	  <script id="editor" type="text/plain" name="content" style="width:800px;height:350px;"> </script>
       </div> 
      </div> 
      	{{csrf_field()}}
     <div class="mws-button-row"> 
      <input type="submit" class="btn btn-danger" value="添加" /> 
      <input type="reset" class="btn " value="重置" /> 
     </div> 
   </div>
    </form> 
   </div> 
  </div>
  <script type="text/javascript">
  //  实例化编辑器  
    var ue = UE.getEditor('editor'); 
 </script>
  
@endsection
@section('title','文章添加')