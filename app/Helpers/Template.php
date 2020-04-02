<?php 
    namespace App\Helpers;

    class Template
    {
        public static function showItemsHistory($by, $time)
        {
            $xhtml = '<p><i class="fa fa-user"></i> '.$by.'</p>
                    <p><i class="fa fa-clock-o"></i> '.date('H:m:s d/m/Y', strtotime($time)).'</p>';
            return $xhtml;
        }

        public static function showItemsStatus($controllerName, $id, $status )
        {
            $link = route($controllerName.'/status', ['status' => $status, 'id' => $id]);
            
            $className  = 'warning';
            $name       = 'Chưa kích hoạt';
            if($status == 'active')
            {
                $className = 'primary';
                $name       = 'Đã kích hoạt';
            }
            $xhtml = sprintf('<td>
                                <a href="%s" type="button" class="btn btn-round btn-%s">%s
                                </a>
                            </td>',$link,$className,$name);

            /* 
                Cách viết nâng cao
                $TemplateInfo = [
                                    'active'    => ['name' => 'Đã kích hoạt', 'className'   => 'success'],
                                    'inActive'  => ['name' => 'Chưa kích hoạt', 'className' => 'info']
                ];
                $arrCurrentStatus = $TemplateInfo[$status]; // Set mảng arrCurrentStatus là chính mảng $TemplateInfo phần tử $status

                $xhtml = sprintf('<td>
                                    <a href="%s" type="button" class="btn btn-round btn-%s">%s
                                    </a>
                                </td>',$status,$arrCurrentStatus['className'],$arrCurrentStatus['name']);
            */
            return $xhtml;
        }

        public static function showItemsIsHome($controllerName, $id, $status)
        {
            $link = route($controllerName.'/ishome', ['status' => $status, 'id' => $id]);
            
            $className  = 'warning';
            $name       = 'Chưa hiển thị';
            if($status == 1)
            {
                $className = 'primary';
                $name       = 'Đã hiển thị';
            }
            $xhtml = sprintf('<td>
                                <a href="%s" type="button" class="btn btn-round btn-%s">%s
                                </a>
                            </td>',$link,$className,$name);
            return $xhtml;
        }

        public static function showItemsType($controllerName, $id, $type)
        {
            $link = route($controllerName.'/type', ['type' => $type, 'id' => $id]);
            
            $className  = 'warning';
            $name       = 'Bình thường';
            if($type == "feature")
            {
                $className = 'primary';
                $name       = 'Nổi bật';
            }
            $xhtml = sprintf('<td>
                                <a href="%s" type="button" class="btn btn-round btn-%s">%s
                                </a>
                            </td>',$link,$className,$name);
            return $xhtml;
        }

        public static function showNotify($key)
        {
            $xhtml = null;
            if (session($key))
            {
                $xhtml = '<div class="alert alert-success">
                {{ session($key) }}
                </div>';
            }
                return $xhtml;
        }


    }
    
?>
