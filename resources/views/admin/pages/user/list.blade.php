<?php 
    use App\Helpers\Template as Template; 
?>
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Full name</th>
                <th class="column-title">Username</th>
                <th class="column-title">Avatar</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Quyền hạn</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
        </thead>
        <tbody>
            
            @if (count($items) > 0)
                @foreach ($items as $key => $value)
                    @php
                        $id             = $value['id'];
                        $index          = $key + 1;
                        $name           = $value['fullname'];
                        $username       = $value['username'];
                        $thumb          = $value['thumb'];

                        $level        = $value['level'];
                        $levelName    = $level == "member" ? "Thành viên bình thường" : "Quản trị";

                        $optionlevel1     = $level == "member" ? "admin" : "member"; //phần value khác với mặc định
                        $optionlevel1Name = $levelName == "Thành viên bình thường" ? "Quản trị" : "Thành viên bình thường"; //phần tên khác với mặc định

                        $linkChangeLevel  = route($controllerName . "/level", ['level' => "new_value", 'id' => $id]); //code cứng new_value đễ dễ dàng thay thế khi làm JS
                        
                        $created        = $value['created'];
                        $created_by     = $value['created_by'];
                        $modified       = $value['modified'];
                        $modified_by    = $value['modified_by'];
                        $status         = $value['status'];
                        $showModifiedHTML   =  Template::showItemsHistory($modified_by,$modified);
                        $showItemsStatus    =  Template::showItemsStatus($controllerName,$id,$status);
                    @endphp
                    <tr class="even pointer">
                        <td class=""> {{ $index }} </td>
                        <td width="15%">
                            <p><strong>{{ $name }}</strong> </p>
                        </td>

                        <td width="15%">
                            <p><strong>{{ $username }}</strong> </p>
                        </td>
                        <td>
                            <img src="../images/user/{{ $thumb }}" alt="{{ $name }}" class="zvn-thumb">
                        </td>
                            {!! $showItemsStatus !!}
                        <td>
                            <select name="select_change_level" data-url="{{ $linkChangeLevel }}" class="form-control" data-field="level">
                                <option value="{{ $level }}" selected="selected">{{ $levelName }}</option>
                                <option value="{{ $optionlevel1 }}">{{ $optionlevel1Name }}</option>
                            </select>
                        </td>
                        
                        <td>
                            <p><i class="fa fa-user"></i> {{ $created_by }}</p>
                            <p><i class="fa fa-clock-o"></i> {{ date('H:m:s d/m/Y', strtotime($created))}}</p>
                        </td>
                        <td>
                            {!! $showModifiedHTML !!}
                        </td>
                        <td class="last">
                            <div class="zvn-box-btn-filter">
                            <a href="user/form/{{$id}}" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="user/delete/{{$id}}" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">
                    Dữ liệu đang được cập nhật
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>