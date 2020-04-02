@php
    use App\Functions\Functions as Functions;
    $linkHome = Functions::getLinkHome();
@endphp
<div class="technology">
        <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
            <div>
                <div class="section_title">{{$value->name}}</div>
            </div>
            <div class="section_bar"></div>
        </div>
        <div class="technology_content">
                    @foreach ($value->articles as $key1 => $value1)
                        @php
                            $id1                 = $value1->id;
                            $name1               = $value1->name;
                            $category_id1        = $value1->category_id;
                            $linkCategory1       = Functions::getLinkCategory($category_id1); //Lấy link của Category 
                            $linkArticle1        = Functions::getLinkArticle($id1,$category_id1); //Lấy link của bài viết 
                            $linkHome1           = Functions::getLinkHome();
                            $thumb1              = asset("default/images/article/$value1->thumb");
                            $publish_at1         = date('d/m/Y', strtotime($value1->publish_at)); 
                        @endphp
                        <div class="post_item post_h_large">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="post_image">
                                        <a href="{{ $linkArticle1 }}">
                                            <img src="{{ $thumb1 }}" alt="{{ $thumb1 }}" class="img-fluid w-100">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="post_content">
                                        <div class="post_category cat_technology ">
                                            <a href="{{ $linkCategory1 }}">{{ $category_name }}</a>
                                        </div>
                                        <div class="post_title"><a href="{{ $linkArticle1 }}"> {{ $name1 }} </a></div>
                                        <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                            <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                                <div class="post_author_name"><a href="#">Phan Thiện Khiêm</a>
                                                </div>
                                            </div>
                                            <div class="post_date"><a href="#">{{ $publish_at1 }}</a></div>
                                        </div>
                                        <div class="post_text">
                                            <p>
                                                {{ $name1 }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                
            
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="{{ $linkCategory1 }}">Xem
                        thêm</a></div>
            </div>
        </div>
    </div>