<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class ShangqidatongController extends Controller {

    const PREFIX = 'vip_';

    public $weObj; //wechat类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);

        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        //$this->_checkBrowser();
    }

    //游戏首页

    public function actionIndex() {
        $this->_Getopenid();
        $this->_checkuser();

        //检索省份
        $sql = "select distinct province from " . self::PREFIX . 'shangqi_area';
        $list = Yii::app()->db->createCommand($sql)->queryAll();

        $this->renderPartial('index', array('list' => $list));
    }

    //后台导出数据
    public function actionAdminshangqi() {
        
        $this->renderPartial('admin');
    }

//后台导出数据---》导出信息
    public function actionOutdata() {
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        $type = Yii::app()->request->getParam('type');
        if ($type == 1) {
            $sql = "select * from " . self::PREFIX . "shangqi_user where name <> ''";
        } else {
            $sql = "select * from " . self::PREFIX . "shangqi_user where name = ''";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '车型');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '省份');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '城市');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '经销商');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '创建时间');
        //循环写入数据
        for ($i = 2; $i < count($data) + 2; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[$i - 2]['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[$i - 2]['openid']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[$i - 2]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data[$i - 2]['phone']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $data[$i - 2]['cartype']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[$i - 2]['province']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[$i - 2]['city']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[$i - 2]['business']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, date('Y-m-d H:i:s',$data[$i - 2]['ctime']));
        }
        /**
         * 下载excel (xlsx格式)
         */
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="上汽大通数据' . date('Y-m-d_H-i-s', time()) . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    //异步方法--获取城市列表
    public function actionAjaxgetcity() {
        $province = Yii::app()->request->getParam('province');
        if (empty($province)) {
            returnJson('缺少必填项', '200001');
        }
        $sql = "select distinct city from " . self::PREFIX . 'shangqi_area where province="' . $province . '"';
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$list) {
            $list = array();
        }
        returnJson($list, '100000');
    }

    //异步方法--获取供销商列表
    public function actionAjaxgetbusiness() {
        $province = Yii::app()->request->getParam('province');
        $city = Yii::app()->request->getParam('city');
        if (empty($city) || empty($province)) {
            returnJson('缺少必填项', '200002');
        }
        $sql = "select distinct business from " . self::PREFIX . 'shangqi_area where province="' . $province . '" and city="' . $city . '"';
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$list) {
            $list = array();
        }
        returnJson($list, '100000');
    }

    //异步方法--完善信息
    public function actionAjaxregister() {
        $this->_Getopenid();
        if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['cartype']) || empty($_POST['province']) || empty($_POST['city']) || empty($_POST['business'])) {
            returnJson('缺少必填项', '200003');
        }
        $user = ShangqiUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            returnJson('用户未注册成功', '200004');
        }
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->cartype = $_POST['cartype'];
        $user->province = $_POST['province'];
        $user->city = $_POST['city'];
        $user->business = $_POST['business'];
        if ($user->save()) {
            returnJson('成功', '100000');
        } else {
            returnJson('更新失败', '200005');
        }
    }

    /*     * ***********************私有方法*************************************************** */

    //私有方法，封装获取openid过程
    private function _Getopenid() {
        if (checkWeixinBrowser()) {
            if (!getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = '9999999999999999999999999999'; //非微信
        }
    }

    //私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid   snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type) {
        if (!@$_GET['code']) {
            $url = $this->weObj->getOauthRedirect($callback, '', $type);
            $this->redirect($url);
            Yii::app()->end();
        }
        $res = $this->weObj->getOauthAccessToken();
        setYS('openid', $res['openid']);
        setYS('sq_access_token', $res['access_token']);
    }

    //私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); //以后替换成错误页面
            return false;
        }

        return true;
    }

    //私有方法，检查用户是否关注过公众号
    //获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo() {
        if (!getYS('openid')) {
            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
            $this->_Author($callback, 'snsapi_userinfo');
        }
        $openid = getYS('openid');
        $userinfo = $this->weObj->getUserInfo($openid);
        if ($userinfo['subscribe'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    //私有方法--判断并注册新用户
    private function _checkuser() {
        $user = ShangqiUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            $user = new ShangqiUser();
            $user->openid = $this->openid;
            $user->ctime = time();
            if (!$user->save()) {
                returnJson('用户注册失败', '400001');
            }
        }
    }

}
