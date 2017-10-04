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

}
