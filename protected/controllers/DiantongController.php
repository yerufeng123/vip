<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class DiantongController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $options = array(
            'token' => Yii::app()->params['diantong']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['diantong']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['diantong']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['diantong']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
    }

    public function actionIndex() {
        //$this->weObj->valid();
        //接收用户输入开始,可以根据用户输入，激活程序代码，实现数据库的增删改查，但不支持根据事件或者用户输入命令，进行代码跳转web页，只能用用户点击的形式跳转页面
        $this->mesObj = $this->weObj->getRev(); //先获取用户消息对象
        $type = $this->mesObj->getRevType();

        switch ($type) {//判断传入类型
            case 'event':
                $event = $this->mesObj->getRevEvent();
                switch ($event['event']) {
                    case 'subscribe'://关注事件
                        $data = array(
                            array(
                                'Title' => '心近致远 蓄势搏发',
                                'Description' => "欢迎加入2015一汽丰田新车品鉴会\n点击了解会议详情日程！",
                                'PicUrl' => 'http://vip2.hui.net/static/vip/diantong/images/tuipic.jpg',
                                'Url' => 'http://mp.weixin.qq.com/s?__biz=MzIwMjAwNjU4NQ==&mid=207751074&idx=1&sn=2595cc087e90cb7c1615fec37c90bf19#rd',
                            ),
                        );
                        $this->mesObj->news($data)->reply(); //回复图文消息
                        break;
                    case 'CLICK'://单击菜单
                        switch ($event['key']) {
                            case 'KEY001':
                                $data = array(
                                    array(
                                        'Title' => '心近致远 蓄势搏发',
                                        'Description' => "欢迎加入2015一汽丰田新车品鉴会\n点击了解会议详情日程！",
                                        'PicUrl' => 'http://vip2.hui.net/static/vip/diantong/images/tuipic.jpg',
                                        'Url' => 'http://mp.weixin.qq.com/s?__biz=MzIwMjAwNjU4NQ==&mid=207751074&idx=1&sn=2595cc087e90cb7c1615fec37c90bf19#rd',
                                    ),
                                );
                                $this->mesObj->news($data)->reply(); //回复图文消息
                                break;
                            default:
                                file_put_contents(_STATICPATH_.'weixincache/aaa.txt', $event['key']);
                                break;
                        }
                        break;
                    
                    default :
                        file_put_contents(_STATICPATH_.'weixincache/aaa.txt', $event['event']);
                }
                break;
            default :
                file_put_contents(_STATICPATH_.'weixincache/aaa.txt', $type);
        }
    }

    //拍照活动---》拍照页
    public function actionGetphoto() {
        $this->_Getopenid();
        $this->renderPartial('takephoto');
    }

    //拍照活动--》大屏幕

    public function actionPhoto() {
        setYS('url', '/diantong/photo');
        $this->_Checklogin();
        $this->renderPartial('photo');
    }

    //拍照活动---》拍照页
//    public function actionTakephoto() {
//        $this->_Getopenid();
//        $this->renderPartial('takephoto');
//    }
    //摇一摇活动---》首页
    public function actionYaoyiyao() {
        $this->_Getopenid();
        $this->_Checkuser();
        $this->renderPartial('yaoyiyao');
    }

    //摇一摇活动---》大屏幕
    public function actionWinner() {
        setYS('url', '/diantong/winner');
        $this->_Checklogin();
        $this->renderPartial('winner');
    }

    //异步方法---》完善用户信息
    public function actionAjaxadduser() {
        $this->_Getopenid();
        if (empty($_POST['phone'])) {
            returnJson('缺少手机号', '10003');
        }

        //判断用户是否有权摇奖
        $this->_Checkauthor($_POST['phone']);
        //判断摇奖时间
        $this->_Checktime();

        //完善用户信息
        $user = DiantongUser::model()->findByAttributes(array('openid' => $this->openid));
        $user2 = DiantongUser::model()->findByAttributes(array('phone' => $_POST['phone']));
        if ($user2) {
            returnJson('该手机号已经被使用，请更换手机号', '20009');
        }
        if (!$user->phone) {
            $user->phone = $_POST['phone'];
            if (!$user->save()) {
                returnJson('用户保存失败', '10001');
            }
        } else {
            
        }



        returnJson('操作成功', '10000');
    }

    //异步方法---》关闭按钮
    public function actionAjaxsetstate() {
        $state = $_POST['state'];
        $config = DiantongConfig::model()->findByAttributes(array('name' => 'state'));
        $config->content = $state;
        if ($config->save()) {
            returnJson('操作成功', '10000');
        } else {
            returnJson('更新失败', '10001');
        }
    }

    //异步方法----》发送红包
    public function actionAjaxsendpacket() {
        $this->_Getopenid(); //获取openid
        $time = $this->_Checktime(); //检测摇奖开启状态

        $user = DiantongUser::model()->findByAttributes(array('openid' => $this->openid));

        if ($user && $user->phone) {
            $this->_Checkauthor($user->phone); //检测领取资格
            if ($time->content == '1') {
                if ($user->gtime1) {
                    returnJson('您已经领取过红包，请等待第二次摇红包', '20007');
                } else {
                    $price = $this->_Lottery(); //发送一个红包
                    $user->price1 = $price;
                    $user->gtime1 = time();
                    if ($user->save()) {
                        returnJson('恭喜您获得' . $price . '元红包', '10000');
                    } else {
                        returnJson('保存失败', '10001');
                    }
                }
            } elseif ($time->content == '2') {
                if ($user->gtime2) {
                    returnJson('您已经领取过红包，感谢您的参与！', '20008');
                } else {
                    $price = $this->_Lottery(); //发送一个红包
                    $user->price2 = $price;
                    $user->gtime2 = time();
                    if ($user->save()) {
                        returnJson('恭喜您获得' . $price . '元红包', '10000');
                    } else {
                        returnJson('保存失败', '10001');
                    }
                }
            } else {
                returnJson('摇奖时间异常', '10001');
            }
        } else {
            returnJson('请先注册', '20006');
        }
    }

    //异步方法----》保存微信图片到本地服务器
    public function actionAjaxgetmetarial() {
        $this->_Getopenid();
        $media_id = $_POST['serverId'];
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/static/weixincache/test.txt', $media_id);
        $media = $this->weObj->getMedia($media_id); //获取其他
        //$media = $this->weObj->getMedia($media_id,'video');//获取视频
        if (!$media) {
            returnJson($this->weObj->errMsg, '10001');
        }

        $path = $this->_Uploadmedia($_SERVER['DOCUMENT_ROOT'] . '/uploads/tempFile/tempsucai' . time() . '.jpg', $media);
        if (!$path) {
            returnJson('图片下载失败', '10003');
        }
        require_once Yii::app()->basePath . '/extensions/Myclass/Image.class.php';
        $image = new Image(null, $_SERVER['DOCUMENT_ROOT'] . '/uploads/diantong');
        $newpath = $image->thumb($path, 800, 800); //图片默认压缩成 100x100的
        if (file_exists($path)) {
            unlink($path);
        }
        $path = substr($newpath, strlen($_SERVER['DOCUMENT_ROOT'])); //此处减去uploads前边的连接
        //保存图片
        $pic = new DiantongPhoto();
        $pic->openid = $this->openid;
        $pic->pic = $path;
        $pic->ctime = time();
        if (!$pic->save()) {
            returnJson('保存图片失败', '10002');
        }
        returnJson($newpath, '10000');
    }

    //异步方法----》审核图片
    public function actionAjaxcheckphoto() {
        $state = $_POST['state'];
        $pid = $_POST['pid'];
        $photo = DiantongPhoto::model()->findByPk($pid);
        if ($state == '1') {
            $photo->enable = 1;
            if ($photo->save()) {
                returnJson('操作成功', '10000');
            } else {
                returnJson('保存失败', '10001');
            }
        } elseif ($state == '2') {
            $photo->enable = 2;
            if ($photo->save()) {
                returnJson('操作成功', '10000');
            } else {
                returnJson('保存失败', '10001');
            }
        } elseif ($state == '3') {
            if ($photo->delete()) {
                returnJson('操作成功', '10000');
            } else {
                returnJson('保存失败', '10001');
            }
        } else {
            returnJson('缺少有效的状态码', '10003');
        }
    }

    //异步方法-----》开关图片动效
    public function actionAjaxchangephoto() {
        $config = DiantongConfig::model()->findByAttributes(array('name' => 'photo'));
        if ($config->content == '0') {
            $config->content = '1';
            if ($config->save()) {
                returnJson('动效开启成功', '10000');
            } else {
                returnJson('动效开启失败', '10001');
            }
        } else {
            $config->content = '0';
            if ($config->save()) {
                returnJson('动效关闭成功', '10000');
            } else {
                returnJson('动效关闭失败', '10001');
            }
        }
    }

    //异步方法----》开启结束动效
    public function actionAjaxsetend() {
        $config = DiantongConfig::model()->findByAttributes(array('name' => 'end'));
        if ($config->content == '0') {
            $config->content = '1';
            if ($config->save()) {
                returnJson('结束动效开启成功', '10000');
            } else {
                returnJson('结束动效开启失败', '10001');
            }
        } else {
            $config->content = '0';
            if ($config->save()) {
                returnJson('结束动效关闭成功', '10000');
            } else {
                returnJson('结束动效关闭失败', '10001');
            }
        }
    }

    //异步方法=------》重置图片审核状态
    public function actionAjaxresetpic() {
        $sql = 'update vip_diantong_photo set enable=0';
        $result = Yii::app()->db->createCommand($sql)->execute();
        if ($result) {
            returnJson('操作成功', '10000');
        } else {
            returnJson('操作失败', '10001');
        }
    }

    //异步方法 ----》批量通过所有图片
    public function actionAjaxsetallpic() {
        $sql = "update vip_diantong_photo set enable=1 where enable=0";
        $result = Yii::app()->db->createCommand($sql)->execute();
        if ($result) {
            returnJson('操作成功', '10000');
        } else {
            returnJson('操作失败', '10001');
        }
    }

    //异步方法----》大屏幕索取最新图片
    public function actionAjaxgetnewphoto2() {
        $config2 = DiantongConfig::model()->findByAttributes(array('name' => 'end'));
        if ($config2->content == '0') {//结束动效没有开启
            $config = DiantongConfig::model()->findByAttributes(array('name' => 'photo'));
            if ($config->content == '1') {
                $sql = "select * from vip_diantong_photo where enable =1";
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        $photo = DiantongPhoto::model()->findByPk($v['id']);
                        $photo->enable = 3;
                        if (!$photo->save()) {
                            returnJson('更新失败', '10001');
                        }
                    }
                    returnJson($data, '10000');
                } else {
                    returnJson('', '10000');
                }
            } else {
                returnJson('', '10000');
            }
        } else {
            returnJson('结束动效开启', '10000');
        }
    }

    //异步方法----》获取最新获奖人
    public function actionAjaxgetnewwinner2() {
        $this->_Getopenid();
        $time = DiantongConfig::model()->findByAttributes(array('name' => 'state'));
        if ($time->content == '1') {
            $sql = 'select * from vip_diantong_user where price1 > 0 order by price1 desc limit 0,10';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //循环获取微信头像
            foreach ($data as $k => $v) {
                $userinfo = $this->weObj->getUserInfo($v['openid']);
                $data[$k]['headpic'] = $userinfo['headimgurl'];
                $data[$k]['nickname'] = $userinfo['nickname'];
                $data[$k]['phone'] = substr_replace($v['phone'], '****', 3, 4);
            }
            returnJson($data, '10000');
        } elseif ($time->content == '2') {
            $sql = 'select * from vip_diantong_user where price2 > 0 order by price2 desc limit 0,10';
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //循环获取微信头像
            foreach ($data as $k => $v) {
                $userinfo = $this->weObj->getUserInfo($v['openid']);
                $data[$k]['headpic'] = $userinfo['headimgurl'];
                $data[$k]['nickname'] = $userinfo['nickname'];
                $data[$k]['phone'] = substr_replace($v['phone'], '****', 3, 4);
                $data[$k]['price1'] = $data[$k]['price2'];
            }
            returnJson($data, '10000');
        } else {
            returnJson('', '10000');
        }
    }

    //异步登陆页
    public function actionAjaxlogin() {
        $psw = $_POST['psw'];
        if ($psw != '123456') {  //必要时修改密码
            returnJson('密码不正确', '10001');
        } else {
            setYS('login001', '1');  //必要时修改 缓存值
            returnJson(getYS('url'), '10000');
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
        //精确查找-审核状态
        if (!empty($data['enable']) || $data['enable'] == '0') {
            $where.=' and enable ="' . $data['enable'] . '"';
        }


        $where = substr($where, 4);
        $page = $_POST['p']; //第几页
        $pernum = Yii::app()->request->getParam('pernum', '5');
        ; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_diantong_photo where {$where} order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_diantong_photo where {$where}";
        } else {
            $sql = "select * from vip_diantong_photo order by ctime desc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_diantong_photo";
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
        $config = DiantongConfig::model()->findByAttributes(array('name' => 'photo'));
        $config2 = DiantongConfig::model()->findByAttributes(array('name' => 'end'));

        //实现分页
        include_once 'page.php';
        $this->renderPartial('admin', array(
            'page' => $show,
            'list' => $result['content'],
            'state' => $config->content,
            'end' => $config2->content,
            'search' => $search,
        ));
    }

    //异步方法--后台导出数据
    public function actionAjaxpushdata() {
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        //从数据库获取 数据，转化为二维数组备用
        $sql = "select * from vip_diantong_user";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '红包一金额');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '红包二金额');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '红包一时间');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '红包二时间');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '创建时间');
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

    //私有方法，检查用户是否关注过公众号
    //获取已关注用户信息，如果未关注调用此方法，仅返回openid和describe信息
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

    private function _Creattoken() {
        $token = $this->weObj->checkAuth();
        $arr['time'] = time();
        $arr['token'] = $token;
        file_put_contents(_STATICPATH_ . '/weixincache/access_token.txt', json_encode($arr));
        return $token;
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

    //私有方法，抽取红包金额，并发送红包给用户
    private function _Lottery() {
        $time = DiantongConfig::model()->findByAttributes(array('name' => 'state'));
        if ($time->content == '1') {

            $sql = "select * from vip_diantong_hongbao where one=0 limit 0,1";
            $hongbao = DiantongHongbao::model()->findBySql($sql);
            $price = $hongbao->num;
            $hongbao->one = 1;
            if (!$hongbao->save()) {
                returnJson('第一次红包保存错误', '10001');
            }
        } elseif ($time->content == '2') {
            $sql = "select * from vip_diantong_hongbao where two=0 limit 0,1";
            $hongbao = DiantongHongbao::model()->findBySql($sql);
            $price = $hongbao->num;
            $hongbao->two = 1;
            if (!$hongbao->save()) {
                returnJson('第二次红包保存错误', '10001');
            }
        } else {
            returnJson('亲，还没有到摇红包的时间哦！', '20005');
        }
        $packet = new packet(Yii::app()->params['diantong']['wxappid'], Yii::app()->params['diantong']['wxmchid'], Yii::app()->params['diantong']['wxkey'], 'diantong');
        $order_id = Yii::app()->params['diantong']['wxmchid'] . date('Ymd', time()) . substr(getTimestamps(3, 1), -10);
        $price1 = $price * 100;
        $openid = $this->openid;
        $data = $packet->set_parm($order_id, $openid, $price1);
        $result = $packet->send_packet($data);
        if ($result['return_code'] != 'SUCCESS') {
            returnJson($result['return_msg'], '20001');
        } else {
            if ($result['result_code'] != 'SUCCESS') {
                returnJson($result['err_code_des'], '20002');
            } else {
                return $price;
                //echo '<pre>';
                //print_r($result);
            }
        }
    }

    //私有方法，检测用户是否已经注册
    private function _Checkuser() {
        $user = DiantongUser::model()->findByAttributes(array('openid' => $this->openid));
        if ($user && $user->phone) {
            
        } else {
            if (!$user) {
                $user = new DiantongUser();
                $user->openid = $this->openid;
                $user->ctime = time();
                if ($user->save()) {
                    //注册成功
                } else {
                    returnJs('注册失败!');
                }
            }
            $this->renderPartial('login');
            die;
        }
    }

    //私有方法，检测摇奖时间是否开启
    private function _Checktime() {
        $time = DiantongConfig::model()->findByAttributes(array('name' => 'state'));
        if ($time->content == '0') {
            returnJson('亲，还没有到摇红包的时间哦！', '20005');
        } else {
            return $time;
        }
    }

    //私有方法，检测用户是否有资格摇奖
    private function _Checkauthor($phone) {
        $user = DiantongPhone::model()->findByAttributes(array('phone' => $phone));
        if (!$user) {
            returnJson('抱歉，邀请名单中未查询到您的手机号！', '20004');
        } else {
            return $user;
        }
    }

    //私有方法，检测是否登录
    private function _Checklogin() {
        if (getYS('login001') != '1') {
            $this->renderPartial('denglu');
            die;
        }
    }

    public function actionDemo() {
        $arr = array();
        $totalnum = 0;
        $total1000a = 0;
        for ($i = 0; $i < 17; $i++) {
            for ($j = 1; $j < 51; $j++) {
                $arr[] = $j + rand(0, 100) * 0.01;
            }
        }
        for ($j = 0; $j < 6; $j++) {
            for ($i = 51; $i < 101; $i++) {
                $arr[] = $i + rand(0, 100) * 0.01;
            }
        }
        for ($i = 0; $i < 3; $i++) {
            for ($j = 101; $j < 189; $j++) {
                $arr[] = $j + rand(0, 100) * 0.01;
            }
        }
        shuffle($arr);
        foreach ($arr as $k => $v) {
            $totalnum+=$v;
            if ($k < 1000) {
                $total1000a+=$v;
            }
            //$hongbao = new DiantongHongbao();
            //$hongbao->num =$v;
            //$hongbao->save();
        }
        var_dump($arr);
        var_dump($totalnum);
        var_dump($total1000a);
        die;
    }

    //创建微信菜单
    public function actionCreatemenu() {
        $data = array(
            'button' => array(
                0 => array(
                    "type" => "view",
                    "name" => "摇红包",
                    "url" => "http://vip2.hui.net/diantong/yaoyiyao"
                ),
                1 => array(
                    "type" => "view",
                    "name" => "上传照片",
                    "url" => "http://vip2.hui.net/diantong/getphoto"
                ),
                2 => array(
                    "type" => "click",
                    "name" => "使用说明",
                    "key" => "KEY001"
                ),
            ),
        );
        var_dump($this->weObj->createMenu($data));
    }

}
