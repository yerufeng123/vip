<?php
header('content-type:text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class RegisterController extends Controller {
    protected $file = '';
    protected $setting = array();
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
        $this->_checkBrowser();
        $this->_Getopenid();
    }
    
    //用户注册页面
    public function actionIndex(){
        $this->renderPartial('index');
    }
    
    //注册用户
    public function actionAjaxuseradd() {
        
        //判断用户是否注册
        $user=  TestadminUserWeixin::model()->findByAttributes(array('openid'=>$this->openid));
        if(!$user){//用户未注册
            $user=new TestadminUser();
            $user->name=$_POST['name'];
            $user->phone=$_POST['phone'];
            $user->city=$_POST['city'];
            $user->address=$_POST['address'];
            $user->ctime=time();
            if($user->save()){
                $userweixininfo=  $this->_getWeixinInfo($this->openid);
                $weixinuser=new TestadminUserWeixin();
                $weixinuser->uid=$user->attributes['id'];
                $weixinuser->wxnickname=$userweixininfo['nickname'];
                $weixinuser->wxcity=$userweixininfo['city'];
                $weixinuser->wxcountry=$userweixininfo['country'];
                $weixinuser->wxprovince=$userweixininfo['province'];
                $weixinuser->wxsex=$userweixininfo['sex'];
                $weixinuser->wxheadimgurl=$userweixininfo['headimgurl']; 
                $weixinuser->openid=  $this->openid;
                $weixinuser->ctime=time();
                if($weixinuser->save()){
                    returnJson('保存成功','10000');
                }else{
                    returnJson('保存失败','10001');
                }
            }else{
                returnJson('保存失败','10001');
            }  
        }else{
            returnJson('您已注册!','10002');
        }
        
    }
    
    
    

    

    /*     * ***********************私有方法*************************************************** */

     // 私有方法，封装获取openid过程
    private function _Getopenid($type = 'snsapi_base') {
        if (checkWeixinBrowser()) {
            if (!getYS('openid') || $type == 'snsapi_userinfo') {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, $type);
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = 'ocKmquOkrC6j74GzX76cjXSFeQ68'; // 非微信
        }
    }

    // 私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type) {
        if (!@$_GET['code'] || ($type == 'snsapi_userinfo' && !@$_GET['info'])) {
            if ($type != 'snsapi_userinfo') {
                $url = $this->weObj->getOauthRedirect($callback, '', $type);
            } else {
                if ($_GET['code']) {
                    $url = $this->weObj->getOauthRedirect($callback . '&info=1', '', $type);
                } else {
                    $url = $this->weObj->getOauthRedirect($callback . '?info=1', '', $type);
                }
            }

            $this->redirect($url);
            Yii::app()->end();
        }
        $res = $this->weObj->getOauthAccessToken();
        setYS('openid', $res['openid']);
        if ($type == 'snsapi_userinfo') {
            $data['access_token'] = $res['access_token'];
            $data['expiretime'] = time() + 7000; // 保留两个小时
            setYS('sq_access_token', json_encode($data));
        }
    }

    // 私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['strasbourg']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); // 以后替换成错误页面
            return false;
        }

        return true;
    }

    // 私有方法，检查用户是否关注过公众号
    // 获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo() {
        if (!getYS('openid')) {
            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
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

    //获取全局token，用于调用微信全部接口（用户授权获取详情信息除外）
    private function _Gettoken() {
        $token = $this->weObj->checkAuth();
        return $token;
    }

    //获取授权token,用户获取未关注公众号用户详情信息
    private function _GetSqtoken() {
        $sq_access_token = getYS('sq_access_token');
        $data = isset($sq_access_token) ? $sq_access_token : '{}';
        $data = json_decode($data, true);
        if (!isset($data['access_token']) || $data['expiretime'] < time()) {
            $this->_Getopenid('snsapi_userinfo');
            $data = json_decode(getYS('sq_access_token'), true);
        }
        return $data['access_token'];
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

    //私有方法----》获取用户微信信息
    private function _getWeixinInfo($openid) {
            $userinfo = $this->weObj->getUserInfo($openid);
            if (!$userinfo) {
                returnJson($userinfo->errMsg, '10001');
            }
            if ($userinfo['subscribe'] != 1) {
                $userinfo = $this->weObj->getOauthUserinfo($this->_GetSqtoken(), $openid);
            }
            return $userinfo;
    }
    
    //导入数据
    public function actionImportdata(){
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/stlsb.xls';
        if (file_exists($path)) {
            require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel/IOFactory.php';
            //导入excel文件
            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $data = $objPHPExcel->getActiveSheet()->toArray(); //0键值中存放的是 属性名
            //插入数据库
            $log = ''; //失败日志
            $time=time();
            foreach ($data as $key => $value) {
                if ($key != 0) {
                    $test=new StrasbourgBusiness();
                    $test->openid='';
                    $test->company=$value[2];
                    $test->phone=$value[3];
                    $test->ctime=$time;
                    $test->businesscode=$value[4];
                    if(!$test->save()){
                        $log='第'.($key+1).'条插入失败,请检查数据';
                    }
    
                    //                     //判断是否已存在该手机号
                    //                     $sql = "select * from vip_bairong_user where phone='{$value[1]}'";
                    //                     $gamer = Yii::app()->db->createCommand($sql)->queryRow();
                    //                     $sql1 = "select * from vip_bairong_message where phone='{$value[1]}'";
                    //                     $gamer1 = Yii::app()->db->createCommand($sql1)->queryRow();
                    //                     if (!$gamer && !$gamer1) {
                    //                         $message = new BairongMessage();
                    //                         $message->phone = $value[1];
                    //                         $message->sid = $value[2];
                    //                         $message->content = $value[3];
                    //                         if (!$message->save()) {
                    //                             $log.="第" . $key . "条数据插入失败\n";
                    //                         }
                    //                     } else {
                    //                         $log.="第" . $key . "条数据手机号已存在\n";
                    //                     }
                }
            }
            if (!empty($log)) {
                echo $log;
            }
            return true;
            die;
        } else {
            die('EXCEL文件不存在！');
        }
    }


}
