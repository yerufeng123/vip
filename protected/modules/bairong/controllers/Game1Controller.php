<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class Game1Controller extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象
    public $callback = "http://bairong.hui.net"; //页面回调地址

    //游戏页

    public function actionGame1() {
        $this->renderPartial('game1');
    }

    //游戏1分享页
    public function actionIndex() {
        $this->renderPartial('index');
    }
    
    //APP报名页
    public function actionGame1phone(){
        $this->renderPartial('phone');
    }

    //全部异步方法集合
    public function actionAjaxgetpost() {
        $key = $_POST['key'];
        switch ($key) {
            case 'setgame1score':
                $phone = $_POST['phone'];
                if (!empty($phone)) {
                    //判断该手机号是否已经注册过
                    $sql2 = "select * from vip_bairong_user where phone='{$phone}'";
                    $user = Yii::app()->db->createCommand($sql2)->queryRow();
                    if ($user) {//如果注册过,就通知用户
                        if ($user['state'] == 1) {
                            echo '该手机号已领过奖品，请重新填写！';
                            die;
                        } else {
                            echo '您的手机已被验证，请直接前往领奖点领取奖品！';
                            die;
                        }
                    } else {//如果该手机号没有注册过，就绑定该手机号到目前openid上
                        $gamer = new BairongUser();
                        $gamer->ctime = time();
                        //获取渠道id
//                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
//                        if (strpos($user_agent, 'MicroMessenger') === false) {
//                            $sql3 = "select id from vip_bairong_style where name='APP'";
//                        } else {
//                            $sql3 = "select id from vip_bairong_style where name='微信'";
//                            
//                        }
                        $sql3 = "select id from vip_bairong_style where name='游戏'";
                        $id = Yii::app()->db->createCommand($sql3)->queryRow();
                        $gamer->sid = $id['id'];

                        $gamer->phone = $phone;
                        //随机奖品
                        $sql = "select id,name from vip_bairong_gift where num >0";
                        $gifts = Yii::app()->db->createCommand($sql)->queryAll();
                        if (empty($gifts)) {
                            echo '礼品已发完';
                            die;
                        }
                        $count = rand(0, count($gifts) - 1); //获取到具体的某种礼品
                        $gamer->gid = $gifts[$count]['id'];
                        $gift = BairongGift::model()->findByPk($gifts[$count]['id']);
                        $gift->num -= 1;
                        if (!$gift->save()) {
                            die($gifts[$count]['name'] . '减库存失败');
                        }
                        if ($gamer->save()) {
                            echo '恭喜你获得礼品：' . $gifts[$count]['name'];
                            $username = Yii::app()->params['mesusername'];
                            $password = Yii::app()->params['mespassword'];
                            //$sendText = $content ? $content : '恭喜你获得礼品：' . $gifts[$count]['name'];
                            $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle('游戏') . ')';
                            $toDetail = $phone;
                            $this->_send($username, $password, $sendText, $toDetail);
                        } else {
                            echo '注册玩家失败！';
                        }
                    }
                }
                break;
            default :
                echo '未识别方法';
        }
    }

    public function actionAdd_app() {
        $phone=  Yii::app()->request->getParam('phone','');
        $style= Yii::app()->request->getParam('type','');
        if (empty($phone)) {
            $this->_error('10001', '手机号不能为空');
        }
        if (!checkPhone($phone)) {
            $this->_error('10002', '手机号格式不正确');
        }
        if(empty($style)){
            $this->_error('10006', '缺少渠道名');
        }
        //判断该手机号是否已经注册过
        $sql2 = "select * from vip_bairong_user where phone='{$phone}'";
        $user = Yii::app()->db->createCommand($sql2)->queryRow();
        if ($user) {//如果注册过,就通知用户
            if ($user['state'] == 1) {
                $this->_error('10003', '手机号已领过奖品');
            } else {
                $this->_error('10004', '手机号已被验证，请直接领奖');
            }
        } else {//如果该手机号没有注册过，就绑定该手机号到目前openid上
            $gamer = new BairongUser();
            $gamer->ctime = time();
            //获取渠道id
//                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
//                        if (strpos($user_agent, 'MicroMessenger') === false) {
//                            $sql3 = "select id from vip_bairong_style where name='APP'";
//                        } else {
//                            $sql3 = "select id from vip_bairong_style where name='微信'";
//                            
//                        }
            $sql3 = "select id from vip_bairong_style where name='{$style}'";
            $id = Yii::app()->db->createCommand($sql3)->queryRow();
            if(!$id){
                $this->_error('10007', '渠道名不正确');
            }
            $gamer->sid = $id['id'];

            $gamer->phone = $phone;

            if ($gamer->save()) {
                $username = Yii::app()->params['mesusername'];
                $password = Yii::app()->params['mespassword'];
                //$sendText = $content ? $content : '恭喜你获得礼品：' . $gifts[$count]['name'];
                $sendText = $content ? $content : '恭喜您获得百荣11周年店庆活动礼品天堂牌晴雨伞一把，请凭此兑领短信在4月25、26日，每天10点至17点，前往百荣二期三层南区中厅东侧兑领。(' . $this->_changeStyle($style) . ')';
                $toDetail = $phone;
                $this->_send($username, $password, $sendText, $toDetail);
                $this->_error('10000', '请领取奖品');
            } else {
                $this->_error('10005', '注册玩家失败');
            }
        }
    }

    /*     * ***********************私有方法*************************************************** */

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

    private function _error($code, $msg) {
        $data = array(
            'code' => $code,
            'msg' => $msg,
        );
        echo json_encode($data);
        die;
    }

}
