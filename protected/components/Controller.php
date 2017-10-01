<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        //判断magic_quotes_gpc状态
        if (@!get_magic_quotes_gpc()) {
            $_GET = sec($_GET);
            $_POST = sec($_POST);
            //$_COOKIE = sec($_COOKIE);
            //$_FILES = sec($_FILES);
        }
        $_SERVER = sec($_SERVER);
    }

    public function session($param, $value = '') {
        if (!empty($value)) {
            Yii::app()->session[$param] = $value;
            return TRUE;
        }
        return Yii::app()->session[$param];
    }

    //将图片从临时文件夹转移到目标文件夹
    public function moveFile($name, $filepath) {
        $arr = array();
        $temppath = explode(',', trim($filepath, ','));
        foreach ($temppath as $k => $v) {
            $srcpath = str_replace('tempFile', $name, $v);
            if (file_exists($v)) {
                $moveresult = rename($v, $srcpath);
                if (!$moveresult) {
                    echo '移动失败！';
                    exit;
                }
                $arr[] = $srcpath;
            } else {
                echo '原文件不存在';
                exit;
            }
        }
        return implode(',', $arr);
    }

}
