@extends('default.main')
@section('content')
<!-- Content -->

    @php
        use App\Functions\Functions as Functions;
        
        $firstArticle       = $articlesItems[0];
        $id                 = $firstArticle->id;
        $name               = $firstArticle->name;
        $content            = $firstArticle->content;
        $category_id        = $firstArticle->category_id;
        $category_name      = Functions::getCategoryName($category_id);
        $linkHome           = Functions::getLinkHome();
        $linkArticle        = Functions::getLinkArticle($id,$category_id); //Lấy link của bài viết
        $linkCategory       = Functions::getLinkCategory($category_id); //Lấy link của bài viết
        $thumb              = asset("default/images/article/$firstArticle->thumb");
        $publish_at         = date('d/m/Y', strtotime($firstArticle->publish_at));
    @endphp
    <div class="section-category">
        <div class="home">
            <div class="parallax_background parallax-window" data-parallax="scroll"
                data-image-src="{{ asset("default/images/footer.jpg")}}" data-speed="0.8"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{ $name }}</div>
                                <div class="breadcrumbs">
                                    <ul class="d-flex flex-row align-items-start justify-content-start">
                                        <li><a href="{{ $linkHome }}">Trang chủ</a></li>
                                        <li><a href="{{ $linkCategory }}">{{ $category_name }}</a></li>
                                        <li>{{ $name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_container container_category">
            <div class="container">
                <div class="row">
                    <!-- Single Post -->
                    <div class="col-lg-9">
                        <div class="single_post">
                            <div class="post_image">
                                <a href="{{ $linkArticle }}">
                                    <img src="{{ $thumb }}" alt="images/article/exzJEG4WDU.jpeg" class="img-fluid w-100">
                                </a>
                            </div>
                            <!-- Dữ liệu bài viết đầu tiên đổ vào đây -->
                            <div class="post_content">
                                <div class="post_category cat_technology ">
                                    <a href="{{ $linkCategory }}">{{ $category_name }}</a>
                                </div>
                                <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
                                <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                    <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                        <div class="post_author_name"><a href="#">Phan Thiện Khiêm</a></div>
                                    </div>
                                    <div class="post_date"><a href="#">{{ $publish_at }}</a>
                                    </div>
                                </div>
                                <div class="post_text">
                                    {!! $content !!}
                                </div>
                            </div>
                            <div
                                class="section_title_container d-flex flex-row align-items-start justify-content-start zvn-title-category">
                                <div>
                                    <div class="section_title">Bài viết liên quan</div>
                                </div>
                                <div class="section_bar"></div>
                            </div>
                            <!-- Dữ liệu các bài viết liên quan đổ vào đây -->
                            @foreach ($articlesRelated as $key => $value)
                            @php
                                $id = $value->id;
                                $name = $value->name;
                                $category_id = $value->category_id;
                                $content = $value->content;
                                $category_name = Functions::getCategoryName($category_id);
                                $linkHome = Functions::getLinkHome();
                                $linkCategory       = Functions::getLinkCategory($category_id); //Lấy link của bài viết
                                $linkArticle = Functions::getLinkArticle($id,$category_id); //Lấy link của bài viết
                                $thumb = asset("default/images/article/$value->thumb");
                                $publish_at = date('d/m/Y', strtotime($value->publish_at));

                            @endphp
                            @if ($id !== $firstArticle->id) <!-- Không lấy lại bài viết đầu tiên -->
                                <div class="post_item post_h_large">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="post_image">
                                                <a href="{{ $linkArticle }}">
                                                    <img src="{{ $thumb }}" alt="{{ $thumb }}" class="img-fluid w-100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="post_content">
                                                <div class="post_category cat_technology ">
                                                    <a href="{{ $linkCategory }}">{{ $category_name }}</a>
                                                </div>
                                                <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
                                                <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                                    <div
                                                        class="post_author d-flex flex-row align-items-center justify-content-start">
                                                        <div class="post_author_name"><a href="#">Phan Thiện Khiêm</a></div>
                                                    </div>
                                                    <div class="post_date"><a href="#">{{ $publish_at }}</a>
                                                    </div>
                                                </div>
                                                <div class="post_text">
                                                    {{ $name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            @endif
                            
                            @endforeach



                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        @include('default.pages.index.index-child.right-content.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- /Content -->