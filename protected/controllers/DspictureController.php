<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class DspictureController extends Controller {
   
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
        $this->renderPartial('index');
    }
    public function actionTakephoto() {
        $this->_Getopenid();
        $user=DspictureUser::model()->findByAttributes(array('openid'=>$this->openid));
        $this->renderPartial('takephoto',array('openid'=>$this->openid,'user'=>$user));
    }
    
    public function actionShare(){
        $this->_Getopenid();
        $user=DspictureUser::model()->findByAttributes(array('openid'=>$_GET['fopenid']));
        $this->renderPartial('share',array('user'=>$user));
    }
    
    

    public function actionAjaxuseradd() {
        if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['city'])) {
            returnJson('缺少必填项', '10002');
        }
        $this->_Getopenid();
        $user=DspictureUser::model()->findByAttributes(array('openid'=>$this->openid));
       
        if(!$user){
            $user=new DspictureUser();
        }
        
        
        
        $user->openid=$this->openid;               
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->city = $_POST['city'];
        $user->ctime=time();      
        
        if (!$user->save()) {
           returnJson($user->getErrors(),'10001');
        } else {
            returnJson('填加成功', '10000');
        }
    }
    
    public function actionAjaxuserupdate() {
        if (empty($_POST['pic']) || empty($_POST['text'])) {
            returnJson('缺少必填项', '10002');
        }
        $this->_Getopenid();
        $user=DspictureUser::model()->findByAttributes(array('openid'=>$this->openid));
        
        if(!$user || empty($user->name)){
            returnJs('您还未注册，请先注册','/dspicture/index');
        }
        
//         if($user && $user->pic){
//             returnJson('您已经更新过，请勿重复提交','20001');
//         }
    
    
        $user->pic = $_POST['pic'];
        $user->text = $_POST['text'];
    
        if (!$user->save()) {
            returnJson($user->getErrors(),'10001');
        } else {
            returnJson('更新成功', '10000');
        }
    }
    
    //异步方法，模糊查询城市
    public function actionAjaxgetcity(){
        $sql="select * from  vip_dspicture_city where city_name like '{$_GET['keyword']}%'";
        $result=Yii::app()->db->createCommand($sql)->queryAll();
        $data['code']='10000';
        $data['results']=$result;
        echo json_encode($data);
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
        if (!empty($data['city'])) {
            $where.=' and city like "%' . $data['city'] . '%"';
        }

        

        $where = substr($where, 4);
        $page = $_POST['p']; //第几页
        $pernum = Yii::app()->request->getParam('pernum', '10');
        ; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_dspicture_user where {$where} order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_dspicture_user where {$where}";
        } else {
            $sql = "select * from vip_dspicture_user order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_dspicture_user";
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
        $sql = "select * from vip_dspicture_user";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '城市');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '分享文本');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '照片');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '创建时间');
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
        setYS('sq_access_token', $res['access_token']);
    }
    
    //私有方法，检测是否屏蔽非微信浏览器
    private function _checkBrowser() {
        if (Yii::app()->params['shangqidatong']['checkBrowser'] && !checkWeixinBrowser()) {
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
    
    //异步方法----》保存微信图片到本地服务器
    public function actionAjaxgetmetarial() {
        $this->_Getopenid();
        $media_id = $_POST['serverId'];
        $media = $this->weObj->getMedia($media_id); //获取其他
        //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        if (!$media) {
            returnJson($this->weObj->errMsg, '10001');
        }
        $path = $this->_Uploadmedia($_SERVER['DOCUMENT_ROOT'] . '/uploads/dspicture/tempsucai' . time() . '.jpg', $media);
        if (!$path) {
            returnJson('图片下载失败', '10003');
        }
        require_once Yii::app()->basePath . '/extensions/Myclass/Image.class.php';
        $image = new Image(null, $_SERVER['DOCUMENT_ROOT'] . '/static/uploads/dspicture');
        $newpath = $image->thumb($path, 800, 800); //图片默认压缩成 100x100的
        if (file_exists($path)) {
            unlink($path);
        }
        $path = substr($newpath, strlen($_SERVER['DOCUMENT_ROOT'])); //此处减去uploads前边的连接
    
        returnJson($path, '10000');
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

}
