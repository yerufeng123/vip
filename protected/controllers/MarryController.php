<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
/**
/**
 * Created by PhpStorm.
 * User: zhaoxiaopan
 * Date: 15-04-13
 * Time: 下午17:31
 */
class MarryController extends Controller {

    public static $userId = 424;
    public static $meetingId = 2157;
    public static $ticketIdA = 2532;
    public static $ticketIdB = 2288;
    public static $ticketIdC = 2288;

    public function actionJl() {
        $openid = '';
        $this->render('jl', array("openid" => $openid));
    }
    
    public function actionIndex(){
        $this->renderPartial('index');
    }
	

    public function actionAjaxsign() {
        if (Yii::app()->request->isAjaxRequest) {
            $starttime = date('Y-m-d H:i:s');
            $endtime = '2015-05-03 23:59:00';
            if ($starttime > $endtime) {
                echo CJSON::encode(array('type' => 2, 'msg' => '婚礼报名已结束'));
                Yii::app()->end();
            }
            $username = $_POST['username'];
            $mobile = $_POST['mobile'];
            //$ask = $_POST['ask']; //祝福语
            //$openId=$_POST['openId'];
            $userId = self::$userId;
            $meetingId = self::$meetingId;
            $select_ticket = self::$ticketIdA;
            $postArr1 = array(
                'id' => $select_ticket,
                'meeting_id' => $meetingId,
            );
            $huiApi = new HuiApi();
            $res_json = $huiApi->submit("meetingTickets/view", $postArr1, true);
            $arr = json_decode($res_json, TRUE);
            $data = json_decode($arr['data']['options'], true);
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'name':
                        $data[$key]['value'] = $username;
                        break;
                    case 'phone':
                        $data[$key]['value'] = $mobile;
                        break;
                    default :
//                        if(substr($key, 0,3)== 'ask'){
//                            $data[$key]['value'] = htmlspecialchars($ask);
//                        }
                        
                }
            }



           
            $postArr = array();
            $postArr['meeting_id'] = $meetingId;
            $postArr['user_id'] = $userId;
            $postArr['type'] = 1;
            $postArr['name'] = $username;
            $postArr['phones'] = $mobile;
            $postArr['ticket_id'] = $select_ticket;
//            $postArr['openid']=$openId;
            $postArr['field_str'] = $data;
            $res_json = $huiApi->submit("meetingCustomer/create", $postArr, true);
            $arr = json_decode($res_json, TRUE);
            if ($arr['code'] != 1000) {
                if ($arr['code'] == 11006) {
                    $arr['msg'] = '婚礼报名已结束';
                }
                echo CJSON::encode(array('type' => 2, 'msg' => $arr['msg']));
                Yii::app()->end();
            } else {
                echo CJSON::encode(array('type' => 1, 'msg' => '报名成功'));
                Yii::app()->end();
            }
        }
    }

    

}
