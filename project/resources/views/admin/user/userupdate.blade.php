@extends('/layout/admin')
@section('title','用户上传列表')

@section('content')        
            <!-- Inner Container Start -->
            <div class="container">
            
                <!-- Statistics Button Container -->
                <div class="mws-stat-container clearfix">
                   
                    
                    
                </div>
                
                <!-- Panels Start -->
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> 用户上传的列表</span>
                    </div>
                   
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th class="checkbox-column" id="xuanze">
                                        <a href="">全选</a>/<a href="">全不选</a>
                                    </th>
                                    <th>用户名</th>
                                    <th>上传时间</th>
                                    <th>上传视频</th>
                                    <th>视频图片</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                               
                            @foreach($res as $k=>$v)
                            
                            <tbody>
                               
                                <tr>
                                    <td class="checkbox-column">
                                        <input type="checkbox">
                                    </td>
                                    <td>{{$v->username}}</td>
                                    <td>{{$v->time}}</td>
                                    <td>{{$v->title}}</td>
                                    <td>{{$v->content}}</td>
                                    <td id="caozuo">
                                    <a href="/admin/userup/{{$v->id}}" class="btn btn-info"> 通过</a>
                                        <form action="/admin/userup/{{$v->id}}" method="post" style="display: inline">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE')}}
                                    
                                             <button class="btn btn-danger">不通过</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                           @endforeach
                        </table>
                    </div>      
                </div>
                
                
                
                
              

                
                
                
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
@endsection          