<?php

/*
 * @author zhangfu
 * @time 2015年10月15日
 * @Description 活动类
 */
header("Content-type: text/html; charset=utf8");

class ActiveController extends Controller
{

    protected $file = '';

    protected $setting = array();

    protected $openid;

    protected $weObj;

    protected $user;

    protected $db;
    
    protected $log;

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        $this->db = yii::app()->db;
    }

    public function beforeAction($action)
    {
        // 活动状态判断
        $this->Check_runtime();
        
        return true;
    }

    /*
     * @Author ZhangFu
     * @Description 活动时间判断
     * @Time 2015年10月15日
     */
    public function Check_runtime()
    {
    //    $this->_checkBrowser();
        $this->_Getopenid();
        $msg='';
        //所有活动均判断用户是否关注了 斯特拉斯堡公众号，没有关注的，一律跳到一到关注页面

            $actionID = $this->action->id;
        if ($actionID == 'make' || $actionID == 'prize' || $actionID == 'is_prize'  || $actionID == 'prize2') {
            $lotterystyle=Yii::app()->request->getParam('lotterystyle');
            if($lotterystyle == 'b'){
                $channel = Constant::CHANNEL_LOTTERY2;
            }elseif($lotterystyle == 'y'){
                $channel = Constant::CHANNEL_LOTTERY3;
            }elseif($lotterystyle == 'p'){
                $channel = Constant::CHANNEL_LOTTERY4;
            }else{
                $channel = Constant::CHANNEL_LOTTERY;
            }
            if($channel == Constant::CHANNEL_LOTTERY || $channel == Constant::CHANNEL_LOTTERY2  || $channel == Constant::CHANNEL_LOTTERY4){
//                if(!$this->_checkUserinfo()){
//                    $this->redirect('http://mp.weixin.qq.com/s?__biz=MzAwODcyNzQ0OA==&mid=400101983&idx=1&sn=5783012ad3f94b57195a18e38a2d8dea#wechat_redirect');
//                    Yii::app()->end();
//                }
            }
            $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
            if(yii::app()->request->isAjaxRequest){
                 if (! empty($this->setting[$channel]['prize_stop_time']) && time() > strtotime($this->setting[$channel]['prize_stop_time'])) {
                    $msg = array(
                        'msg' => '抽奖已结束，结束时间为：' . $this->setting[$channel]['prize_stop_time'],
                        'code' => 1001
                    );
                }
                if (! empty($this->setting[$channel]['prize_begin_time']) && time() < strtotime($this->setting[$channel]['prize_begin_time'])) {
                    $msg = array(
                        'msg' => '抽奖未开始，开始时间为：' . $this->setting[$channel]['prize_begin_time'],
                        'code' => 1002
                    );
                }
            }
 
        } elseif ($actionID == 'miaopai' || $actionID == 'miao' ||$actionID == 'miao_success' ||$actionID == 'miaoindex') {
             $channel = Constant::CHANNEL_SECKILL;
             $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
            if(yii::app()->request->isAjaxRequest){
                if (! empty($this->setting[Constant::CHANNEL_SECKILL]['miao_stop_time']) && time() > strtotime($this->setting[Constant::CHANNEL_SECKILL]['miao_stop_time'])) {
                    $msg = array(
                        'msg'=>'本次秒拍已结束，敬请关注下一次的秒拍活动 ',
                       // 'msg' => '秒拍已结束，结束时间为：' . $this->setting[Constant::CHANNEL_SECKILL]['miao_stop_time'],
                        'code' => 1001
                    );
                }
                if (! empty($this->setting[Constant::CHANNEL_SECKILL]['miao_begin_time']) && time() < strtotime($this->setting[Constant::CHANNEL_SECKILL]['miao_begin_time'])) {
                    $msg = array(
                         'msg'=>'本次秒拍未开始，敬请关注下一次的秒拍活动 ',
                         //'msg' => '秒拍未开始，开始时间为：' . $this->setting[Constant::CHANNEL_SECKILL]['miao_begin_time'],
                        'code' => 1002
                    );
                 }
            }
        } elseif ($actionID == 'auction' || $actionID == 'auction_goods' || $actionID =='auction_wall') {
            $channel = Constant::CHANNEL_AUCTION;
            $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
            if($actionID != 'auction' && $actionID !='auction_wall'){
                if (! empty($this->setting[Constant::CHANNEL_AUCTION]['auction_stop_time']) && time() > strtotime($this->setting[Constant::CHANNEL_AUCTION]['auction_stop_time'])) {
                    $msg = array(
                        'msg'=>'本次竞拍已结束，敬请关注下一次的竞拍活动 ',
                        //   'msg' => '竞拍已结束，结束时间为：' . $this->setting[Constant::CHANNEL_AUCTION]['auction_stop_time'],
                        'code' => 1001
                    );
                }
                if (! empty($this->setting[Constant::CHANNEL_AUCTION]['auction_begin_time']) && time() < strtotime($this->setting[Constant::CHANNEL_AUCTION]['auction_begin_time'])) {
                    $msg = array(
                        'msg'=>'本次竞拍未开始，敬请关注下一次的竞拍活动',
                        // 'msg' => '竞拍未开始，开始时间为：' . $this->setting[Constant::CHANNEL_AUCTION]['auction_begin_time'],
                        'code' => 1002
                    );
                } 
            }
            $this->log='/uploads/strasbourg/'.$this->setting[Constant:: CHANNEL_AUCTION]['name'].'.txt';
        } elseif ($actionID == 'christmasindex' || $actionID == 'christmasrules' || $actionID == 'christmas' || $actionID == 'christmas_add') {
            $channel = Constant::CHANNEL_GAME;
            $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
            if (! empty($this->setting[Constant::CHANNEL_GAME]['christmas_stop_time']) && time() > strtotime($this->setting[Constant::CHANNEL_GAME]['christmas_stop_time'])) {
                $msg = array(
                    'msg' => '接圣诞游戏已结束，结束时间为：' . $this->setting[Constant::CHANNEL_GAME]['christmas_stop_time'],
                    'code' => 1001
                );
            }
            if (! empty($this->setting[Constant::CHANNEL_GAME]['christmas_begin_time']) && time() < strtotime($this->setting[Constant::CHANNEL_GAME]['christmas_begin_time'])) {
                $msg = array(
                    'msg' => '接圣诞游戏未开始，开始时间为：' . $this->setting[Constant::CHANNEL_GAME]['christmas_begin_time'],
                    'code' => 1002
                );
            }
        }elseif($actionID == 'certificate_validate'  || $actionID == 'auctiondata' || $actionID == 'auction_one' || $actionID == 'auction_success' || $actionID == 'christmas_end'){
             if($actionID == 'certificate_validate'){
                 $channel=Constant::CHANNEL_GAME;
             }elseif($actionID == 'auctiondata' || $actionID == 'auction_one' || $actionID == 'auction_success'){
                 $channel= Constant::CHANNEL_AUCTION;
             }elseif($actionID == 'christmas_end'){
                 $channel = Constant::CHANNEL_GAME;
             }
    		 $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
		}elseif($actionID == 'no_prize' ||$actionID == 'payok' ||$actionID == 'create_order'){
		    //不做处理
		}elseif($actionID != 'my_certificate' && $actionID != 'getuser' && $actionID != 'gamereg'){
		     $channel = yii::app()->request->getParam('type');
			 $this->setting = require_once (dirname(__FILE__) . '/../config/'.$channel.'.php');
		}
        if (! $this->openid) {
            $msg = '参做错误';
        } else {
                $this->user = $this->db->createCommand("select * from vip_strasbourg_user where openid = '{$this->openid}'")->queryRow();
                if($actionID != 'certificate_validate' && $actionID != 'view_score' && $actionID != 'payok' && $actionID !=  'auction_wall' && $actionID !=  'gamereg'){
                    if (! $this->user || empty($this->user['phone'])) {
                        if($actionID == 'christmasindex' || $actionID == 'christmas'){
                            if(! $this->user){
                                $this->db->createCommand("insert into vip_strasbourg_user (ctime,openid,channel)values('".time()."','".$this->openid."','".Constant::CHANNEL_GAME."')")->execute();
                                $this->user['id']=$this->db->getLastInsertID();
                            }
                        }else{
                            // 跳转用户信息登记页
                            $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri;
                            $this->redirect(array("/strasbourg/register/register?callback={$callback}&channel=" . $channel
                            ));
                            yii::app()->end();
                        }
                    }
                }
        }    
        if (yii::app()->request->isAjaxRequest) {
            if ($msg) {
                echo json_encode($msg);
                yii::app()->end();
            }
        }
        if ($msg) {
            echo "<script>alert('" . $msg['msg'] . "');</script>";
        }
        
    }
    
    // 私有方法，封装获取openid过程
    private function _Getopenid($type = 'snsapi_base')
    {

        $options = array(
            'token' => Yii::app()->params['strasbourg']['wxtoken'], // 填写你设定的key
            'encodingaeskey' => Yii::app()->params['strasbourg']['wxencodingaeskey'], // 填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['strasbourg']['wxappid'], // 填写高级调用功能的app id
            'appsecret' => Yii::app()->params['strasbourg']['wxappsecret']
        ); // 填写高级调用功能的密钥
        $this->weObj = new Wechatg($options);
        if (checkWeixinBrowser()) {
            if (! getYS('openid') || $type == 'snsapi_userinfo') {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, $type);
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = 'ocKmquOkrC6j74GzX76cjXSFeQ68'; // 非微信
        }
    }
    
    // 私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type)
    {
        if (! @$_GET['code']) {
            $url = $this->weObj->getOauthRedirect($callback, '', $type);
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
    private function _checkBrowser()
    {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && ! checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); // 以后替换成错误页面
            return false;
        }
        
        return true;
    }
    
    
    //私有方法，检测用户是否关注公众号
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

    /**
     * ******************************************--------------抽奖开始-----------------********************************************
     */
    /*
     * @Author ZhangFu
     * @Description 抽奖（小）首页
     * @Time 2015年10月15日
     */
    public function actionPrize(){
        $lotterystyle=Yii::app()->request->getParam('lotterystyle');
        if(empty($lotterystyle)){
            returnJson('缺少参数','10003');
        }
        unsetYS($lotterystyle.'ok');
        $this->redirect('/strasbourg/active/prize2?lotterystyle='.$lotterystyle);
    }
    public function actionPrize2()
    {
        $lotterystyle=Yii::app()->request->getParam('lotterystyle');
        if(empty($lotterystyle)){
            returnJson('缺少参数','10003');
        }
        
     //var_dump($lotterystyle.'ok');die;
       
        $this->render('prizeindex',array('lotterystyle'=>$lotterystyle));
    }

    /*
     * @Author ZhangFu
     * @Description 生成中奖信息 ajax请求
     * @Time 2015年10月15日
     */
    public function actionMake()
    {
        if (yii::app()->request->isAjaxRequest) {
            $lotterystyle=$_POST['lotterystyle'];
            if(empty($lotterystyle)){
                echo TJSON(array(
                    'msg' => '缺少参数!',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            
//            if(getYS($lotterystyle.'ok')){
//                echo TJSON(array(
//                    'msg' => '您本次已抽过奖！',
//                    'code' => 2000
//                ));
//                yii::app()->end();
//            }else{
//                setYS($lotterystyle.'ok', 'ok');
//            }
            
            //增加摇奖次数
            if($lotterystyle =='b'){
                $channellottery=Constant::CHANNEL_LOTTERY2;
                $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'prize2totalnum'));
            }elseif($lotterystyle == 'y'){
                $channellottery = Constant::CHANNEL_LOTTERY3;
                $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'prize3totalnum'));
            }elseif($lotterystyle == 'p'){
                $channellottery = Constant::CHANNEL_LOTTERY4;
                $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'prize4totalnum'));
            }else{
                $channellottery=Constant::CHANNEL_LOTTERY;
                $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'prizetotalnum'));
            }
            $strasbourgconfig->content=$strasbourgconfig->content+1;
            if(!$strasbourgconfig->save()){
                returnJson('数量增加失败','10001');
            }
            
            $prize_arr = $this->setting[$channellottery]['setting'];
            // 取出奖品ID与概率
            foreach ($prize_arr as $k => $v) {
                $arr[$v['id']] = $v['v'];
            }
            // 根据概率取奖品ID
            $rid = $this->get_rand($arr);
            // 当前抽中的奖品数量
            $str = array();
            if ($rid) {
                foreach ($prize_arr as $k => $v) {
                    if ($v['id'] == $rid) {
                        $str = $v; // 取出中奖项
                    }
                }
            } else {
                //插入一条日志
               // $goodsjson = TJSON($this->setting[$channellottery]);
                //$time=time();
                //$this->db->createCommand("insert into vip_strasbourg_activelog (uid,cid,activename,num,ctime,state,pid,goods_json)values({$this->user['id']},0,'{$this->setting[$channellottery]['name']}',1,$time,0,100,'{$goodsjson}')")->execute();
                // ajax返回中奖信息
                echo TJSON(array(
                    'msg' => '谢谢惠顾',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            
            
            // 当前奖品已抽中数量
            $prize_list = $this->db->createCommand("select count(1) from vip_strasbourg_activelog  where activename = '{$this->setting[$channellottery]['name']}' and pid = $rid")->queryRow();
            // 当前用户已抽奖次数
            $option_num = $this->db->createCommand("select count(1) from vip_strasbourg_activelog where activename = '{$this->setting[$channellottery]['name']}' and uid = {$this->user['id']}")->queryRow();
            
            if ($option_num['count(1)'] >= $this->setting[$channellottery]['option_limit']) { // 判断用户抽奖次数
                echo TJSON(array(
                    'msg' => "您的" . $this->setting[$channellottery]['option_limit'] . "次抽奖机会已用完",
                    'code' => 2000
                ));
                yii::app()->end();
            } elseif ($prize_list['count(1)'] >= $str['num']) { // 判断中奖总数量
                //插入一条日志
                $goodsjson = TJSON($this->setting[$channellottery]);
                $time=time();
                $this->db->createCommand("insert into vip_strasbourg_activelog (uid,cid,activename,num,ctime,state,pid,goods_json)values({$this->user['id']},0,'{$this->setting[$channellottery]['name']}',1,$time,0,100,'{$goodsjson}')")->execute();
                echo TJSON(array(
                    'msg' => '谢谢惠顾',//该奖品已领完
                    'code' => 2000
                ));
                yii::app()->end();
            }
            
            if($rid == '100'){
                //插入一条日志
                $goodsjson = TJSON($this->setting[$channellottery]);
                $time=time();
                $this->db->createCommand("insert into vip_strasbourg_activelog (uid,cid,activename,num,ctime,state,pid,goods_json)values({$this->user['id']},0,'{$this->setting[$channellottery]['name']}',1,$time,0,$rid,'{$goodsjson}')")->execute();
                // ajax返回中奖信息
                echo TJSON(array(
                    'msg' => '谢谢惠顾',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            
            // $ewa=getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . Yii::app()->request->hostInfo . "/active/hexiao?user=" . $user->code . "&Type=Customized&Stype=FangFund&Config=;", "uploads/qrpic/" . $user->code . ".png");
            $time = time();
            $code = $time . rand(1, 999);
            $ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->user['openid'] ."&qrcode=".$code.'&ctype=1')."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
            $goodsjson = TJSON($this->setting[$channellottery]);
            $msg = array(
                'data' => $str,
                'code' => 1000
            );
            
            // 凭证过期时间 0表示户不过期
            $overtime = 0;
            if ($this->setting[$channellottery]['overtime']) {
                $overtime = time() + ($this->setting[$channellottery]['overtime'] * 3600);
            }
            $transaction = $this->db->beginTransaction();
            try {
                // 插入凭证数据
                $inc = $this->db->createCommand("insert into vip_strasbourg_certificate (uid,erweimaurl,code,openid,type,ctime,overtime,channel)values({$this->user['id']},'$ewa','$code','{$this->user['openid']}','{$this->setting[$channellottery]['name']}',$time,$overtime,'".$channellottery."')")->execute();
                $cid = $this->db->getLastInsertID();
                // 插入抽奖记录
                $inp = $this->db->createCommand("insert into vip_strasbourg_activelog (uid,cid,activename,num,ctime,state,pid,goods_json)values({$this->user['id']},$cid,'{$this->setting[$channellottery]['name']}',1,$time,0,$rid,'{$goodsjson}')")->execute();
                $lid=$this->db->getLastInsertID();
                $transaction->commit();
            } catch (Exception $e) {
                $msg = array(
                    'msg' => '谢谢惠顾',
                    'code' => 2000
                );
                $transaction->rollBack();
            }
            if ($msg['code'] == 1000) {
                $msg['data']['lid'] = $lid;
            }
            
            // ajax返回中奖信息
            echo TJSON($msg);
        } else {
            echo '访问出错';
            yii::app()->end();
        }
    }

    /*
     * @Author ZhangFu
     * @Description 抽奖结果页
     * @Time 2015年10月21日
     */
    public function actionIs_prize()
    {
        $lotterystyle=Yii::app()->request->getParam('lotterystyle');
        $lid = yii::app()->request->getParam('lid');
        
        $data = $this->db->createCommand("select * from vip_strasbourg_activelog where id = $lid and uid = {$this->user['id']}")->queryRow();
        $goodarr=array();//所中的奖品
        $goods_json=json_decode($data['goods_json'],true);
        foreach ($goods_json['setting'] as $key=>$good){
            if($good['id'] == $data['pid']){
                $goodarr=$good;
            }
        }
        $data['certificate'] = $this->db->createCommand("select * from vip_strasbourg_certificate where id = {$data['cid']}")->queryRow();
        
        
        
        $this->render('isprize', array(
            'cid'=>$data['certificate']['id'],
            'good'=>$goodarr,
            'lotterystyle'=>$lotterystyle,
        ));
    }
    
    /*
     * @Author Gaoxiangdong
     * @Description 未中奖
     * @Time 2015年11月24日
     */
    public function actionNo_prize()
    {
        $this->renderPartial('noprize');
    }
    
    /**
     * @Author Gaoxiangdong
     * @Description 添加抽奖用户
     * @Time 2015年11月20号
     */
    public function actionAjaxuseradd(){
        if(empty($_POST['name']) || empty($_POST['phone'])){
            returnJson('缺少参数','10003');
        }
        $user=StrasbourgLotteryuser::model()->findByAttributes(array('openid'=>$this->openid));
		if(!$user){
			$user=new StrasbourgLotteryuser();
			$user->openid=$this->openid;
			$user->name=$_POST['name'];
			$user->phone=$_POST['phone'];
			$user->ctime=time();
		}else{
		    $user->name=$_POST['name'];
		    $user->phone=$_POST['phone'];
		}
		if(!$user->save()){
		    returnJson($user->getErrors(),'10001');
		}else{
		    returnJson('保存成功','10000');
		}
        
    }

    /*
     * @Author ZhangFu
     * @Description 中奖概率计算
     * @Time 2015年10月15日
     */
    private function get_rand($proArr)
    {
        $result = '';
        // 概率数组的总概率精度
        $proSum = array_sum($proArr);
        // 概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset($proArr);
        return $result;
    }

    /**
     * ******************************************--------------竞拍开始-----------------********************************************
     */
    /*
     * @Author ZhangFu
     * @Description 竞拍商品介绍页
     * @Time 2015年10月16日
     */
    public function actionAuction_goods()
    {
        $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'auctiontotalnum'));
        $strasbourgconfig->content=$strasbourgconfig->content+1;
        if(!$strasbourgconfig->save()){
            returnJson('次数增加失败','10001');
        }
        
        //授权获取用户微信信息
        if(empty($this->user['nickname']) && empty($this->user['headimgurl'])){
            $userinfo = $this->weObj->getUserInfo($this->openid);
            if($userinfo['subscribe'] != 1){
                $userinfo = $this->weObj->getOauthUserinfo($this->_GetSqtoken(), $this->openid);
            }
            $user=StrasbourgUser::model()->findByAttributes(array('openid'=>$this->openid));
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
        $disc=$this->setting[Constant::CHANNEL_AUCTION]['setting']['discrption'];
        $this->render('auctiongoods',array('disc'=>$disc));
    }

    /*
     * @Author ZhangFu
     * @Description 竞拍大屏幕
     * @Time 2015年10月22日
     */
    public function actionAuction_wall()
    {
        $setting=$this->setting[Constant::CHANNEL_AUCTION];
        $time=time();
        $etime=strtotime($setting['auction_stop_time']);
        $stime=strtotime($setting['auction_begin_time']);
        $ctime=($etime-$time);
        if($ctime >0 && $stime <=$time){
            $t=gmstrftime('%H:%M:%S',$ctime);
        }else{
            $t='00:00:00';
        }
        $uprice = $this->db->createCommand("select uid,price from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}'  order by price desc limit 5")->queryALL();
        if(count($uprice) >= 1){
            foreach($uprice as $k=>$v){
                $uinfo=$this->db->createCommand("select name,phone,headimgurl from vip_strasbourg_user where id = {$v['uid']}")->queryRow();
                $uinfo['name']=mb_substr($uinfo['name'],0,1,'utf-8').'**';
                $uinfo['phone']=substr_replace($uinfo['phone'],'****',3,4);
                $uprice[$k]['uinfo']=$uinfo;
            }
        }
        if(yii::app()->request->isAjaxRequest){
            echo json_encode(array('data'=>$uprice,'t'=>$t));
            yii::app()->end();
        }
        $this->render('auctionwall',array('t'=>$t));
    }

    /*
     * @Author ZhangFu
     * @Description 竞拍页
     * @Time 2015年10月21日
     */
    public function actionAuction()
    {
        $data = $this->actionAuctiondata();
        $setting=$this->setting[Constant::CHANNEL_AUCTION];
        $endtime=$setting['auction_stop_time'];
        $myprice=$this->db->createCommand("select price from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' and uid = {$this->user['id']} order by price desc limit 1")->queryRow();
        if(time() > strtotime($endtime)){  //活动结束
            $order=$this->db->createCommand("select * from vip_strasbourg_order where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' limit 1")->queryRow();
            if($order['uid'] == $this->user['id']){  //最高价是是否是自己
                if($order['state'] == 1){  //有无支付订单
                     $this->actionPayok($order['order_sn'],Constant::CHANNEL_AUCTION);
                }else{
                   $data=$this->actionAuction_success();
                   $this->render('auctionindex',array('endtime'=>$endtime,'sigle'=>$data,'nowprice'=>$myprice));
                }
            }else{
                $log=$this->db->createCommand("select price from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}'")->queryRow();
                if($log){
                    $sdata=$this->actionAuction_success();
                    $this->render('auctionindex',array('endtime'=>$endtime,'data'=>$data,'nowprice'=>$myprice,'sigle'=>$sdata));
                }else{
                    $this->render('auctionindex',array('endtime'=>$endtime,'data'=>$data,'nowprice'=>$myprice));
                }
            }
        }else{
            $this->render('auctionindex',array('endtime'=>$endtime,'data'=>$data,'istrue'=>'1','nowprice'=>$myprice));
        }
    }

    /*
     * @Author ZhangFu
     * @Description 竞拍数据排行
     * @Time 2015年10月21日
     */
    public function actionAuctiondata()
    {
        $setting=$this->setting[Constant::CHANNEL_AUCTION];
        $time=time();
        $etime=strtotime($setting['auction_stop_time']);
        $stime=strtotime($setting['auction_begin_time']);
        $ctime=($etime-$time);
        if($ctime >0){
            $t=gmstrftime('%H:%M:%S',$ctime);
        }else{
            $t='00:00:00';
        }
        $data = $this->db->createCommand("select price from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' order by price desc limit 1")->queryRow();
        $uprice = $this->db->createCommand("select uid,price from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}'  order by price desc limit 5")->queryALL();
        $addarr=array();
        if(is_array($uprice)){
            foreach($uprice as $k=>$v){
                $name=$this->db->createCommand("select name from vip_strasbourg_user where id = {$v['uid']}")->queryRow();
                $addarr[$k]=$name['name'];
            }
        }
        $data['price']=$data['price']?$data['price']:'0';
        if (yii::app()->request->isAjaxRequest) {
            echo json_encode(array('data'=>$data,'t'=>"$t",'upuser'=>$addarr));
            yii::app()->end();
        }
        return $data;
    }

    /*
     * @Author ZhangFu
     * @Description AJAX 竞拍加价
     * @Time 2015年10月16日
     */
    public function actionAuction_one()
    {
        if (yii::app()->request->isAjaxRequest) {
            $time = time();
            $ewa = '';
            $goodsjson =$this->MyJsonEncode($this->setting[Constant::CHANNEL_AUCTION]);
            $file=file_get_contents($this->log);
            if (date('Y-m-d H:i:s', time()) >= $this->setting[Constant::CHANNEL_AUCTION]['auction_stop_time'] || $file == 1) {
                echo json_encode(array(
                    'msg' => '竞拍已结束',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            $oldprice = $this->db->createCommand("select price,uid from vip_strasbourg_activelog where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' order by price desc")->queryRow();
            if($oldprice['uid'] == $this->user['id']){
                echo json_encode(array(
                    'msg' => '您已出价最高了',
                    'code' => 3000,
                ));
                yii::app()->end();
            }
            if($oldprice['price']){
                $newpirce = $oldprice['price'] + $this->setting[Constant::CHANNEL_AUCTION]['setting']['add'];
            }else{
                $newpirce =  $this->setting[Constant::CHANNEL_AUCTION]['setting']['price'] + $this->setting[Constant::CHANNEL_AUCTION]['setting']['add'];
            }
            $res = $this->db->createCommand("insert into vip_strasbourg_activelog (uid,activename,num,ctime,pid,price,cid,goods_json)values({$this->user['id']},'{$this->setting[Constant:: CHANNEL_AUCTION]['name']}',1,$time,{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']},'$newpirce',0,'{$goodsjson}')")->execute();

            if (! $res) {
                echo json_encode(array(
                    'msg' => '竞价被人抢先了，您请再出价赶上',
                    'code' => 2000,
                    'price'=>$newpirce
                ));
                yii::app()->end();
            }
            echo json_encode(array(
                'msg' => '加价成功',
                'code' => 1000,
                'price'=>$newpirce,
            ));
            yii::app()->end();
        }
    }

    public function actiontimeer(){
        $setting=$this->setting[Constant::CHANNEL_AUCTION];
        $time=time();
        $etime=strtotime($setting['auction_stop_time']);
        $ctime=($etime-$time);
        if($ctime >0){
          $t=gmstrftime('%H:%M:%S',$ctime);
          echo json_encode(array('time'=>$t,'code'=>1000));
           yii::app()->end();
        }else{
            echo json_encode(array('time'=>0,'code'=>2000));
           yii::app()->end();
        }
    }
    /*
     * @Author ZhangFu
     * @Description 竞拍成功页
     * @Time 2015年10月21日
     */
    public function actionAuction_success()
    {
         $order=$this->db->createCommand("select * from vip_strasbourg_order where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' limit 1")->queryRow();
         $file=file_get_contents($this->log);
         if(!$file && !$order){
             @file_put_contents($this->log,'1');
             $msg=json_decode($this->actionCreate_order(Constant::CHANNEL_AUCTION),true);
             $msg=$msg['data'];
           //  $order=$this->db->createCommand("select * from vip_strasbourg_order where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' limit 1")->queryRow();
         }else{ 
             $msg=array('out_trade_no'=>$order['order_sn'],'body'=>'斯特拉斯堡集市','total_fee'=>$order['price']);
         }
         sleep(3);
         $order=$this->db->createCommand("select * from vip_strasbourg_order where activename = '{$this->setting[Constant:: CHANNEL_AUCTION]['name']}' and pid = '{$this->setting[Constant:: CHANNEL_AUCTION]['setting']['id']}' limit 1")->queryRow();
          
         $data['oldprice'] = $this->setting[Constant::CHANNEL_AUCTION]['setting']['price'];
         $data['buyer']=$this->user['id'] == $order['uid']?'true':'false';
         $data['type']=Constant::CHANNEL_AUCTION;
         $data['order']=$msg;
         $data['price']=$order['price'];
         
        if(yii::app()->request->isAjaxRequest){
           echo json_encode($data);
            yii::app()->end();   
        }
        return $data;
    }

    /**
     * ******************************************--------------秒拍开始-----------------********************************************
     */
    
    //数组转换保留为中文的JSON字符串
    public  function MyJsonEncode($data){
        return urldecode(json_encode($this->MyUrlEncode($data)));
        //需要PHP版本5.4以上：
        //return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    //保留中文的JSON字符串转换为数组
    public function MyJsonDecode($data){
        $data = urlencode($data);
        $data = str_replace("%7B",'{',$data);
        $data = str_replace("%7D",'}',$data);
        $data = str_replace("%5B",'[',$data);
        $data = str_replace("%5D",']',$data);
        $data = str_replace("%3A",':',$data);
        $data = str_replace("%2C",',',$data);
        $data = str_replace("%22",'"',$data);
        return $this->MyUrlDecode(json_decode($data,true));
    }
    
    //自定义的URL编码
    function MyUrlEncode($data) {
        //可对关联数组进行URL编码，并处理换行符
        //内部递归调用
        //用于MyJsonEncode函数调用
        if(!is_array($data)){
            $data = str_replace("\r",'\r',$data);
            $data = str_replace("\n",'\n',$data);
            $data = urlencode($data);
        }
        else {
            foreach($data as $key=>$value) {
                $data[$this->MyUrlEncode($key)] = $this->MyUrlEncode($value);
                if((string)$this->MyUrlEncode($key)!==(string)$key){
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }
    //自定义的URL解码
    function MyUrlDecode($data) {
        //可对关联数组进行URL解码，并处理换行符
        //内部递归调用
        //用于MyJsonDecode函数调用
        if(!is_array($data)){
            $data = urldecode($data);
            $data = str_replace('\r',"\r",$data);
            $data = str_replace('\n',"\n",$data);
        }
        else {
            foreach($data as $key=>$value) {
                $data[$this->MyUrlDecode($key)] = $this->MyUrlDecode($value);
                if((string)$this->MyUrlDecode($key)!==(string)$key){
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }
    /*
     * @Author ZhangFu
     * @Description 秒拍介绍页
     * @Time 2015年10月22日
     */
    public function actionMiaoindex()
    {
        $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'seckilltotalnum'));
        $strasbourgconfig->content=$strasbourgconfig->content+1;
        if(!$strasbourgconfig->save()){
            returnJson('次数增加失败','10001');
        }
        
        $active = $this->setting[Constant::CHANNEL_SECKILL];
       // echo '<pre>';print_r($this->setting);die;
        $data['discrption']=$active['setting']['discrption'];
        $this->render('miaoindex',$data);
    }

    /*
     * @Author ZhangFu
     * @Description 秒拍页
     * @Time 2015年10月21日
     */
    public function actionMiao()
    {
        $active = $this->setting[Constant::CHANNEL_SECKILL];
        $data['num'] = $this->setting[Constant::CHANNEL_SECKILL]['setting']['sale_num'];
        $data['price'] = $this->setting[Constant::CHANNEL_SECKILL]['setting']['price'];
        $data['starttime']=strtotime($active['miao_begin_time']);
        $data['endttime']=strtotime($active['miao_stop_time']);

        $time = time();
        $settime = (60 * $active['past_time']); // 秒拍过期时间
        $data['mylog'] = $this->db->createCommand("select * from vip_strasbourg_activelog where activename = '{$active['name']}' and pid = {$active['setting']['id']} and uid = {$this->user['id']} and (state != 1 and ctime+$settime > $time)")->queryRow();
        $data['miaonum'] = $this->db->createCommand("select count(1) from vip_strasbourg_activelog where activename = '{$active['name']}' and pid = {$active['setting']['id']}  and (state != 1 and ctime+$settime > $time)")->queryRow();
        $this->render('miao', $data);
    }
    
    /*
     * @Author ZhangFu
     * @Description AJAX 秒拍操作 秒拍30分钟未支付记录失效 商品可重新秒拍
     * @Time 2015年10月21日
     */
    public function actionMiaopai()
    {
        if (yii::app()->request->isAjaxRequest) {
            $active = $this->setting[Constant::CHANNEL_SECKILL];
            $time = time();
            $settime = (60 * $active['past_time']); // 秒拍过期时间
            $list = $this->db->createCommand("select count(1) from vip_strasbourg_activelog where activename = '{$active['name']}' and pid = {$active['setting']['id']} and (state = 1 or ctime+$settime > $time)")->queryRow();
            if ($list['count(1)'] >= $active['setting']['sale_num']) {
                echo json_encode(array(
                    'msg' => '秒拍商品被大家一抢而空了！没关系，下场秒拍加油啊！',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            // 查询是否已参加
            $log = $this->db->createCommand("select id from vip_strasbourg_activelog where activename = '{$active['name']}' and pid = {$active['setting']['id']} and uid = {$this->user['id']} and (state = 1 or ctime+$settime > $time)")->queryRow();
            if ($log) {
                echo json_encode(array(
                    'msg' => '您已秒到商品，快去兑换吧！',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            $code = $time . rand(1, 999);
            $ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->user['openid'] ."&qrcode=".$code.'&ctype=1')."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
            //$ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->user['openid'] ."&qrcode=".$time)."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
            $goodsjson = $this->MyJsonEncode($active);
                     // 插入凭证数据
            $inc = $this->db->createCommand("insert into vip_strasbourg_certificate (uid,erweimaurl,code,openid,type,ctime,channel)values({$this->user['id']},'$ewa','$code','{$this->user['openid']}','{$active['name']}',$time,'".Constant:: CHANNEL_SECKILL."')")->execute(); 
            $cid = $this->db->getLastInsertID();
            // 插入秒拍数据
            $res = $this->db->createCommand("insert into vip_strasbourg_activelog (uid,activename,num,ctime,pid,price,cid,goods_json,state)values({$this->user['id']},'{$active['name']}',1,$time,{$active['setting']['id']},'{$active['setting']['price']}',$cid,'$goodsjson',0)")->execute(); 
            if ($res) {
                echo json_encode(array(
                    'price' => $active['setting']['price'],
                    'code' => 1000,
                    'miaonum'=>$list['count(1)']+1
                ));
                yii::app()->end();
            }
            echo json_encode(array(
                'msg' => '秒拍商品被大家一抢而空了！没关系，下场秒拍加油啊！',
                'code' => 2000
            ));
            yii::app()->end();
        }
    }

    /*
     * @Author ZhangFu
     * @Description 秒拍成功页
     * @Time 2015年10月22日
     */
    public function actionMiao_success()
    {
//         $time = time();
//         $settime = (60 * $active['past_time']); // 秒拍过期时间
        $active = $this->setting[Constant::CHANNEL_SECKILL];
        $list = $this->db->createCommand("select count(1) as num from vip_strasbourg_activelog where activename = '{$active['name']}' and pid = {$active['setting']['id']}")->queryRow();
        $list['type']=Constant::CHANNEL_SECKILL;
        $this->render('miaosuccess',$list);
    }

    /**
     * ******************************************--------------团购开始-----------------********************************************
     */
    /*
     * @Author ZhangFu
     * @Description 团购介绍页
     * @Time 2015年10月21日
     */
    public function actionTuan_index()
    {
        $this->render('tuanindex');
    }

    /*
     * @Author ZhangFu
     * @Description 团购页
     * @Time 2015年10月21日
     */
    public function actionTuangou()
    {
        if($this->tuan_checklog()){
            $this->redirect('tuan_result');die;
        }else{
            //获取参加团购的人数
            $data=$this->actionTuan_data();
            //判断进入时是否应该读秒
            $time=time();
            if($time < strtotime($data['tuan_begin_time'])){
                $flag=2;
            }elseif($time > strtotime($data['tuan_stop_time'])){
                $flag=0;
            }else{
                $flag=1;
            }
            //判断用户是否下过单
            $log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$this->user['id'],'activename'=>$data['name'],'pid'=>$data['setting']['id']));
            if($log && $log->state==0){
                $istuanlog=1;
            }else{
                if($log->state == 1){
                    $flag=3;//用户已下过单，并且支付完成
                }
                $istuanlog=0;
            }
            $this->render('tuangou',array('flag'=>$flag,'data'=>$data,'istuanlog'=>$istuanlog));
       }
    }

    public function actionAjaxtuangou(){
        if (yii::app()->request->isAjaxRequest) {
            $setting = $this->setting[Constant::CHANNEL_GROUP];
            $time = time();
            $is_option = $this->db->createCommand("select id from vip_strasbourg_activelog where activename = '{$setting['name']}' and uid = {$this->user['id']} and pid = '{$setting['setting']['id']}'")->queryRow();
            if ($is_option) {
                echo json_encode(array(
                    'msg' => '您已参加此活动',
                    'code' => 2000
                ));
                yii::app()->end();
            }
            $goodsjson = TJSON($setting);
             $code = $time . rand(1, 999);
             $ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->user['openid'] ."&qrcode=".$code.'&ctype=1')."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
            $transaction = $this->db->beginTransaction();
            try {
                // 插入凭证数据
                $inc = $this->db->createCommand("insert into vip_strasbourg_certificate (uid,erweimaurl,code,openid,type,ctime,channel)values({$this->user['id']},'$ewa','$code','{$this->user['openid']}','{$setting['name']}',$time,'".Constant:: CHANNEL_GROUP."')")->execute();
                $cid = $this->db->getLastInsertID();
                $res = $this->db->createCommand("insert into vip_strasbourg_activelog (uid,activename,num,ctime,pid,cid,goods_json,state)values({$this->user['id']},'{$setting['name']}',1,$time,'{$setting['setting']['id']}',$cid,'$goodsjson',0)")->execute();
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        
            if ($res) {
                echo json_encode(array(
                    'msg' => '团购成功',
                    'code' => 1000
                ));
                yii::app()->end();
            }
            echo json_encode(array(
                'msg' => '团购失败',
                'code' => 2000
            ));
            yii::app()->end();
        }
    }
    /*
     * @Author ZhangFu
     * @Description 团购成功页
     * @Time 2015年10月21日
     */
    public function actionTuan_result()
    {
        $data = $this->actionTuan_data();
        $this->render('tuanresult', array(
            'data' => $data,
            'openid'=>$this->user['openid'],
        ));
    }

    /*
     * @Author ZhangFu
     * @Description AJAX 团购数据
     * @Time 2015年10月21日
     */
    public function actionTuan_data()
    {
        $setting = $this->setting[Constant::CHANNEL_GROUP];
        $prices = $setting['setting']['price'];
        $peple = $this->db->createCommand("select count(1) from vip_strasbourg_activelog where activename = '{$setting['name']}' and pid = {$setting['setting']['id']}")->queryRow();
        foreach ($prices as $s => $i) {
            if ($peple['count(1)'] >= $s) {
                $is = 1;
                $setting['setting']['nowprice'] = $i;
                $setting['setting']['nowpeple'] = $peple;
            }
        }
        
        // 团购人数达不到最低标准，返回最代团购价
        if (! $is) {
            reset($prices);
            $setting['setting']['nowprice'] = current($prices);
            $setting['setting']['nowpeple'] =$peple;
        }
        
//         if (yii::app()->request->isAjaxRequest) {
//             echo json_encode($setting);
//             yii::app()->end();
//         } else {
            return $setting;
        //}
    }
    
    /**
     * 获取团购凭证页
     */
     public function actionTuan_erweima(){
         $setting = $this->setting[Constant::CHANNEL_GROUP];
         $log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$this->user['id'],'activename'=>$setting['name'],'pid'=>$setting['setting']['id']));
         $certificate=StrasbourgCertificate::model()->findByPk($log->cid);
         
         $tuandata=json_decode($log->goods_json,true);
         $this->renderPartial('tuanerweima',array('tuandata'=>$tuandata,'certificate'=>$certificate));
     }
    
    /**
     * 检查团购
     */
    public function tuan_checklog(){
        $setting = $this->setting[Constant::CHANNEL_GROUP];
            $log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$this->user['id'],'activename'=>$setting['name'],'pid'=>$setting['setting']['id']));
            if($log && $log->state == 0 && time() > strtotime($setting['tuan_stop_time'])){
                return true;//订单存在，且未支付
            }else{
                return false;//订单不存在或者已支付
            }
        return false;        
    }

    /**
     * ******************************************--------------接圣诞-----------------********************************************
     */
    
    /*
     * @Author ZhangFu
     * @Description 接圣诞首页
     * @Time 2015年10月22日
     */
    public function actionChristmasindex()
    {
        $strasbourgconfig=StrasbourgConfig::model()->findByAttributes(array('name'=>'gametotalnum'));
        $strasbourgconfig->content=$strasbourgconfig->content+1;
        if(!$strasbourgconfig->save()){
            returnJson('次数增加失败','10001');
        }
        
        $setting = $this->setting[Constant::CHANNEL_GAME];
        $hascertif=$this->actionMy_certificate(Constant::CHANNEL_GAME,1);
        if(yii::app()->request->isAjaxRequest){
            $day = date('Y-m-d', time());
            $now = time();
            $mkn=$this->db->createCommand("select count(1) as num from vip_strasbourg_certificate where channel = 'game'")->queryRow();
            if($now >= strtotime($setting['christmas_stop_time']) || $mkn['num'] >= $setting['mkn_num']){
               echo json_encode(array('msg'=>'活动已结束!','code'=>2000)); 
               yii::app()->end();
            }else{
                echo json_encode(array('msg'=>'ok','code'=>1000));
                yii::app()->end();
            }
        }
        $this->render('christmasindex',array('hascertif'=>$hascertif));
    }
 
    /*
     * @Author ZhangFu
     * @Description 接圣诞游戏页
     * @Time 2015年10月22日
     */
    public function actionChristmas()
    {
        $day = date('Y-m-d', time());
        $now = time();
        $setting = $this->setting[Constant::CHANNEL_GAME];
        if($now >= strtotime($setting['christmas_stop_time'])){
            $this->redirect('active/christmasindex');
            yii::app()->end();
        }
        $mkn=$this->db->createCommand("select count(1) as num from vip_strasbourg_certificate where channel = 'game'")->queryRow();
        if($mkn['num'] >= $setting['mkn_num']){
            echo "<script>alert('活动已结束!');</script>";
        }
        // 查询当天游戏记录
        $day_log = $this->db->createCommand("select num from vip_strasbourg_game where ctime = '$day' and uid = {$this->user['id']}")->queryRow();
        if (! $day_log) {
            // 插入新游戏记录
            $this->db->createCommand("insert into vip_strasbourg_game (uid,currentscore,totalscore,num,ctime,start)values({$this->user['id']},0,0,0,'$day',{$now})")->execute();
        }else{
            $up=$this->db->createCommand("update vip_strasbourg_game set num=num+1 ,currentscore = 0,start = $now where uid = {$this->user['id']} and ctime = '$day'")->execute();
        } 
        $user=$this->db->createCommand("select * from vip_strasbourg_user where id = {$this->user['id']}")->queryRow();
        $this->render('christmas',$user);
    }
 
    /*
     * @Author ZhangFu
     * @Description 接圣诞结束页
     * @Time 2015年10月22日
     */
    public function actionChristmas_end()
    {
        $setting = $this->setting[Constant::CHANNEL_GAME];
        if (yii::app()->request->isAjaxRequest) {
            $score=yii::app()->request->getParam('score');
            $day = date('Y-m-d', time());
            
            $mkn=$this->db->createCommand("select count(1) as num from vip_strasbourg_certificate where channel = 'game'")->queryRow();
            if($mkn['num'] >= $setting['mkn_num']){
                echo json_encode(array('msg'=>'活动已结束!','code'=>2000));
                yii::app()->end();
            }
            
            $res = $this->db->createCommand("update vip_strasbourg_game set currentscore = '$score' ,totalscore=totalscore+ '$score' where uid = {$this->user['id']} and ctime = '$day'")->execute();
            if(!$res){
                echo json_encode(array('msg'=>'游戏出错请重新进入!','code'=>2000));
                yii::app()->end();
            }
            // 更新用户表积分
            $is_up = $this->db->createCommand("update vip_strasbourg_user set scores = scores+ {$score} where id = {$this->user['id']} ")->execute();
            if(!$is_up){
                echo json_encode(array('msg'=>'游戏出错请重新进入!','code'=>2000));
                yii::app()->end();
            }
            // 反回当天游戏数据,与用户积分数据
            $game = $this->db->createCommand("select id,currentscore from vip_strasbourg_game where uid = {$this->user['id']} and ctime = '{$day}'")->queryRow();
            $data['game'] = $game;
            $data['mkn']=0;
            $data['game']['cid']=0;
            $mkn_num=$this->actionMy_certificate(Constant::CHANNEL_GAME);
            if($mkn_num == 0){ $convert=4500;}elseif($mkn_num == 1){$convert=6000;}elseif($mkn_num >= 2){$convert=9000;}
            if($score >= $convert){
                $time=time();
            //    $data['mkn']=floor($score/$convert);
                $data['mkn']=1;
                $code = $time . rand(1, 999);
                $ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $this->user['openid'] ."&qrcode=".$code.'&ctype=1')."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
                // 插入凭证数据
                $inc = $this->db->createCommand("insert into vip_strasbourg_certificate (uid,erweimaurl,code,openid,type,ctime,channel)values({$this->user['id']},'$ewa','$code','{$this->user['openid']}','{$setting['name']}',$time,'".Constant::CHANNEL_GAME."')")->execute();
                $cid = $this->db->getLastInsertID();
                $data['game']['cid']=$cid;
                if($inc){
                    $res=$this->db->createCommand("update vip_strasbourg_game set mkn ={$data['mkn']} ,cid = {$cid} where uid = {$this->user['id']} and id = {$game['id']}")->execute();
                }
                //页面判断马卡龙数量，用户名是否存在，不存在进入留资页面
               if(!$res || !$inc){
                   echo json_encode(array('msg'=>'游戏出错请重新进入!','code'=>2000));
                   yii::app()->end();
               }
            }
            echo json_encode($data);
            yii::app()->end();
        }
    }

    //留资页
    public function actionGamereg(){
        $name=yii::app()->request->getParam('name');
        $phone=yii::app()->request->getParam('phone');
      //  $home=yii::app()->request->getParam('home');
        if(!$name || !$phone){
           echo json_encode(array('msg'=>'缺少参数!','code'=>2000));
           yii::app()->end();
        }
     
        $res=$this->db->createCommand("update vip_strasbourg_user set name = '$name', phone = '$phone',channel = '".Constant::CHANNEL_GAME."' where id = {$this->user['id']}")->execute();
      //  echo "update vip_strasbourg_user set name = '$name', phone = '$phone',hometown = '$home',channel = '".Constant::CHANNEL_GAME."' where id = {$this->user['id']}";die;
        if($res){
            echo json_encode(array('msg'=>'ok','code'=>1000));
            yii::app()->end();
        }else{
            echo json_encode(array('msg'=>'更新失败','code'=>2000));
            yii::app()->end();
        }
        
    }

    /**
     * ******************************************--------------结束-----------------********************************************
     */
    
    
    public function actionGetuser(){
    
        $this->_Getopenid();
        $user = $this->db->createCommand("select id,username,phone from vip_strasbourg_user where openid = '{$this->openid}'")->queryRow();
         echo json_encode($user);
         yii::app()->end();
    }
    /*
     * @Author ZhangFu
     * @Description 生成订单
     * @Time 2015年10月22日
     */
    public function actionCreate_order($ztype='')
    { 
       
        $rtype = yii::app()->request->getParam('type');
        $type=$rtype?$rtype:$ztype;
        $this->setting = include(dirname(__FILE__) . '/../config/'.$type.'.php');
        if((!$type || $type == '') && !$ztype){
            returnJson('缺少参数',10003);
        }
        $data = $this->setting["$type"];
        $buyer = $this->db->createCommand("select * from vip_strasbourg_activelog where activename = '{$data['name']}' and pid = '{$data['setting']['id']}' and uid = {$this->user['id']} and num = 1 order by id desc limit 1")->queryRow();
            switch($type){
                case Constant::CHANNEL_GROUP:
                    $shuju=$this->actionTuan_data();
                    $buyer['price']=$shuju['setting']['nowprice']*1;
                    break;
                case Constant::CHANNEL_AUCTION:
                    $buyer = $this->db->createCommand("select * from vip_strasbourg_activelog where activename = '{$data['name']}' and pid = '{$data['setting']['id']}'  order by price desc limit 1")->queryRow();
                    if(!$buyer){
                        @file_put_contents($this->log,'0');
                        $msg =json_encode(array(
                            'msg' =>'微信支付小二忙不过来了，请您重新支付！',
                            'code' => 2000
                        ));
                        echo  $msg;
                        yii::app()->end();
                    }
                    $user= $this->db->createCommand("select openid,name,phone from vip_strasbourg_user where id = {$buyer['uid']}")->queryRow();
                    $time = time();
                    $code = $time . rand(1, 999);
                    if($buyer['cid'] <= 0){
                        $ewa = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . urlencode(Yii::app()->request->hostInfo . "/strasbourg/active/certificate_validate?fopenid=" . $user['openid'] ."&qrcode=".$code.'&ctype=1')."&Type=Customized&Stype=FangFund&Config=;", "uploads/strasbourg/" . $code . ".png");
                        $inc = $this->db->createCommand("insert into vip_strasbourg_certificate (uid,erweimaurl,code,openid,type,ctime,channel)values({$buyer['uid']},'$ewa','$code','{$user['openid']}','{$this->setting[Constant:: CHANNEL_AUCTION]['name']}',$time,'".Constant:: CHANNEL_AUCTION."')")->execute();
                        if($inc){
                            $cid = $this->db->getLastInsertID();
                            $op1=$this->db->createCommand("update vip_strasbourg_activelog set cid = '{$cid}' where id= {$buyer['id']}")->execute();
                        }
                        if(!$op1){
                            @file_put_contents($this->log,'0');
                            $msg =json_encode(array(
                                'msg' =>'微信支付小二忙不过来了，请您重新支付！',
                                'code' => 2000
                            ));
                            if($msg && !$ztype){
                                echo  $msg;
                            }else{
                                return $msg;
                            }
                            yii::app()->end();
                        }
                      $buyer = $this->db->createCommand("select * from vip_strasbourg_activelog where id= {$buyer['id']}")->queryRow();
                    } 
                  //  $buyer['price']=0.01;
                    break;
                default:
            }
            $time = time();
            $order_sn = 'stlsb_' . time() . rand(1, 1000);
            $res = $this->db->createCommand("insert into vip_strasbourg_order (order_sn,activename,pid,uid,state,time,price,cid)values('$order_sn','{$buyer['activename']}',{$buyer['pid']},{$buyer['uid']},0,{$time},'{$buyer['price']}',{$buyer['cid']})")->execute();
            if ($res) {
                $paydata['out_trade_no'] = $order_sn;
                $paydata['body'] = '斯特拉斯堡集市';
                $paydata['total_fee'] = $buyer['price'];
                $msg= json_encode(array(
                    'data' => $paydata,
                    'code' => 1000
                ));
            } else {
                @file_put_contents($this->log,'0');
                $msg= json_encode(array(
                    'msg' => '订单创建失败!',
                    'code' => 2000
                ));
            }
           if($msg && !$ztype){
               echo  $msg;
            }else{
                return $msg;
            }
        
    }

    /*
     * @Author ZhangFu
     * @Description 添加新用户
     * @Time 2015年10月22日
     */
    public function actionCreate_user()
    {
        if (yii::app()->request->isAjaxRequest) {
            $uname = yii::app()->request->getParam('name');
            $phone = yii::app()->request->getParam('phone');
            if ($uname && $phone) {
                $res = $this->db->createCommand("insert into vip_strasbourg_user (name,phone,ctime,openid)values('$uname','$phone','','{$this->openid}')")->execute();
                if ($res) {
                    echo json_encode(array(
                        'msg' => '提交成功！',
                        'code' => 1000
                    ));
                    yii::app()->end();
                }
                echo json_encode(array(
                    'msg' => '提交失败，请重试!',
                    'code' => 2000
                ));
                yii::app()->end();
            }
        }
    }

    /*
     * @Author ZhangFu
     * @Description 支付成功页
     * @Time 2015年10月21日
     */
 public function actionPayok($ordersn='',$channel='')
    {
        $ordersn = $ordersn?$ordersn:yii::app()->request->getParam('ordersn');
        $channel = $channel?$channel:yii::app()->request->getParam('channel');
        if(!isset($ordersn) || empty($ordersn) || !isset($channel) || empty($channel)){
            returnJs('缺少参数');
        } 
        sleep(3); 
        $orderdata=$this->db->createCommand("select * from vip_strasbourg_order where order_sn = '{$ordersn}' and state = 1")->queryRow();
        
        if(!$orderdata){
          echo "<script>alert('未找到订单信息');<script>";
          yii::app()->end();
        }
        $goods_json=$this->db->createCommand("select goods_json from vip_strasbourg_activelog where activename = '{$orderdata['activename']}' and pid ={$orderdata['pid']} and uid = {$orderdata['uid']} and cid = {$orderdata['cid']} ")->queryRow();
        $orderdata['goods']=$goods_json['goods_json'];
        $orderdata['type']=$channel;

        switch ($channel){
            case Constant::CHANNEL_GROUP:
                $data=$this->actionTuan_data();
                $tuandata=json_decode($orderdata['goods'],true);
                $this->renderPartial('tuansuccess',array('tuandata'=>$tuandata,'orderdata'=>$orderdata,'data'=>$data));
                break;
            case 'seckill':
                 $this->render('miaopayok',$orderdata);
                break;
            case Constant::CHANNEL_LOTTERY:
                yii::app()->db->createCommand("update vip_strasbourg_certificate set isvalid = 1 where id = '{$orderdata['cid']}'")->execute();
                $this->render('lotterypayok',$orderdata);
                break; 
            case 'auction':
                $this->render('auctionpayok',$orderdata);
               break;
            case Constant::CHANNEL_SAOMA:
                //查找商家
                $business=StrasbourgBusiness::model()->findByAttributes(array('businesscode'=>$orderdata['businesscode']));
                
                $this->renderPartial('saomapayok',array('orderdata'=>$orderdata,'business'=>$business,'ordersn'=>$ordersn));
                break;
               
        }
    }
    

    /*
     * @Author ZhangFu
     * @Description 展示凭证页
     * @Time 2015年10月21日
     */
    public function actionCertificate_web()
    {
        $cid= yii::app()->request->getParam('cid');    //凭证ID
        $type = yii::app()->request->getParam('type');  //活动类型
        $day = date('Y-m-d', time());
        
        $order['ewm'] = $this->db->createCommand("select erweimaurl,code,uid,type from vip_strasbourg_certificate where id = {$cid}")->queryRow();
        if($type == Constant::CHANNEL_GAME ){
            $order['goods'] = $this->db->createCommand("select mkn,cid from vip_strasbourg_game where uid = {$this->user['id']}  and cid = $cid")->queryRow();
        }else{
            $goods = $this->db->createCommand("select pid,goods_json from vip_strasbourg_activelog where uid = {$order['ewm']['uid']} and cid = {$cid} and activename = '{$order['ewm']['type']}'")->queryRow();
            $order['goods']=$goods['goods_json'];
        }   
      
         $goodsstr=json_decode($order['goods'],true);
         $business=$this->db->createCommand("select * from vip_strasbourg_business where businesscode = '{$goodsstr['shop_num']}'")->queryRow();
         $order['type']=$type;
         $order['shop_num']=$business['roomnumer'];
         switch ($type){//不同二维码页面
             case Constant::CHANNEL_LOTTERY:
             case Constant::CHANNEL_LOTTERY2:
             case Constant::CHANNEL_LOTTERY3:
             case Constant::CHANNEL_LOTTERY4:
                 
                 $goodarr=array();//选中的商品
                 $goods_array=json_decode($goods['goods_json'],true);
                 foreach ($goods_array['setting'] as $k=>$v){
                     if($v['id']== $goods['pid']){
                         $goodarr=$v;
                     }
                 }
                 
                 if($type == Constant::CHANNEL_LOTTERY2){
                     $lotteryuser=StrasbourgLotteryuser::model()->findByAttributes(array('openid'=>$this->openid));
                     if(!$lotteryuser){
                         $this->renderPartial('lotteryregister',array('good'=>$goodarr));die;
                     }
                 }
                 
                 //查找商家
                 $business=StrasbourgBusiness::model()->findByAttributes(array('businesscode'=>$goodarr['shop_num']));
                 //var_dump($business);die;
                 $this->renderPartial('lotteryerweima',array('order'=>$order,'good'=>$goodarr,'business'=>$business));
                 break;
             case Constant::CHANNEL_AUCTION :
                 $this->render('aewm',$order);
             break;
             case Constant::CHANNEL_SECKILL:
                 $this->render('mperm',$order);
                 break;
             default:
                 $this->render('gameer',$order);
         }
         
        
    }
    
    
//     public function actionCertificate_lottery()
//     {
//         $cid= yii::app()->request->getParam('cid');    //凭证ID
//         $type = yii::app()->request->getParam('type');  //活动类型
//         $day = date('Y-m-d', time());
    
//         $order['ewm'] = $this->db->createCommand("select erweimaurl,code,uid,type from vip_strasbourg_certificate where id = {$cid}")->queryRow();
//         if($type == Constant::CHANNEL_GAME ){
//             $order['goods'] = $this->db->createCommand("select mkn,cid from vip_strasbourg_game where uid = {$this->user['id']}  and cid = $cid")->queryRow();
//         }else{
//             $goods = $this->db->createCommand("select pid,goods_json from vip_strasbourg_activelog where uid = {$order['ewm']['uid']} and cid = {$cid} and activename = '{$order['ewm']['type']}'")->queryRow();
//             $order['goods']=$goods['goods_json'];
//         }
//         $order['type']=$type;
//         switch ($type){//不同二维码页面
//             case Constant::CHANNEL_LOTTERY:
//             case Constant::CHANNEL_LOTTERY2:
//             case Constant::CHANNEL_LOTTERY3:
//                 $goodarr=array();//选中的商品
//                 $goods_array=json_decode($goods['goods_json'],true);
//                 foreach ($goods_array['setting'] as $k=>$v){
//                     if($v['id']== $goods['pid']){
//                         $goodarr=$v;
//                     }
//                 }
//                 $this->renderPartial('lotteryerweima',array('order'=>$order,'good'=>$goodarr));
//                 break;
//             case Constant::CHANNEL_AUCTION :
//                 $this->render('aewm',$order);
//                 break;
//             case Constant::CHANNEL_SECKILL:
//                 $this->render('mperm',$order);
//                 break;
//             default:
//                 $this->render('gameer',$order);
//         }
         
    
//     }
    /*
    @Author ZhangFu
    @Description  我的凭证列表
    @Time  2015年11月5日
    $channel  活动类型  return bool 是否有我的凭证
    */
    public function actionMy_certificate($channel='',$state=''){

       $stype = yii::app()->request->getParam('type'); //凭证状态
       $atype=yii::app()->request->getParam('atype');   //活动类型
       $type=$atype?$atype:$channel;
       $stype=$stype?$stype:$state;
       $time=time();
       if($stype == 1){  //有效凭证
           if($type == Constant::CHANNEL_LOTTERY || $type == Constant::CHANNEL_LOTTERY2 || $type == Constant::CHANNEL_LOTTERY3 || $type == Constant::CHANNEL_LOTTERY4){
               $where =" (a.overtime = 0  or a.overtime > '$time') and (a.channel = '".Constant::CHANNEL_LOTTERY."' or a.channel = '".Constant::CHANNEL_LOTTERY2."' or a.channel = '".Constant::CHANNEL_LOTTERY3."' or a.channel = '".Constant::CHANNEL_LOTTERY4."')";
           }else{
               $where =" (a.overtime = 0  or a.overtime > '$time') and a.channel = '$type'";
           }
       }elseif($stype == 2){  //过期凭证
           if($type == Constant::CHANNEL_LOTTERY || $type == Constant::CHANNEL_LOTTERY2 || $type == Constant::CHANNEL_LOTTERY3  || $type == Constant::CHANNEL_LOTTERY4){
               $where =" (a.overtime != 0  and a.overtime < '$time') and (a.channel = '".Constant::CHANNEL_LOTTERY."' or a.channel = '".Constant::CHANNEL_LOTTERY2."' or a.channel = '".Constant::CHANNEL_LOTTERY3."' or a.channel = '".Constant::CHANNEL_LOTTERY4."')";
           }else{
               $where =" (a.overtime != 0  and a.overtime < '$time') and a.channel = '$type'";
           }
           
       }else{   //全部凭证
           if($type == Constant::CHANNEL_LOTTERY || $type == Constant::CHANNEL_LOTTERY2 || $type == Constant::CHANNEL_LOTTERY3  || $type == Constant::CHANNEL_LOTTERY4){
               $where ="(a.channel = '".Constant::CHANNEL_LOTTERY."' or a.channel = '".Constant::CHANNEL_LOTTERY2."' or a.channel = '".Constant::CHANNEL_LOTTERY3."' or a.channel = '".Constant::CHANNEL_LOTTERY4."')";
           }else{
               $where ="  a.channel = '$type'";
           }
       }
       if($type == Constant::CHANNEL_GAME){
           $list=$this->db->createCommand("select a.* from vip_strasbourg_certificate as a  left join vip_strasbourg_user as b on a.uid = b.id  where a.uid = {$this->user['id']} and  b.phone != '' and $where order by id desc")->queryAll();
       }elseif($type == Constant::CHANNEL_LOTTERY || $type == Constant::CHANNEL_LOTTERY2 || $type == Constant::CHANNEL_LOTTERY3  || $type == Constant::CHANNEL_LOTTERY4){
           //echo "select a.* from vip_strasbourg_certificate as a  where a.uid = {$this->user['id']}  and  $where";die;
           $list=$this->db->createCommand("select a.* from vip_strasbourg_certificate as a  where a.uid = {$this->user['id']}  and  $where order by id desc")->queryAll();
       }else{
           $list=$this->db->createCommand("select a.*,b.order_sn from vip_strasbourg_certificate as a left join vip_strasbourg_order as b on a.id = b.cid and b.state = 1 where a.uid = {$this->user['id']} and a.isvalid = 1 and  $where order by id desc")->queryAll();
       }
       
      
       if(yii::app()->request->isAjaxRequest && !$channel){
          echo count($list);
          yii::app()->end();
       }
   
       if($channel && $list){
           return  count($list);
           yii::app()->end();
       }elseif($channel && !$list){
           return  0;
           yii::app()->end();
       }
       $this->render('certificatelist',array('data'=>$list,'type'=>$type,'stype'=>$stype));
    }

    /*
     * @Author ZhangFu
     * @Description 凭证核销 
     * @Time 2015年10月23日
     * type =1 商户  2 用户 
     */
    public function actionCertificate_validate()
    {

        $code = yii::app()->request->getParam('qrcode');
        $type= yii::app()->request->getParam('ctype');
        $cdata = $this->db->createCommand("select * from vip_strasbourg_certificate where code = '{$code}'")->queryRow();
        $data['type']=$type;
        $data['certificate']=$cdata;
        $data['user']=$this->db->createCommand("select name,phone from vip_strasbourg_user where id = {$cdata['uid']}")->queryRow();
        if($cdata['channel'] == Constant::CHANNEL_GAME){
            $setting = $this->setting[Constant::CHANNEL_GAME];
            $goods['goods_json'] = json_encode(array('setting'=>array('name'=>'小礼品'),'shop_name'=>$setting['shop_name'],'shop_phone'=>$setting['shop_phone'],'shop_num'=>$setting['shop_num']));
        }else{
            $goods = $this->db->createCommand("select goods_json,pid from vip_strasbourg_activelog where uid = {$cdata['uid']} and cid ={$cdata['id']} ")->queryRow();
        }
        $data['goods']=json_decode($goods['goods_json'],true);
        if($cdata['channel'] == Constant::CHANNEL_LOTTERY || $cdata['channel']==Constant::CHANNEL_LOTTERY2 || $cdata['channel']==Constant::CHANNEL_LOTTERY3 || $cdata['channel']==Constant::CHANNEL_LOTTERY4){
            //$log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$data['certificate']['uid'],'cid'=>$data['certificate']['id']));
            foreach ($data['goods']['setting'] as $key=>$setting){
                if($setting['id'] == $goods['pid']){
                    $data['goods']['shop_num']=$data['goods']['setting'][$key]['shop_num'];
                }
            }
        }
        
        //$shop=$this->db->createCommand("select * from vip_strasbourg_business where businesscode = '{$data['goods']['shop_num']}'")->queryRow();
        $shop=$this->db->createCommand("select * from vip_strasbourg_business where openid = '{$this->openid}'")->queryRow();
        $data['goods']['shop_name']=$shop['company'];
        $data['goods']['shop_phone']=$shop['phone'];
        $data['goods']['roomnumer']=$shop['roomnumer'];
        $data['channel']=$cdata['channel'];
        if ($cdata) {
            if ($cdata['overtime'] == 0 || $cdata['overtime'] > time()) {
                if($type == 1){
                    if(!$shop){
                        $this->redirect('/strasbourg/register/bregister?callback='.urlencode('/strasbourg/active/certificate_validate?qrcode='.$code.'&ctype='.$type));
                        yii::app()->end();
                    }else{
                        if($data['goods']['shop_num'] != $shop['businesscode']){
                           // echo "<script>alert('请到指定商户处核销凭证!');</script> temp";
                            $this->render('temp');
                            yii::app()->end();
                        }
                    }
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        // 修改凭证过期时间
                        $time = '31507200';
                        $this->db->createCommand("update vip_strasbourg_certificate set overtime = '{$time}' where id = {$cdata['id']}")->execute();
                        $data['code']=1000;
                        $transaction->commit();
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        yii::app()->end();
                    }
                    $data['msg']='请您予以发放';
                    $data['code']=1000;
                }elseif($type == 2){
                    $data['msg']='请向商户领取';
                    $data['code']=1000;
                }
            } else {
                $shoparr=$this->db->createCommand("select * from vip_strasbourg_business where businesscode = '{$data['goods']['shop_num']}'")->queryRow();
                $data['goods']['shop_name']=$shoparr['company'];
                $data['goods']['shop_phone']=$shoparr['phone'];
                $data['goods']['roomnumer']=$shoparr['roomnumer'];
                
                if($type == 2){
                    $data['msg']='请向商户领取';
                    $data['code']=2000;
                }else{
                    $data['msg']='此凭证已过期';
                    $data['code']=2000;
                }

            }
        } else {
            $data['msg']='未找到凭证';
            $data['code']=2000;
        }
        if(yii::app()->request->isAjaxRequest){
           echo json_encode($data);
           yii::app()->end();
        }
      
        if($cdata['channel'] == Constant::CHANNEL_LOTTERY || $cdata['channel']==Constant::CHANNEL_LOTTERY2 || $cdata['channel']==Constant::CHANNEL_LOTTERY3 || $cdata['channel']==Constant::CHANNEL_LOTTERY4){
            $log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$data['certificate']['uid'],'cid'=>$data['certificate']['id']));
            foreach ($data['goods']['setting'] as $key=>$setting){
                if($setting['id'] == $log['pid']){
                    $data['goods']['setting']['name']=$data['goods']['setting'][$key]['prize'];
                    $shop_num=$data['goods']['shop_num']=$data['goods']['setting'][$key]['shop_num'];
                    //查找商家
                    $business=StrasbourgBusiness::model()->findByAttributes(array('businesscode'=>$shop_num));
                    $shop_num=$data['goods']['shop_name']=$business->company;
                    $shop_num=$data['goods']['shop_phone']=$business->phone;
                }
            }
        }
       $this->render('certificatevalidate',$data);
    }

    /*
     * 数组写入配制文件
     */
    private function arrayeval($array, $level = 0)
    {
        $space = '';
        $tab1 = str_repeat("\t", $level + 1);
        $evaluate = "array $space(\r\n$tab1";
        $comma = $space;
        foreach ($array as $key => $val) {
            $key = is_string($key) ? '\'' . addcslashes($key, '\'\\') . '\'' : $key;
            $val = ! is_array($val) && (! ((string) $val === (string) (int) $val) || strlen($val) > 12) ? '\'' . addcslashes($val, '\'\\') . '\'' : $val;
            if (is_array($val)) {
                $evaluate .= "$comma$key => " . arrayeval($val, $level + 1);
            } else {
                $evaluate .= "$comma$key => $val";
            }
            $comma = ",\r\n$space$tab1";
        }
        $tab2 = str_repeat("\t", $level);
        $evaluate .= "$space\r\n$tab2)";
        return $evaluate;
    }

    /*
     * 活动信息配制页
     * 更新配制
     */
    public function actionActiveup($content)
    {
        $setting = is_array($content) ? "<?php\r\nreturn " . $this->arrayeval($content) . "\r\n?>" : $content;
        if ($fp = fopen($this->_file, 'w')) {
            flock($fp, 2);
            fwrite($fp, $setting);
            fclose($fp);
            return $this;
        }
    }
}
?>