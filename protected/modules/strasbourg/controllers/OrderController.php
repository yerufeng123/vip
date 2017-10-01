<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class OrderController extends BaseController{
//管理员显示
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
        if (!empty($data['order_sn'])) {
            $where.=' and order_sn =' . $data['order_sn'];
        }
        //角色
        if (!empty($data['state']) || $data['state'] == '0') {
            $where.=' and state =' . $data['state'];
        }
        //姓名
        if (!empty($data['activename'])) {
            $where.=' and activename like "%' . $data['activename'] . '%"';
        }
        
        $where.=' and activename <> "微信扫码"';
        
        $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select * from vip_strasbourg_order where {$where} order by time desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_strasbourg_order order by time desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        foreach($data as $key=>$value){
            $user=StrasbourgUser::model()->findByPk($value['uid']);
            $log=StrasbourgActivelog::model()->findByAttributes(array('uid'=>$value['uid'],'cid'=>$value['cid']));
            $certificate=StrasbourgCertificate::model()->findByPk($value['cid']);
            $good=json_decode($log->goods_json,true);
            $data[$key]['uid']=$user->name;
            switch ($certificate->channel){
                case Constant::CHANNEL_LOTTERY:
                case Constant::CHANNEL_LOTTERY2:
                case Constant::CHANNEL_LOTTERY3:
                case Constant::CHANNEL_LOTTERY4:
                    foreach ($good['setting'] as $k=>$v){
                         if($v['id']==$value['pid']){
                            $data[$key]['pid']=$v['name'];
                         }
                    }
                    break;
                default:
                    $data[$key]['pid']=$good['setting']['name'];
            }
                
                
            

        }
        
        
        
        if(!empty($where)){
            $sql2 = "select count(id) as num from vip_strasbourg_order where {$where}";
        }else{
            $sql2 = "select count(id) as num from vip_strasbourg_order";
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
    
    
    public function actionIndexsao() {
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
        if (!empty($data['company'])) {
            $where.=' and b.company like "%' . $data['company'] . '%"';
        }
        
        //房间编号
        if (!empty($data['roomnumer'])) {
            $where.=' and b.roomnumer ="' . $data['roomnumer'].'"';
        }
       
    
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
        $this->renderPartial('indexsao', array(
            'page' => $show,
            'search' => $search,
            'list'=>$result['content'],
            'totalprice'=>$result['totalprice'],
        ));
    }
    
    
    //异步方法--后台导出数据
    public function actionAjaxpushdata() {
		set_time_limit(600);

        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        //从数据库获取 数据，转化为二维数组备用
        $sql = "select a.order_sn,a.activename,a.state,FROM_UNIXTIME(a.time),a.price,a.businesscode,b.company,b.phone,b.roomnumer from vip_strasbourg_order a left join vip_strasbourg_business b on a.businesscode = b.businesscode where a.state =1 GROUP BY a.order_sn order by time desc limit 0,3000";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
    
        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '订单号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '活动名');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '订单状态:0未支付1已支付');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '订单时间戳');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '订单价格');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '商家编号');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '商家名称');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '商家手机');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '木屋 编号');
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
