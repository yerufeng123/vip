<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class QuanjudeController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //游戏首页

    public function actionIndex() {
        $this->renderPartial('index');
    }

    //游戏页
    public function actionGame() {
        $this->renderPartial('game');
    }
    

    //私有方法,获取openid
    private function _Getopenid() {
        /* 黄飞红微信公众平台 */
        $options = array(
            'token' => 'olgHSv63s4fa6eMLD369', //填写你设定的key
            'encodingaeskey' => 'ofRiTzBIpFHoJiftlHaHciZWlfuWRIVptkKDBtNWKvM', //填写加密用的EncodingAESKey
            'appid' => 'wx14943a5e7bba8b64', //填写高级调用功能的app id
            'appsecret' => '92fcae4e551e233c6cc3978e7750cf68', //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        //获取网页授权的access_token和openid,此access_token仅仅用来获取用户基本信息，获取用户的openid,其他普通接口使用的是普通的access_token,不是这个token
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            //非微信
            $this->openid = '9999999999999999999999999999'; //仅用于PC端方便浏览使用
        } else {
            if (!getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        }
    }

    //私有方法，封装页面授权过程
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

    /*
     * 私有方法，抽奖算法
     * @param array $arr 概率数组 
     * @param inter $definition@ 概率经度 0表示百分之一，1表示千分之一 2万分之一 ，以此类推 经度越大执行越慢
     * return string 中奖身份识别标识（可为 奖品名或者奖品id）  
     */

    private function _Lottery($arr, $definition = 2) {
//        $arr = array(
//            array(//一等奖
//                'num' => '1',
//                'prob' => '20',
//            ),
//            array(//二等奖
//                'num' => '2',
//                'prob' => '30',
//            ),
//        );
        $newarr = array();
        $num = $totalnum = pow(10, 2 + $definition);
        foreach ($arr as $k => $v) {
            $tempnum = intval($arr[$k]['prob']); //填充数量
            if ($totalnum >= $tempnum) {
                $temparr = array_fill(0, $tempnum, $arr[$k]['num']);
                $totalnum -= $tempnum;
                $newarr = array_merge($newarr, $temparr);
            } else {
                returnJson('抽奖填充失败', '10001');
            }
        }
        $newarr = array_merge($newarr, array_fill(0, $totalnum, '0'));
        $d = mt_rand(0, $num);
        return $newarr[$d];
    }
    
}
