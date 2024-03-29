@extends('Admin.layouts')
@section('body')

<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 会员管理列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">管理名称</th>
        
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($res as $v)
       <tr class="odd"> 
        <td class="sorting_1">{{$v->id}}</td> 
        <td class=" ">{{$v->userName}}</td> 
     
        <td class=" ">
         <a class=" btn btn-success" href="/role/{{$v->id}}">分配角色</a>
          <br/>
          <form action="/Admin/users/{{$v->id}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}

            <button class="btn btn-success" type="submit">删除管理</button>
          </form>

          <a class="btn btn-info" href="/Admin/users/{{$v->id}}/edit">修改按钮</a></td> 
         
       </tr>
       @endforeach
       
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
        {{ $res->links() }}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>

@endsection
@section('title','会员列表')