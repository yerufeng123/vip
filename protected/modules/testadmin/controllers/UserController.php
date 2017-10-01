<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class UserController extends BaseController{
    public $user;//用户对象
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
        //姓名（模糊查找）
        if (!empty($data['user_name'])) {
            $where.=' and name like "%' . $data['user_name'] . '%"';
        }
        //手机号（模糊查找）
        if (!empty($data['user_phone'])) {
            $where.=' and phone like "%' . $data['user_phone'] . '%"';
        }
        
        //时间检索
        $strattime=  strtotime($data['starttime']);
        $endtime=  strtotime($data['endtime']);
        if(!empty($strattime) && !empty($endtime)){
            $where.=" and a.ctime > '{$strattime}' and a.ctime < '{$endtime}'";
        }elseif(!empty($strattime)){
            $where.=" and a.ctime > '{$strattime}'";
        }elseif(!empty($endtime)){
            $where.=" and a.ctime < '{$endtime}'";
        }else{
            
        }
         $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.name,a.phone,a.city,a.address,a.ctime,a.status,b.wxnickname,b.wxheadimgurl,b.openid,b.bindstatus from vip_testadmin_user as a left join vip_testadmin_user_weixin as b on a.id=b.uid where {$where} order by a.ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select a.name,a.phone,a.city,a.address,a.ctime,a.status,b.wxnickname,b.wxheadimgurl,b.openid,b.bindstatus from vip_testadmin_user as a left join vip_testadmin_user_weixin as b on a.id=b.uid order by a.ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
             $sql2 = "select count(id) as num from vip_testadmin_user as a where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_testadmin_user as a";
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
    

}
