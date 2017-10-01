<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class LicaiController extends Controller {

    public $weObj; //wechat工具类对象
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
    }

    //游戏首页

    public function actionIndex() {
        $this->_register();
//        if (!$this->_checkState()) {
//            returnJs('每人只能玩一次游戏哦');
//        }
        $this->renderPartial('index');
    }

    //游戏页
    public function actionGame() {
        $this->_register();
//        if (!$this->_checkState()) {
//            returnJs('每人只能玩一次游戏哦');
//        }
        $this->renderPartial('game');
    }

    //注册页
    public function actionLogin() {
        $this->_register();
        $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
        if ($user->gtime == 0) {
            returnJs('您还没玩游戏，请返回首页','/licai/index');
        }
//        if ($user->phone != '') {
//            returnJs('您已经注册过了','/licai/index');
//        }

        $this->render('login', array(
            'score' => $user->score,
            'redpacket' => $user->redpacket,
        ));
    }

    //分享页
    public function actionShare() {
        $this->_register();
        $fopenid = Yii::app()->request->getParam('openid');
        if ($fopenid) {
            if ($fopenid == $this->openid) {
                $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
                if ($user->phone == '') {
                    $this->renderPartial('login');
                } else {
                    $this->renderPartial('share', array(
                        'openid' => $this->openid,
                    )); //自己点击自己链接,跳到二维码
                }
            } else {
                $this->redirect('/licai/index'); //别人点击链接跳到首页
            }
        } else {
            $this->renderPartial('share', array(
                'openid' => $this->openid,
            ));
        }
    }

    //异步方法---》设置游戏分数
    public function actionAjaxsetscore() {
        if ($_POST['score'] == '') {
            returnJson('缺少分数', '10003');
        }
        $this->_Getopenid();
        $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
        //if ($user->score != 0) {
       //     returnJson('已存在游戏分数，不能重复设置', '20001');
       // } else {
            $user->score = $_POST['score'];
            $user->redpacket = $this->_changestore($user->score);
            $user->gtime = time();
            if ($user->save()) {
                returnJson('保存分数成功', '10000');
            } else {
                returnJson('保存分数失败', '10001');
            }
       // }
    }

    //异步方法 ----》设置游戏手机号
    public function actionAjaxsetphone() {
        if ($_POST['phone'] == '') {
            returnJson('缺少手机号', '10003');
        }
        if (!checkPhone($_POST['phone'])) {
            returnJson('手机号格式不正确', '30002');
        }
        $this->_Getopenid();
        $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
        //if ($user->phone != '') {
         //   returnJson('已存在手机号，不能重复设置', '20002');
       // } else {
            $user->phone = $_POST['phone'];
            if ($user->save()) {
                returnJson('保存手机成功', '10000');
            } else {
                returnJson('保存手机失败', '10001');
            }
      //  }
    }

    //接口
    public function actionGetscore() {
        $phone = Yii::app()->request->getParam('phone');
        if (!$phone) {
            returnJson('缺少手机号', '30001');
        }
        if (!checkPhone($phone)) {
            returnJson('手机号格式不正确', '30002');
        }
        $user = LicaiUser::model()->findByAttributes(array('phone' => $phone));
        if ($user) {
            returnJson($user->redpacket, '10000');
        } else {
            returnJson('手机号不存在', '30003');
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
            $this->openid = '999999999999999'.time(); //非微信
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

    //私有方法，注册用户
    private function _register() {
        $this->_Getopenid();
        $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            $user = new LicaiUser();
            $user->openid = $this->openid;
            $user->ctime = time();
            if (!$user->save()) {
                returnJson('保存失败', '10001');
            }
        }
    }

    //私有方法，判断用户是否还能玩游戏
    private function _checkState() {
        $this->_Getopenid();
        $user = LicaiUser::model()->findByAttributes(array('openid' => $this->openid));
        if ($user->gtime != 0) {
            return false;
        } else {
            return true;
        }
    }

    //私有方法，转换分数
    private function _changestore($store) {
        switch ($store) {
            case $store > 610:
                $redpacket = 8;
                break;
            case $store > 410:
                $redpacket = 5;
                break;
            case $store > 210:
                $redpacket = 3;
                break;
            case $store > 90:
                $redpacket = 2;
                break;
            default :
                $redpacket = 0;
        }
        return $redpacket;
    }

}
