<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class LinkController extends BaseController{
    public $link;//管理员对象
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
        //链接标题
        if (!empty($data['title'])) {
            $where.=' and title like"%' . $data['title'].'%"';
        }
        
        //所属产品
        if (!empty($data['pid'])) {
            $where.=' and pid =' . $data['pid'];
        }
        
        //发布人
        if (!empty($data['adminname'])) {
            $where.=' and name like "%' . $data['adminname'] . '%"';
        }
         $where=  substr($where, 4);
        
        
        $page=$_POST['p'];//第几页
        $pernum=5;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.id,a.title,a.little_pic,a.url,a.display,a.PX,a.ctime,a.pid,a.aid,b.name as adminname from vip_qizheng_link as a left join vip_qizheng_administrator b on b.id=a.aid where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_qizheng_link order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
             $sql2 = "select count(a.id) as num from vip_qizheng_link as a left join vip_qizheng_administrator b on b.id=a.aid where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_qizheng_link";
        }
       
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        //处理链接图片和发布人和所属产品
        foreach ($data as $key => $value) {
            $data[$key]['little_pic'] = Yii::app()->request->hostInfo . '/' . $value['little_pic'];
            $admin = new QizhengAdministrator();
            $admin1 = $admin->getAdminInfo($value['aid']);
            $data[$key]['adminname'] = $admin1['name'];
            $product=new QizhengProduct();
            $product1 =$product->getProductInfo($value['pid']);
            $data[$key]['productname'] = $product1['name'];
        }
        
        
        
        
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

    //发布新推广链接
    public function actionLink_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('link_add');
        } else {//异步
            if(empty($_POST['title']) || empty($_POST['url']) || empty($_POST['pid']) || empty($_POST['little_pic'])){
                echo '必填字段填写不完整!';die;
            }
           
            $link=new QizhengLink();
            $link->title=$_POST['title'];
            $link->url=$_POST['url'];
            $link->pid=$_POST['pid'];
            $link->aid=  $this->session('admin_id');
            $link->ctime=time();
            $link->little_pic=trim($_POST['little_pic'],',');
            if($link->save()>0){
                //发布成功
            }else{
                echo '发布失败';die;
            }
        }
    }

    //修改一个管理员信息
    public function actionLink_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_qizheng_link where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('link_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['title']) || empty($_POST['url']) || empty($_POST['pid'])  || empty($_POST['little_pic'])){
                echo '必填字段填写不完整!';die;
            }
            $link= QizhengLink::model()->findByPk($_POST['id']);
            $link->title=$_POST['title'];
            $link->url=$_POST['url'];
            $link->pid=$_POST['pid'];
            $link->aid=  $this->session('admin_id');
            $link->display=$_POST['display'];
            $link->PX=$_POST['PX'];
           $link->little_pic=trim($_POST['little_pic'],',');
            if($link->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个管理员信息
    public function actionLink_delete() {
        $_POST['id'] = $_GET['id'];
        $link=  QizhengLink::model();
        $linknum=$link->deleteByPk($_POST['id']);
        if ($linknum>0) {
            
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
