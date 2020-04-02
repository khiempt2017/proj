{{-- @if (count($items) > 0)
    @foreach ($items as $key => $value)
        @php
            
        @endphp
        
    @endforeach
@else
@endif --}}

<?php 
    
?>
@foreach ($categoryItemsIsHome as $key => $value)
    @php
        $category_name  = $value->name;
        
    @endphp
    @if($value->display == "grid")
        @include('default.pages.index.index-child.left-content.category-child.category-grid')
    @elseif($value->display == "list")
        @include('default.pages.index.index-child.left-content.category-child.category-list')  
    @endif   
@endforeach