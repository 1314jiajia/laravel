<div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <div id="page">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">姓名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">电话</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">地址</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $v)
       <tr class="odd"> 
        <td class="sorting_1">{{ $v->id }}</td> 
        <td class=" ">{{ $v->name }}</td> 
        <td class=" ">{{ $v->tel }}</td> 
        <td class=" ">{{ $v->address}}</td> 
     
        <td class=" ">
         <!-- <a href= "/" class="btn btn-info" href="">详情</a> -->
          <form action="/Admin/huiyuan/{{$v->id}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button class="btn btn-success" type="submit"><i class="icon-trash"></i></button>
          </form>

          <a class="btn btn-info" href=""><i class="icon-wrench"></i></a></td> 
         
       </tr>
        @endforeach
       
      </tbody>
     </table>
   </div>