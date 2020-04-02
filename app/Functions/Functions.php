<?php 
    namespace App\Functions;
    use Illuminate\Support\Str;
    class Functions
    {
        public static function getCategoryName($category_id)
        {
            $categoryArr = ['1' => "Thể thao",
                            '2' => "Giáo dục",
                            '3' => "Sức khỏe",
                            '4' => "Du lịch",
                            '5' => "Khoa học",
                            '6' => "Số hóa",
                            '7' => "Xe Ô-tô",
                            '8' => "Kinh doanh",
                            ];
            return $categoryArr[$category_id];
        }

        public static function getLinkHome()
        {
            return Route("index");
        }

        public static function getLinkArticle($article_id,$category_id)
        {
            return Route("home/article",['id'=>$article_id, 'category_id'=>$category_id]);
        }

        public static function getLinkCategory($category_id)
        {
            $category_name = self::getCategoryName($category_id);
            return Route("home/category",['id'=>$category_id,'category_name'=>Str::slug($category_name)]);
        }
    }
    
?>
