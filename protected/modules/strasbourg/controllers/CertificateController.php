<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class CertificateController extends Controller{
    public $admin;//管理员对象
//管理员显示
    public function actionIndex() {
        $this->renderPartial('index');
    }

    

}
