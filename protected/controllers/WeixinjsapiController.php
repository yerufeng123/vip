<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class WeixinjsapiController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象
    public $callback = "http://www.hui.net/kabao/demos/blog/index.php"; //页面回调地址

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

    //Jsapi接口demo列表
    public function actionIndex() {
        $this->renderPartial('index');
    }

    //基础接口
    public function actionCheckversion() {
        $this->renderPartial('ckversion');
    }

    //分享接口
    public function actionShare() {
        $this->renderPartial('share');
    }

    //图像接口
    public function actionPic() {
        $this->renderPartial('pic');
    }
    
    //音频接口
    public function actionVoice(){
        $this->renderPartial('voice');
    }
    //设备接口
    public function actionDevice(){
        $this->renderPartial('device');
    }
    
    //地理位置
    public function actionLocation(){
        $this->renderPartial('location');
    }
    
    //界面操作
    public function actionOperate(){
        $this->renderPartial('operate');
    }
    
    //微信扫一扫
    public function actionSaoyisao(){
        $this->renderPartial('saoyisao');
    }
    

    //异步方法---》保存微信图片到本地服务器
    public function actionAjaxgetmetarial() {
        $media_id = $_POST['serverId'];
        $media = $this->weObj->getMedia($media_id); //获取其他
        //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        if (!$media) {
            echo $this->weObj->errMsg;
            die;
        }

        $path = $this->_Uploadmedia($_SERVER['DOCUMENT_ROOT'] . '/uploads/tempFile/tempsucai' . time() . '.jpg', $media);
        $path = substr($path, strlen($_SERVER['DOCUMENT_ROOT'])); //此处减去uploads前边的连接
        echo $path;
        die;
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

    private function _Creattoken() {
        $token = $this->weObj->checkAuth();
        $arr['time'] = time();
        $arr['token'] = $token;
        file_put_contents(_STATICPATH_ . '/weixincache/access_token.txt', json_encode($arr));
        return $token;
    }

    //私有方法，用于将远程文档流写入文件
    private function _Uploadmedia($path, $filename) {
        $fp = @fopen($path, a);
        $wresult = fwrite($fp, $filename);
        $cresult = fclose($fp);
        if ($wresult && $cresult) {
            return $path;
        } else {
            return false;
        }
    }

}
