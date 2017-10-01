<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class CertificateadminController extends BaseController{
    public $certificate;//用户对象
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
        //来源渠道
        if (!empty($data['channel']) || $data['channel'] == '0') {
            $where.=' and a.channel ="' . $data['channel'].'"';
        }
        //姓名（模糊查找）
        if (!empty($data['name'])) {
            $where.=' and b.name like "%' . $data['name'] . '%"';
        }
        //手机（模糊查找）
        if (!empty($data['phone'])) {
            $where.=' and b.phone like "%' . $data['phone'] . '%"';
        }
        //二维码编号（模糊查找）
        if (!empty($data['code'])) {
            $where.=' and a.code like "%' . $data['code'] . '%"';
        }
        
        //活动标题（模糊查找）
        if (!empty($data['type'])) {
            $where.=' and a.type like "%' . $data['type'] . '%"';
        }
        //微信识别码（模糊查找）
        if (!empty($data['openid'])) {
            $where.=' and a.openid like "%' . $data['openid'] . '%"';
        }
        $where=  substr($where, 4);
    
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.id,a.uid,a.erweimaurl,a.code,a.openid,a.type,a.ctime,a.overtime,a.channel,b.name,b.headimgurl,b.phone from vip_strasbourg_certificate a left join  vip_strasbourg_user b on a.uid=b.id where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select a.id,a.uid,a.erweimaurl,a.code,a.openid,a.type,a.ctime,a.overtime,a.channel,b.name,b.headimgurl,b.phone from vip_strasbourg_certificate a left join  vip_strasbourg_user b on a.uid=b.id order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
            $sql2 = "select count(a.id) as num from vip_strasbourg_certificate a left join vip_strasbourg_user b on a.uid=b.id where {$where}";
        }else{
            $sql2 = "select count(id) as num from vip_strasbourg_certificate";
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

    

    //删除一个用户信息
    public function actionCertificate_delete() {
        $_POST['id'] = $_GET['id'];
        $certificate=  StrasbourgCertificate::model();
        $certificatenum=$certificate->deleteByPk($_POST['id']);
        $log=StrasbourgActivelog::model();
        $log->deleteAllByAttributes(array('cid'=>$_POST['id']));
        
        if ($certificatenum>0) {
            
            $this->renderPartial('../public/success',array(
                'message'=>'删除成功！',
                'jumpUrl'=>$_SERVER['HTTP_REFERER'],
                'waitSecond'=>3,
            ));
        } else {
           $this->renderPartial('../public/error',array(
                'message'=>'删除失败！',
                'jumpUrl'=>$_SERVER['HTTP_REFERER'],
                'waitSecond'=>3,
            ));
        }
    }

}
