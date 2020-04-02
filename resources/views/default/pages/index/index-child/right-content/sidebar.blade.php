
<div class="sidebar">
        <!-- Latest Posts -->
        <div class="sidebar_latest">
            <div class="sidebar_title">Bài viết gần đây</div>
            <div class="latest_posts">
                @php
                    use App\Functions\Functions as Functions;
                @endphp
                <?php 
                    
                ?>
                @foreach ($articlesNewest as $key => $value)
                    @php
                        $id             = $value->id;
                        $name           = $value->name;
                        $category_id    = $value->category_id;
                        $content        = $value->content;
                        $category_name  = $value->category_name;
                        $linkHome       = Functions::getLinkHome();
                        $linkArticle    = Functions::getLinkArticle($id,$category_id); //Lấy link của bài viết
                        $linkCategory   = Functions::getLinkCategory($category_id); //Lấy link của bài viết
                        $thumb          = asset("default/images/article/$value->thumb");
                        $publish_at     = date('d/m/Y', strtotime($value->publish_at));

                    @endphp
                    <!-- Latest Post -->
                    <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="latest_post_image"><img src="{{ $thumb  }}"
                                alt="{{ $thumb  }}">
                            </div>
                        </div>
                        <div class="latest_post_content">
                            <div class="post_category_small cat_video"><a href="{{ $linkCategory }}">{{ $category_name }}</a></div>
                            <div class="latest_post_title">
                                <a
                                    href="{{ $linkArticle }}">{{ $name }}
                                </a>
                            </div>
                            <div class="latest_post_date">{{ $publish_at }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Advertisement -->
        <!-- Extra -->
        <div class="sidebar_extra">
            <a href="#">
                <div class="sidebar_title">Quảng cáo</div>
                <div class="sidebar_extra_container">
                    <div class="background_image"
                        style="background-image:url({{asset("default/images/extra_1.jpg")}})"></div>
                    <div class="sidebar_extra_content">
                        <div class="sidebar_extra_title">30%</div>
                        <div class="sidebar_extra_title">off</div>
                        <div class="sidebar_extra_subtitle">Mua online ngay bây giờ</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Most Viewed -->
        <div class="most_viewed">
            <div class="sidebar_title">Xem nhiều nhẩt</div>
            <div class="most_viewed_items">
                <!-- Most Viewed Item -->
                <div class="most_viewed_item d-flex flex-row align-items-start justify-content-start">
                    <div>
                        <div class="most_viewed_num">01.</div>
                    </div>
                    <div class="most_viewed_content">
                        <div class="post_category_small cat_video"><a href="category.html">video</a>
                        </div>
                        <div class="most_viewed_title"><a href="#">New tech development</a>
                        </div>
                        <div class="most_viewed_date"><a href="#">March 12, 2018</a></div>
                    </div>
                </div>
                <!-- Most Viewed Item -->
                <div class="most_viewed_item d-flex flex-row align-items-start justify-content-start">
                    <div>
                        <div class="most_viewed_num">02.</div>
                    </div>
                    <div class="most_viewed_content">
                        <div class="post_category_small cat_world"><a href="category.html">world</a>
                        </div>
                        <div class="most_viewed_title"><a href="#">Robots are taking over</a>
                        </div>
                        <div class="most_viewed_date"><a href="#">March 12, 2018</a></div>
                    </div>
                </div>
                <!-- Most Viewed Item -->
                <div class="most_viewed_item d-flex flex-row align-items-start justify-content-start">
                    <div>
                        <div class="most_viewed_num">03.</div>
                    </div>
                    <div class="most_viewed_content">
                        <div class="post_category_small cat_technology"><a href="category.html">tech</a>
                        </div>
                        <div class="most_viewed_title"><a href="#">10 tips to tech world</a>
                        </div>
                        <div class="most_viewed_date"><a href="#">March 12, 2018</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tags -->
        <div class="tags">
            <div class="sidebar_title">Tags</div>
            <div class="tags_content d-flex flex-row align-items-start justify-content-start flex-wrap">
                <div class="tag cat_technology"><a href="#">technology</a></div>
                <div class="tag"><a href="#">design</a></div>
                <div class="tag"><a href="#">travel</a></div>
                <div class="tag cat_video"><a href="#">video</a></div>
                <div class="tag cat_party"><a href="#">party</a></div>
                <div class="tag"><a href="#">music</a></div>
                <div class="tag cat_world"><a href="#">world</a></div>
                <div class="tag"><a href="#">adventure</a></div>
            </div>
        </div>
    </div>