<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class HuangfeihongController extends Controller {

    const GAME_MAXDAY_TIME = 3; //每天最大可玩次数
    const GAME_MAXSHARE_TIME = 6; //每天最大有效的朋友单击链接次数
    const GAME_PRETIME_NUM = 1; //多少人点击分享链接才增加次数
    const GAME_PREADD_TIME = 1; //每次增加多少次游戏机会
    const GAME_FIRST_LEVEL = 1000; //一等奖门槛
    const GAME_SECOND_LEVEL = 500; //二等奖门槛

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //游戏首页

    public function actionIndex() {
        $this->_Getopenid();
        //检查是否是注册用户
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!$user) {
            //用户不存在就注册新用户
            $user = new HuangfeihongUser();
            $user->openid = $this->openid;
            $user->utime = time();
            $user->ctime = time();
            if (!$user->save()) {
                returnJson('注册用户失败,请重试！', '10001');
            }
        } else {//判断用户是否可玩
            //判断是否需要清零
            if (date('Y-m-d', $user->utime) != date('Y-m-d', time())) {
                $user->gamenum = 0;
                $user->friendnum = 0;
                if (!$user->save()) {
                    returnJson('当天游戏次数重置失败！', '10001');
                }
            }
            $numshare = intval($user->friendnum / self::GAME_PRETIME_NUM) * self::GAME_PREADD_TIME; //当天朋友点击链接可加游戏次数值
            $enableshare = (self::GAME_MAXSHARE_TIME < $numshare) ? self::GAME_MAXSHARE_TIME : $numshare; //当天朋友点击链接 有效添加游戏次数
            $gametime = self::GAME_MAXDAY_TIME + $enableshare; //当天可玩游戏次数
            $maxtime = self::GAME_MAXDAY_TIME + self::GAME_MAXSHARE_TIME; //当天可玩游戏理论最大次数

            if ($user->gamenum >= $maxtime) {
                $flag = 'none'; //次数已用完
            } elseif ($user->gamenum >= $gametime) {
                $flag = 'share'; //分享后，可继续玩
            } else {
                $flag = 'ok'; //可以继续玩
            }
        }
        $this->renderPartial('index', array(
            'flag' => $flag,
            'openid' => $this->openid,
        ));
    }

    //游戏页
    public function actionGame() {
        $this->_Getopenid();
        $this->renderPartial('game', array(
            'openid' => $this->openid,
        )); //17600859935
    }

    //抽奖页
    public function actionLottery() {
        $this->_Getopenid();
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        //判断用户抽奖用户是否存在
        if (!$user) {
            returnJson('用户不存在', '10001');
        }

        //判断是否有抽奖权限
        if ($user->giftlevel == '0') {
            returnJson('没有抽奖权限！', '10001');
        }






        //领过奖品并填写信息完成的一律按谢谢惠顾处理
        if ($user->gid && $user->phone) {
            $giftlevel = '谢谢惠顾';
            $describe = "人品好，手气不佳，明天再来吧。";
            $flag = 0;

//             elseif ($user->gid) {//用户已抽过奖，不过没有填写领奖信息
//            $gift = HuangfeihongGift::model()->findByPk($user->gid);
//            if (!$gift) {
//                $giftlevel = '谢谢惠顾';
//                $describe = "人品好，手气不佳，明天再来吧。";
//                $flag = 0;
//            } else {
//                $describe = $gift->describe;
//                switch ($gift->level) {
//                    case '1':
//                        $giftlevel = '一等奖！！！';
//                        $flag = 1;
//                        break;
//                    case '2':
//                        $giftlevel = '二等奖！！！';
//                        $flag = 1;
//                        break;
//                    default :
//                        $giftlevel = '谢谢惠顾';
//                        $describe = "人品好，手气不佳，明天再来吧。";
//                        $flag = 0;
//                }
//            }
//        }
        } else {
            //如果用户中过奖，却没填写信息，就先把该奖的库存加回来
            if ($user->gid && empty($user->phone)) {
                $gift = HuangfeihongGift::model()->findByPk($user->gid);
                $gift->num +=1;
                $gift->save();
            }

            $sql = "select * from vip_huangfeihong_gift where level >= {$user->giftlevel}";
            $gifts = Yii::app()->db->createCommand($sql)->queryAll();
            $data = array(); //拼接抽奖数据
            foreach ($gifts as $key => $value) {
                if ($value['num'] > 0) {
                    $data[$key]['num'] = $value['id'];
                    $data[$key]['prob'] = $value['chance'];
                }
            }
            if (empty($data)) {
                returnJs('奖品已发完！');
            }
            $giftid = $this->_Lottery($data); //抽取一个奖品
            $gift = HuangfeihongGift::model()->findByPk($giftid);
            if (!$gift) {
                $giftlevel = '谢谢惠顾';
                $describe = "人品好，手气不佳，明天再来吧。";
                $flag = 0;
            } else {
                $describe = $gift->describe;
                switch ($gift->level) {
                    case '1':
                        $giftlevel = '一等奖！！！';
                        $flag = 1;
                        break;
                    case '2':
                        $giftlevel = '二等奖！！！';
                        $flag = 1;
                        break;
                    default :
                        $giftlevel = '谢谢惠顾';
                        $describe = "人品好，手气不佳，明天再来吧。";
                        $flag = 0;
                }
                //减库存
                $gift->num -= 1;
                if (!$gift->save()) {
                    returnJson('奖品减库存失败！', '10001');
                }
                //给用户关联奖品
                $user->gid = $giftid;
                $user->gtime = time();
                if (!$user->save()) {
                    returnJson('关联奖品失败！', '10001');
                }
            }
        }

        $this->renderPartial('lottery', array(
            'giftlevel' => $giftlevel, //中奖等级
            'describe' => $describe, //中奖信息描述
            'flag' => $flag, //是否允许填写信息
            'openid' => $this->openid,
        ));
    }

    //注册页
    public function actionRegister() {
        $this->_Getopenid();
        $this->renderPartial('register', array(
            'openid' => $this->openid,
        ));
    }

    //分享引导页
    public function actionShare() {
        $this->_Getopenid();
        $openid = Yii::app()->request->getParam('oid', '');
        if ($openid) {
            $friend = HuangfeihongFriend::model()->findByAttributes(array('openid' => $this->openid, 'fopenid' => $openid)); //分享者的当前朋友
            $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $openid)); //分享者
            if (!$friend && $user) {
                //注册新朋友
                $friend = new HuangfeihongFriend();
                $friend->openid = $this->openid;
                $friend->fopenid = $openid;
                $friend->ctime = time();
                if (!$friend->save()) {
                    returnJson('注册新朋友失败！', '100001');
                }
                //分享者朋友点击次数加1
                $user->friendnum +=1;
                if (!$user->save()) {
                    returnJson('分享者加次数失败！', '100001');
                }
            }
        }
        $this->renderPartial('share', array(
            'openid' => $this->openid,
        ));
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
            $where.=' and a.name like "%' . $data['name'] . '%"';
        }
        //模糊查找-电话
        if (!empty($data['phone'])) {
            $where.=' and a.phone like "%' . $data['phone'] . '%"';
        }
        //模糊查找-城市
        if (!empty($data['city'])) {
            $where.=' and a.city like "%' . $data['city'] . '%"';
        }

        //模糊查找-奖项
        if (!empty($data['level'])) {
            $where.=' and b.level like "%' . $data['level'] . '%"';
        }

        $where = substr($where, 4);
        $page = $_POST['p']; //第几页
        $pernum = Yii::app()->request->getParam('pernum', '10');
        ; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select a.name,a.openid,a.phone,a.city,a.address,a.gamenum,a.friendnum,a.sharenum,a.gid,a.gtime,a.ctime,b.level from vip_huangfeihong_user as a  left join vip_huangfeihong_gift as b on a.gid=b.id where {$where} order by gtime asc limit {$startnum},{$pernum}";
            $sql2 = "select count(a.id) as num from vip_huangfeihong_user as a  left join vip_huangfeihong_gift as b on a.gid=b.id where {$where}";
        } else {
            $sql = "select a.name,a.openid,a.phone,a.city,a.address,a.gamenum,a.friendnum,a.sharenum,a.gid,a.gtime,a.ctime,b.level from vip_huangfeihong_user as a  left join vip_huangfeihong_gift as b on a.gid=b.id order by gtime asc limit {$startnum},{$pernum}";
            $sql2 = "select count(id) as num from vip_huangfeihong_user";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理数据
        foreach ($data as $key => $value) {
            $gift = HuangfeihongGift::model()->findByPk($value['gid']);
            if ($gift) {
                switch ($gift->level) {
                    case '1':
                        $data[$key]['gid'] = '一等奖';
                        break;
                    case '2':
                        $data[$key]['gid'] = '二等奖';
                        break;
                    default :
                        $data[$key]['gid'] = '未中奖';
                }
            } else {
                $data[$key]['gid'] = '未中奖';
            }
        }

        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }
        //获取奖项配置
        $giftfirst = HuangfeihongGift::model()->findByAttributes(array('level' => '1'));
        $giftsecond = HuangfeihongGift::model()->findByAttributes(array('level' => '2'));

        //获取游戏总人数
        $sql3 = "select count(id) as num from vip_huangfeihong_user";
        $totalnum = Yii::app()->db->createCommand($sql3)->queryRow();
        //实现分页
        include_once 'page.php';
        $this->renderPartial('admin', array(
            'page' => $show,
            'list' => $result['content'],
            'search' => $search,
            'giftfirst' => $giftfirst,
            'giftsecond' => $giftsecond,
            'totalnum' => $totalnum['num'], //游戏总人数
        ));
    }

    //异步方法--后台导出数据
    public function actionAjaxpushdata() {
        require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel.php';
        //从数据库获取 数据，转化为二维数组备用
        $sql = "select * from vip_huangfeihong_user";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '微信标识');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '手机');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '城市');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '地址');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '最后游戏次数');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '最后朋友点击量');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '历史分享量');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', '可刮奖级别');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', '最后游戏时间戳');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', '注册时间戳');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', '领奖时间戳');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', '关联礼品序号');
        $objPHPExcel->getActiveSheet()->fromArray($data, $nullValue, 'A2'); //如果出现乱码的时候，用上边的试试
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="huangfeihong' . date('Y_m_d_H_i_s', time()) . '.xlsx"');
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

    //异步提交数据，完善用户信息
    public function actionAjaxadduser() {
        $this->_Getopenid();
        $city = $_POST['city'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        if (!user) {
            returnJson('玩家不存在，无法领奖！', '10001');
        }
        $user->city = $city;
        $user->name = $name;
        $user->phone = $phone;
        $user->address = $_POST['address'];
        if (!$user->save()) {
            returnJson('领奖失败', '10001');
        } else {
            returnJson('领奖成功', '10000');
        }
    }

    //异步提交数据，设置游戏次数
    public function actionAjaxaddnum() {
        $this->_Getopenid();
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        //判断是否需要清零
        if (date('Y-m-d', $user->utime) != date('Y-m-d', time())) {
            $user->gamenum = 0;
            $user->friendnum = 0;
            if (!$user->save()) {
                returnJson('当天游戏次数重置失败！', '10001');
            }
        }
        $numshare = intval($user->friendnum / self::GAME_PRETIME_NUM) * self::GAME_PREADD_TIME; //当天朋友点击链接可加游戏次数值
        $enableshare = (self::GAME_MAXSHARE_TIME < $numshare) ? self::GAME_MAXSHARE_TIME : $numshare; //当天朋友点击链接 有效添加游戏次数
        $gametime = self::GAME_MAXDAY_TIME + $enableshare; //当天可玩游戏次数
        $maxtime = self::GAME_MAXDAY_TIME + self::GAME_MAXSHARE_TIME; //当天可玩游戏理论最大次数

        if ($user->gamenum >= $maxtime) {
            returnJson('您的ID今天还可玩游戏0次', '20001'); //游戏次数已用完
        } elseif ($user->gamenum >= $gametime) {
            returnJson('您的ID今天还可玩游戏0次', '20002'); //未分享，分享后可以继续玩
        } else {
            $user->gamenum+=1;
            $user->utime = time();
            if ($user->save()) {
                returnJson('增加游戏次数成功', '10000');
            } else {
                returnJson('增加游戏次数失败', '10001');
            }
        }
    }

    //异步提交数据，设置中奖级别
    public function actionAjaxsetcoupon() {
        $this->_Getopenid();
        $score = $_POST['score'];
        if ($score == '') {
            returnJson('缺少积分', '10003');
        }
        if ($score < self::GAME_SECOND_LEVEL) {
            returnJson('积分过低，不能抽奖', '10001');
        }
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        $oldlevel = $user->giftlevel;
        if ($score >= self::GAME_FIRST_LEVEL) {
            $user->giftlevel = 1;
        } elseif ($score >= self::GAME_SECOND_LEVEL) {
            $user->giftlevel = 2;
        } else {
            $user->giftlevel = 0;
        }

        if ($oldlevel == 0 || ($user->giftlevel < $oldlevel && $user->giftlevel != 0)) {
            if (!$user->save()) {
                echo returnJson('抽奖等级更新失败', '10001');
            }
        }
        echo returnJson('成功', '10000');
    }

    //异步提交数据，设置分享次数
    public function actionAjaxsetsharetime() {
        $this->_Getopenid();
        $user = HuangfeihongUser::model()->findByAttributes(array('openid' => $this->openid));
        $user->sharenum +=1;
        if ($user->save()) {
            echo returnJson('更新分享次数成功', '10000');
        } else {
            echo returnJson('更新分享次数失败', '10001');
        }
    }

    //异步提交程序，更改奖品信息
    public function actionAjaxupdategift() {
        if ($_POST['pwd'] != 'admin') {
            returnJson('密码错误，请重新输入', '10001');
        }
        $giftfirst = HuangfeihongGift::model()->findByAttributes(array('level' => '1'));
        $giftfirst->name = $_POST['firstname'];
        $giftfirst->num = $_POST['firstnum'];
        $giftfirst->chance = $_POST['firstchance'];
        $giftfirst->describe = $_POST['firstdescribe'];
        if (!$giftfirst->save()) {
            returnJson('保存配置1失败！', '10001');
        }
        $giftsecond = HuangfeihongGift::model()->findByAttributes(array('level' => '2'));
        $giftsecond->name = $_POST['secondname'];
        $giftsecond->num = $_POST['secondnum'];
        $giftsecond->chance = $_POST['secondchance'];
        $giftsecond->describe = $_POST['seconddescribe'];
        if (!$giftsecond->save()) {
            returnJson('保存配置2失败！', '10001');
        }
        returnJson('保存配置成功!', '10000');
    }

    //私有方法，封装获取openid过程
    private function _Getopenid() {
        $options = array(
            'token' => Yii::app()->params['enicar']['wxtoken'], //填写你设定的key
            'encodingaeskey' => Yii::app()->params['enicar']['wxencodingaeskey'], //填写加密用的EncodingAESKey
            'appid' => Yii::app()->params['enicar']['wxappid'], //填写高级调用功能的app id
            'appsecret' => Yii::app()->params['enicar']['wxappsecret'], //填写高级调用功能的密钥
        );
        $this->weObj = new Wechatg($options);
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

    /*
     * 私有方法，抽奖算法
     * @param array $arr 概率数组 
     * @param inter $definition@ 概率经度 0表示百分之一，1表示千分之一 2万分之一 ，以此类推 经度越大执行越慢
     * return string 中奖身份识别标识（可为 奖品名或者奖品id）  
     */

    private function _Lottery($arr, $definition = 2) {
//        $arr = array(
//            array(//一等奖
//                'num' => '1',
//                'prob' => '20',
//            ),
//            array(//二等奖
//                'num' => '2',
//                'prob' => '30',
//            ),
//        );
        $newarr = array();
        $num = $totalnum = pow(10, 2 + $definition);
        foreach ($arr as $k => $v) {
            $tempnum = intval($arr[$k]['prob']); //填充数量
            if ($totalnum >= $tempnum) {
                $temparr = array_fill(0, $tempnum, $arr[$k]['num']);
                $totalnum -= $tempnum;
                $newarr = array_merge($newarr, $temparr);
            } else {
                returnJson('抽奖填充失败', '10001');
            }
        }
        $newarr = array_merge($newarr, array_fill(0, $totalnum, '0'));
        $d = mt_rand(0, $num);
        return $newarr[$d];
    }

    /* 测试接口 */

    public function actionAjaxtestdemo() {
        if (empty($_POST['name']) && empty($_POST['phone']) && empty($_POST['type'])) {
            returnJson('缺少必填项', '20001');
        }
        if (!checkPhone($phone)) {
            returnJson('手机格式不正确', '20002');
        }
        $filename = _STATICPATH_ . 'weixincache/huxitest.php';
        $data = json_decode(file_get_contents($filename));
        if ($_POST['type'] == '1') {
            $user = array();
            $user['name'] = $_POST['name'];
            $user['phone'] = $_POST['phone'];
            $data[] = $user;
            file_put_contents($filename, json_encode($data));
            returnJson('保存成功', '10000');
        }else{
            returnJson($data, '10000');
        }
    }

}
