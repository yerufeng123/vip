<?php

/*
 * AdminExt
 * User:aiming
 * Date:2015-12-09
 */

class LuyinUserExt extends LuyinUser {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //根据openid，获取用户信息
    public static function getUserId($openid) {
        if (empty($openid)) {
            return returnJson('缺少参数', '10003', 3);
        }
        $user = LuyinUser::model()->findByAttributes(array('openid' => $openid));
        if (!$user) {
            return returnJson('用户不存在', '20001', 3);
        }

        return returnJson($user->attributes, '10000',3);
    }

}

?>