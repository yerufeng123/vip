<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动
return array(
    
    Constant::CHANNEL_GAME => array(      // 接圣诞
        'name' => '小礼品',
        'christmas_begin_time' => '2015-12-1 00:00:00',   // 活动开始
        'christmas_stop_time' => '2037-12-15 24:00:00',         // 活动结束
        'continue_time' => 0.5,               // 单场游戏时间 /分钟
        'sigle_score' => 100,                 // 单个奖励
   //     'total_score' => 20,                // 单场总分限制
        'day_limit' => 100000,                    //游戏场限制   1天/几场
        'mkn_num'=>3000,                  
        'shop_num'=>'stlsb1001',  
    ),
    

);
?>