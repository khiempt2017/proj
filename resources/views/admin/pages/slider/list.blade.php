<?php 
    use App\Helpers\Template as Template; 
?>
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Slider Info</th>
                <th class="column-title">Trạng thái</th>
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
                        $description    = $value['description'];
                        $link           = $value['link'];
                        $thumb          = $value['thumb'];
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
                        <td width="40%">
                        <p><strong>Name:</strong> {{ $name }}</p>
                            <p><strong>Description:</strong> {{ $description }}</p>
                            <p><strong>Link:</strong> {{ $link }}</p>
                            <p><img src="../images/slider/{{ $thumb }}" alt="{{ $name }}" class="zvn-thumb"></p>

                        </td>
                        
                            {!! $showItemsStatus !!}
                        
                        <td>
                            <p><i class="fa fa-user"></i> {{ $created_by }}</p>
                            <p><i class="fa fa-clock-o"></i> {{ date('H:m:s d/m/Y', strtotime($created))}}</p>
                        </td>
                        <td>
                            {!! $showModifiedHTML !!}
                        </td>
                        <td class="last">
                            <div class="zvn-box-btn-filter">
                            <a href="slider/form/{{$id}}" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="slider/delete/{{$id}}" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
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