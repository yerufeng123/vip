<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class NavigationController extends Controller {
    protected $file = '';
    protected $setting1 = array();
    protected $setting2 = array();
    protected $setting3 = array();
    protected $lottery3_timearr=null;
    protected $seckill_timearr=null;
    protected $auction_timearr=null;
    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $this->setting1 = require_once (dirname(__FILE__) . '/../config/auction.php');
        $this->setting2 = require_once (dirname(__FILE__) . '/../config/seckill.php');
        $this->setting3 = require_once (dirname(__FILE__) . '/../config/lottery3.php');
        $this->lottery3_timearr=$lottery3_timearr;
        $this->seckill_timearr=$seckill_timearr;
        $this->auction_timearr=$auction_timearr;
        $options = array(
            'token' => Yii::app()->params['strasbourg']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['strasbourg']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['strasbourg']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['strasbourg']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
        //$this->_checkBrowser();
    }

    //活动聚合首页入口
    public function actionIndex() {
        $nowtime=time();
        foreach ($this->lottery3_timearr as $k1=>$v1){
            $begintime1=$v1[0];
            if($nowtime < strtotime($v1[1])){
                break;
            }else{
               continue;
            }
        }
        
        if($nowtime > strtotime($this->lottery3_timearr[count($this->lottery3_timearr)-1][1])){
            $endtime1=0;//抽奖
        }else{
            $endtime1=1;
        }
//         //$begintime1=$this->setting3[Constant::CHANNEL_LOTTERY3]['prize_begin_time'];//抽奖
//         if($nowtime>strtotime($this->setting3[Constant::CHANNEL_LOTTERY3]['prize_stop_time'])){
//             $endtime1=0;//抽奖
//         }else{
//             $endtime1=1;
//         }
        
        if($nowtime<strtotime($this->setting3[Constant::CHANNEL_LOTTERY3]['prize_stop_time']) && $nowtime>strtotime($this->setting3[Constant::CHANNEL_LOTTERY3]['prize_begin_time'])){
            $starttime1=1;//抽奖
        }else{
            $starttime1=0;
        }
       
        
        foreach ($this->seckill_timearr as $k2=>$v2){
            $begintime2=$v2[0];
            if($nowtime < strtotime($v2[1])){
                break;
            }else{
                continue;
            }
        }
        
        if($nowtime > strtotime($this->seckill_timearr[count($this->seckill_timearr)-1][1])){
            $endtime2=0;//抽奖
        }else{
            $endtime2=1;
        }
        
        
        //$begintime2=$this->setting2[Constant::CHANNEL_SECKILL]['miao_begin_time'];//秒拍
//         if(time()>strtotime($this->setting2[Constant::CHANNEL_SECKILL]['miao_stop_time'])){
//             $endtime2=0;//抽奖
//         }else{
//             $endtime2=1;
//         }
        
        if(time()<strtotime($this->setting2[Constant::CHANNEL_SECKILL]['miao_stop_time']) && time()>strtotime($this->setting2[Constant::CHANNEL_SECKILL]['miao_begin_time'])){
            $starttime2=1;//抽奖
        }else{
            $starttime2=0;
        }
        
        
        foreach ($this->auction_timearr as $k3=>$v3){
            $begintime3=$v3[0];
            if($nowtime < strtotime($v3[1])){
                break;
            }else{
                continue;
            }
        }
//         var_dump(date('Y-m-d H:i:s'),$nowtime);
//         echo '<br>';
//         var_dump($this->auction_timearr);
//         echo '<br>';
        
//         echo '<br>';
//         echo '<br>';
//         echo '<br>';
//         var_dump($this->setting1);
//         var_dump($begintime3);die;
       // var_dump(date('Y-m-d H:i:s'),$nowtime);
       // var_dump($this->auction_timearr[count($this->auction_timearr)-1][1]);die;
        if($nowtime > strtotime($this->auction_timearr[count($this->auction_timearr)-1][1])){
            $endtime3=0;//抽奖
        }else{
            $endtime3=1;
        }
        //$begintime3=$this->setting1[Constant::CHANNEL_AUCTION]['auction_begin_time'];//竞拍
        
//         if(time()>strtotime($this->setting1[Constant::CHANNEL_AUCTION]['auction_stop_time'])){
//             $endtime3=0;//抽奖
//         }else{
//             $endtime3=1;
//         }
        
        if(time()<strtotime($this->setting1[Constant::CHANNEL_AUCTION]['auction_stop_time']) && time()>strtotime($this->setting1[Constant::CHANNEL_AUCTION]['auction_begin_time'])){
            $starttime3=1;//抽奖
        }else{
            $starttime3=0;
        }
        $this->renderPartial('index',array('begintime1'=>$begintime1,'begintime2'=>$begintime2,'begintime3'=>$begintime3,'endtime1'=>$endtime1,'endtime2'=>$endtime2,'endtime3'=>$endtime3,'starttime1'=>$starttime1,'starttime2'=>$starttime2,'starttime3'=>$starttime3));
    }
    
    //马卡龙游戏规则页面
    public function actionGamerule(){
        $this->renderPartial('christmasrule');
    }
    
    
    //商家后台页面
    public function actionAdmin(){
        if(!getYS('roomnumer')){
            $this->redirect('/strasbourg/navigation/login');die;
        }
        
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);
        
        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search=$_POST;
        
        $where = '';
        /*
         * 获取管理员列表
         */
        /* 查询条件拼写 */
        //订单号
        if (!empty($data['order_sn'])) {
            $where.=' and a.order_sn ="'.$data['order_sn'].'"';
        }
        //是否支付
        //if (!empty($data['state']) || $data['state'] == '0') {
            $where.=' and a.state =1';
        //}
        
        //所属商户
        $roomnumer=getYS('roomnumer');
        
        //房间编号
        
            $where.=' and b.roomnumer ="' . $roomnumer.'"';
        
         
        
        $where.=' and activename = "微信扫码"';
        
        $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.order_sn,a.activename,a.pid,a.uid,a.state,a.time,a.price,a.cid,a.businesscode,b.company,b.phone,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode where {$where} GROUP BY a.order_sn order by time desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select a.order_sn,a.activename,a.pid,a.uid,a.state,a.time,a.price,a.cid,a.businesscode,b.company,b.phone,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode  GROUP BY a.order_sn order by time desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
            //$sql2 = "select count(a.id) as num,sum(a.price) as totalprice from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode  where {$where}";
            $sql2="select a.order_sn,a.activename,a.pid,a.uid,a.state,a.time,a.price,a.cid,a.businesscode,b.company,b.phone,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode where {$where} GROUP BY a.order_sn";
        }else{
            //$sql2 = "select count(id) as num,sum(price) as totalprice from vip_strasbourg_order";
            $sql2="select a.order_sn,a.activename,a.pid,a.uid,a.state,a.time,a.price,a.cid,a.businesscode,b.company,b.phone,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode GROUP BY a.order_sn";
        }
         
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        $totalpirce=0;
        $num=0;
        if(!empty($data2)){
            $num=count($data2);
            foreach ($data2 as $k=>$v){
                $totalpirce+=$v['price'];
            }
        }
        //         if (!empty($data)) {
        //             $result['content'] = $data;
        //             $result['count'] = $data2[0]['num'];
        //             $result['totalprice']=$data2[0]['totalprice'];
        //         } else {
        //             $result['content'] = array();
        //             $result['count'] = $data2[0]['num'];
        //             $result['totalprice']=0;
        //         }
        
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $num;
            $result['totalprice']=$totalpirce;
        } else {
            $result['content'] = array();
            $result['count'] = $num;
            $result['totalprice']=0;
        }
        
        //实现分页
        include_once 'page.php';
        $this->renderPartial('admin', array(
            'page' => $show,
            'search' => $search,
            'list'=>$result['content'],
            'totalprice'=>$result['totalprice'],
        ));
    }
    
    public function actionLogin(){
        if(Yii::app()->request->isAjaxRequest){
            if(empty($_POST['phone']) || empty($_POST['roomnumer'])){
                returnJson('缺少参数','10003');
            }
            
            $business=StrasbourgBusiness::model()->findByAttributes(array('phone'=>$_POST['phone'],'roomnumer'=>$_POST['roomnumer']));
            if(!$business){
                returnJson('账户不存在','20001');
            }else{
                setYS('roomnumer', $business->roomnumer);
                returnJson('操作成功','10000');
            }
            
        }else{
            $this->renderPartial('login');
        }
    }
    
    //异步判断竞拍是否已开始
    public function actionAjaxauction(){
        if(time()>strtotime($this->setting1[Constant::CHANNEL_AUCTION]['auction_stop_time'])){
            returnJson('竞拍已结束，请等待下次竞拍开始','10001');
        }
        if(time()<strtotime($this->setting1[Constant::CHANNEL_AUCTION]['auction_begin_time'])){
            returnJson('竞拍还未开始，本轮开始时间为'.$this->setting1[Constant::CHANNEL_AUCTION]['auction_begin_time'],'10001');
        }
        returnJson('竞拍进行中','10000');
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
    
    
    //异步方法--后台导出数据
    public function actionAjaxpushdata() {
        $roomnumer=getYS('roomnumer');
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        //从数据库获取 数据，转化为二维数组备用
        $sql = "select a.order_sn,a.activename,a.state,FROM_UNIXTIME(a.time),a.price,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode where a.state=1 and b.roomnumer='{$roomnumer}' GROUP BY a.order_sn order by time desc ";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
    
        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '订单号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '活动名');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '订单状态:0未支付1已支付');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '订单时间戳');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '订单价格');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '木屋 编号');
        $objPHPExcel->getActiveSheet()->fromArray($data, $nullValue, 'A2'); //如果出现乱码的时候，用上边的试试
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="stlsb' . date('Y_m_d_H_i_s', time()) . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }


}
