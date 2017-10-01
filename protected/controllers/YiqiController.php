<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class YiqiController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //登陆页

    public function actionLogin() {
        $this->render('login');
    }

    //异步登陆页
    public function actionAjaxlogin() {
        $psw = $_POST['psw'];
        if ($psw != '123456') {
            returnJson('密码不正确', '10001');
        } else {
            setYS('login', '1');
            returnJson('密码验证成功', '10000');
        }
    }

    //游戏首页
    public function actionIndex() {
        $code = Yii::app()->request->getParam('user');
        if ($code) {
            $user = YiqiUser::model()->findByAttributes(array('code' => $code));
            if ($user) {
                $this->renderPartial('index2', array(
                    'business' => $user->business,
                    'address1' => $user->address1,
                    'phone' => $user->phone,
                    'address2' => $user->address2,
                    'weixin' => $user->weixin,
                ));
            } else {
                $this->renderPartial('index');
            }
        } else {
            if (getYS('login') != '1') {
                $this->redirect('/yiqi/login');
                die;
            } else {
                unsetYS('login');
            }
            $this->renderPartial('index');
        }
    }

    public function actionUseradd() {
        if (empty($_POST['business']) || empty($_POST['address1']) || empty($_POST['phone']) || empty($_POST['address2']) || empty($_POST['weixin'])) {
            returnJs('缺少必填项');
        }
        $user = new YiqiUser();

        $user->business = $_POST['business'];
        $user->address1 = $_POST['address1'];
        $user->phone = $_POST['phone'];
        $user->address2 = $_POST['address2'];
        $time = time();
        $user->ctime = $time;
        $user->code = $time . rand(1, 999);
        $user->weixin = $_POST['weixin'];
        //生成二维码
        $img = getImage(Yii::app()->request->hostInfo . "/qr/API.php?Data=" . Yii::app()->request->hostInfo . "/yiqi/index?user=" . $user->code . "&Type=Customized&Stype=FangFund&Config=;", "uploads/qrpic/" . $user->code . ".png");
        $user->erweima = $img;
        if (!$user->save()) {
            returnJs('提交失败');
        } else {
            $this->renderPartial('erweima', array('erweima' => $img));
        }
    }

}
