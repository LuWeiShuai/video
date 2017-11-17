@extends('layout/admin')
@section('title','用户列表页')


@section('content')
	<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            Data Table with Numbered Pagination
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <div id="DataTables_Table_1_length" class="dataTables_length">
                <label>
                    Show
                    <select size="1" name="DataTables_Table_1_length" aria-controls="DataTables_Table_1">
                        <option value="10" selected="selected">
                            10
                        </option>
                        <option value="25">
                            25
                        </option>
                        <option value="50">
                            50
                        </option>
                        <option value="100">
                            100
                        </option>
                    </select>
                    entries
                </label>
            </div>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    Search:
                    <input type="text" aria-controls="DataTables_Table_1">
                </label>
            </div>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 160px;">
                            Rendering engine
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 205px;">
                            Browser
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 193px;">
                            Platform(s)
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 135px;">
                            Engine version
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 102px;">
                            CSS grade
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr class="odd">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Firefox 1.0
                        </td>
                        <td class=" ">
                            Win 98+ / OSX.2+
                        </td>
                        <td class=" ">
                            1.7
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Firefox 1.5
                        </td>
                        <td class=" ">
                            Win 98+ / OSX.2+
                        </td>
                        <td class=" ">
                            1.8
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Firefox 2.0
                        </td>
                        <td class=" ">
                            Win 98+ / OSX.2+
                        </td>
                        <td class=" ">
                            1.8
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Firefox 3.0
                        </td>
                        <td class=" ">
                            Win 2k+ / OSX.3+
                        </td>
                        <td class=" ">
                            1.9
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Camino 1.0
                        </td>
                        <td class=" ">
                            OSX.2+
                        </td>
                        <td class=" ">
                            1.8
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Camino 1.5
                        </td>
                        <td class=" ">
                            OSX.3+
                        </td>
                        <td class=" ">
                            1.8
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Netscape 7.2
                        </td>
                        <td class=" ">
                            Win 95+ / Mac OS 8.6-9.2
                        </td>
                        <td class=" ">
                            1.7
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Netscape Browser 8
                        </td>
                        <td class=" ">
                            Win 98SE+
                        </td>
                        <td class=" ">
                            1.7
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Netscape Navigator 9
                        </td>
                        <td class=" ">
                            Win 98+ / OSX.2+
                        </td>
                        <td class=" ">
                            1.8
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" sorting_1">
                            Gecko
                        </td>
                        <td class=" ">
                            Mozilla 1.0
                        </td>
                        <td class=" ">
                            Win 95+ / OSX.1+
                        </td>
                        <td class=" ">
                            1
                        </td>
                        <td class=" ">
                            A
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_1_info">
                Showing 1 to 10 of 57 entries
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                <a tabindex="0" class="first paginate_button paginate_button_disabled"
                id="DataTables_Table_1_first">
                    First
                </a>
                <a tabindex="0" class="previous paginate_button paginate_button_disabled"
                id="DataTables_Table_1_previous">
                    Previous
                </a>
                <span>
                    <a tabindex="0" class="paginate_active">
                        1
                    </a>
                    <a tabindex="0" class="paginate_button">
                        2
                    </a>
                    <a tabindex="0" class="paginate_button">
                        3
                    </a>
                    <a tabindex="0" class="paginate_button">
                        4
                    </a>
                    <a tabindex="0" class="paginate_button">
                        5
                    </a>
                </span>
                <a tabindex="0" class="next paginate_button" id="DataTables_Table_1_next">
                    Next
                </a>
                <a tabindex="0" class="last paginate_button" id="DataTables_Table_1_last">
                    Last
                </a>
            </div>
        </div>
    </div>
</div>
	
@endsection