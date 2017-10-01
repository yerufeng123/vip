<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class LuyinController extends Controller {

    public $weObj;
    // wechat工具类对象
    public $openid;
    // 用户openid
    public $mesObj;

    // 用户消息对象
    // public $callback = "http://www.hui.net/kabao/demos/blog/index.php"; //页面回调地址
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);

        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], // 填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], // 填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], // 填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret']
        ); // 填写高级调用功能的密钥

        $this->weObj = new Wechatg($options);
    }

    //朋友圈列表
    public function actionIndex() {
        $this->_Getopenid();
        $this->_updateState($this->openid); //更新用户微信信息
        //获取我的朋友圈
        $json = json_decode(LuyinUserExt::getUserId($this->openid), true);
        if ($json['code'] != '10000') {
            returnJson($json['result'], $json['code']);
        }
        $uid = $json['result']['id'];
        $sql = "select * from vip_luyin_user a where a.id in (select fid from vip_luyin_friend where uid={$uid})";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $data['friend'] = $result;

        //获取我的信息
        $data['myinfo']['headpic'] = $json['result']['headimgurl'];
        $data['myinfo']['bgpic'] = empty($json['result']['bgimgurl']) ? _STATIC_ . 'vip/luyin/img/photo3.jpg' : $json['result']['bgimgurl'];
        $data['myinfo']['name'] = !empty($json['result']['name']) ? $json['result']['name'] : !empty($json['result']['nickname']) ? $json['result']['nickname'] : '';
        $data['myinfo']['video'] = empty($json['result']['voiceurl']) ? '' : $json['result']['voiceurl'];
        
        //获取我的录音列表
        $data['videos']=LuyinVideo::model()->findAllByAttributes(array('uid'=>$uid));
        $data['openid']=  $this->openid;

        $this->renderPartial('index', array('data' => $data));
    }

    //异步方法----》保存微信图片到本地服务器
    public function actionAjaxgetmetarial() {
        $this->_Getopenid();
        $type = $_POST['type'];
        $media_id = $_POST['serverId'];
        // $media = $this->weObj->getMedia($media_id); //获取其他
        // //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        // if (!$media) {
        //     returnJson($this->weObj->errMsg, '10001');
        // }

        // $path = $this->_Uploadmedia($_SERVER['DOCUMENT_ROOT'] . '/uploads/tempFile/tempsucai' . time() . '.jpg', $media);
        // if (!$path) {
        //     returnJson('图片下载失败', '10003');
        // }
        // require_once Yii::app()->basePath . '/extensions/Myclass/Image.class.php';
        // $image = new Image(null, $_SERVER['DOCUMENT_ROOT'] . '/uploads/luyin');
        // $newpath = $image->thumb($path, 800, 800); //图片默认压缩成 100x100的
        // if (file_exists($path)) {
        //     unlink($path);
        // }
        // $path = substr($newpath, strlen($_SERVER['DOCUMENT_ROOT'])); //此处减去uploads前边的连接
        // //保存图片
        // $user = LuyinUser::model()->findByAttributes(array('openid' => $this->openid));
        // if ($type == 'headpic') {
        //     $user->headimgurl = $path;
        // } elseif ($type == 'bgpic') {
        //     $user->bgimgurl = $path;
        // } else {
            
        // }
        // if (!$user->save()) {
        //     returnJson('保存图片失败', '10002');
        // }
        // returnJson($path, '10000');
        returnJson('/uploads/luyin/th_tempsucai1456367970.jpg','10000');
    }
    
    //异步方法----》保存微信语音到本地服务器
    public function actionAjaxgetmetarial2() {
        $this->_Getopenid();
        $media_id = $_POST['serverId'];
        /*$media = $this->weObj->getMedia($media_id); //获取其他
        //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        if (!$media) {
            returnJson($this->weObj->errMsg, '10001');
        }

        $path = $this->_Uploadmedia($_SERVER['DOCUMENT_ROOT'] . '/uploads/luyin/tempsucai' . time() . '.mp3', $media);
        if (!$path) {
            returnJson('语音下载失败', '10003');
        }
        
        $path = substr($path, strlen($_SERVER['DOCUMENT_ROOT'])); //此处减去uploads前边的连接
        
        //获取我的朋友圈
        $json = json_decode(LuyinUserExt::getUserId($this->openid), true);
        if ($json['code'] != '10000') {
            returnJson($json['result'], $json['code']);
        }
        $uid = $json['result']['id'];
        //保存录音表数据
        $video=new LuyinVideo();
        $video->uid=$uid;
        $video->localid=$path;
        $video->ctime=time();
        if(!$video->save()){
             returnJson(gxdCreateMultiLink($video->getErrors()), '20002');
        }
        
        returnJson($path, '10000');*/
        returnJson('/uploads/luyin/tempsucai1456365903.mp3', '10000');
    }
    
    
    //异步方法----》更新语音选中状态
    public function actionAjaxupdateaudio(){
        $this->_Getopenid();
        $localid=$_POST['localId'];
        /*$transaction=  Yii::app()->db->beginTransaction();
        //更新录音素材表状态
        LuyinVideo::model()->updateAll(array('state'=>0));
        $video=LuyinVideo::model()->findByAttributes(array('localid'=>$localid));
        $video->state=1;
        if(!$video->save()){
            $transaction->rollback();
            returnJson('更新失败','10001');
        }
        
        //更新用户表录音链接
        $user=LuyinUser::model()->findByAttributes(array('openid'=>$this->openid));
        $user->voiceurl=$localid;
        if(!$user->save()){
            $transaction->rollback();
            returnJson('更新失败','10001');
        }
        $transaction->commit();*/
        returnJson('更新成功','10000');
    }
    
    //异步方法----》删除语音
    public function actionAjaxdeleteaudio(){
        $this->_Getopenid();
        $localid=$_POST['localId'];
        /*$video=LuyinVideo::model()->findByAttributes(array('localid'=>$localid));
        if($video->state == '1'){
            LuyinUser::model()->updateAll(array('voiceurl'=>''),'openid="'.$this->openid.'"');
        }
        if($video->delete()){
            returnJson('成功','10000');
        }else{
            returnJson('删除失败','10001');
        }*/
        returnJson('成功','10000');
        
    }
    
    

    //导入数据
    public function actionImportdata() {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/stlsb.xls';
        if (file_exists($path)) {
            require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel/IOFactory.php';
            //导入excel文件
            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $data = $objPHPExcel->getActiveSheet()->toArray(); //0键值中存放的是 属性名
            //插入数据库
            $log = ''; //失败日志
            $time = time();
            foreach ($data as $key => $value) {
                if ($key != 0) {
                    $test = new StrasbourgBusiness();
                    $test->openid = '';
                    $test->company = $value[2];
                    $test->phone = $value[3];
                    $test->ctime = $time;
                    $test->businesscode = $value[4];
                    if (!$test->save()) {
                        $log = '第' . ($key + 1) . '条插入失败,请检查数据';
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

    // 私有方法，封装获取openid过程
    private function _Getopenid($type = 'snsapi_base') {
//        if (checkWeixinBrowser()) {
//            if (!getYS('openid') || $type == 'snsapi_userinfo') {
//                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
//                $this->_Author($callback, $type);
//            }
//            $this->openid = getYS('openid');
//        } else {
//            $this->openid = '9999999999999999999999999999'; // 非微信
//        }
        $this->openid = 'ocKmquOkrC6j74GzX76cjXSFeQ68'; // 非微信
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
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
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

    //私有方法----》更新用户微信信息
    private function _getWeixinInfo($openid) {
        $userinfo = $this->weObj->getUserInfo($openid);
        if (!$userinfo) {
            //returnJson($userinfo->errMsg, '10001');
        }
        if ($userinfo['subscribe'] != 1) {
            $userinfo = $this->weObj->getOauthUserinfo($this->_GetSqtoken(), $openid);
        }
        return $userinfo;
    }

    //私有方法----》更新用户邀请状态，并更新用户微信信息
    private function _updateState($openid) {

        $user = LuyinUser::model()->findByAttributes(array('openid' => $openid));
        if (!$user) {
            $user = new LuyinUser();
            $user->openid = $this->openid;
            $user->ctime = time();
        }
        if (empty($user->nickname) && empty($user->headimgurl)) {
            $userinfo = $this->_getWeixinInfo($this->openid);
            $user->nickname = $userinfo['nickname'];
            $user->sex = $userinfo['sex'];
            $user->province = $userinfo['province'];
            $user->city = $userinfo['city'];
            $user->country = $userinfo['country'];
            $user->headimgurl = $userinfo['headimgurl'];
        }

        $user->state = 1;
        if (!$user->save()) {
            //错误提示
        }
    }

    //私有方法----》用户开户
    private function _Openuser($openid) {
        $user = LuyinUser::model()->findByAttributes(array('openid' => $openid));
        if (!$user) {
            $user = new LuyinUser();
            $user->openid = $openid;
            $user->ctime = time();
            if (!$user->save()) {
                //错误提示
            }
        }
    }

}
