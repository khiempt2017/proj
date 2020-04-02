@php
    use App\Functions\Functions as Functions;
    $linkLogin      = route("user/index/login");
    $linkLogout     = route("user/logout");
    $linkHome       = Functions::getLinkHome();
@endphp
<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{{ $linkHome }}">
                                <div class="logo"><span>KHIÊM</span>PHAN</div>
                            </a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>KHIÊM</span>PHAN</div>
                            </a>
                        </div>
                        <!-- Navigation -->
                        <nav class="main_nav">
                            <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">
                                
                                @if (count($categoryItemsMenu) > 0)
                                    @foreach ($categoryItemsMenu as $key => $value)
                                        @php
                                            $category_id    = $value->id;
                                            $category_name  = $value->name;  
                                            $linkCategory   = Functions::getLinkCategory($category_id); //Lấy link của bài viết 
                                            $currentCategoryId = route::input("id");
                                            $className      = $currentCategoryId == $category_id ? "class=active" : "";
                                            
                                        @endphp
                                        <!-- Menu -->
                                        <li {{$className}}><a href="{{$linkCategory}}">{{$category_name}}</a></li>
                                    @endforeach
                                @endif
                                @if (session('userInfo'))

                                    <li><a href="{{ $linkLogout }}">Log Out</a></li>

                                @else

                                    <li><a href="{{ $linkLogin }}">Đăng nhập</a></li>

                                @endif
                                
                            </ul>
                        </nav>
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm">
                            <i class="fa fa-bars trans_200 menu_mm" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>