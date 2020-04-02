@php
    use App\Functions\Functions as Functions;
@endphp
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            @if (count($categoryItemsMenu) > 0)
                @foreach ($categoryItemsMenu as $key => $value)
                    @php
                        $category_id    = $value->id;
                        $category_name  = $value->name;   
                        $linkCategory   = Functions::getLinkCategory($category_id); //Lấy link của bài viết
                    @endphp
                    <!-- Menu -->
                    <li class="menu_mm"><a href="{{$linkCategory}}">{{$category_name}}</a></li>
                @endforeach
            @endif
            
        </ul>
    </nav>
    <div class="menu_subscribe"><a href="#">Subscribe</a></div>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>