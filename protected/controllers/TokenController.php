<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class TokenController extends Controller {

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

    public function actionIndex() {
        echo $this->weObj->checkAuth();
    }

}
