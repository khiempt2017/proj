


<?php 
    //Lấy cái link đến từng URL ở trên mà không phải code cứng link như trên
    //$controllerName = 'slider';
    
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
 @extends('admin.main');
 @section('content')
<div class="right_col" role="main">
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Dashboard</h3>
        </div> 
    </div>
</div>
@endsection