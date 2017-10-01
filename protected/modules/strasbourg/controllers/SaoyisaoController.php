<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class SaoyisaoController extends Controller{
    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $options = array(
            'token' => Yii::app()->params['strasbourg']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['strasbourg']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['strasbourg']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['strasbourg']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        //$this->_checkBrowser();
    }
    
    
    public function actionIndex() {
        $this->_Getopenid();
        $paycode=Yii::app()->request->getParam('paycode');
        if(empty($paycode)){
            returnJson('缺少参数','20001');
        }
        
        //查找商家
        $business=StrasbourgBusiness::model()->findByAttributes(array('businesscode'=>$paycode));
        if(!$business){
            returnJson('该商户不存在','20001');
        }
        
        $this->renderPartial('index',array('openid'=>$this->openid,'paycode'=>$paycode,'business'=>$business));
    }
    
    public function actionCheckordersn(){
        if(!isset($_POST['ordersn']) || empty($_POST['ordersn'])){
            returnJson('缺少参数','10003');
        }
        
        $order =StrasbourgOrder::model()->findByAttributes(array('order_sn'=>$_POST['ordersn']));
        if($order->cid != '0'){
            returnJson('验证失败','10001');
        }else{
            $order->cid=1;
            $order->save();
            returnJson('验证成功','10000');
        }
    }
    
    //支付生成订单
    public function actionCreate_order(){
        $type = yii::app()->request->getParam('type');
        $paycode=Yii::app()->request->getParam('paycode');
        if(empty($type) || empty($_POST['price']) || empty($paycode)){
            returnJson('缺少参数','20002');
        }
        
        $this->_Getopenid();
        $time = time();
        
            //生成一个订单
            $order_sn = 'stlsb_' . $time . rand(1, 1000);
            $order=new StrasbourgOrder();
            $order->order_sn=$order_sn;
            $order->time=time();
            $order->cid=0;
            $order->price=$_POST['price'];
            $order->activename='微信扫码';
            $order->pid=0;
            $order->uid=0;
            $order->businesscode=$paycode;//商家编号
            if(!$order->save()){
                returnJson($order->getErrors(),'10001');
            }else{
                $paydata['out_trade_no'] = $order_sn;
                $paydata['body'] = '石景山洋庙会';
                $paydata['total_fee'] = $_POST['price']*1;
                returnJson($paydata,'10000');
            }


        
            
        
    }
    
    //支付回调
    public function actionCallback(){
        
    }
    
    
    /*     * ***********************私有方法*************************************************** */
    
    //私有方法，封装获取openid过程
    private function _Getopenid($type='snsapi_base') {
        if (checkWeixinBrowser()) {
            if (!getYS('openid') || $type== 'snsapi_userinfo') {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, $type);
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
        if($type == 'snsapi_userinfo'){
            $data['access_token']=$res['access_token'];
            $data['expiretime']=time()+7000;//保留两个小时
            setYS('sq_access_token', json_encode($data));
        }
    }
    
    //私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); //以后替换成错误页面
            return false;
        }
    
        return true;
    }
    
    
   

}
