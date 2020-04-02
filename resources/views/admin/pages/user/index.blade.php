{{-- <a href="slider">LIST</a>
<a href="slider/delete/12">Delete</a>
<a href="slider/change-status-active/69">Status</a>
<a href="slider/form/69">Edit</a>
<a href="slider/form">Add</a> --}}
<?php 
    use App\Helpers\Template as Template; 
?>

<?php 
    //Lấy cái link đến từng URL ở trên mà không phải code cứng link như trên
    //$controllerName = 'slider';
    /*
    $linkList       = route($controllerName);
    $linkAdd        = route($controllerName.'/form');
    $linkEdit       = route($controllerName.'/form',  ['id' => 12]);
    $linkStatus     = route($controllerName.'/status',['id' => 69, 'status' => 'active']);
    $linkDelete     = route($controllerName.'/delete',['id' => 69]);

    echo '<h3 style="color:red"> Link List:     '.$linkList.'</h3>';
    echo '<h3 style="color:red"> Link Add:      '.$linkAdd.'</h3>';
    echo '<h3 style="color:red"> Link Edit:     '.$linkEdit.'</h3>';
    echo '<h3 style="color:red"> Link Status:   '.$linkStatus.'</h3>';
    echo '<h3 style="color:red"> Link Delete:   '.$linkDelete.'</h3>';
    
    */
    $linkAdd        = route($controllerName.'/form');
?>

@php
    
    

@endphp
@extends('admin.main')
@section('content')
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Danh sách {{ucfirst($controllerName)}}</h3>
            </div>
            <div class="zvn-add-new pull-right">
            <a href="{{$linkAdd}}" class="btn btn-success"><i
                        class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
        @include('admin.templates.notify')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Bộ lọc</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            @php
                            
                            $total = 0;
                            $arrCount = null; //Tạo mảng lưu từng số lượng của các trạng thái
                            foreach($countStatus as $key => $value)
                            {
                                $arrCount[$value['status']] = $value['count'];
                                $total += $arrCount[$value['status']];//Tính luôn tổng số lượng các status
                            }

                            

                            //Giữ lại giá trị sau khi đã bấm search
                            //$search_value = isset($_GET['search_value']) ? $_GET['search_value'] : '';
                            $search_value = $params['search']['value'];
                            $search_field = $params['search']['field'];

                            
                            //Lấy được mảng $arrCount có các phần tử như bên dưới
                            // [active] => 2
                            // [inActive] => 1
                            $arrCount['all'] = $total;
                            

                            $activeBtnAll       = ($params['filter']['status'] == 'all')      ? 'btn-primary' : 'btn-success';
                            $activeBtnActive    = ($params['filter']['status'] == 'active')   ? 'btn-primary' : 'btn-success';
                            $activeBtnInactive  = ($params['filter']['status'] == 'inactive') ? 'btn-primary' : 'btn-success';

                            @endphp
                            <div class="col-md-6">
                                <a href="?filter_status=all" type="button" class="btn {{ $activeBtnAll }}">Tất cả                                    
                                    <span class="badge bg-white">{{ @$arrCount['all'] }}</span>
                                </a>
                                <a href="?filter_status=active" type="button" class="btn {{ $activeBtnActive }}">Đã kích hoạt                             
                                   <span class="badge bg-white">{{ @$arrCount['active'] }}</span>
                                </a>
                                <a href="?filter_status=inactive" type="button" class="btn {{ $activeBtnInactive }}">Chưa kích hoạt                    
                                    <span class="badge bg-white">{{ @$arrCount['inactive'] }}</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="#" method="GET">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle btn-active-field"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                Search by {{ucfirst($search_field)}} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="#"
                                                    class="select-field" data-my-field="all">Search by All</a></li>
                                                <li><a href="#"
                                                    class="select-field" data-my-field="id">Search by ID</a></li>
                                                <li><a href="#"
                                                    class="select-field" data-my-field="name">Search by Name</a>
                                                </li>
                                            </ul>
                                        </div>
                                    <input type="text" class="form-control" name="search_value" value="{{ $search_value }}">
                                        <span class="input-group-btn">
                                        <button id="btn-clear" type="button" class="btn btn-success"
                                                style="margin-right: 0px">Xóa tìm kiếm</button>
                                        <button id="btn-search" type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </span>
                                    <input type="hidden" name="search_field" value="{{$search_field}}">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <select name="select_filter" class="form-control"
                                        data-field="level">
                                    <option value="default" selected="selected">Select Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--box-lists-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Danh sách</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @include('admin.pages.user.list')  <!-- Chứa phần đổ dữ liệu ra danh sách -->
                        
                    </div>
                </div>
            </div>
        </div>
        <!--end-box-lists-->
        <!--box-pagination-->
        
        {!! $items->appends(request()->input())->links('admin.elements.pagination', ['items' => $items]) !!} <!-- Chứa phần Pagination -->
        <!--end-box-pagination-->
    </div>
@endsection
