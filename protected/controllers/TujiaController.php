<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class TujiaController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //首页

    public function actionIndex() {
        $this->renderPartial('index');
    }

    public function actionAjaxuseradd() {
        if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['room'])) {
            returnJson('缺少必填项', '10002');
        }
        $user = new TujiaUser();

        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->room = $_POST['room'];
        $user->year = $_POST['YYYY'];
        $user->mouth = $_POST['MM'];
        $user->day = $_POST['DD'];
        $user->fname = $_POST['fname'];
        $user->code=$_POST['yym'];
        $time = time();
        $user->ctime = $time;


        if (!$user->save()) {
            returnJson('插入数据异常', '10001');
        } else {
            returnJson('操作成功', '10000');
        }
    }

    //后台检索页
    public function actionAdmin() {
        $_POST = array_merge($_GET, $_POST);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;
        $where = '';
        /*
         * 获取管理员列表
         */
        /* 查询条件拼写 */
        //模糊查找-姓名
        if (!empty($data['name'])) {
            $where.=' and name like "%' . $data['name'] . '%"';
        }
        //模糊查找-电话
        if (!empty($data['phone'])) {
            $where.=' and phone like "%' . $data['phone'] . '%"';
        }
        //模糊查找-房源
        if (!empty($data['room'])) {
            $where.=' and room like "%' . $data['room'] . '%"';
        }

        //模糊查找-邀请人
        if (!empty($data['fname'])) {
            $where.=' and fname like "%' . $data['fname'] . '%"';
        }
        //模糊查找-预约码
        if (!empty($data['yym'])) {
            $where.=' and code like "%' . $data['yym'] . '%"';
        }

        $where = substr($where, 4);
        $page = $_POST['p']; //第几页
        $pernum = Yii::app()->request->getParam('pernum', '10');
        ; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_tujia_user where {$where} order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_tujia_user where {$where}";
        } else {
            $sql = "select * from vip_tujia_user order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_tujia_user";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();

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
        $this->renderPartial('admin', array(
            'page' => $show,
            'list' => $result['content'],
            'search' => $search,
        ));
    }
    
    //异步方法--后台导出数据
    public function actionAjaxpushdata() {
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        //从数据库获取 数据，转化为二维数组备用
        $sql = "select * from vip_tujia_user";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '房源');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '年');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '月');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '日');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '邀请人姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', '填写时间');
        $objPHPExcel->getActiveSheet()->fromArray($data, $nullValue, 'A2'); //如果出现乱码的时候，用上边的试试
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="tujia' . date('Y_m_d_H_i_s', time()) . '.xlsx"');
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
