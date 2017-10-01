<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
class IndexController extends BaseController{
    public $admin;//管理员对象
//管理员显示
    public function actionIndex() {
        $h5viewednum=StrasbourgConfig::model()->findByAttributes(array('name'=>'h5viewednum'))->content;//h5浏览量
        $h5sharenum=StrasbourgConfig::model()->findByAttributes(array('name'=>'h5sharenum'))->content;//h5转发量 
        $h5viewednum =empty($h5viewednum) ? 1:$h5viewednum;
        $h5chuanbopercent=cutNumber($h5sharenum/$h5viewednum, 4,2);//二次传播率
        
        
        
        //h5留资量
        $sql3="select count('id') as num from vip_strasbourg_user";
        $data=Yii::app()->db->createCommand($sql3)->queryRow();
        $h5registernum=$data['num'];
        
        //h5核销量
        $sql4="select count('id') as num from vip_strasbourg_certificate where channel = '".Constant::CHANNEL_H5."' and type='h5one' and overtime <> 0";
        $data=Yii::app()->db->createCommand($sql4)->queryRow();
        $h5hexiaonum=$data['num'];
        if($h5registernum == 0){
            $h5percent=cutNumber($h5hexiaonum/$h5registernum,4,2);//h5转化率
        }else{
            $h5percent=cutNumber(0,4,2);//h5转化率
        }
        
        
        
        
        //铭牌游戏发起量
        $sql="select count('id') as num from vip_strasbourg_user where nickname <> '' and headimgurl <> ''";
        $data=Yii::app()->db->createCommand($sql)->queryRow();
        $tagsharenum=$data['num'];
        
        
        
        //铭牌游戏核销量
        $sql2="select count('id') as num from vip_strasbourg_certificate where channel = '".Constant::CHANNEL_H5."' and type='h5two' and overtime <> 0";
        $data=Yii::app()->db->createCommand($sql2)->queryRow();
        $taghexiaonum=$data['num'];
        if($tagsharenum == 0){
            $tagpercent=cutNumber(0,4,2);//铭牌转化率
        }else{
            $tagpercent=cutNumber($taghexiaonum/$tagsharenum,4,2);//铭牌转化率
        }
        
        
        
        //铭牌传播量
        $sql5="select count('id') as num from vip_strasbourg_tags";
        $data=Yii::app()->db->createCommand($sql5)->queryRow();
        $tagchuanbonum=$data['num'];
        
        
        
        
        
        
        $this->renderPartial('index',array('h5viewednum'=>$h5viewednum,'h5sharenum'=>$h5sharenum,'h5chuanbopercent'=>$h5chuanbopercent,'h5registernum'=>$h5registernum,'h5hexiaonum'=>$h5hexiaonum,'h5percent'=>$h5percent,'tagsharenum'=>$tagsharenum,'taghexiaonum'=>$taghexiaonum,'tagpercent'=>$tagpercent,'tagchuanbonum'=>$tagchuanbonum));
    }

    

}
