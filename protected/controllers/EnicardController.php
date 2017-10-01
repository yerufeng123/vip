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

class EnicardController extends Controller {

    const GAME_PERSON_TIMES = 9999999; //每人每天无要求玩游戏次数
    const GAME_FRIEND_MAXNUM = 1; //每人每天最多的有效分享朋友数
    const GAME_ONEFRIEND_NUM = 1; //每有一个有效分享，增加的游戏次数
    const GAME_LOTTERY_DEFINITION = 0; //抽奖景区度 0：百分之几  1：千分之几  2：万分之几 ......

    private $game_lottery_config = array(//抽奖配置
        /**
         * 1、概率必须为整数,可通过配置精确的方式，实现各种微小概率
         * 2、中奖概率数字之和不能超过 精确度，比如百分之几精确，要求数字之和不能超过100
         * 3、未中奖概率不许配置，默认代号为0
         */
        array(
            'pronum' => '1', //一等奖代号
            'proprb' => '2', //中奖概率(跟精确度参数配合，为最终概率)
        ),
        array(
            'pronum' => '2', //二等奖代号
            'proprb' => '5', //中奖概率(跟精确度参数配合，为最终概率)
        ),
        array(
            'pronum' => '2', //二等奖代号
            'proprb' => '7', //中奖概率(跟精确度参数配合，为最终概率)
        )
            // .
            // .
            // .
    );
    public $weObj; //wechat类对象
    public $openid; //用户openid

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        date_default_timezone_set('PRC'); //设置时间为北京时间，记得配置文件中配置下，一劳永逸
        // include_once Yii::app()->basePath . '/components/cardSDK.php';//卡券所需
    }

    //游戏首页
    public function actionIndex() {
        $this->_Getopenid(); //自动获取openid
        $user = EnicarUser::model()->findByAttributes(array('openid' => $this->openid));

        //注册新用户
        $user = $this->_Register($user);
        //判断是否需要重置游戏次数
        $this->_Resetgame($user);
        //判断用户是否可玩
        $enable = $this->_Playenable($user);
        $this->renderPartial("index", array(
            'enable' => $enable,
        ));
    }

    //游戏页
    public function actionGame() {
        $this->_Getopenid(); //自动获取openid
        $this->renderPartial("game");
    }

    //游戏报名页
    public function actionSignup() {
        $this->_Getopenid(); //自动获取openid
        $this->renderPartial("signup");
    }

    //游戏分享页
    public function actionShare() {
        $this->renderPartial("share");
    }

    //异步方法，判断是否可玩
    public function actionAjaxcheckenable() {
        $this->_Getopenid(); //自动获取openid
        $user = EnicarUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            returnJson('玩家不存在！', '20002');
        }
        //判断用户是否可玩
        $enable = $this->_Playenable($user);
        returnJson($enable, '10000');
    }

    //异步方法,增加一次游戏次数
    public function actionAjaxaddnum() {
        $this->_Getopenid(); //自动获取openid
        $user = EnicarUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            returnJson('玩家不存在！', '20003');
        }
        $this->_Addplaynum($user);
        returnJson('成功', '10000');
    }

    //异步方法，完善玩家信息
    public function actionAjaxsignup() {
        $this->_Getopenid(); //自动获取openid
        $user = EnicarUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            returnJson('玩家不存在！', '20004');
        }
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];

        //判断手机号是否重复
        $user2 = EnicarUser::model()->findByAttributes(array('phone' => $_POST['phone']));
        if ($user2) {
            returnJson('手机号已存在', '20005');
        }
        if (!$user->save()) {
            returnJson('完善玩家信息失败！', '10001');
        } else {
            returnJson('成功', '10000');
        }
    }

    //异步方法，增加分享次数
    public function actionAjaxaddshare() {
        $this->_Getopenid(); //自动获取openid
        $user = EnicarUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            returnJson('玩家不存在！', '20006');
        }
        $user->friendnum = self::GAME_ONEFRIEND_NUM; //分享就有一个玩的次机会
        $user->sharenum += 1;
        if ($user->save()) {
            returnJson('成功', '10000');
        } else {
            returnJson('增加分享次数失败！', '10001');
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

    //私有方法，判断并注册用户
    private function _Register($user) {
        //判断身份标示是否存在
        if (!$this->openid) {
            returnJson('openid不存在！', '20001');
        }

        //判断当前浏览器---可在配置中开关
        if (checkWeixinBrowser() && Yii::app()->params['enicar']['checkBrowser']) {
            returnJs('请使用微信浏览器打开本页面');
        }

        //判断当前用户是否存在
        if (!$user) {
            $user = new EnicarUser();
            $user->openid = $this->openid;
            $user->ctime = time();
            $user->utime = time();
            if (!$user->save()) {
                returnJson('新用户注册失败', '10001');
            }
        }

        return $user;
    }

    //私有方法，判断是否需要重置游戏次数
    private function _Resetgame($user) {
        if (date('Y-m-d', $user->utime) != date('Y-m-d', time())) {
            $user->gamenum = 0;
            $user->friendnum = 0;
            $user->sharenum = 0;

            if (!$user->save()) {
                returnJson('游戏重置失败！', '10001');
            }
        }
    }

    //私有方法，判断是否可以继续游戏
    private function _Playenable($user) {
        $max_play_num = self::GAME_PERSON_TIMES + self::GAME_FRIEND_MAXNUM * self::GAME_ONEFRIEND_NUM; //理论最大可玩次数

        $current_play_num = self::GAME_PERSON_TIMES + intval($user->friendnum * self::GAME_ONEFRIEND_NUM);
        $current_play_num = ($current_play_num > $max_play_num) ? $max_play_num : $current_play_num; //当前可玩最大游戏次数
        if ($user->gamenum >= $max_play_num) {
            return 'no'; //当前游戏次数已为最大值
        } elseif ($user->gamenum >= $current_play_num) {
            return 'share'; //次数已用完，分享还可以继续玩
        } else {
            return 'ok'; //可以继续玩
        }
    }

    //私有方法，增加游戏次数
    private function _Addplaynum($user) {
        $user->gamenum +=1;
        $user->utime = time();
        if (!$user->save()) {
            returnJson('增加游戏次数失败！', '10001');
        }
    }

}

?>
