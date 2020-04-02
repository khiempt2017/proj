<?php 
    // echo '<h3 style="color:red"> View của article - form</h3>';
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

{{-- <a href="article">LIST</a>
<a href="article/delete/12">Delete</a>
<a href="article/change-status-active/69">Status</a>
<a href="article/form/69">Edit</a>
<a href="article/form">Add</a> --}}
<?php 
    use App\Helpers\Template as Template; 
    use App\Functions\Functions as Functions; 
    $linkSave = route($controllerName . '/save');
    
?>



@extends('admin.main')
@section('content')

<div class="right_col" role="main">
    @include('admin.templates.error')
    <!-- Gọi Error nếu Validate ra lỗi -->

    @if ($items == null)
    <!--  Nếu không có dữ liệu thì show ra kiểu ko dữ liệu. $items là giá trị article controller trả về nếu có id trên URL-->
    <!--  ============================ Phần Add ============================-->
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>{{ucfirst($controllerName)}} - Form - Add</h3>
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
                <label for="editor" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                <div class="col-md-6 col-sm-6 col-xs-12">       
                        <textarea name="content" id="content" rows="10" cols="80">                                                      
                        </textarea>
                        <script>
                            // Replace the <textarea id="editor"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'content' );
                        </script>
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
                <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-6 col-xs-12" id="category" name="category_id">
                        <option value="default">Select Category</option>
                        @foreach ($categoryList as $key => $value) <!-- In danh sách category ra -->

                            @php
                                $category_id          = $value->id;
                                $categoryName         = $value->name;
                            @endphp

                            <option value="{{ $category_id }}">{{$categoryName}}</option>      
                        @endforeach
                    
                    </select>
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
                $content        = $items[0]['content'];
                $thumb          = $items[0]['thumb'];
                $category_id    = $items[0]['category_id'];
                $status         = $items[0]['status'];
                $type           = $items[0]['type'];
                $categoryName   = Functions::getCategoryName($category_id);
                
                $statusName     = ($status == "active") ? "Kích Hoạt" : "Chưa kích hoạt";
            ?>
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>{{ucfirst($controllerName)}} - Form - Edit</h3>
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
                <label for="editor" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                <div class="col-md-6 col-sm-6 col-xs-12">       
                        <textarea name="content" id="content" value="" rows="10" cols="80">       
                                {{ $content }}                                               
                        </textarea>
                        <script>
                            // Replace the <textarea id="editor"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'content' );
                        </script>
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
                <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-6 col-xs-12" id="category" name="category_id">
                        <option value="{{ $category_id }} ">{{ $categoryName }} </option>
                        @foreach ($categoryList as $key => $value) <!-- In danh sách category ra -->

                            @php
                                $category_id          = $value->id;
                                $categoryName         = $value->name;
                            @endphp

                            <option value="{{ $category_id }}">{{$categoryName}}</option>      
                        @endforeach
                    
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb" value="{{ $thumb }}">
                    <p style="margin-top: 50px;"><img src="{{asset("/images/article/$thumb")}}"
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