<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class ContentController extends Controller {

    public $user; //用户对象

    //获取详情内容
    public function actionContentinfo() {
        $Icid = Yii::app()->request->getParam('Icid');
        $sql = 'select * from vip_qizheng_content where display=1 and id=' . $Icid . ' order by PX asc,ctime desc';
        $data = Yii::app()->db->createCommand($sql)->queryRow();
        $this->renderPartial('contentinfo', array(
            'contentinfo' => $data));
    }

}
