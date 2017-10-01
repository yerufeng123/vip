<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class AdminController extends BaseController {

    public $style; //管理员对象

//渠道列表显示

    public function actionIndex() {
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;

        /*
         * 获取渠道列表
         */


        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        $sql = "select * from vip_bairong_style  limit {$startnum},{$pernum}";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $sql2 = "select count(id) as num from vip_bairong_style";

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
            'list' => $result['content'],
        ));
    }

    //渠道添加
    public function actionStyle_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('style_add');
        } else {//异步
            if (empty($_POST['name'])) {
                echo '必填字段填写不完整!';
                die;
            }
            $style = new BairongStyle();
            $style->name = $_POST['name'];
            if ($style->save() > 0) {
                //注册成功
            } else {
                echo '注册失败';
                die;
            }
        }
    }

    //修改一个渠道信息
    public function actionStyle_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql = "select * from vip_bairong_style where id='{$_POST['id']}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('style_editor', array(
                'list' => $data[0],
            ));
        } else {
            if (empty($_POST['name'])) {
                echo '必填字段填写不完整!';
                die;
            }
            $style = BairongStyle::model()->findByPk($_POST['id']);
            $style->name = $_POST['name'];
            if ($style->save() > 0) {
                //更新成功
            } else {
                echo '更新失败';
                die;
            }
        }
    }

    //删除一个渠道信息
    public function actionStyle_delete() {
        $_POST['id'] = $_GET['id'];
        $style = BairongStyle::model();
        $stylenum = $style->deleteByPk($_POST['id']);
        if ($stylenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //玩家统计页面
    public function actionTongji() {
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;

        $where = '';
        /*
         * 获取玩家列表
         */
        /* 查询条件拼写 */
        //手机号
        if (!empty($data['phone'])) {
            $where.=' and phone like"%' . $data['phone'] . '%"';
        }
        //领奖状态
        if (!empty($data['state']) || ($data['state'] === '0')) {
            $where.=' and state =' . $data['state'];
        }
        //渠道
        if (!empty($data['sid'])) {
            $where.=' and sid =' . $data['sid'];
        }

        $where = substr($where, 4);
        //echo $where;die;
        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select id,phone,state,sid,ctime from vip_bairong_user where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        } else {
            $sql = "select * from vip_bairong_user order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理渠道
        foreach ($data as $key => $value) {
            $style = new BairongStyle();
            $name = $style->getStyleName($value['sid']);
            $data[$key]['name'] = $name['name'];
        }





        if (!empty($where)) {
            $sql2 = "select count(id) as num from vip_bairong_user  where {$where}";
        } else {
            $sql2 = "select count(id) as num from vip_bairong_user";
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
        $this->renderPartial('tongji', array(
            'page' => $show,
            'search' => $search,
            'list' => $result['content'],
        ));
    }

    //删除某条统计信息
    public function actionTongji_delete() {
        $_POST['id'] = $_GET['id'];
        $game = BairongUser::model();
        $gamenum = $game->deleteByPk($_POST['id']);
        if ($gamenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //异步获取所有 渠道列表
    public function actionAjaxgetstyle() {
        $sql = 'select id,name from vip_bairong_style';
        $style = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($style)) {
            $style = array();
        }
        echo json_encode($style);
    }

    //验证手机
    public function actionPhonecheck() {
        $this->renderPartial('phonecheck');
    }

    //发送短信
    public function actionSendmessage() {
        if (empty($_POST['phone']) || empty($_POST['sid'])) {
            echo '缺少必填项';
            die;
        }
        require_once Yii::app()->basePath . '/components/EventHelper.php';
        $phone = $_POST['phone'];
        $sid = $_POST['sid'];
        $content = $_POST['content'];

        //判断用户是否存在并未领奖
        $sql = "select * from vip_bairong_user where phone='{$phone}'";
        $gamer = Yii::app()->db->createCommand($sql)->queryRow();
        if ($gamer) {//存在就检查用户是否已经领奖（未领奖可能来至微信渠道）
            if ($gamer['state'] == '1') {
                echo '您已领奖，不能重复领取';
                die;
            }
            if ($gamer['gid']) {//游戏渠道
                $sql2 = "select name from vip_bairong_gift where id={$gamer['gid']}";
                $gift = Yii::app()->db->createCommand($sql2)->queryRow();
                echo '您已中奖，快去领取礼品：' . $gift['name'];
                //$sendText = $content ? $content : '身份符合，请领取奖品' . $gift['name'];
                $sendText = $content ? $content : '恭喜您成功领取天堂牌“晴雨伞”一把！';
            } else {//其他渠道
                echo '您已验证，请凭短信领取奖品';
                $sql3 = "select name from vip_bairong_style where id={$gamer['sid']}";
                $style = Yii::app()->db->createCommand($sql3)->queryRow();
                $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle($style['name']) . ')';
            }
            $username = Yii::app()->params['mesusername'];
            $password = Yii::app()->params['mespassword'];
            $toDetail = $phone;
            $this->_send($username, $password, $sendText, $toDetail);

            die;
        } else {//不存在就添加用户（非微信渠道）
            //数据库添加一条数据
            $gamer1 = new BairongUser();
            $gamer1->phone = $phone;
            $gamer1->sid = $sid;
            $gamer1->ctime = time();
            if ($gamer1->save()) {
                echo '请领取奖品';
                $sql3 = "select name from vip_bairong_style where id={$sid}";
                $style = Yii::app()->db->createCommand($sql3)->queryRow();
                $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle($style['name']) . ')';
                $username = Yii::app()->params['mesusername'];
                $password = Yii::app()->params['mespassword'];
                $toDetail = $phone;
                $this->_send($username, $password, $sendText, $toDetail);
            } else {
                echo '用户注册失败！';
                die;
            }
        }
    }

    //修改领奖状态
    public function actionSetstate() {
        $gid = $_POST['gid'];
        $gamer = BairongUser::model()->findByPk($gid);
        $gamer->state = 1;
        $gamer->gtime = time();
        if ($gamer->save()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //批量短信发送首页
    public function actionBatchmessage() {
        if (empty($_POST['send'])) {
            $page = Yii::app()->request->getParam('p', '1'); //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            $sql = "select * from vip_bairong_message limit {$startnum},{$pernum}";

            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //处理渠道
            foreach ($data as $key => $value) {
                $style = new BairongStyle();
                $name = $style->getStyleName($value['sid']);
                $data[$key]['name'] = $name['name'];
            }



            $sql2 = "select count(id) as num from vip_bairong_message";

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
            $this->renderPartial('batchmessage', array(
                'page' => $show,
                'list' => $result['content'],
            ));
        } else {
            //数据库读取数据
            $sql = 'select * from vip_bairong_message';
            $message = Yii::app()->db->createCommand($sql)->queryAll();
            require_once Yii::app()->basePath . '/components/EventHelper.php';
            foreach ($message as $key => $value) {

                $phone = $value['phone'];
                $sid = $value['sid'];
                $content = $value['content'];

                //判断用户是否存在并未领奖
                $sql = "select * from vip_bairong_user where phone='{$phone}'";
                $gamer = Yii::app()->db->createCommand($sql)->queryRow();
                if ($gamer) {//存在就检查用户是否已经领奖（未领奖可能来至微信渠道）
                    if ($gamer['gid']) {//游戏渠道
                        $sql2 = "select name from vip_bairong_gift where id={$gamer['gid']}";
                        $gift = Yii::app()->db->createCommand($sql2)->queryRow();
                        $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle('游戏') . ')';
                        //$sendText = $content ? $content : '身份符合，请领取奖品' . $gift['name'];
                    } else {//其他渠道
                        $sql3 = "select name from vip_bairong_style where id={$sid}";
                        $style = Yii::app()->db->createCommand($sql3)->queryRow();
                        $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle($style['name']) . ')';
                        //$sendText = $content ? $content : '身份确认可以领取奖品';
                    }
                    $username = Yii::app()->params['mesusername'];
                    $password = Yii::app()->params['mespassword'];
                    $toDetail = $phone;
                    $this->_send($username, $password, $sendText, $toDetail);

                    die;
                } else {//不存在就添加用户（非微信渠道）
                    //数据库添加一条数据
                    $gamer1 = new BairongUser();
                    $gamer1->openid = '9999999999999999999999999999'; //非微信渠道，openid一律为这个
                    $gamer1->wxname = '玩家';
                    $gamer1->phone = $phone;
                    $gamer1->sid = $sid;
                    $gamer1->ctime = time();
                    if ($gamer1->save()) {
                        $sql3 = "select name from vip_bairong_style where id={$sid}";
                        $style = Yii::app()->db->createCommand($sql3)->queryRow();
                        $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle($style['name']) . ')';
                        //$sendText = $content ? $content : '身份确认可以领取奖品';
                        $username = Yii::app()->params['mesusername'];
                        $password = Yii::app()->params['mespassword'];
                        $toDetail = $phone;
                        $this->_send($username, $password, $sendText, $toDetail);
                    } else {
                        
                    }
                }
            }
            //清空临时表 vip_bairong_message
            $sql = 'truncate table vip_bairong_message';
            Yii::app()->db->createCommand($sql)->execute();
            return true;
        }
    }

    //读取导入的excel，并将信息插入数据库
    public function actionReadexecl() {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['path'];
        if (file_exists($path)) {
            require_once Yii::app()->basePath . '/extensions/PHPExcel/PHPExcel/IOFactory.php';
            //导入excel文件
            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $data = $objPHPExcel->getActiveSheet()->toArray(); //0键值中存放的是 属性名
            //判断是否是需要的excel格式
            if (count($data[0]) != 4) {
                die('请传入正确的excel');
            }

            //插入数据库
            $log = ''; //失败日志
            foreach ($data as $key => $value) {
                if ($key != 0) {
                    //判断是否已存在该手机号
                    $sql = "select * from vip_bairong_user where phone='{$value[1]}'";
                    $gamer = Yii::app()->db->createCommand($sql)->queryRow();
                    $sql1 = "select * from vip_bairong_message where phone='{$value[1]}'";
                    $gamer1 = Yii::app()->db->createCommand($sql1)->queryRow();
                    if (!$gamer && !$gamer1) {
                        $message = new BairongMessage();
                        $message->phone = $value[1];
                        $message->sid = $value[2];
                        $message->content = $value[3];
                        if (!$message->save()) {
                            $log.="第" . $key . "条数据插入失败\n";
                        }
                    } else {
                        $log.="第" . $key . "条数据手机号已存在\n";
                    }
                }
            }
            if (!empty($log)) {
                echo $log;
            }
            return true;
            die;
        } else {
            die('EXCEL文件不存在！');
        }
    }

    //删除某条批量发送流中的短信
    public function actionMessage_delete() {
        $_POST['id'] = $_GET['id'];
        $message = BairongMessage::model();
        $messagenum = $message->deleteByPk($_POST['id']);
        if ($messagenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //易信通短信发送 私有方法
    private function _send($username, $password, $sendText, $toDetail) {
        require_once Yii::app()->basePath . '/components/EventHelper.php';
        $json = '{"jsonrpc":"2.0","method":"genLoginToken","id":1,"params":["' . $username . '","' . $password . '"]}';
        $url = "http://yxt.bbn.com.cn/eums/rpc/power/authService";
        $mes = $this->_HttpXmlPostRequest($url, $json);
        $mesarr = json_decode($mes, true);
        if (!$mesarr['result']['result']) {
            die($mesarr['result']['msg']);
        }
        $key = strtolower($mes);
        $key = substr($key, strpos($key, "access"));
        $key = substr($key, 0, strpos($key, '"'));
        $sms = '{"jsonrpc":"2.0","method":"save","id":2,"params":[{"sendText":"' . $sendText . '","sendTime":"","sendTo":"","toDetail":"' . $toDetail . '" ,"businessType":"' . $keyg . '" ,"status":"2","sendFrom":"api","callBack":""}],"auth":{"loginToken":"' . $key . '"}}';
        $post = "http://yxt.bbn.com.cn/eums/rpc/smsSave";
        $smsstatus = $this->_HttpXmlPostRequest($post, $sms);
        $smsstatusarr = json_decode($smsstatus, true);
        if (isset($smsstatusarr['error'])) {
            die($smsstatusarr['error']['message']);
        }
        return true;
    }

    //易信通 私有方法
    private function _HttpXmlPostRequest($url, $post_string) {
        $context = array('http' => array('method' => "POST", 'header' => "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */* \r\n Content-type:application/json;charset=utf-8", 'content' => $post_string));
        $stream_context = stream_context_create($context);
        $data = file_get_contents($url, FALSE, $stream_context);
        return $data;
    }

    //渠道名称转换 私有方法
    private function _changeStyle($name) {
        $name = strtoupper($name);
        switch ($name) {
            case 'APP':
                return 'app';
                break;
            case '报纸':
                return 'news';
                break;
            case 'DM':
                return 'dm';
                break;
            case '游戏':
                return 'game';
                break;
            case '线上预购':
                return 'o2o';
                break;
            default :
                return $name;
                break;
        }
    }

}
