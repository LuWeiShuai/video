@extends('layout/admin')
@section('title','分区管理')


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            分区列表
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 65px;">
                            分类树
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 70px;">
                           ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 50px;">
                            栏目名
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 54px;">
                            栏目管理
                        </th>
                       
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @if(count($res) == 0) 
                    <tr><td colspan="4" style="text-align: center;">暂无数据</td></tr>
                @else
                    @foreach($res as $k => $v)
                        <tr class="@if($k % 2 == 0)
                                            odd  
                                        @else  
                                            even 
                                        @endif">
                           @if($v->fid ==0)
                                <td align="left" valign="middle">
                                    <img src="{{ url('/admins/images/dirfirst.gif')}}" width="15" height="13">
                                </td>
                                 <td class=" ">
                                    {{$v->id}}
                                </td>
                                <td class=" ">
                                   {{$v->name}}
                                </td>
                                <td class=" ">
                                <a href="{{ url('/admin/type/'.$v->id.'/edit')}}" class="btn btn-danger">修 改</a>
                                <a href="/admin/typeSon/create" class="btn btn-danger">添加子分区</a>
                                
                                <!-- 根据fid查询是否有子分区 -->
                                <?php $res1 = DB::table('type')->where('fid',$v->id)->get();?>
    
                                @if($res1 == null)
                                <form action="{{ url('/admin/type/'.$v->id)}}" method='post' style='display:inline'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class='btn btn-warning'>删 除</button>
                               </form>
                               @endif
                               
                                </td>
                            </tr>
                            @endif
                                @foreach($res as $key=>$val)
                                @if($val->fid == $v->id)
                                    <tr class="@if($k % 2 == 0)
                                            odd  
                                        @else  
                                            even 
                                        @endif">
                                        <td align="left" valign="middle">
                                            <img src="{{ url('/admins/images/dirsecond.gif')}}" width="29" height="29">
                                        </td>
                                         <td class=" ">
                                            {{$val->id}}
                                        </td>
                                        <td class=" ">
                                           {{$val->name}}
                                        </td>
                                         <td class=" ">
                                        <a href="{{ url('/admin/typeSon/'.$val->id.'/edit')}}" class="btn btn-danger">修 改</a> 
                                        
                                        <!-- 根据子分区的id查询是否有视频 -->
                                         <?php $res2 = DB::table('video')->where('tid',$val->id)->get(); ?>
                                         
                                        @if($res2 == null)
                                        <form action="{{ url('/admin/typeSon/'.$val->id)}}" method='post' style='display:inline'>
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class='btn btn-warning'>删 除</button>
                                       </form>
                                       @endif
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                           
                            
                                   
                    @endforeach
                @endif
                </tbody>
            </table>
           
            
        </div>
    </div>
</div>

@endsection