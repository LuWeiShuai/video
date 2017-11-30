@extends('layout/admin')
@section('title','浏览链接')


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            浏览链接
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <form action="/admin/friendlink" method="get">
            <div id="DataTables_Table_1_length" class="dataTables_length">
                <label>
                    显示
                    <select size="1" name="num" aria-controls="DataTables_Table_1">
                        <option value="10" @if($request->num == '10') selected="selected" @endif>
                            10
                        </option>
                        <option value="25" @if($request->num == '25') selected="selected" @endif>
                            25
                        </option>
                        <option value="50" @if($request->num == '50') selected="selected" @endif>
                            50
                        </option>
                    </select>
                    条数据
                </label>
            </div>
           
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    关键字:
                    <input type="text" name="search" value="{{$request->search}}" aria-controls="DataTables_Table_1">
                </label>
                <button class="btn btn-danger">搜索</button>
            </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 65px;">
                            编号
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 70px;">
                           链接名称
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 50px;">
                            关键字
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 54px;">
                            链接地址
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 54px;">
                            链接管理
                        </th>
                       
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    
                    @if(count($res) == 0)
                        <tr><td colspan="5" style="text-align: center;">暂无数据</td></tr>
                    @else
                        @foreach($res as $k => $v)
                        <tr class="@if($k % 2 == 0)
                                        odd  
                                    @else  
                                        even 
                                    @endif">
                           <td class=" " >
                                {{$v->id}}
                            </td>
                            <td class=" ">
                                {{$v->linkName}}
                            </td>
                            <td class=" ">
                               {{$v->keywords}}
                            </td>
                           <td class=" ">
                             <a href=" {{$v->url}} " style="color: #f39800;"> {{$v->url}}</a>
                            </td>
                            <td class=" ">
                                <a href="/admin/friendlink/{{$v->id}}/edit" class="btn btn-danger">修改</a>
                                <form action="/admin/friendlink/{{$v->id}}" method='post' style='display:inline'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class='btn btn-warning'>删除</button>
                               </form>
                            </td>
                        </tr>
                        @endforeach
                    
                    @endif
                </tbody>
            </table>
             <style>
                .pagination li{
                    float: left;
                    height: 20px;
                    padding: 0 10px;
                    display: block;
                    font-size: 12px;
                    line-height: 20px;
                    text-align: center;
                    cursor: pointer;
                    outline: none;
                    background-color: #444444;
                    color: #fff;
                    text-decoration: none;
                    border-right: 1px solid rgba(0, 0, 0, 0.5);
                    border-left: 1px solid rgba(255, 255, 255, 0.15);
                    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                }
                .pagination a{
                    color: #ffffff;
                }
                .pagination .active{
                    background-color: #88a0eb;
                    border: none;
                    background-image: none;
                    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
                }
                 .pagination .disabled{
                    color:#666666;
                    cursor: default;
                 }
                 .pagination{
                    margin: 0px;
                 }
            </style>

            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate" >
              
               {!! $res->appends($request->all())->render() !!}
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    $('.mws-form-message').delay(3000).slideUp(1000);

</script>

@endsection