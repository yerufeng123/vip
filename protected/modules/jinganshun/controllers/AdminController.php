<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class AdminController extends BaseController{
    public $admin;//管理员对象
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
        if (!empty($data['admin_sex'])) {
            $where.=' and sex =' . $data['admin_sex'];
        }
        //角色
        if (!empty($data['admin_role'])) {
            $where.=' and role =' . $data['admin_role'];
        }
        //姓名
        if (!empty($data['admin_name'])) {
            $where.=' and name like "%' . $data['admin_name'] . '%"';
        }
        //地址（模糊查找）
        if (!empty($data['admin_address'])) {
            $where.=' and address like "%' . $data['admin_address'] . '%"';
        }
         $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=5;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select * from vip_jinganshun_administrator where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_jinganshun_administrator order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
             $sql2 = "select count(id) as num from vip_jinganshun_administrator where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_jinganshun_administrator";
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
    public function actionAdmin_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('admin_add');
        } else {//异步
            if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['role']) || empty($_POST['phone'])){
                echo '必填字段填写不完整!';die;
            }
            $sql="select id from vip_jinganshun_administrator where username='{$_POST['username']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($data)){
                echo '该账号已被注册！';die;
            }
            $admin=new JinganshunAdministrator();
            $admin->username=$_POST['username'];
            $admin->password=setPwd($_POST['password'],$_POST['username']);
            $admin->name=$_POST['name'];
            $admin->role=$_POST['role'];
            $admin->sex=$_POST['sex'];
            $admin->qq=$_POST['qq'];
            $admin->phone=$_POST['phone'];
            $admin->address=$_POST['address'];
            $admin->ctime=time();
            if($admin->save()>0){
                //注册成功
            }else{
                echo '注册失败';die;
            }
        }
    }

    //修改一个管理员信息
    public function actionAdmin_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_jinganshun_administrator where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('admin_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['username']) || empty($_POST['name']) || empty($_POST['role']) || empty($_POST['phone'])){
                echo '必填字段填写不完整!';die;
            }
            $sql="select id from vip_jinganshun_administrator where username='{$_POST['username']}' and id <> '{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($data)){
                echo '该账号已被注册！';die;
            }
            $admin= JinganshunAdministrator::model();
            $admin->id=$_POST['id'];
            $admin->username=$_POST['username'];
            $admin->name=$_POST['name'];
            $admin->role=$_POST['role'];
            $admin->sex=$_POST['sex'];
            $admin->qq=$_POST['qq'];
            $admin->phone=$_POST['phone'];
            $admin->address=$_POST['address'];
            $admin->enable=$_POST['enable'];
            if($admin->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个管理员信息
    public function actionAdmin_delete() {
        $_POST['id'] = $_GET['id'];
        $admin=  JinganshunAdministrator::model();
        $adminnum=$admin->deleteByPk($_POST['id']);
        if ($adminnum>0) {
            
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
