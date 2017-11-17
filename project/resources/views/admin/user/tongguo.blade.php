@extends('layout/admin')
@section('title','待审核列表')
<style type="text/css">
	#xuanze{
		width:60px;
		/*font-size:1px;*/
	}

</style>

@section('content')
	        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Statistics Button Container -->
            	<div class="mws-stat-container clearfix">
                	
                    <!-- Statistic Item -->
                	
                </div>
                
                <!-- Panels Start -->
                
            	
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Table with Toolbar</span>
                    </div>
                    <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <a href="#" class="btn"><i class="icol-accept"></i> Accept</a>
                                <a href="#" class="btn"><i class="icol-cross"></i> Reject</a>
                                <a href="#" class="btn"><i class="icol-printer"></i> Print</a>
                                <a href="#" class="btn"><i class="icol-arrow-refresh"></i> Renew</a>
                                <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icol-disconnect"></i> Disconnect From Server</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-submenu">
                                        <a href="#">More Options</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Contact Administrator</a></li>
                                            <li><a href="#">Destroy Table</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                            <tbody>
                                <tr>
                                	<td class="checkbox-column">
                                        <input type="checkbox">
                                    </td>
                                    <td>Trident</td>
                                    <td>2012.12.21</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>
                                    	<form action="/admin/guo/id" method="post">
                                    		{{csrf_field()}}
											{{ method_field('DELETE')}}

                                    		<input type="submit" value="下架">
                                    	</form>
                               	 	</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>    	
                </div>
            <!-- Inner Container End -->
            

@endsection
