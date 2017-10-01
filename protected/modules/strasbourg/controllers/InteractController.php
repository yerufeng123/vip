<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class InteractController extends BaseController{
    public $tag;//用户对象
//管理员显示
    public function actionTag() {
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
        //点亮的铭牌
        if (!empty($data['tagindex']) || $data['tagindex'] == '0') {
            $where.=' and a.tagindex ="' . $data['tagindex'].'"';
        }
        //点击用户（模糊查找）
        if (!empty($data['openid'])) {
            $where.=' and a.openid like "%' . $data['openid'] . '%"';
        }
        //被点用户（模糊查找）
        if (!empty($data['fopenid'])) {
            $where.=' and a.fopenid like "%' . $data['fopenid'] . '%"';
        }
        
        //被点姓名（模糊查找）
        if (!empty($data['name'])) {
            $where.=' and b.name like "%' . $data['name'] . '%"';
        }
        
        //被点电话（模糊查找）
        if (!empty($data['phone'])) {
            $where.=' and b.phone like "%' . $data['phone'] . '%"';
        }
        
         $where=  substr($where, 4);
        
        $page=$_POST['p'];//第几页
        $pernum=10;//每页显示数
        $startnum = ($page - 1) * $pernum;
        if(!empty($where)){
            $sql = "select a.id,a.openid,a.fopenid,a.tagindex,a.ctime,b.name,b.phone,b.headimgurl from vip_strasbourg_tags a left join vip_strasbourg_user b on b.openid=a.fopenid  where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        }else{
            $sql = "select a.id,a.openid,a.fopenid,a.tagindex,a.ctime,b.name,b.phone,b.headimgurl from vip_strasbourg_tags a left join vip_strasbourg_user b on b.openid=a.fopenid order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($where)){
             $sql2 = "select count(a.id) as num from vip_strasbourg_tags a left join vip_strasbourg_user b on b.openid=a.fopenid where {$where}";
        }else{
             $sql2 = "select count(id) as num from vip_strasbourg_tags";
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

    //管理员注册
    public function actionTag_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('tag_add');
        } else {//异步
            if(empty($_POST['tagname'])){
                echo '必填字段填写不完整!';die;
            }
            $sql="select id from vip_strasbourg_tags where tagname='{$_POST['tagname']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($data)){
                echo '该账号已被注册！';die;
            }
            $tag=new StrasbourgTags();
            $tag->tagname=$_POST['tagname'];
            $tag->name=$_POST['name'];
            $tag->phone=$_POST['phone'];
            $tag->ctime=time();
            if($tag->save()>0){
                //注册成功
            }else{
                echo '注册失败';die;
            }
        }
    }

    //修改一个管理员信息
    public function actionTag_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql="select * from vip_strasbourg_tags where id='{$_POST['id']}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('tag_editor',array(
                'list'=>$data[0],
            ));
        } else {
             if(empty($_POST['name']) || empty($_POST['phone'])){
                echo '必填字段填写不完整!';die;
            }
            
            $tag= StrasbourgTags::model();
            $tag->id=$_POST['id'];
            $tag->name=$_POST['name'];
            $tag->phone=$_POST['phone'];
            if($tag->save()>0){
                //更新成功
            }else{
                echo '更新失败';die;
            }
        }
    }

    //删除一个管理员信息
    public function actionTag_delete() {
        $_POST['id'] = $_GET['id'];
        $tag=  StrasbourgTags::model();
        $tagnum=$tag->deleteByPk($_POST['id']);
        if ($tagnum>0) {
            
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
