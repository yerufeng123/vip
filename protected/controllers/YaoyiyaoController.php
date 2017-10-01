<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class YaoyiyaoController extends Controller {

    public $weObj; //wechat类对象
    public $openid; //用户openid

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        include_once Yii::app()->basePath . '/components/cardSDK.php';
        /**
         * 自动获取openid
         */
        $options = array(
            'token' => Yii::app()->params['shengjing']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['shengjing']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['shengjing']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['shengjing']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        $this->_checkBrowser(); //检查浏览器
    }

    public function actionIndex() {
        $this->renderPartial('yaoyiyao');
    }

    //摇一摇详情页
    public function actionDetail() {
        $type = Yii::app()->request->getParam('type');
        if (empty($type)) {
            die('缺少type类型');
        }
        switch ($type) {
            case 'text':
                $sql = "select * from vip_shengjing_text";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $num = rand(0, count($data) - 1);
                $media = $data[$num]['detail'];
                $pic = Yii::app()->request->hostInfo . '/' . $data[$num]['pic'];
                $this->renderPartial('text', array('media' => $media, 'pic' => $pic));
                break;
            case 'image':
                $sql = "select * from vip_shengjing_image";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $num = rand(0, count($data) - 1);
                $media = setPicUrl($data[$num]['detail'], '2');
                //$media = Yii::app()->request->hostInfo . '/' . $data[$num]['detail'];
                $this->renderPartial('image', array('media' => $media, 'text' => $data[$num]['text']));
                break;
            case 'imageone':
                $sql = "select * from vip_shengjing_imageone";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $num = rand(0, count($data) - 1);
                $media = setPicUrl($data[$num]['detail'], '1');
                $this->renderPartial('imageone', array('media' => $media));
                break;
            case 'voice':
                $sql = "select * from vip_shengjing_voice";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $num = rand(0, count($data) - 1);
                $media = Yii::app()->request->hostInfo . '/' . $data[$num]['detail'];
                $pic = Yii::app()->request->hostInfo . '/' . $data[$num]['pic'];
                $this->renderPartial('voice', array('media' => $media, 'pic' => $pic));
                break;
            case 'card':
                $sql = "select * from vip_shengjing_card";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $num = rand(0, count($data) - 1);
                $media = $data[$num]['detail']; //获取card_id
                $sign = $this->weObj->getJsSign2($media);
                $temp = addslashes(json_encode($sign));
                $this->renderPartial('card', array('cardid' => $media, 'card_ext' => $temp));
                break;
            default :
                die('未知类型');
        }
    }

    //根据事件点判断摇奖类型
    public function actionAjaxgetstyle() {
        error_reporting(0);
        $types = Yii::app()->params['shengjing']['timetype']; //读取配置文件：各类型媒体可摇时间段
        $timetype = array();
        $current = time();
        foreach ($types as $key => $value) {
            if (($current >= strtotime($value['stime'])) && ($current <= strtotime($value['etime']))) {
                $timetype[] = $key;
            }
        }
        if (empty($timetype)) {
            echo 'no';
            die; //该时间段，没有可摇奖的媒体类型
        }
        $num = rand(0, count($timetype) - 1);

        //随机获取该类型下的缩略图和描述信息
//        $media = Yii::app()->params['displaystyle'][$timetype[$num]];
//        $num1 = rand(0, count($media['thumbpic']) - 1);
//        $num2 = rand(0, count($media['describe']) - 1);
//        $data['thumbpic'] = Yii::app()->request->hostInfo . $media['thumbpic'][$num1];
//        $data['describe'] = $media['describe'][$num1];
        $data['type'] = $timetype[$num];
        echo json_encode($data);
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
        if (Yii::app()->params['minsheng']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); //以后替换成错误页面
            return false;
        }

        return true;
    }

}
