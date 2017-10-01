<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class InformationController extends BaseController{
//分类显示
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
        //所属产品
        if (!empty($data['pid'])) {
            $where.=' and pid =' . $data['pid'];
        }
        
        //标题
        if (!empty($data['title'])) {
            $where.=' and title like "%' . $data['title'] . '%"';
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
            $sql = "select a.id,a.title,a.little_pic,a.display,a.PX,a.ctime,a.pid,a.aid,b.name as adminname from vip_qizheng_information as a left join vip_qizheng_administrator b on b.id=a.aid where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select * from vip_qizheng_information order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理资料图片和发布人和所属产品
        foreach ($data as $key => $value) {
            $data[$key]['little_pic'] = Yii::app()->request->hostInfo . '/' . $value['little_pic'];
            $admin = new QizhengAdministrator();
            $admin1 = $admin->getAdminInfo($value['aid']);
            $data[$key]['adminname'] = $admin1['name'];
            $product=new QizhengProduct();
            $product1 =$product->getProductInfo($value['pid']);
            $data[$key]['productname'] = $product1['name'];
        }
        if(!empty($where)){
             $sql2 = "select count(a.id)as num from vip_qizheng_information as a left join vip_qizheng_administrator b on b.id=a.aid where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_qizheng_information";
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

    //新分类发布
    public function actionInformation_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('information_add');
        } else {//异步
            if(empty($_POST['title'])  || empty($_POST['pid']) || empty($_POST['little_pic'])){
                echo '必填字段填写不完整!';die;
            }
           
            $information=new QizhengInformation();
            $information->title=$_POST['title'];
            $information->ctime=time();
            $information->pid=$_POST['pid'];
            $information->aid=$this->session('admin_id');
            $information->little_pic=$_POST['little_pic'];
            
            if($information->save()>0){
                //注册成功
            }else{
                echo '注册失败';die;
            }
        }
    }

    //修改一个分类信息
    public function actionInformation_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_qizheng_information where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('information_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['title']) || empty($_POST['pid']) || empty($_POST['little_pic'])){
                echo '必填字段填写不完整!';die;
            }
            $information= QizhengInformation::model()->findByPk($_POST['id']);
             $information->title=$_POST['title'];
            $information->display=$_POST['display'];
            $information->PX=$_POST['PX'];
            $information->pid=$_POST['pid'];
            $information->aid=$this->session('admin_id');
            $information->little_pic=$_POST['little_pic'];
            if($information->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个分类信息
    public function actionInformation_delete() {
        $_POST['id'] = $_GET['id'];
        $information= QizhengInformation::model();
        $informationnum=$information->deleteByPk($_POST['id']);
        if ($informationnum>0) {
            
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
    
    
    
    
    
    
    //文献显示
    public function actionContent_index() {
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
        //所属产品
        if (!empty($data['pid'])) {
            $where.=' and c.pid =' . $data['pid'];
        }
        //所属分类
        if (!empty($data['Iid'])) {
            $where.=' and a.Iid =' . $data['Iid'];
        }
        
        //标题
        if (!empty($data['title'])) {
            $where.=' and a.title like "%' . $data['title'] . '%"';
        }
        //发布人
        if (!empty($data['adminname'])) {
            $where.=' and b.name like "%' . $data['adminname'] . '%"';
        }
        $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=5;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.id,a.title,a.display,a.PX,a.ctime,a.Iid,a.aid,b.name as adminname,c.pid,c.title as informationname from vip_qizheng_content as a left join vip_qizheng_administrator b on b.id=a.aid left join vip_qizheng_information as c on a.Iid=c.id where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select a.id,a.title,a.display,a.PX,a.ctime,a.Iid,a.aid,b.name as adminname,c.pid,c.title as informationname from vip_qizheng_content as a left join vip_qizheng_administrator b on b.id=a.aid left join vip_qizheng_information as c on a.Iid=c.id  order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理资料图片和发布人和所属产品
        foreach ($data as $key => $value) {
            $admin = new QizhengAdministrator();
            $admin1 = $admin->getAdminInfo($value['aid']);
            $data[$key]['adminname'] = $admin1['name'];
            $product=new QizhengProduct();
            $product1 =$product->getProductInfo($value['pid']);
            $data[$key]['productname'] = $product1['name'];
//            $information=new Information();
//            $information1 =$information->getInformationInfo($value['Iid']);
//            $data[$key]['informationname'] = $information1['title'];
        }
        if(!empty($where)){
             $sql2 = "select a.id,a.title,a.display,a.PX,a.ctime,a.Iid,a.aid,b.name as adminname,c.pid,c.title as informationname from vip_qizheng_content as a left join vip_qizheng_administrator b on b.id=a.aid left join vip_qizheng_information as c on a.Iid=c.id where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_qizheng_content";
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
        $this->renderPartial('content_index', array(
            'page' => $show,
            'search' => $search,
            'list'=>$result['content'],
        ));
    }

    //新文献发布
    public function actionContent_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('content_add');
        } else {//异步
            if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['Iid'])){
                echo '必填字段填写不完整!';die;
            }
            $information=new QizhengContent();
            $information->title=$_POST['title'];
            $information->content=$_POST['content'];
            $information->ctime=time();
            $information->Iid=$_POST['Iid'];
            $information->aid=$this->session('admin_id');
            
            if($information->save()>0){
                //注册成功
            }else{
                echo '注册失败';die;
            }
        }
    }

    //修改一个文献信息
    public function actionContent_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select a.id,a.title,a.content,a.display,a.PX,a.ctime, a.Iid,b.pid from vip_qizheng_content a left join vip_qizheng_information b on a.Iid=b.id where a.id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $data[0]['content']=stripcslashes($data[0]['content']);
            $this->renderPartial('content_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['Iid'])){
                echo '必填字段填写不完整!';die;
            }
            $information= QizhengContent::model()->findByPk($_POST['id']);
             $information->title=$_POST['title'];
            $information->content=$_POST['content'];
            $information->display=$_POST['display'];
            $information->PX=$_POST['PX'];
            $information->Iid=$_POST['Iid'];
            $information->aid=$this->session('admin_id');
            if($information->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个文献信息
    public function actionContent_delete() {
        $_POST['id'] = $_GET['id'];
        $information= QizhengContent::model();
        $informationnum=$information->deleteByPk($_POST['id']);
        if ($informationnum>0) {
            
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
    
    //根据产品id,获取文献分类列表
    public function actionAjaxgetinformation(){
        $pid=$_POST['pid'];
        $sql="select id,pid,title from vip_qizheng_information where pid='{$pid}'";
        $data=  Yii::app()->db->createCommand($sql)->queryAll();
        echo json_encode($data);
    }

}
