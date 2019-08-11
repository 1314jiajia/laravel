@extends('Admin.layouts')
@section('body')

<html>
 <head></head>
 <script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 文章管理列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">批量操作</th>
          <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">标题</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">文章内容</th>
        
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($res as $v)
       <tr class="odd"> 
        <td ><input type="checkbox" value="{{ $v->id }}"> </td>
        <td class="">{{ $v->id }}</td> 
        <td class="">{{ $v->title }}</td> 
        <td class=" ">{{ $v->content }}</td> 
     
        <td class=" ">
  
          <form action="/Admin/Article/{{$v->id}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <!-- <button class="btn btn-success" type="submit"><i class="icon-trash"></i></button> -->
            <button class="btn btn-success" >可以使用ajax删除</button>
          </form>

          
         
       </tr>
       @endforeach
       <tr>
          <td colspan="5">
                <button class="btn btn-success " id = "lijinglei" >全选</button>
                <button class="btn btn-success "  >反选</button>
                <button class="btn btn-success " id = "del">删除</button>
           </td>
       </tr>
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
    
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">

  // 全选反选
  $('#lijinglei').click(function(){

      $(':checkbox').each(function(){
        
        $(this).attr('checked',true);

      });
      // 注意不要写在下一级的里面
      }).next().click(function(){

        $(':checkbox').each(function(){
          
          // 如果是true我就给你false 
          $(this).attr('checked',!$(this).attr('checked'));
        
        });

  // 果然被选中就删除
   }).next().click(function(){

      // 声明一个空数组把要删除的id都放在里面
        arr = [];
      $(':checkbox').each(function(){

        // 判断被选中的数据
        if( $(this).attr('checked')){

           // 拿到id
            id = $(this).val();

           // 推到数值中去 
            arr.push(id);
        }

      });
        // ajax 删除
     $.get('/ArticleDel',{arr:arr},function(data){
            
            // 删除页面
          if(data == 1){
              
              for(var i=0; i<arr.length;i++ ){
                $("input[value="+arr[i]+"]").parents('tr').remove();
              }

          }
          
    });

});


  
 </script>
</html>

@endsection
@section('title','文章列表')