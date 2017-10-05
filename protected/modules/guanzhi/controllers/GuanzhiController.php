<?php

class GuanzhiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    //用户留资料
    public function actionRegister() {
        $_POST = array_merge($_GET, $_POST);
        if(!isset($_POST['name']) || empty($_POST['name'])){
        	//echo json_encode(['code' => '20001', 'msg' => '请填写用户名', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20001', 'msg' => '请填写用户名', 'data' => []]);
        }
        if(!isset($_POST['phone']) || empty($_POST['phone'])){
        	//echo json_encode(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);
        }
        if(!isset($_POST['code']) || empty($_POST['code'])){
        	//echo json_encode(['code' => '20003', 'msg' => '手机验证码不正确', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20003', 'msg' => '手机验证码不正确', 'data' => []]);
        }
        if(!isset($_POST['city']) || empty($_POST['city'])){
        	//echo json_encode(['code' => '20004', 'msg' => '请填写城市', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20004', 'msg' => '请填写城市', 'data' => []]);
        }
        if(!isset($_POST['intention']) || empty($_POST['intention'])){
        	//echo json_encode(['code' => '20005', 'msg' => '请选择购车意向', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20005', 'msg' => '请选择购车意向', 'data' => []]);
        }
        if(!isset($_POST['level']) || empty($_POST['level'])){
        	//echo json_encode(['code' => '20006', 'msg' => '缺少级别', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20006', 'msg' => '缺少级别', 'data' => []]);
        }
        if(!isset($_POST['score']) || empty($_POST['score'])){
        	//echo json_encode(['code' => '20007', 'msg' => '缺少游戏分数', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20007', 'msg' => '缺少游戏分数', 'data' => []]);
        }




        //检查用户验证码是否正确
        if($_POST['code'] != getYS('randNum'.$_POST['phone'])){
        	//echo json_encode(['code' => '20008', 'msg' => '验证码不正确', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20008', 'msg' => '验证码不正确', 'data' => []]);
        }
        unsetYS('randNum'.$_POST['phone']);


        //查询用户手机号是否已存在
        $sql = "select * from vip_guanzhi_user where phone = {$_POST['phone']}";
        if(Yii::app()->db->createCommand($sql)->queryAll()){
        	//echo json_encode(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);
        }

        $sql = "insert into vip_guanzhi_user(name,phone,code,city,intention,level,score) value('{$_POST['name']}','{$_POST['phone']}','{$_POST['code']}','{$_POST['city']}',{$_POST['intention']},{$_POST['level']},{$_POST['score']})";
        if(Yii::app()->db->createCommand($sql)->execute()){
        	//echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => []]);exit();
            $this->jsonptxt(['code' => '10000', 'msg' => 'success', 'data' => []]);
        }else{
        	//echo json_encode(['code' => '10001', 'msg' => 'failed', 'data' => []]);exit();
            $this->jsonptxt(['code' => '10001', 'msg' => 'failed', 'data' => []]);
        }
    }

    //获取验证码
    public function actionSendcode() {
    	$_POST = array_merge($_GET, $_POST);
    	if(!isset($_POST['phone']) || empty($_POST['phone'])){
        	//echo json_encode(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);
        }

    	//查询用户手机号是否已存在
        $sql = "select * from vip_guanzhi_user where phone = {$_POST['phone']}";
        if(Yii::app()->db->createCommand($sql)->queryAll()){
        	//echo json_encode(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);
        }

        //检查防刷cookie是否存在
        if(getYC(md5('sendcode'.$_POST['phone']))){
            $this->jsonptxt(['code' => '10001', 'msg' => 'failed', 'data' => []]);
        }

        //随机生产一个6位验证码
        $randNum=rand(100000,999999);
        //@TODO:发送短信通知用户验证码
        if($this->sendMsg($_POST['phone'],$randNum)){
            setYS('randNum'.$_POST['phone'],$randNum);
            setYC(md5('sendcode'.$_POST['phone']),1,50);
            //echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => [$randNum]]);exit();
            $this->jsonptxt(['code' => '10000', 'msg' => 'success', 'data' => []]);
        }else{
            $this->jsonptxt(['code' => '10001', 'msg' => 'failed', 'data' => []]);
        }

        
    }

	//获取题库
	public function actionQuestions(){
		$_POST = array_merge($_GET, $_POST);
		$newData = $tempData = [];

		if(isset($_POST['level'])){
			$sql = "select * from vip_guanzhi_questions where type = {$_POST['level']}";
			$data = Yii::app()->db->createCommand($sql)->queryAll();
			if($_POST['level'] == 1){
				$keys = array_rand($data,3);
				foreach ($keys as $key) {
					$data[$key]['options']=explode(',', $data[$key]['options']);
					$newData[] = $data[$key];
				}
			}elseif ($_POST['level'] == 2) {
				$keys = array_rand($data,4);
				foreach ($keys as $key) {
					$data[$key]['options']=explode(',', $data[$key]['options']);
					$newData[] = $data[$key];
				}
			}elseif ($_POST['level'] == 3) {
				$keys = array_rand($data,5);
				foreach ($keys as $key) {
					$data[$key]['options']=explode(',', $data[$key]['options']);
					$newData[] = $data[$key];
				}
			}
		}else{
			$sql = "select * from vip_guanzhi_questions";
			$data = Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($data as $key => $value) {
				$tempData[$value['type']][] =$value;
			}
			$keys = array_rand($tempData[1],3);
			foreach ($keys as $key) {
				$tempData[1][$key]['options']=explode(',', $tempData[1][$key]['options']);
				$newData[0][] = $tempData[1][$key];
			}
			$keys = array_rand($tempData[2],4);
			foreach ($keys as $key) {
				$tempData[2][$key]['options']=explode(',', $tempData[2][$key]['options']);
				$newData[1][] = $tempData[2][$key];
			}
			$keys = array_rand($tempData[3],5);
			foreach ($keys as $key) {
				$tempData[3][$key]['options']=explode(',', $tempData[3][$key]['options']);
				$newData[2][] = $tempData[3][$key];
			}
		}
		//echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => $newData]);
        $this->jsonptxt(['code' => '10000', 'msg' => 'success', 'data' => $newData]);
	}

	//抽奖接口
    public function actionLottery() {
    	$_POST = array_merge($_GET, $_POST);
        if(!isset($_POST['phone']) || empty($_POST['phone'])){
            //echo json_encode(['code' => '200010', 'msg' => '缺少手机号', 'data' => []]);exit();
            $this->jsonptxt(['code' => '200010', 'msg' => '缺少手机号', 'data' => []]);
        }

    	if(!isset($_POST['level']) || empty($_POST['level'])){
        	//echo json_encode(['code' => '20009', 'msg' => '缺少游戏级别', 'data' => []]);exit();
            $this->jsonptxt(['code' => '20009', 'msg' => '缺少游戏级别', 'data' => []]);
        }

        //检查用户是否已参加抽奖
        $sql= "select * from vip_guanzhi_user where phone = {$_POST['phone']}";
        $userinfo=Yii::app()->db->createCommand($sql)->queryRow();
        if(!$userinfo){
            //echo json_encode(['code' => '200012', 'msg' => '用户不存在', 'data' => []]);exit();
            $this->jsonptxt(['code' => '200012', 'msg' => '用户不存在', 'data' => []]);
        }
        if($userinfo['ranking']){
            //echo json_encode(['code' => '200011', 'msg' => '已参加过抽奖活动', 'data' => []]);exit();
            $this->jsonptxt(['code' => '200011', 'msg' => '已参加过抽奖活动', 'data' => []]);
        }

        //奖池设定
        //统计3等奖和2等奖个数
        $sql= "select count(id) as num from vip_guanzhi_user where ranking = 3";
        $data=Yii::app()->db->createCommand($sql)->queryRow();
        $numThree= $data['num'];
        $sql= "select count(id) as num from vip_guanzhi_user where ranking = 2";
        $data=Yii::app()->db->createCommand($sql)->queryRow();
        $numTwo= $data['num'];


        $arr1 = $arr2 = $arr3 = [];
        for ($i = 1; $i < 101; $i++) { 
        	$arr1[] = 1;
        }

        for ($i = 101; $i < 1101; $i++) { 
        	$arr2[] = 1;
        }

        $sql= "select * from vip_guanzhi_coupon where type = 1 and status= 0";
        $coupon=Yii::app()->db->createCommand($sql)->queryRow();


        if($_POST['level'] == 1){
        	if($numThree < 40 && $coupon && rand(1,100) == 2){
                //更新优惠券和用户表
                $sql= "update vip_guanzhi_coupon set status = 1 where id = {$coupon['id']}";
                Yii::app()->db->createCommand($sql)->execute();
                $sql= "update vip_guanzhi_user set ranking = 3,coupon_id = {$coupon['id']} where phone = {$_POST['phone']}";
                Yii::app()->db->createCommand($sql)->execute();

        		//echo json_encode(['code' => '10000', 'msg' => '中三等奖', 'data' => ['ranking' => 3,'coupon' => $coupon['couponnum']]]);exit();
                $this->jsonptxt(['code' => '10000', 'msg' => '中三等奖', 'data' => ['ranking' => 3,'coupon' => $coupon['couponnum']]]);
        	}
        }elseif($_POST['level'] == 2 || $_POST['level'] == 3){
            if($numTwo < 20 && rand(101,1101) == 102){
                //更新优惠券和用户表
                $sql= "update vip_guanzhi_user set ranking = 2 where phone = {$_POST['phone']}";
                Yii::app()->db->createCommand($sql)->execute();
                //echo json_encode(['code' => '10000', 'msg' => '中二等奖', 'data' => ['ranking' => 2]]);exit();
                $this->jsonptxt(['code' => '10000', 'msg' => '中二等奖', 'data' => ['ranking' => 2]]);
            }

            if($numThree < 40 && $coupon && rand(1,100) == 2){
                //更新优惠券和用户表
                $sql= "update vip_guanzhi_coupon set status = 1 where id = {$coupon['id']}";
                Yii::app()->db->createCommand($sql)->execute();
                $sql= "update vip_guanzhi_user set ranking = 3,coupon_id = {$coupon['id']} where phone = {$_POST['phone']}";
                Yii::app()->db->createCommand($sql)->execute();
                //echo json_encode(['code' => '10000', 'msg' => '中三等奖', 'data' => ['ranking' => 3,'coupon' => $coupon['couponnum']]]);exit();
                $this->jsonptxt(['code' => '10000', 'msg' => '中三等奖', 'data' => ['ranking' => 3,'coupon' => $coupon['couponnum']]]);
            }

        }


        $sql= "update vip_guanzhi_user set ranking = 5 where phone = {$_POST['phone']}";
        Yii::app()->db->createCommand($sql)->execute();
        //echo json_encode(['code' => '10001', 'msg' => '未中奖', 'data' => []]);exit();
        $this->jsonptxt(['code' => '10001', 'msg' => '未中奖', 'data' => []]);
    }

    //发送短信
    public function sendMsg($phone,$code){
        $url = 'https://sms.yunpian.com/v2/sms/tpl_single_send.json';
        $data = array(
            'apikey' => '1e0c0d21ccc7b8765db75bab684e21a6',
            'mobile' => $phone,
            'tpl_id' => '1976520',
            'tpl_value' => urlencode("#code#").'='.urlencode($code)
        );
        $result=http_post($url, $data);
        $res = json_decode($result,true);
        if($res && $res['code'] == 0){
           return true; 
        }
        return false;
    }

    public function jsonptxt($data,$mode = 1){
        if($mode && isset($_POST['jsoncallback'])){
            $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
            echo  $jsoncallback . "(" . json_encode($data) . ")";exit();
        }else{
            echo json_encode($data);exit();
        }
    }
}
