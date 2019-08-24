@extends('Admin.layouts')
@section('body')

<html>
 <head></head>
<script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 商品列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <div id="page">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">类别</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">图片</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">描述</th>
 <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">数量</th>
 
  <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">单价</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
       @foreach($data as $v)
       <tr class="odd"> 
        <!-- <td class="sorting_1"></td>  -->
        <td class=" ">{{ $v->id }}</td> 
        <td class=" ">{{ $v->name }}</td> 
        <td class=" ">{{ $v->cate_id }}</td> 
        <td class=" "><img src="{{ $v->pic }}"></td> 
        <td class=" ">{!! $v->description !!}</td> 
        <td class=" ">{{ $v->num }}</td> 
        <td class=" ">{{ $v->price }}</td> 
     
        <td class=" ">
         
          <form action="/Admin/shop/{{ $v->id }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button class="btn btn-success" type="submit"><i class="icon-trash"></i></button>
          </form>
 
          <a class="btn btn-info" href="/Admin/shop/{{ $v->id }}/edit"><i class="icon-wrench"></i></a></td> 
         
       </tr>
     
       @endforeach
      </tbody>
     </table>
   </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">

      <a class="btn btn-info" onclick="()"> 上一页</a> 
      

       <!-- <a class="btn btn-info" onclick="pages()"> </a>  -->
    
       <a class="btn btn-info" onclick="()"> 下一页</a> 
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">

 </script>
</html>

@endsection
@section('title','商品列表')