<?php

/**
 * Created by PhpStorm.
 * User: zhaoxiaopan
 * Date: 15-04-13
 * Time: 下午17:31
 */
class AirchinaController extends Controller
{

    public $weObj;
    // wechat工具类对象
    public $openid;
    // 用户openid
    public $mesObj;
    // 用户消息对象
    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], // 填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], // 填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], // 填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret']
        ); // 填写高级调用功能的密钥
       
        $this->weObj = new Wechatg($options);
    }
    
    public function beforeAction($action){
         if($this->action->id != 'admin'){
            $this->_checkBrowser();
         }
         return true;
    }

    public function actionWeixin()
    {
        $this->weObj->valid();
    }
    
    // 首页
    public function actionIndex()
    {
        
        $style=getYP('g_style');
        if(empty($style)){
            $style=7;//分享渠道获得
        }
        switch ($style) {
            case '1':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum1'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '2':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum2'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '3':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum3'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '4':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum4'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '5':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum5'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '6':
                $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum6'));
                $stylenum->configvalue +=1;
                if($stylenum->save()){
                }else{
                    returnJson($stylenum->getErrors(),'10001');
                }
                break;
            case '7':
                    $stylenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'stylenum7'));
                    $stylenum->configvalue +=1;
                    if($stylenum->save()){
                    }else{
                        returnJson($stylenum->getErrors(),'10001');
                    }
                    break;
        
            default:
                returnJson('渠道不存在','10001');
                break;
        }
        
        $viewnum = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'viewnum'
        ));
        $viewnum->configvalue += 1;
        $viewnum->save();
        
        $this->_Register();

        //检查用户是否已抽奖，如果抽奖，就把前端先替换好
        $usercoupon=AirchinaUserCoupon::model()->findByAttributes(array('openid'=>$this->openid));
        if($usercoupon){
            if($usercoupon->cid){
                $coupon=AirchinaCoupon::model()->findByPk($usercoupon->cid);
                $data['couponnum']=$coupon->couponnum;
                switch($coupon->type){
                    case '1':
                        $data['type']='10';
                        break;
                    case '2':
                        $data['type']='20';
                        break; 
                    case '3':
                        $data['type']='30';
                        break;
                    case '4':
                        $data['type']='100';
                        break;
                    case '0':
                        $data['type']='未知';
                        break;
                }
            }else{
                $data['type']='未中';
            }
        }
        $this->render('index',$data);
    }
    
    
    
    // 抽奖页
    public function actionBonus()
    {
        $this->_Register();
        
        // 检查用户是否已经领过优惠券
        $data['coupon'] = null;
        $data['flag'] = false;//是否已领奖
        $usercoupon = AirchinaUserCoupon::model()->findByAttributes(array(
            'openid' => $this->openid
        ));
        if ($usercoupon) {
            if ($usercoupon->cid == '0') {
                $data['coupon'] = null;
                $data['flag'] = true;
            } else {
                $coupon = AirchinaCoupon::model()->findByPk($usercoupon->cid);
                if ($coupon) {
                    $data['coupon'] = $coupon;
                    $data['flag'] = true;
                }
            }
        }
        
        $this->renderPartial('bonus', array(
            'data' => $data
        ));
    }
    
    
    
    // 后台检索页
    public function actionAdmin()
    {
        $_POST = array_merge($_GET, $_POST);
        
        // 如果页数为空，默认为1
        $_POST['p'] = ! empty($_GET['p']) ? $_GET['p'] : '1';
        // 给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;
        $where = '';
        /*
         * 获取管理员列表
         */
        /* 查询条件拼写 */
        // 精确查找激活码编号
        if (!empty($data['couponnum']) || $data['couponnum'] == '0') {
            $where .= ' and couponnum ="' . $data['couponnum'] . '"';
        }
        // 代金券类型
        if (! empty($data['type']) || $data['type'] == '0') {
            $where .= ' and type ="' . $data['type'] . '"';
        }
        
        // 激活码状态
        if (! empty($data['state']) || $data['state'] == '0') {
            $where .= ' and state ="' . $data['state'] . '"';
        }
        
        $where = substr($where, 4);
        $page = $_POST['p']; // 第几页
        $pernum = Yii::app()->request->getParam('pernum', '10');// 每页显示数
        $startnum = ($page - 1) * $pernum;
        if (! empty($where)) {
            $sql = "select * from vip_airchina_coupon where {$where} order by id desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_airchina_coupon where {$where}";
        } else {
            $sql = "select * from vip_airchina_coupon order by id desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_airchina_coupon";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (! empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }
        
        // 浏览次数
        $data['viewnum']= AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'viewnum'
        ))->configvalue;
        
        // 分享次数
        $data['sharenum'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'sharenum'
        ))->configvalue;
        
        // 微博渠道
        $data['stylenum1'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum1'
        ))->configvalue;
        
        // 国航官网渠道
        $data['stylenum2'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum2'
        ))->configvalue;
        
        // 网盟渠道
        $data['stylenum3'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum3'
        ))->configvalue;
        
        
        // 备选1渠道
        $data['stylenum4'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum4'
        ))->configvalue;
        
        // 备选2渠道
        $data['stylenum5'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum5'
        ))->configvalue;
        
        // 备选3渠道
        $data['stylenum6'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum6'
        ))->configvalue;

        // 分享渠道
        $data['stylenum7'] = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'stylenum7'
        ))->configvalue;
        
        
        // 实现分页
        include_once 'page.php';
        $this->renderPartial('admin', array(
            'page' => $show,
            'list' => $result['content'],
            'search' => $search,
            'data' => $data
        ));
    }
    
    // 异步方法----》提交分享信息
    public function actionAjaxtijiao()
    {
        $this->_Getopenid();
        $content = getYP('content');
        $name = getYP('name');
        $select = getYP('select');
        if (empty($content) || empty($name) || empty($select)) {
            returnJson('缺少参数', '10003');
        }
        
        $user = AirchinaUser::model()->findByAttributes(array(
            'openid' => $this->openid
        ));
        if (! $user) {
            returnJson('用户不存在', '10001');
        }
        
        $share = new AirchinaShare();
        $share->openid = $this->openid;
        $share->name = $name;
        $share->content = $content;
        $share->select = $select * 1;
        $share->ctime = time();
        if (! $share->save()) {
            returnJson($share->getErrors(), '10001');
        } else {
            $data['ctime'] = $share->ctime;
            returnJson($data, '10000');
        }
    }
    
    // 异步方法----》抽奖
    public function actionAjaxlottery()
    {
        $this->_Register();
        $proArr = array(
            '0' => array(
                'id' => 1,
                'prize' => '1',
                'v' => 36
            ),
            '1' => array(
                'id' => 2,
                'prize' => '2',
                'v' => 27
            ),
            '2' => array(
                'id' => 3,
                'prize' => '3',
                'v' => 18
            ),
            '3' => array(
                'id' => 4,
                'prize' => '4',
                'v' => 9
            ),
            '4' => array(
                'id' => 5,
                'prize' => '0',
                'v' => 2
            )
        );
        // 检查是否已发5000份
        $daynumobj = AirchinaConfig::model()->findByAttributes(array(
            'configname' => 'daynum'
        ));
        $transaction = $daynumobj->dbConnection->beginTransaction();

        $daynum = $daynumobj->configvalue;
        $json = json_decode($daynum, true);
        if ($json['date'] != date('Y-m-d')) {
            $data['num'] = 0;
            $data['date'] = date('Y-m-d');
            $daynumobj->configvalue = json_encode($data);
            if (! $daynumobj->save()) {
                $transaction->rollBack();
                returnJson('操作失败', '10001');
            }
            $num = getLottery1($proArr);
        } elseif (intval($json['num']) < 15000) {
            $num = getLottery1($proArr);
        } else {
            $num = 4;
        }
        
        $coupon = AirchinaCoupon::model()->findByAttributes(array(
            'state' => 0,
            'type' => $proArr[$num]['prize']
        ));
        if ($coupon) {
            $data['type'] = $coupon->type;
            $data['number'] = $coupon->couponnum;
            $coupon->state = 1;
            if ($coupon->save()) {
                $usercoupon = AirchinaUserCoupon::model()->findByAttributes(array(
                    'openid' => $this->openid
                ));
                if (! $usercoupon) {
                    $usercoupon = new AirchinaUserCoupon();
                    $usercoupon->openid = $this->openid;
                    $usercoupon->cid = $coupon->id;
                    $usercoupon->ctime = time();
                    if ($usercoupon->save()) {
                        $daynumobj = AirchinaConfig::model()->findByAttributes(array(
                            'configname' => 'daynum'
                        ));
                        $daynum = $daynumobj->configvalue;
                        $json = json_decode($daynum, true);
                        $json['num'] += 1;
                        $daynumobj->configvalue = json_encode($json);
                        if($daynumobj->save()){
                            //保存用户分数
                            $user=AirchinaUser::model()->findByAttributes(array('openid'=>$this->openid));
                            $user->select=$_POST['score']*1;
                            if($user->save()){
                                $transaction->commit();
                                returnJson($data, '10000');
                            }else{
                                $transaction->rollBack();
                                returnJson('操作失败', '10001');
                            }
                        }else{
                            $transaction->rollBack();
                            returnJson('操作失败', '10001');
                        }
                    } else {
                        $transaction->rollBack();
                        returnJson('操作失败','10001');
                    }
                } else {
					 $coupon->state = 0;
					 $coupon->save();
                    $transaction->rollBack();
                    returnJson('抽过奖品了哦', '20002');
                }
            } else {
                $transaction->rollBack();
                returnJson('操作失败', '10001');
            }
        } else {
            $usercoupon = AirchinaUserCoupon::model()->findByAttributes(array(
                'openid' => $this->openid
            ));
            if (! $usercoupon) {
                $usercoupon = new AirchinaUserCoupon();
                $usercoupon->openid = $this->openid;
                $usercoupon->cid = 0;
                $usercoupon->ctime = time();
                if ($usercoupon->save()) {
                    //保存用户分数
                    $user=AirchinaUser::model()->findByAttributes(array('openid'=>$this->openid));
                    $user->select=$_POST['score']*1;
                    if($user->save()){
                        $data['type'] = 0;
                        $transaction->commit();
                        returnJson($data, '10000');
                    }else{
                        $transaction->rollBack();
                        returnJson('操作失败', '10001');
                    }
                    
                } else {
                    $transaction->rollBack();
                    returnJson('操作失败', '10001');
                }
            } else {
                $transaction->rollBack();
                returnJson('抽过奖品了哦', '20002');
            }
        }
    }
    
    // 异步方法----》统计分享成功测试
    public function actionAjaxshareok()
    {
        $sharenum=AirchinaConfig::model()->findByAttributes(array('configname'=>'sharenum'));
        $sharenum->configvalue +=1;
        $sharenum->save();
    }
    
    // 导入数据
    public function actionImportdata()
    {
        set_time_limit(0);
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel/IOFactory.php';
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/uploads/test2.xls';
        if (! file_exists($filename)) {
            die('testexcel文件不存在');
        }
        // 导入excel文件
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $data = $objPHPExcel->getActiveSheet()->toArray(); // 0键值中存放的是 属性名
        foreach ($data as $key => $value) {
            $user = new AirchinaCoupon2();
            $user->couponnum = $value[0];
            $user->type = 1;
            $user->state = 0;
            if (! $user->save()) {
                var_dump($user->getErrors());
                die();
            }
        }
    }

    /* * ***********************私有方法*************************************************** */
    
    // 私有方法，封装获取openid过程
    private function _Getopenid($type = 'snsapi_base')
    {
        if (checkWeixinBrowser()) {
            if (! getYS('openid') || $type == 'snsapi_userinfo') {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; // 此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, $type);
            }
            $this->openid = getYS('openid');
        } else {
            $this->openid = '9999999999999999999999999999'; // 非微信
        }
    }
    
    // 私有方法，封装页面授权过程（//$type:snsapi_base 静默获取用户openid snsapi_userinfo授权获取用户openid和用户信息）
    private function _Author($callback, $type)
    {
        if (! @$_GET['code'] || ($type == 'snsapi_userinfo' && ! @$_GET['info'])) {
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
    private function _checkBrowser()
    {
        if (Yii::app()->params['common']['checkBrowser'] && ! checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); // 以后替换成错误页面
            return false;
        }
        
        return true;
    }
    
    // 私有方法，检查用户是否关注过公众号
    // 获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
    public function _checkUserinfo()
    {
        if (! getYS('openid')) {
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
    
    // 获取全局token，用于调用微信全部接口（用户授权获取详情信息除外）
    private function _Gettoken()
    {
        $token = $this->weObj->checkAuth();
        return $token;
    }
    
    // 获取授权token,用户获取未关注公众号用户详情信息
    private function _GetSqtoken()
    {
        $sq_access_token = getYS('sq_access_token');
        $data = isset($sq_access_token) ? $sq_access_token : '{}';
        $data = json_decode($data, true);
        if (! isset($data['access_token']) || $data['expiretime'] < time()) {
            $this->_Getopenid('snsapi_userinfo');
            $data = json_decode(getYS('sq_access_token'), true);
        }
        return $data['access_token'];
    }
    
    // 私有方法，用于将远程文档流写入文件
    private function _Uploadmedia($path, $filename)
    {
        $fp = @fopen($path, a);
        $wresult = fwrite($fp, $filename);
        $cresult = fclose($fp);
        if ($wresult && $cresult) {
            return $path;
        } else {
            return false;
        }
    }
    
    // 私有方法----》注册用户
    private function _Register()
    {
        $this->_Getopenid();
        if (empty($this->openid)) {
            returnJson('微信识别码不能为空', '10001');
        }
        $user = AirchinaUser::model()->findByAttributes(array(
            'openid' => $this->openid
        ));
        if (! $user) {
            $user = new AirchinaUser();
            $user->openid = $this->openid;
            $user->ctime = time();
            if (! $user->save()) {
                returnJson($user->getErrors(), '10001');
            }
        }
        
    }
}
