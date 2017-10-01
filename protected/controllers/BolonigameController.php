<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
/**
/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class BolonigameController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象
    public $callback = "http://www.hui.net/kabao/demos/blog/index.php"; //页面回调地址

    //报名页
    public function actionIndex() {
        $this->_Getopenid();
        //判断用户是否存在
        $user = BoloniUser::model()->findByAttributes(array('openid' => $this->openid));
        if ($user) {
            $this->redirect('/bolonigame/game');
        }
        $this->renderPartial('index');
    }

    //游戏首页
    public function actionGame() {
        $this->_Getopenid();
        //检查是否是注册用户
        $user = BoloniUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            $this->redirect('/bolonigame/index');
        } else {//判断用户是否可玩
            //判断是否需要清零
            if (date('Y-m-d', $user->updatetime) != date('Y-m-d', time())) {
                $user->num = 0;
                $user->sharetime = 0;
            }
            if ($user->num >= 30) {
                $flag = 'none'; //次数已用完
            } elseif ($user->num == 2 && empty($user->sharetime)) {
                $flag = 'share'; //分享后，可多玩一次
            } else {
                $flag = 'ok'; //可以继续玩
            }
        }
        $this->renderPartial('game', array('flag' => $flag));
    }

    //游戏页
    public function actionGamedetail() {
        $this->_Getopenid();
        $this->renderPartial('gamedetail');
    }

    //游戏结果页
    public function actionGameover() {
        $this->_Getopenid();
        $coupon1 = Yii::app()->request->getParam('coupon1', 0);
        $coupon2 = Yii::app()->request->getParam('coupon2', 0);

        $this->renderPartial('gameover');
    }

    //异步提交数据，注册用户
    public function actionAjaxadduser() {
        $this->_Getopenid();
        $city = $_POST['city'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $user = new BoloniUser();
        $user->city = $city;
        $user->name = $name;
        $user->phone = $phone;
        $user->updatetime = time();
        $user->openid = $this->openid;
        if (!$user->save()) {
            returnJson('玩家注册失败', '10001');
        } else {
            returnJson('玩家添加成功', '10000');
        }
    }

    //异步提交数据，设置游戏次数
    public function actionAjaxaddnum() {
        $this->_Getopenid();
        $user = BoloniUser::model()->findByAttributes(array('openid' => $this->openid));
        //判断是否需要清零
        if (date('Y-m-d', $user->updatetime) != date('Y-m-d', time())) {
            $user->num = 0;
            $user->sharetime = 0;
        }
        if ($user->num >= 3) {
            echo returnJson('您的ID今天还可玩游戏0次', '20001');//已分享
        } elseif ($user->num == 2 && empty($user->sharetime)) {
            echo returnJson('您的ID今天还可玩游戏0次', '20002');//未分享
        } else {
            $user->num +=1;
            $user->updatetime = time();
            if ($user->save()) {
                $data['coupon1'] = $user->coupon1;
                $data['coupon2'] = $user->coupon2;
                
                returnJson($data, '10000');
            } else {
                returnJson('增加游戏次数失败', '10001');
            }
        }
    }

    //异步提交数据，设置游戏分数
    public function actionAjaxsetcoupon() {
        $this->_Getopenid();
        $coupon1 = $_POST['coupon1'];
        $coupon2 = $_POST['coupon2'];
        if ($coupon1 == '' || $coupon2 == '') {
            echo returnJson('缺少优惠券分数', '10003');
        }
        $user = BoloniUser::model()->findByAttributes(array('openid' => $this->openid));
        $data['coupon1'] = $coupon1;
        $data['coupon2'] = $coupon2;
        $user->coupon1 = $data['coupon1'];
        $user->coupon2 = $data['coupon2'];
        if ($user->save()) {
            echo returnJson($data, '10000');
        } else {
            echo returnJson('优惠券更新失败', '10001');
        }
    }

    //异步提交数据，设置分享时间
    public function actionAjaxsetsharetime() {
        $this->_Getopenid();
        $user = BoloniUser::model()->findByAttributes(array('openid' => $this->openid));
        $user->sharetime = time();
        if ($user->save()) {
            echo returnJson('更新分享时间成功', '10000');
        } else {
            echo returnJson('更新分享时间失败', '10001');
        }
    }

    /*     * ***********************私有方法*************************************************** */

    //私有方法，封装获取openid过程
    private function _Getopenid() {
        $options = array(
            'token' => Yii::app()->params['enicar']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['enicar']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['enicar']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['enicar']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        if (checkWeixinBrowser()) {
            if (!getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        } else {
            setYS('openid', 'ocKmquOkrC6j74GzX76cjXSFeQ68');
            $this->openid = 'ocKmquOkrC6j74GzX76cjXSFeQ68'; //非微信
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

}
