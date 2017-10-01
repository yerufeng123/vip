<?php

/**
 * Created by PhpStorm.
 * User: gaoxiangdong
 * Date: 15-04-17
 * Time: 下午13:19
 */
class DongmengController extends Controller {

    public $weObj; //wechat工具类对象
    public $openid; //用户openid
    public $mesObj; //用户消息对象

    //游戏首页

    public function actionIndex() {
        $this->renderPartial('index');
    }

    //游戏页
    public function actionGame() {
        $this->renderPartial('game');
    }
    

    

    
    
}
