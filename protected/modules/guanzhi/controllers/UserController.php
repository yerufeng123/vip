<?php

class UserController extends BaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';



	public function actionIndex() {
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
        //性别
        // if (!empty($data['admin_sex'])) {
        //     $where.=' and sex =' . $data['admin_sex'];
        // }
        // //角色
        // if (!empty($data['admin_role'])) {
        //     $where.=' and role =' . $data['admin_role'];
        // }
        // //姓名
        // if (!empty($data['admin_name'])) {
        //     $where.=' and name like "%' . $data['admin_name'] . '%"';
        // }
        // //地址（模糊查找）
        // if (!empty($data['admin_address'])) {
        //     $where.=' and address like "%' . $data['admin_address'] . '%"';
        // }
         $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=20;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select * from vip_guanzhi_user where {$where} order by created_at desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_guanzhi_user order by created_at desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($data as $key => $value){
        	$sql = "select * from vip_guanzhi_coupon where id = {$value['coupon_id']}";
			$coupon = Yii::app()->db->createCommand($sql)->queryRow();
        	$data[$key]['couponCode']= $coupon['couponnum'];
        }

        if(!empty($where)){
             $sql2 = "select count(id) as num from vip_guanzhi_user where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_guanzhi_user";
        }
       
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }

        //实现分页
        include_once 'page.php';
        $this->renderPartial('index', array(
            'page' => $show,
            'search' => $search,
            'list'=>$result['content'],
        ));
    }

    //用户留资料
    public function actionRegister() {
        $_POST = array_merge($_GET, $_POST);
        if(!isset($_POST['name']) || empty($_POST['name'])){
        	echo json_encode(['code' => '20001', 'msg' => '请填写用户名', 'data' => []]);exit();
        }
        if(!isset($_POST['phone']) || empty($_POST['phone'])){
        	echo json_encode(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);exit();
        }
        if(!isset($_POST['code']) || empty($_POST['code'])){
        	echo json_encode(['code' => '20003', 'msg' => '手机验证码不正确', 'data' => []]);exit();
        }
        if(!isset($_POST['city']) || empty($_POST['city'])){
        	echo json_encode(['code' => '20004', 'msg' => '请填写城市', 'data' => []]);exit();
        }
        if(!isset($_POST['intention']) || empty($_POST['intention'])){
        	echo json_encode(['code' => '20005', 'msg' => '请选择购车意向', 'data' => []]);exit();
        }
        if(!isset($_POST['level']) || empty($_POST['level'])){
        	echo json_encode(['code' => '20006', 'msg' => '缺少级别', 'data' => []]);exit();
        }
        if(!isset($_POST['score']) || empty($_POST['score'])){
        	echo json_encode(['code' => '20007', 'msg' => '缺少游戏分数', 'data' => []]);exit();
        }

        //检查用户验证码是否正确
        if($_POST['code'] != getYS('randNum'.$_POST['phone'])){
        	unsetYS('randNum'.$_POST['phone']);
        	echo json_encode(['code' => '20008', 'msg' => '验证码不正确', 'data' => []]);exit();
        }
        unsetYS('randNum'.$_POST['phone']);


        //查询用户手机号是否已存在
        $sql = "select * from vip_guanzhi_user where phone = {$_POST['phone']}";
        if(Yii::app()->db->createCommand($sql)->queryAll()){
        	echo json_encode(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);exit();
        }

        $sql = "insert into vip_guanzhi_user(name,phone,code,city,intention,level,score) value('{$_POST['name']}','{$_POST['phone']}','{$_POST['code']}','{$_POST['city']}',{$_POST['intention']},{$_POST['level']},{$_POST['score']})";
        if(Yii::app()->db->createCommand($sql)->execute()){
        	echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => []]);exit();
        }else{
        	echo json_encode(['code' => '10001', 'msg' => 'failed', 'data' => []]);exit();
        }
    }

    //获取验证码
    public function actionSendcode() {
    	$_POST = array_merge($_GET, $_POST);
    	if(!isset($_POST['phone']) || empty($_POST['phone'])){
        	echo json_encode(['code' => '20002', 'msg' => '请填写手机号', 'data' => []]);exit();
        }

    	//查询用户手机号是否已存在
        $sql = "select * from vip_guanzhi_user where phone = {$_POST['phone']}";
        if(Yii::app()->db->createCommand($sql)->queryAll()){
        	echo json_encode(['code' => '20006', 'msg' => '该手机号已被使用', 'data' => []]);exit();
        }

        //随机生产一个6位验证码
        $randNum=rand(100000,999999);
        //@TODO:发送短信通知用户验证码

        setYS('randNum'.$_POST['phone'],$randNum);
        echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => [$randNum]]);exit();
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
				$newData['one'][] = $tempData[1][$key];
			}
			$keys = array_rand($tempData[2],4);
			foreach ($keys as $key) {
				$tempData[2][$key]['options']=explode(',', $tempData[2][$key]['options']);
				$newData['two'][] = $tempData[2][$key];
			}
			$keys = array_rand($tempData[3],5);
			foreach ($keys as $key) {
				$tempData[3][$key]['options']=explode(',', $tempData[3][$key]['options']);
				$newData['three'][] = $tempData[3][$key];
			}
		}
		echo json_encode(['code' => '10000', 'msg' => 'success', 'data' => $newData]);
	}

	//抽奖接口
    public function actionLottery() {
    	$_POST = array_merge($_GET, $_POST);
    	if(!isset($_POST['level']) || empty($_POST['level'])){
        	echo json_encode(['code' => '20009', 'msg' => '缺少游戏级别', 'data' => []]);exit();
        }

        //奖池设定
        //统计3等奖和2等奖个数


        $arr1 = $arr2 = $arr3 = [];
        for ($i = 1; $i < 101; $i++) { 
        	$arr1[] = 1,
        }

        for ($i = 101; $i < 1101 ; $i++) { 
        	$arr2[] = 1,
        }

        if（$_POST['level'] == 1）{
        	if(rand(1,100) == 2){
        		echo json_encode(['code' => '10000', 'msg' => '中三等奖', 'data' => []]);exit();
        	}
        }

    	
    }
}
