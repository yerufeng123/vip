<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class ProductController extends BaseController {

//管理员显示
    public function actionIndex() {
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

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
        //性别
        if (!empty($data['name'])) {
            $where.=' and a.name like"%' . $data['name'] . '%"';
        }

        //姓名
        if (!empty($data['adminname'])) {
            $where.=' and b.name like "%' . $data['adminname'] . '%"';
        }
        $where = substr($where, 4);

        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select a.id,a.name,a.product_pic,a.PX,a.ctime,a.aid,b.name as adminname from vip_qizheng_product a left join vip_qizheng_administrator b on a.aid=b.id where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        } else {
            $sql = "select * from vip_qizheng_product order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理产品图片和发布人
        foreach ($data as $key => $value) {
            $pic = explode(',', $value['product_pic']);
            $data[$key]['product_pic'] = Yii::app()->request->hostInfo . '/' . $pic[0];
            $admin = new QizhengAdministrator();
            $admin1 = $admin->getAdminInfo($value['aid']);
            $data[$key]['adminname'] = $admin1['name'];
        }





        if (!empty($where)) {
            $sql2 = "select count(a.id) from vip_qizheng_product a left join vip_qizheng_administrator b on a.aid=b.id where {$where}";
        } else {
            $sql2 = "select count(id) as num from vip_qizheng_product";
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
            'list' => $result['content'],
        ));
    }

    //产品发布
    public function actionProduct_add() {
        if (empty($_POST)) {//非异步
            $this->renderPartial('product_add');
        } else {//异步
            if (empty($_POST['name']) || empty($_POST['introduction']) || empty($_POST['use_method']) || empty($_POST['bad_reaction']) || empty($_POST['taboo']) || empty($_POST['pic']) || empty($_POST['product_pic'])) {
                echo '必填字段填写不完整!';
                die;
            }

            $product = new QizhengProduct();
            $product->pic = trim($this->moveFile('businesspic', $_POST['pic']), ',');
            $product->product_pic = trim($this->moveFile('productpic', $_POST['product_pic']), ',');
            $product->name = $_POST['name'];
            $product->introduction = $_POST['introduction'];
            $product->use_method = $_POST['use_method'];
            $product->bad_reaction = $_POST['bad_reaction'];
            $product->taboo = $_POST['taboo'];
            $product->ctime = time();
            $product->other = $_POST['other'];
            $product->aid = $this->session('admin_id');
            if ($product->save() > 0) {
                //发布成功
            } else {
                echo '发布失败';
                die;
            }
        }
    }

    //修改一个产品信息
    public function actionProduct_editor() {
        if (empty($_POST)) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql = "select * from vip_qizheng_product where id='{$_POST['id']}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //处理宣传和产品图片
            $data[0]['pic2'] = explode(',', $data[0]['pic']);
            $data[0]['product_pic2'] = explode(',', $data[0]['product_pic']);

            //处理其他显示项
            $data[0]['other'] = json_decode(stripslashes($data[0]['other']), true);
            if (isset($data[0]['other']) && is_array($data[0]['other'])) {
                foreach ($data[0]['other'] as $key => $value) {
                    $arr = explode('@@@@', $value);
                    $temp[$key]['title'] = $arr[0];
                    $temp[$key]['content'] = $arr[1];
                }
                $data[0]['other'] = $temp;
            }
            
            $this->renderPartial('product_editor', array(
                'list' => $data[0],
            ));
        } else {
            if (empty($_POST['name']) || empty($_POST['introduction']) || empty($_POST['use_method']) || empty($_POST['bad_reaction']) || empty($_POST['taboo']) || empty($_POST['pic']) || empty($_POST['product_pic'])) {
                echo '必填字段填写不完整!';
                die;
            }
            $id = $_POST['id'];
            $product = QizhengProduct::model()->findByPk($id);
            $product->name = $_POST['name'];
            $product->introduction = $_POST['introduction'];
            $product->use_method = $_POST['use_method'];
            $product->bad_reaction = $_POST['bad_reaction'];
            $product->taboo = $_POST['taboo'];
            $product->PX = $_POST['PX'];
            $product->aid = $this->session('admin_id');
            $product->pic = trim($this->moveFile('businesspic', $_POST['pic']), ',');
            $product->product_pic = trim($this->moveFile('productpic', $_POST['product_pic']), ',');
            $product->other = $_POST['other'];
            if ($product->save() > 0) {
                //更新成功
            } else {
                echo '更新失败';
                die;
            }
        }
    }

    //删除一个产品信息
    public function actionProduct_delete() {
        $_POST['id'] = $_GET['id'];
        $product = QizhengProduct::model();
        $productnum = $product->deleteByPk($_POST['id']);
        if ($productnum > 0) {

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

    //获取产品列表
    public function actionAjaxgetproduct() {
        $sql = "select id,name from vip_qizheng_product";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        echo json_encode($data);
    }

}
