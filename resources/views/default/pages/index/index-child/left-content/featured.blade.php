@php
    use App\Functions\Functions as Functions;
    $linkHome = Functions::getLinkHome();
@endphp
<div class="featured">
    <div class="featured_title">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="section_title">Nổi bật</div>
                        </div>
                        <div class="section_bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Title -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Post -->
                @php
                    $firssFeatureArticle= $featuredArticleItems[0];
                    $id                 = $firssFeatureArticle->id;
                    $name               = $firssFeatureArticle->name;
                    $category_id        = $firssFeatureArticle->category_id;
                    $category_name      = $firssFeatureArticle->category_name;
                    $linkCategory       = Functions::getLinkCategory($category_id); //Lấy link của Category 
                    $linkArticle        = Functions::getLinkArticle($id,$category_id); //Lấy link của bài viết 
                    $linkHome           = Functions::getLinkHome();
                    $thumb              = asset("default/images/article/$firssFeatureArticle->thumb");
                    $publish_at         = date('d/m/Y', strtotime($firssFeatureArticle->publish_at));  
                    unset($featuredArticleItems[0]); //Unset phần tử đầu tiên của mảng để phần đổ dữ liệu tiếp theo không đổ lại cái này nữa
                    
                @endphp
            <div class="post_item post_v_large d-flex flex-column align-items-start justify-content-start">
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    <div class="post_image">
                        <a href="{{ $linkArticle }}">
                            <img src="{{ $thumb }}" alt="images/article/{{ $name }}" class="img-fluid w-100">
                        </a>
                    </div>
                    <div class="post_content">
                        <div class="post_category cat_technology ">
                            <a href="{{ $linkCategory }}">{{ $category_name }}</a>
                        </div>
                        <div class="post_title"><a
                                href="{{ $linkArticle }}">{{ $name }}</a></div>
                        <div class="post_info d-flex flex-row align-items-center justify-content-start">
                            <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                <div class="post_author_name"><a href="#">Khiêm</a>
                                </div>
                            </div>
                            <div class="post_date"><a href="#">{{ $publish_at }}</a></div>
                        </div>
                        <div class="post_text">
                            <p>{{ $name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            @foreach ($featuredArticleItems as $key => $value)
                @php
                    $id                 = $value->id;
                    $name               = $value->name;
                    $category_id        = $value->category_id;
                    $category_name      = $value->category_name;
                    $linkCategory       = Functions::getLinkCategory($category_id); //Lấy link của Category 
                    $linkArticle        = Functions::getLinkArticle($id,$category_id); //Lấy link của bài viết 
                    $linkHome           = Functions::getLinkHome();
                    $thumb              = asset("default/images/article/$value->thumb");
                    $publish_at         = date('d/m/Y', strtotime($value->publish_at));  
                @endphp
                
                <div>
                    <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                        <div class="post_image">
                                <a href="{{ $linkArticle }}">
                                    <img src="{{ $thumb }}" alt="images/article/{{ $name }}" class="img-fluid w-100">
                                </a>
                        </div>
                        <div class="post_content">
                            <div class="post_category cat_technology ">
                                <a href="{{ $linkCategory }}">{{ $category_name }}</a>
                            </div>
                            <div class="post_title"><a
                                    href="{{ $linkArticle }}">{{ $name }}</a></div>
                            <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                    <div class="post_author_name"><a href="#">Khiêm</a>
                                    </div>
                                </div>
                                <div class="post_date"><a href="#">{{ $publish_at }}</a></div>
                            </div>
                            <div class="post_text">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>