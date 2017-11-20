@extends('layout/admin')
@section('title','用户列表页')


@section('content')
	<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            用户列表页
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
              <form action='/admin/user' method='get'>
                <div id="DataTables_Table_1_length" class="dataTables_length">
                    <label>
                        显示
                        <select name="num" size="1" aria-controls="DataTables_Table_1">
                            <option value="10"  @if($request->num == '10') selected="selected"  @endif>
                                10
                            </option>
                                   
                            <option value="25" @if($request->num == '25') selected="selected"  @endif> 
                                 25
                            </option>

                            <option value="50"  @if($request->num == '50') selected="selected"  @endif>
                                50
                            </option>
                           
                        </select>
                        条数据
                    </label>
                </div>
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <label>
                        关键字:
                        <input type="text" name='search' aria-controls="DataTables_Table_1" value="{{isset($_GET['search']) ? $_GET['search'] : '' }}">
                    </label>

                    <button class='btn btn-danger'>搜索</button>
                </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 160px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 200px;">
                            手机号
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 190px;">
                            上次登陆时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 130px;">
                            视频观看权限
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 120px;">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <!-- {!! $res !!} -->
                    @foreach($res as $key => $val)
                    <!-- {!! $val !!} -->
                    @if($key % 2 == 0 )
                        <tr class="odd">
                            <td class=" sorting_1">
                                {{ $val->id }}
                            </td>
                            <td class=" ">
                                {{ $val->tel }}
                            </td>
                            <td class=" ">
                                {{ $val->lastlogin }}
                            </td>
                            <td class=" ">
                               {{$val->status ? 'vip用户' : '普通用户'}}
                            </td>
                            <td class=" ">
                                <a href="{{ url('/admin/user/'.$val->id.'/edit') }}"><button class="btn btn-danger">修改</button></a>
                                <form action="{{ url('/admin/user/'.$val->id) }}" method='post' style='display:inline'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class='btn btn-warning'>删除</button>
                               </form>
                            </td>
                        </tr>
                        @else
                        <tr class="even">
                            <td class=" sorting_1">
                                {{ $val->id }}
                            </td>
                            <td class=" ">
                                {{ $val->tel }}
                            </td>
                            <td class=" ">
                                {{ $val->lastlogin }}
                            </td>
                            <td class=" ">
                               {{$val->status ? 'vip用户' : '普通用户'}} 
                            </td>
                            <td class=" ">
                                <a href="{{ url('/admin/user/'.$val->id.'/edit') }}"><button class="btn btn-danger">修改</button></a>
                                <form action="{{ url('/admin/user/'.$val->id) }}" method='post' style='display:inline'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class='btn btn-warning'>删除</button>
                               </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            
                        <style>
            .pagination li{
                background-color: #444444;
                border-left: 1px solid rgba(255, 255, 255, 0.15);
                border-right: 1px solid rgba(0, 0, 0, 0.5);
                box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
                
                cursor: pointer;
                display: block;
                float: left;
                font-size: 12px;
                height: 20px;
                line-height: 20px;
                outline: medium none;
                padding: 0 10px;
                text-align: center;
                text-decoration: none;
            }

            .pagination a{
                color: #fff;

            }
            
            .pagination .active{
                background-color: #88a9eb;
                background-image: none;
                border: medium none;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.25) inset;
                color: #323232;
            }

            .pagination .disabled{
                color: #666666;
                cursor: default;
            }

            .pagination{

                margin:0px;
            }
            </style>

            <div class="dataTables_paginate paging_full_numbers">

                {!! $res->appends($request->all())->render()!!}
              
            </div>
        </div>
    </div>
</div>
	
@endsection