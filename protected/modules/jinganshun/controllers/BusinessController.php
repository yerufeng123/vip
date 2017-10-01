<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class BusinessController extends BaseController {

    //获取公司简介
    public function actionBrief() {
        if (empty($_POST)) {
            $sql = 'select * from vip_jinganshun_brief';
            $data = Yii::app()->db->createCommand($sql)->queryRow();
            $data['pic2'] = explode(',', trim($data['pic'], ','));
            $this->renderPartial('brief', array(
                'data' => $data));
        } else {
            if (empty($_POST['pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '300001');
            }
            $id = $_POST['bid'];
            $brief = JinganshunBrief::model()->findByPk($id);
            $brief->text = $_POST['content'];
            $brief->pic = trim(moveFile('businesspic', $_POST['pic']), ',');
            if ($brief->save() > 0) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新数据失败', '300002');
            }
        }
    }

    //获取保安风采
    public function actionMien() {
        if (empty($_POST)) {
            $_POST = array_merge($_GET, $_POST);
            unset($_POST['_URL_']);

            //如果页数为空，默认为1
            $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
            //给模板查询区域赋值
            $data = $_POST;

            /*
             * 获取渠道列表
             */


            $page = $_POST['p']; //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            $sql = "select * from vip_jinganshun_mien  limit {$startnum},{$pernum}";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $sql2 = "select count(id) as num from vip_jinganshun_mien";

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
            $this->renderPartial('mien', array(
                'page' => $show,
                'list' => $result['content'],
            ));
        } else {
            if (empty($_POST['pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '300003');
            }
            $id = $_POST['bid'];
            $mien = JinganshunMien::model()->findByPk($id);
            $mien->text = $_POST['content'];
            $mien->pic = trim(moveFile('businesspic', $_POST['pic']), ',');
            if ($mien->save() > 0) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新数据失败', '300004');
            }
        }
    }
    
    //添加保安风采
    public function actionMienadd() {
        if (empty($_POST)) {
            $this->renderPartial('mienadd');
        } else {
            if (empty($_POST['little_pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '300005');
            }
            $mien = new JinganshunMien();
            $mien->pic = $_POST['little_pic'];
            $mien->content = $_POST['content'];
            if ($mien->save()) {
                returnJson('成功', '100000');
            } else {
                returnJson('保存失败', '300006');
            }
        }
    }
    
    //删除一个员工关怀信息
    public function actionMiendelete() {
        $_POST['id'] = $_GET['id'];
        $mien=  JinganshunMien::model();
        $miennum=$mien->deleteByPk($_POST['id']);
        if ($miennum>0) {
            
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
    
    //获取员工关怀
    public function actionCare() {
        if (empty($_POST)) {
            $_POST = array_merge($_GET, $_POST);
            unset($_POST['_URL_']);

            //如果页数为空，默认为1
            $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
            //给模板查询区域赋值
            $data = $_POST;

            /*
             * 获取渠道列表
             */


            $page = $_POST['p']; //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            $sql = "select * from vip_jinganshun_care  limit {$startnum},{$pernum}";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $sql2 = "select count(id) as num from vip_jinganshun_care";

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
            $this->renderPartial('care', array(
                'page' => $show,
                'list' => $result['content'],
            ));
        } else {
            if (empty($_POST['pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '300003');
            }
            $id = $_POST['bid'];
            $care = JinganshunCare::model()->findByPk($id);
            $care->text = $_POST['content'];
            $care->pic = trim(moveFile('businesspic', $_POST['pic']), ',');
            if ($care->save() > 0) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新数据失败', '300004');
            }
        }
    }
    
    //修改一个员工关怀
    public function actionCareeditor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_jinganshun_care where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('admin_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['username']) || empty($_POST['name']) || empty($_POST['role']) || empty($_POST['phone'])){
                echo '必填字段填写不完整!';die;
            }
            $sql="select id from vip_qizheng_administrator where username='{$_POST['username']}' and id <> '{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($data)){
                echo '该账号已被注册！';die;
            }
            $admin= QizhengAdministrator::model();
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
    
    //添加员工关怀
    public function actionCareadd() {
        if (empty($_POST)) {
            $this->renderPartial('careadd');
        } else {
            if (empty($_POST['little_pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '300005');
            }
            $care = new JinganshunCare();
            $care->pic = $_POST['little_pic'];
            $care->content = $_POST['content'];
            if ($care->save()) {
                returnJson('成功', '100000');
            } else {
                returnJson('保存失败', '300006');
            }
        }
    }
    
    //删除一个员工关怀信息
    public function actionCaredelete() {
        $_POST['id'] = $_GET['id'];
        $care=  JinganshunCare::model();
        $carenum=$care->deleteByPk($_POST['id']);
        if ($carenum>0) {
            
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
