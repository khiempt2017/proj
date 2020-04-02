<?php 
    use App\Helpers\Template as Template; 
?>
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th class="column-title">STT</th>
                <th class="column-title">ID</th>
                <th class="column-title">Category Info</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Hiển thị</th>
                <th class="column-title">Dạng hiển thị</th>
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
                        $name           = $value['name'];
                        $created        = $value['created'];
                        $created_by     = $value['created_by'];
                        $modified       = $value['modified'];
                        $modified_by    = $value['modified_by'];
                        $status         = $value['status'];
                        $is_home        = $value['is_home'];

                        $display        = $value['display'];
                        $displayName    = $display == "grid" ? "Lưới" : "Danh sách";

                        $optionDisplay1     = $display == "grid" ? "list" : "grid"; //phần value khác với mặc định
                        $optionDisplay1Name = $displayName == "Lưới" ? "Danh sách" : "Lưới"; //phần tên khác với mặc định

                        $linkChangeDisplay  = route($controllerName . "/display", ['display' => "new_value", 'id' => $id]); //code cứng new_value đễ dễ dàng thay thế khi làm JS

                        $currentPage        = $page;
                        $showModifiedHTML   =  Template::showItemsHistory($modified_by,$modified);
                        $showItemsStatus    =  Template::showItemsStatus($controllerName,$id,$status);
                        $showItemsIsHome    =  Template::showItemsIsHome($controllerName,$id,$is_home);
                    @endphp
                    <tr class="even pointer">
                        <td class=""> {{ $index }} </td>
                        <td class=""> {{ $id }} </td>
                        <td width="40%">
                            <p><strong>Name:</strong> {{ $name }}</p>
                        </td>
                        {!! $showItemsStatus !!}
                        {!! $showItemsIsHome !!}
                        <td>
                            <select name="select_change_display" data-url="{{ $linkChangeDisplay }}" class="form-control" data-field="level">
                                <option value="{{ $display }}" selected="selected">{{ $displayName }}</option>
                                <option value="{{ $optionDisplay1 }}">{{ $optionDisplay1Name }}</option>
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
                            <a href="category/form/{{$id}}" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="category/delete/{{$id}}" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
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