<?php

/**
 * Created by PhpStorm.
 * User: zhaoxiaopan
 * Date: 15-04-13
 * Time: 下午17:31
 */
class ChuangxinController extends Controller {

    public static $userId = 1823;
    public static $meetingId = 3905;
    public static $ticketIdA = 4426;
    public static $ticketIdB = 4426;
    public static $ticketIdC = 4426;

    public function actionIndex() {
        $this->renderPartial('index');
    }

    public function actionAjaxsign1() {
//        if (Yii::app()->request->isAjaxRequest) {
//            $starttime = date('Y-m-d H:i:s');
//            $endtime = '2015-03-25 23:59:00';
//
//            $username = $_POST['username'];
//            $mobile = $_POST['mobile'];
//            $openId = $_POST['openId'];
//            $userId = self::$userId;
//            $meetingId = self::$meetingId;
//
//            if ($_POST['ticket_id'] == 'quantian') {
//                $select_ticket = self::$ticketIdA;
//            } elseif ($_POST['ticket_id'] == 'shangwu') {
//                $select_ticket = self::$ticketIdB;
//            } elseif ($_POST['ticket_id'] == 'xiawu') {
//                $select_ticket = self::$ticketIdC;
//            }
//            $company = $_POST['company'];
//            $work = $_POST['position'];
//            $email = '';
//
//            $postArr = array();
//            $postArr['meeting_id'] = $meetingId;
//            $postArr['user_id'] = $userId;
//            $postArr['type'] = 2;
//            $postArr['name'] = $username;
//            $postArr['phones'] = $mobile;
//            $postArr['ticket_id'] = $select_ticket;
//            $postArr['openid'] = $openId;
//            $postArr['is_import'] = $meetingId;
//            $postArr['field_str'] = '{"name":{"type":"text","name":"name","necessarily":"yes","optionName":"\u59d3\u540d","content":"","value":"' . $username . '"},"phone":{"type":"text","name":"phone","necessarily":"yes","optionName":"\u624b\u673a","content":"","value":"' . $mobile . '"},"company":{"type":"text","name":"company","necessarily":"no","optionName":"\u516c\u53f8","content":"","value":"' . $company . '"},"position":{"type":"text","name":"position","necessarily":"no","optionName":"\u804c\u4f4d","content":"","value":"' . $work . '"},"email":{"type":"text","name":"email","necessarily":"no","optionName":"\u90ae\u7bb1","content":"","value":"' . $email . '"}}';
//
//
//            $huiApi = new HuiApi();
//            $res_json = $huiApi->submit("meetingCustomer/create", $postArr, true);
//            $arr = json_decode($res_json, TRUE);
//            if ($arr['code'] != 1000) {
//                if ($arr['code'] == 11006) {
//                    $arr['msg'] = '活动报名已结束';
//                }
//                echo CJSON::encode(array('type' => 2, 'msg' => $arr['msg']));
//                Yii::app()->end();
//            } else {
//                echo CJSON::encode(array('type' => 1, 'msg' => '等待审核 凭二维码出席'));
//                Yii::app()->end();
//            }
//        }
        echo CJSON::encode(array('type' => 2, 'msg' => '活动报名已结束'));
        Yii::app()->end();
    }

    public function actionAjaxsign() {
//        if (Yii::app()->request->isAjaxRequest) {
//            $starttime = date('Y-m-d H:i:s');
//            $endtime = '2015-05-30 23:59:00';
//            /* if ($starttime > $endtime) {
//              echo CJSON::encode(array('type' => 2, 'msg' => '报名已结束'));
//              Yii::app()->end();
//              } */
//            $username = $_POST['username'];
//            $mobile = $_POST['mobile'];
//            $company = $_POST['company'];
//            $userId = self::$userId;
//            $meetingId = self::$meetingId;
//            $select_ticket = self::$ticketIdA;
//            $postArr1 = array(
//                'id' => $select_ticket,
//                'meeting_id' => $meetingId,
//            );
//            $huiApi = new HuiApi();
//            $res_json = $huiApi->submit("meetingTickets/view", $postArr1, true);
//            $arr = json_decode($res_json, TRUE);
//            $data = json_decode($arr['data']['options'], true);
//            $str = '';
//            foreach ($data as $key => $value) {
//                switch ($key) {
//                    case 'name':
//                        $str = 'name;' . $username;
//                        $data[$key]['value'] = $username;
//                        break;
//                    case 'phone':
//                        $str .= '#phone;' . $mobile;
//                        $data[$key]['value'] = $mobile;
//                        break;
//                    case 'position':
//                        $str .= '#position;' . $position;
//                        $data[$key]['value'] = $position;
//                        break;
//                    case 'email':
//                        $str .= '#email;' . $email;
//                        $data[$key]['value'] = $email;
//                        break;
//                    default:
//                        $str .= '#company;' . $company;
//                        break;
//                }
//            }
//
////            if($_POST['ticket_id'] == 'quantian'){
////                $select_ticket=self::$ticketIdA;
////            }elseif($_POST['ticket_id'] == 'shangwu'){
////                $select_ticket=self::$ticketIdB;
////            }elseif($_POST['ticket_id'] == 'xiawu'){
////                $select_ticket=self::$ticketIdC;
////            }
////            $company=$_POST['company'];
////            $work=$_POST['position'];
////            $email='';
////            $work='PHP工程师';
////            $email='';
//
//            $postArr = array();
//            $postArr['meeting_id'] = $meetingId;
//            $postArr['user_id'] = $userId;
//            $postArr['type'] = 1;
//            $postArr['name'] = $username;
//            $postArr['phones'] = $mobile;
//            $postArr['ticket_id'] = $select_ticket;
//            $postArr['field_str'] = $data;
//            $res_json = $huiApi->submit("meetingCustomer/create", $postArr, true);
//            $arr = json_decode($res_json, TRUE);
//            if ($arr['code'] != 1000) {
//                if ($arr['code'] == 11006) {
//                    $arr['msg'] = '报名已结束';
//                }
//                echo CJSON::encode(array('type' => 2, 'msg' => $arr['msg']));
//                Yii::app()->end();
//            } else {
//                echo CJSON::encode(array('type' => 1, 'msg' => '报名成功'));
//                Yii::app()->end();
//            }
//        }
        echo CJSON::encode(array('type' => 1, 'msg' => '报名成功'));
                Yii::app()->end();
    }

    public function actionSigntech() {
        $huiapi = new HuiApi();
        //$huiapi = $this->huiapi();
        $user_id = self::$userId;
        $meetingId = self::$meetingId;
        $set = $huiapi->submit("meeting/check/view", array("meeting_id" => $meetingId));
        //$res = $this->getMeetingInfo($user_id, $id);
        $res = $huiapi->submit("meeting/info", array("user_id" => $user_id, "id" => $meetingId));
        if (empty($res)) {
            echo '11';
            Yii::app()->end();
        }
        $where = array(
            "meeting_id" => $meetingId,
            "type_id" => 4,
            "user_id" => $user_id
        );
        $config = $huiapi->submit("module/list", array("where" => $where));
        $tpl = dirname(Yii::app()->basePath) . $config[0]['visit_url'] . "/index.php";
        if ($config[0]['in_use'] == 1 && file_exists($tpl)) {
            $this->renderFile($tpl, array('set' => $set, 'res' => $res));
        } else {
            $this->renderPartial("signtech", array('set' => $set, 'res' => $res, 'meetingId' => $meetingId));
        }
        //$this->render('signtech');
    }

    public function actionGetdata() {
        $id = self::$meetingId;
        $huiapi = new HuiApi();
        $list = $huiapi->submit("checkin/signtech", array("meeting_id" => $id), true);
        print_r($list);
    }

}
