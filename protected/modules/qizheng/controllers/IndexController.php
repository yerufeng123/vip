<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class IndexController extends Controller {

    public $user; //用户对象

    //
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $cookie = Yii::app()->request->getCookies();
        $usercode = $cookie['usercode']->value;
        if (empty($usercode)) {
            $this->redirect('/qizheng/login/userlogin');
        }
    }

//管理员显示
    public function actionIndex() {
        /* 顶部产品列表 */
        $sql = 'select id,name from vip_qizheng_product order by PX asc,ctime asc';
        $productlist = Yii::app()->db->createCommand($sql)->queryAll();
        //字数限制
        if (isset($productlist) && is_array($productlist)) {
            foreach ($productlist as $k => $v) {
                if (mb_strlen($v['name']) > 24) {
                    $productlist[$k]['name'] = msubstr($v['name'], 0, 8);
                }
            }
        } else {
            $productlist = array();
        }



        $pid = Yii::app()->request->getParam('pid', $productlist[0]['id']);


        /* 获取产品信息 */
        if (empty($productlist)) {
            $product = array();
            $information=array();
            $link=array();
            
        } else {
            $sql1 = 'select * from vip_qizheng_product where id=' . $pid;

            $product = Yii::app()->db->createCommand($sql1)->queryRow();
            //var_dump($product);die;
            //处理商家图片和产品图片
            $temppic = explode(',', trim($product['pic'], ','));
            $product['pic'] = $temppic;
            //$tempproduct_pic = explode(',', trim($product['product_pic'], ','));
            //$product['product_pic'] = $tempproduct_pic;
            //处理其他选项
            $tempother = json_decode(stripcslashes($product['other']));
            if (isset($tempother) && is_array($tempother)) {
                foreach ($tempother as $key => $value) {
                    $tempother[$key] = explode('@@@@', $value);
                }
                $product['other'] = $tempother;
            }



            /* 获取产品资料 */
            $sql2 = 'select id,title,little_pic from vip_qizheng_information  where display=1 and pid=' . $pid . ' order by PX asc,ctime desc limit 0,6';
            $information = Yii::app()->db->createCommand($sql2)->queryAll();
            /* 获取推广链接 */
            $sql3 = 'select id,title,little_pic,url from vip_qizheng_link where display=1 and pid=' . $pid . ' order by PX asc,ctime desc limit 0,4';
            $link = Yii::app()->db->createCommand($sql3)->queryAll();
        }
        $this->renderPartial('index', array(
            'productlist' => $productlist,
            'product' => $product,
            'information' => $information,
            'link' => $link,
            'pid' => $pid,
        ));
    }

    //获取资料内容列表
    public function actionContentlist() {
        $Iid = Yii::app()->request->getParam('Iid');
        $Ititle = Yii::app()->request->getParam('Ititle');
        $sql = 'select id,title from vip_qizheng_content where display=1 and Iid=' . $Iid . ' order by PX asc,ctime desc';
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        $this->renderPartial('contentlist', array(
            'contentlist' => $data,
            'Ititle' => $Ititle,
        ));
    }

}
