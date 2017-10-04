<?php

class LoginController extends Controller {

    public $errmsg; //错误信息

    //登录界面

    public function actionIndex() {
        $this->renderPartial('index');
    }

    //判断用户输入账号和密码是否正确
    public function actionLogin() {
        if (empty($_POST['admin_username'])) {
            $this->errmsg = '账号不能为空!';
            echo $this->errmsg;
            die;
        }
        if (empty($_POST['admin_password'])) {
            $this->errmsg = '密码不能为空!';
            echo $this->errmsg;
            die;
        }
        $password = setPwd($_POST['admin_password'], $_POST['admin_username']);
        $admin = new GuanzhiAdministrator();
        $administrator = $admin->getAdminInfo2($_POST['admin_username']); //根据账号获取管理员信息
        if (empty($administrator)) {//找不到该账号
            $this->errmsg = '账号不存在！';
        } else {//找到了该账号就去比对密码
            if (empty($administrator['password']) || ($administrator['password'] != $password)) {
                $this->errmsg = '密码不正确！';
            } else if ($administrator['enable'] == '0') {
                $this->errmsg = '账号已停用！';
            }
        }


        //如果存在错误信息，则输出，程序不再向下执行,否则就保存管理员信息
        if (!empty($this->errmsg)) {
            echo $this->errmsg;
            exit;
        } else {
            $this->session('admin_id', $administrator['id']);
            $this->session('admin_role', $administrator['role']);
            $this->session('admin_username', $administrator['username']);
        }
    }

    //退出
    public function actionLoginout() {

        unset(Yii::app()->session['admin_id']);
        unset(Yii::app()->session['admin_role']);
        unset(Yii::app()->session['admin_username']);

        $this->redirect(array('login/index'));
    }

    //员工登陆
    public function actionUserlogin() {
        $this->renderPartial('userlogin');
    }

    //验证员工编号
    public function actionUserloginon() {
        $usercode = $_POST['usercode'];
        if (empty($usercode)) {
            $this->errmsg = "员工编号为空";
        }
        $user = new QizhengUser();
        $u = $user->getUser($usercode);
        if (empty($u)) {//找不到该账号
            $this->errmsg = '员工编号不存在！';
        } else {//找到了该账号就去比对密码
            if ($u['enable'] == '0') {
                $this->errmsg = '员工编号已停用！';
            }
        }

        //如果存在错误信息，则输出，程序不再向下执行,否则就保存管理员信息
        if (!empty($this->errmsg)) {
            echo $this->errmsg;
            exit;
        } else {
            //访问量加1
            $user->addone();
            $cookie = new CHttpCookie('usercode', $u['username']);
            $cookie->expire = time() + 60 * 30;  //30分钟有效期
            Yii::app()->request->cookies['usercode'] = $cookie;
        }
    }

}
