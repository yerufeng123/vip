<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class AotocomController extends Controller {
   
    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $options = array(
            'token' => Yii::app()->params['common']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['common']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['common']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['common']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
    }

    //首页

    public function actionIndex() {
        $this->_Getopenid();
        if($this->_checkUserinfo()){
            $user=AotocomUser::model()->findByAttributes(array('openid'=>$this->openid));
            if($user){//用户存在就浏览数加1
                $user->viewnum+=1;
                if(!$user->save()){
                     returnJson($user->getErrors(),'10001');
                }
            }else{//用户不存在，就创建用户，并让浏览数等于1
                $user=new AotocomUser();
                $user->openid=$this->openid;
                $user->viewnum=1;
                $user->ctime=time();
                if(!$user->save()){
                    returnJson($user->getErrors(),'10001');
                }
            }
            $this->renderPartial('index');
        }else{
            $this->renderPartial('erweima');
        }
        
    }

    public function actionAjaxuseradd() {
        if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['company']) || empty($_POST['email'])) {
            returnJson('缺少必填项', '10002');
        }
        $this->_Getopenid();
        $user=AotocomUser::model()->findByAttributes(array('openid'=>$this->openid));
       
        if($user->name){
            returnJson('您已经申请过，请勿重复提交申请','20001');
        }
                       
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->email = $_POST['email'];
        $user->company = $_POST['company'];
        $user->link=$_POST['link'];      
        
        if (!$user->save()) {
           returnJson($user->getErrors(),'10001');
        } else {
            returnJson('填加成功', '10000');
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
        if (!empty($data['email'])) {
            $where.=' and email like "%' . $data['email'] . '%"';
        }

        //模糊查找-邀请人
        if (!empty($data['company'])) {
            $where.=' and company like "%' . $data['company'] . '%"';
        }
        //模糊查找-预约码
        if (!empty($data['link'])) {
            $where.=' and link like "%' . $data['link'] . '%"';
        }

        $where = substr($where, 4);
        $page = $_POST['p']; //第几页
        $pernum = Yii::app()->request->getParam('pernum', '10');
        ; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_aotocom_user where {$where} order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_aotocom_user where {$where}";
        } else {
            $sql = "select * from vip_aotocom_user order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_aotocom_user";
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
        $sql = "select * from vip_aotocom_user";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '邮箱');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '企业自媒体名称');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '链接');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '创建时间');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '浏览次数');
        $objPHPExcel->getActiveSheet()->fromArray($data, $nullValue, 'A2'); //如果出现乱码的时候，用上边的试试
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="vip' . date('Y_m_d_H_i_s', time()) . '.xlsx"');
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
    
    
    /*     * ***********************私有方法*************************************************** */
    
    //私有方法，封装获取openid过程
    private function _Getopenid() {
        if (checkWeixinBrowser()) {
            if (!getYS('openid')) {
                $callback = Yii::app()->request->hostInfo . Yii::app()->request->requestUri; //此回调地址是单独为 授权回调页面设置的，跟应用的回调地址无关
                $this->_Author($callback, 'snsapi_base');
            }
            $this->openid = getYS('openid');
        } else {
            setYS('openid', 'ocKmquOkrC6j74GzX76cjXSFeQ68');
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
        setYS('sq_access_token', $res['access_token']);
    }
    
    //私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['common']['checkBrowser'] && !checkWeixinBrowser()) {
            returnJs('请在微信中打开页面'); //以后替换成错误页面
            return false;
        }
    
        return true;
    }
    
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

}
