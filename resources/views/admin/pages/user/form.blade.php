<?php 
    // echo '<h3 style="color:red"> View của Slider - form</h3>';
    // echo '<h3 style="color:red">ID bên View: '.$id.'</h3>';
    // echo '<h3 style="color:red">Title bên View: '.$title.'</h3>';

    // $linkList       = route($controllerName);
    // $linkAdd        = route($controllerName.'/form');
    // $linkEdit       = route($controllerName.'/form',  ['id' => 12]);
    // $linkStatus     = route($controllerName.'/status',['id' => 69, 'status' => 'active']);
    // $linkDelete     = route($controllerName.'/delete',['id' => 69]);

    // echo '<h3 style="color:red"> Link List:     '.$linkList.'</h3>';
    // echo '<h3 style="color:red"> Link Add:      '.$linkAdd.'</h3>';
    // echo '<h3 style="color:red"> Link Edit:     '.$linkEdit.'</h3>';
    // echo '<h3 style="color:red"> Link Status:   '.$linkStatus.'</h3>';
    // echo '<h3 style="color:red"> Link Delete:   '.$linkDelete.'</h3>';
?>

{{-- <a href="slider">LIST</a>
<a href="slider/delete/12">Delete</a>
<a href="slider/change-status-active/69">Status</a>
<a href="slider/form/69">Edit</a>
<a href="slider/form">Add</a> --}}
<?php 
    use App\Helpers\Template as Template; 
    $linkSave = route($controllerName . '/save');
    
?>



@extends('admin.main')
@section('content')

<div class="right_col" role="main">
    @include('admin.templates.error')
    <!-- Gọi Error nếu Validate ra lỗi -->

    @if ($items == null)
    <!--  Nếu không có dữ liệu thì show ra kiểu ko dữ liệu. $items là giá trị slider controller trả về nếu có id trên URL-->
    <!--  ============================ Phần Add ============================-->
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>User - Form - Add</h3>
        </div>
    </div>
    <div class="x_content">
        <form method="POST" action="{{$linkSave}}" accept-charset="UTF-8" enctype="multipart/form-data"
            class="form-horizontal form-label-left" id="main-form">
            <input name="_token" type="hidden" value="dutQIgn8U38T7e7XMeOBAb7gy1so1xFoXAu3xK0y">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="name" type="text" value="" id="name">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="password" type="password" value="" id="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="password_confirmation" type="password" value="" id="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="description" type="text" value=""
                        id="description">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-6 col-xs-12" id="status" name="status">
                        <option value="default">Select status</option>
                        <option value="active">Kích hoạt</option>
                        <option value="inactive" selected="selected">Chưa kích hoạt</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="link" type="text" value="" id="link">
                </div>
            </div>
            <div class="form-group">
                <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb">
                    <p style="margin-top: 50px;"><img src="" alt="" class="zvn-thumb"></p>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input name="id" type="hidden" value="">
                    <input name="thumb_current" type="hidden" value="">
                    <input class="btn btn-success" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
    @else
    <!--  $items có giá trị nên sẽ show ra kiểu Edit-->
    <!--  ============================ Phần Edit ============================-->

    <?php 
                $id             = $items[0]['id'];
                $name           = $items[0]['name'];
                $description    = $items[0]['description'];
                $link           = $items[0]['link'];
                $thumb          = $items[0]['thumb'];
                $status         = $items[0]['status'];
                $statusName     = ($status == "active") ? "Kích Hoạt" : "Chưa kích hoạt";
            ?>
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>User - Form - Edit</h3>
        </div>
    </div>
    <div class="x_content">
        <form method="POST" action="{{$linkSave}}" accept-charset="UTF-8" enctype="multipart/form-data"
            class="form-horizontal form-label-left" id="main-form">

            <input name="_token" type="hidden" value="dutQIgn8U38T7e7XMeOBAb7gy1so1xFoXAu3xK0y">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="name" type="text" value="{{ $name }}"
                        id="name">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="description" type="text"
                        value="{{ $description }}" id="description">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-6 col-xs-12" id="status" name="status">
                        <option value="{{ $status }}" selected="selected">{{ $statusName }}</option>
                        <option value="active" >Kích hoạt</option>
                        <option value="inactive">Chưa kích hoạt</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="link" type="text"
                        value="{{ $link }}" id="link">
                </div>
            </div>
            <div class="form-group">
                <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb" value="{{ $thumb }}">
                    <p style="margin-top: 50px;"><img src="{{asset("/images/slider/$thumb")}}"
                            alt="Ưu đãi học phí" class="zvn-thumb"></p>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <input name="id" type="hidden" value="{{ $id }}">
                    <input name="thumb_current" type="hidden" value="{{ $thumb }}">
                    <input class="btn btn-success" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
    @endif

</div>
@endsection