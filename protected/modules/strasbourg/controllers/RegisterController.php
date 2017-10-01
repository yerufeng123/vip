<?php

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
        $this->file = dirname(__FILE__) . '/../config/ActiveConfig.php';
        $this->setting = require_once ($this->file);
        
        $options = array(
            'token' => Yii::app()->params['strasbourg']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['strasbourg']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['strasbourg']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['strasbourg']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        //$this->_checkBrowser();
    }

    //H5首页入口
    public function actionIndex() {
        //增加一次浏览
        $config=StrasbourgConfig::model()->findByAttributes(array('name'=>'h5viewednum'));
        $content=$config->content * 1 + 1;
        $config->content=$content;
        $config->save();
        
        $this->_Getopenid();
        $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$this->openid));
        //if($user){//用户已注册，前往分享页
        //    $this->redirect('tag');
        //}else{//用户 H5未注册，前往H5
            $this->renderPartial('index');
        //}
    }
    
    //注册用户
    public function actionUseradd() {
        $this->_Getopenid();
        
        //判断用户是否注册
        $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$this->openid));
        if($user){//用户已注册，前往分享页
            returnJs('您已注册过，无需重复注册','/strasbourg/register/tag');
            //$this->redirect('tag');die;
        }
        
        //判断用户输入条件是否合格
        if (empty($_POST['name']) || empty($_POST['phone'])) {
            returnJs('缺少必填项');
        }
        if(!checkPhone($_POST['phone'])){
            returnJs('手机号格式不正确');
        }
        
        
        
        //生成用户
        $user = new StrasbourgUser();
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->channel=Constant::CHANNEL_H5;
        $time = time();
        $user->ctime = $time;
        $user->openid = $this->openid;
        if (!$user->save()) {
            returnJs('提交失败');
        } else {
            //生成领奖二维码
            $certificate=new StrasbourgCertificate();
            $code = $time . rand(1, 999);
            $img = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->openid ."&qrcode=".$code)."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
            $certificate->uid=$user->attributes['id'];
            $certificate->erweimaurl=$img;
            $certificate->code=$code;
            $certificate->openid=$this->openid;
            $certificate->ctime=time();
            //$certificate->overtime='';
            $certificate->channel=Constant::CHANNEL_H5;
            $certificate->type='h5one';//h5注册领奖凭证
            if(!$certificate->save()){//如果凭证生成失败，将用户删除
                returnJs('生成二维码失败');
            }else{
                //插入活动日志
                $log=new StrasbourgActivelog();
                $log->uid=$user->attributes['id'];
                $log->cid=$certificate->attributes['id'];
                $log->activename=$this->setting[Constant::CHANNEL_H5]['name'];
                $log->ctime=time();
                $log->pid=1;
                $log->goods_json=json_encode($this->setting[Constant::CHANNEL_H5]['setting']);
                if(!$log->save()){
                    returnJs('生成日志失败');
                }else{
                    $this->renderPartial('erweima',array('certificate'=>$certificate));
                }
            }
            
        }
    }
    
    //集铭牌入口
    public function actionTag(){
        $this->_Getopenid();
        $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$this->openid));
        if(!$user){//用户未注册
            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri;
            $this->redirect(array("/strasbourg/register/register?callback={$callback}&channel=".Constant::CHANNEL_H5));
        }else{//用户已注册
            //如果用户没有授权过，先提示用户授权
            if(empty($user->nickname) && empty($user->headimgurl)){
                $userinfo = $this->weObj->getUserInfo($this->openid);
                if($userinfo['subscribe'] != 1){
                    $userinfo = $this->weObj->getOauthUserinfo($this->_GetSqtoken(), $this->openid);
                }
                $user->nickname=$userinfo['nickname'];
                $user->sex=$userinfo['sex'];
                $user->province=$userinfo['province'];
                $user->city=$userinfo['city'];
                $user->country=$userinfo['country'];
                $user->headimgurl=$userinfo['headimgurl'];
                if(!$user->save()){
                    returnJs('保存资料失败！');
                }
            }
            
            
            $sql="select tagindex from vip_strasbourg_tags where fopenid='{$this->openid}'";
            $arr=array();
            $tags=Yii::app()->db->createCommand($sql)->queryAll();
            foreach($tags as $tag){
                $arr[]=$tag['tagindex'];
            }
            
            //判断用户是否集齐铭牌
            if(count($arr) >= 6){
                //判断是否给用户已发布凭证
                $certificate=StrasbourgCertificate::model()->findByAttributes(array('openid'=>$this->openid,'channel'=>Constant::CHANNEL_H5,'type'=>'h5two'));
                if(!$certificate){//没有凭证，就发放凭证
                    $time=time();
                    //生成领奖二维码
                    $certificate=new StrasbourgCertificate();
                    $code = $time . rand(1, 999);
                    $img = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->openid ."&qrcode=".$code)."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
                    $certificate->uid=$user->attributes['id'];
                    $certificate->erweimaurl=$img;
                    $certificate->code=$code;
                    $certificate->openid=$this->openid;
                    $certificate->ctime=time();
                    //$certificate->overtime='';
                    $certificate->channel=Constant::CHANNEL_H5;
                    $certificate->type='h5two';//h5注册领奖凭证
                    if(!$certificate->save()){//如果凭证生成失败，将用户删除
                        returnJs('生成二维码失败');
                    }else{
                        //发放成功
                        //插入活动日志
                        $log=new StrasbourgActivelog();
                        $log->uid=$user->attributes['id'];
                        $log->cid=$certificate->attributes['id'];
                        $log->activename=$this->setting[Constant::CHANNEL_H5]['name'];
                        $log->ctime=time();
                        $log->pid=2;
                        $log->goods_json=json_encode($this->setting[Constant::CHANNEL_H5]['setting']);
                        if(!$log->save()){
                            returnJs('生成日志失败');
                        }else{
                            //生成成功
                        }
                    }
                }
                $this->renderPartial('tagok',array('certificate'=>$certificate));die;
            }else{
                $this->renderPartial('tag',array('certificate'=>$certificate,'openid'=>$this->openid,'tags'=>$arr,'name'=>$user->name));die;
            }
        }
    }
    
    //单独注册页面入口
    public function actionRegister(){
        if(!Yii::app()->request->isAjaxRequest){
            $this->_Getopenid();
            $callback=$_GET['callback'];
            $channel=empty($_GET['channel']) ? 'certificate' : $_GET['channel'];
            
            if(empty($callback) || empty($channel)){
                returnJson('缺少参数','10003');
            }
            switch ($channel){
                case Constant::CHANNEL_LOTTERY:
                case Constant::CHANNEL_LOTTERY2:
                case Constant::CHANNEL_LOTTERY3:
                case Constant::CHANNEL_LOTTERY4:
                    //$this->renderPartial('lotteryregister');
                    //break;
                default:
                    $this->renderPartial('register');
            }
            
        }else{
            if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['channel'])){
                returnJson('缺少参数','10003');
            }
            $this->_Getopenid();
            $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$this->openid));
            if(!$user){
                $user=new StrasbourgUser();
                $user->name=$_POST['name'];
                $user->phone=$_POST['phone'];
                //$user->hometown=$_POST['hometown'];
                $user->ctime=time();
                $user->channel=$_POST['channel'];
                $user->openid=$this->openid;
            }else{
                $user->name=$_POST['name'];
                $user->phone=$_POST['phone'];
                //$user->hometown=$_POST['hometown'];
                $user->channel=$_POST['channel'];
            }
            
            if(!$user->save()){
                returnJson('注册失败','10001');
            }else{
                returnJson('注册成功','10000');
            }
        }
       
    }
    
    //分享页入口
    public function actionShare(){
        $this->_Getopenid();
        $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$_GET['fopenid']));
        if(!$user){
            returnJs('您访问的用户不存在！');
        }
        
        //检索用户已经被点亮的铭牌
        $arr=array();
        $fopenid=$_GET['fopenid'];
        $sql="select tagindex from vip_strasbourg_tags where fopenid='{$fopenid}'";
        $tags=Yii::app()->db->createCommand($sql)->queryAll();
        foreach($tags as $tag){
            $arr[]=$tag['tagindex'];
        }
        
        //检索当前用户是否是分享者本人
        $flag2= ($this->openid==$fopenid)? '1' : '0';
        if(flag2 != '1'){
            //检查当前用户是否已经帮链接主人点亮过铭牌
            $flag=StrasbourgTags::model()->findByAttributes(array('openid'=>$this->openid,'fopenid'=>$fopenid));
            $flag=empty($flag)? '0' : '1';
        }else{
            $flag= '1';
        }
        
        
        
        
        
//         //获取被点赞者头像
//         $userinfo = $this->weObj->getUserInfo($fopenid);
//         if($userinfo['subscribe'] != 1){
//             $userinfo = $this->weObj->getOauthUserinfo($this->_GetSqtoken(), $fopenid);
//         }
        $headpic= $user->headimgurl;
        
        $this->renderPartial('share',array('tags'=>$arr,'flag'=>$flag,'flag2'=>$flag2,'headpic'=>$headpic));
    }
    
    //点亮标签
    public function actionAjaxaddtag(){
        $this->_Getopenid();
        $fopenid=$_POST['fopenid'];
        $tagindex=$_POST['tagindex'];
        //判断被点名牌者是否存在
        $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$fopenid));
        if(!$user){
            returnJson('您访问的用户不存在！','20001');
        }
        
        //判断是否是为自己点亮名牌
        if($fopenid == $this->openid){
            returnJson('不能给自己点亮铭牌','20002');
        }
        
        //判断是否已经帮人家点亮过铭牌
        $flag=StrasbourgTags::model()->findByAttributes(array('openid'=>$this->openid,'fopenid'=>$fopenid));
        if($flag){
            returnJson('您已经帮他点亮过铭牌','20003');
        }
        
        //判断该铭牌是否已经被点亮过
        $tags=StrasbourgTags::model()->findByAttributes(array('fopenid'=>$fopenid,'tagindex'=>$tagindex));
        if($tags){
            returnJson('该铭牌已被点亮','20004');
        }
        
        $tag=new StrasbourgTags();
        $tag->openid=$this->openid;
        $tag->fopenid=$fopenid;
        $tag->tagindex=$tagindex;
        $tag->ctime=time();
        if(!$tag->save()){
            returnJson('点亮失败','10001');
        }else{
            returnJson('点亮成功','10000');
        }
        
    }
    
    
    //商户注册
    public function actionBregister(){
        if(!Yii::app()->request->isAjaxRequest){
            $callback=Yii::app()->request->getParam('callback');
            $this->_Getopenid();
            $this->renderPartial('businessregister',array('callback'=>$callback));
        }else{
            if(($_POST['roomnumer'] !=0 && empty($_POST['roomnumer'])) || empty($_POST['phone'])){
                returnJson('缺少参数','10003');
            }
            $this->_Getopenid();
            $user=StrasbourgBusiness::model()->findByAttributes(array('openid'=>$this->openid));
            if($user){
                returnJson('您已提交','20001');
            }
            $user=StrasbourgBusiness::model()->findByAttributes(array('phone'=>$_POST['phone'],'roomnumer'=>$_POST['roomnumer']));
            if(!$user){
                returnJson('商户不存在，请尽快提交商户信息给主办方','20002');
            }
            
            $user->ctime=time();
            $user->openid=$this->openid;
            if(!$user->save()){
                returnJson('注册失败','10001');
            }else{
                returnJson('注册成功','10000');
            }
        }
    }
    
    
    public function actionBregister2(){
        if(!Yii::app()->request->isAjaxRequest){
            $this->_Getopenid();
            $this->renderPartial('businessregistertwo');
        }else{
            if(($_POST['roomnumer'] !=0 && empty($_POST['roomnumer'])) || empty($_POST['phone'])){
                returnJson('缺少参数','10003');
            }
            $this->_Getopenid();
            $user=StrasbourgBusiness::model()->findByAttributes(array('openid'=>$this->openid));
            if($user){
                returnJson('您已提交','20001');
            }
            $user=new StrasbourgBusiness();
            $user->phone=$_POST['phone'];
            $user->roomnumer=$_POST['roomnumer'];
			switch($_POST['roomnumer']){
				case '一号木屋':
					$user->businesscode='stlsb121';
					break;
				case '二号木屋':
					$user->businesscode='stlsb122';
					break;
			    case '三号木屋':
					$user->businesscode='stlsb123';
					break;
			    case '四号木屋':
					$user->businesscode='stlsb124';
					break;
			    case '五号木屋':
					$user->businesscode='stlsb125';
					break;
			    case '六号木屋':
					$user->businesscode='stlsb126';
					break;
				default:
					break;
			}
            $user->ctime=time();
            $user->openid=$this->openid;
            if(!$user->save()){
                returnJson('注册失败','10001');
            }else{
                returnJson('注册成功','10000');
            }
        }
    }
    
    //异步方法---》增加一次转发量
    public function actionAjaxaddsharenum(){
        $config=StrasbourgConfig::model()->findByAttributes(array('name'=>'h5sharenum'));
        $content=$config->content * 1 + 1;
        $config->content=$content;
        $config->save();
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

    //获取全局token，用于调用微信全部接口（用户授权获取详情信息除外）
    private function _Gettoken() {
        $token = $this->weObj->checkAuth();
        return $token;
    }
    
    //获取授权token,用户获取未关注公众号用户详情信息
    private function _GetSqtoken(){
        $sq_access_token=getYS('sq_access_token');
        $data=isset($sq_access_token) ? $sq_access_token : '{}';
        $data=json_decode($data,true);
        if(!isset($data['access_token']) || $data['expiretime'] < time()){
            $this->_Getopenid('snsapi_userinfo');
           $data=json_decode(getYS('sq_access_token'),true);
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
