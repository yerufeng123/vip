<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class UserController extends BaseController{
    public $user;//用户对象
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
        //员工身份
        if (!empty($data['channel']) || $data['channel'] == '0') {
            $where.=' and channel ="' . $data['channel'].'"';
        }
        //姓名（模糊查找）
        if (!empty($data['user_name'])) {
            $where.=' and name like "%' . $data['user_name'] . '%"';
        }
        //手机号（模糊查找）
        if (!empty($data['user_phone'])) {
            $where.=' and phone like "%' . $data['user_phone'] . '%"';
        }
        //微信识别码（模糊查找）
        if (!empty($data['openid'])) {
            $where.=' and openid like "%' . $data['openid'] . '%"';
        }
         $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select * from vip_strasbourg_user where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_strasbourg_user order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
             $sql2 = "select count(id) as num from vip_strasbourg_user where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_strasbourg_user";
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

    //管理员注册
    public function actionUser_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('user_add');
        } else {//异步
            if(empty($_POST['username'])){
                echo '必填字段填写不完整!';die;
            }
            $sql="select id from vip_strasbourg_user where username='{$_POST['username']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($data)){
                echo '该账号已被注册！';die;
            }
            $user=new StrasbourgUser();
            $user->username=$_POST['username'];
            $user->name=$_POST['name'];
            $user->phone=$_POST['phone'];
            $user->ctime=time();
            if($user->save()>0){
                //注册成功
            }else{
                echo '注册失败';die;
            }
        }
    }

    //修改一个管理员信息
    public function actionUser_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_strasbourg_user where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('user_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['name']) || empty($_POST['phone'])){
                echo '必填字段填写不完整!';die;
            }
            
            $user= StrasbourgUser::model();
            $user->id=$_POST['id'];
            $user->name=$_POST['name'];
            $user->phone=$_POST['phone'];
            if($user->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个用户信息
    public function actionUser_delete() {
        $_POST['id'] = $_GET['id'];
        $user=  StrasbourgUser::model();
        $usernum=$user->deleteByPk($_POST['id']);
        $certificate=StrasbourgCertificate::model();
        $certificate->deleteAllByAttributes(array('uid'=>$_POST['id']));
        $log=StrasbourgActivelog::model();
        $log->deleteAllByAttributes(array('uid'=>$_POST['id']));
        $olduser=StrasbourgUser::model()->findByPk($_POST['id']);
        $tag=StrasbourgTags::model();
        $tag->deleteAllByAttributes(array('fopenid'=>$olduser->openid));
        
        if ($usernum>0) {
            
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
