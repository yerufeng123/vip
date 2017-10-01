<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
/**
/*
 * 英纳格项目
 * 项目功能描述：用户玩游戏，每人每天可玩依次，分享后可多玩依次
 * 高祥栋
 * 2015-4-1
 */

class MinshengController extends Controller {

    public $weObj; //wechat类对象
    public $openid; //用户openid

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        date_default_timezone_set('PRC'); //设置时间为北京时间，记得配置文件中配置下，一劳永逸
        // include_once Yii::app()->basePath . '/components/cardSDK.php';//卡券所需

        $options = array(
            'token' => Yii::app()->params['minsheng']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['minsheng']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['minsheng']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['minsheng']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        $this->_checkBrowser(); //检测浏览器
    }

    //游戏首页
    public function actionIndex() {
        //$this->_Getopenid(); //自动获取openid

        $this->renderPartial("index");
    }
    
    //游戏首页2--白色分享图
    public function actionIndex3() {
        //$this->_Getopenid(); //自动获取openid

        $this->renderPartial("index3");
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

?>
