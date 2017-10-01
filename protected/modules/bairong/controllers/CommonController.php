<?php

class CommonController extends Controller {
    //此方法为通用上传插件调用方法（通用）
    public function actionUploadify1() {
        $config = array(
            'allowExts' => array('xls', 'xlsx'),
//            'thumb' => true,
//            'thumbMaxWidth' => $_GET['width'],
//            'thumbMaxHeight' => $_GET['height'],
//            'thumbRemoveOrigin' => TRUE,
//            'thumbType' => 3,
            //'water' => true,
            //'waterImg' => './static/img/abc_water.jpg', //此处必须为 .  开始的当前文件夹
            //'waterPos' => 7,
            //'waterRemoveOrigin' => true,
        );
        require_once Yii::app()->basePath . '/extensions/Myclass/UploadFile.class.php';
        $file = new UploadFile($config);
        $path = $file->uploadOne($_FILES['Filedata']);
        if ($path !== false) {
            echo $path[0]['savepath'].$path[0]['savename'];
        } else {
            echo $file->getErrorMsg();
        }
    }

}
