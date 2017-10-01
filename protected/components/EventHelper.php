<?php
    class Page
    {
        //是否回发数据，1:是
        public static function IsPostBack()
        {
            global $SYSRunEventName;
            return !empty($SYSRunEventName);
        }

        //加载并执行事件
        function EventLoad()
        {
            global $SYSRunEventName;

            $arrEvent=get_defined_functions();
            $arrEventUser=$arrEvent['user'];

            $arr=array_keys($_POST);
            foreach($arr as $row)
            {
                $name=strtolower($row);
                foreach($arrEventUser as $row1)
                {
                    $name1=str_ireplace('_click','',$row1);
                    if($name==$name1)
                    {
                        $SYSRunEventName=$row1;
                        break;
                    }
                }

                if(!empty($SYSRunEventName))
                {
                    break;    
                }
            }

            if(function_exists('Page_Load')) 
                Page_Load();

            $SYSRunEventRunName=strtolower($SYSRunEventName);

            if(Page::IsPostBack())
            {
                $SYSRunEventName();
            }
        }
    }

    class Comm
    {
        public static function GetParam($params=array(),$cmd='addoverride')
        {
            $allParam=array();

            if($cmd=='addoverride')
            {
                $arrKeys=array_keys($params);
                foreach($arrKeys as $row)
                {
                    if(!in_array($row,array_keys($allParam))) 
                        $allParam[$row]=$params[$row];
                }
            }
            else if($cmd=='del')
            {
                foreach($params as $row)
                {
                    unset($_GET[$row]); 
                }
            }

            
            $arrKeys=array_keys($_GET);
            foreach($arrKeys as $row)
            {
                if(!in_array($row,array_keys($allParam)))
                    $allParam[$row]=$_GET[$row];
            }

            $p='';
            $arrKeys=array_keys($allParam);
            foreach($arrKeys as $row)
            {
                $p.=$row.'='.$allParam[$row].'&';
            }
            return rtrim($p,'&');
        }
    }
$page=new Page();
$page->EventLoad();
    //Page::EventLoad();
?>