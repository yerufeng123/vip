<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class DudaojianjieController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //首页

    public function actionIndex() {
        returnJs('维护中，敬请期待！');
        $this->renderPartial('index');
    }
    

    

}
