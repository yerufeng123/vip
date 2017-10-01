<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动

return array(

    Constant::CHANNEL_LOTTERY => array( // 抽奖
        'name' => '斯特拉斯堡小抽奖活动'.date('Y年m月d日'), // 活动名
        'prize_begin_time' => '2015-12-2 10:40:00', // 开始时间
        'prize_stop_time' => '2037-1-4 23:59:59', // 结束时间
        'option_limit' => 10000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
                '0' => array(
                    'id' => 3, // 奖品ID
                    'prize' => '果酱1瓶', // 奖品名
                    'v' => 65, // 抽中概率
                    'num' => 65, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '1' => array(
                    'id' => 4, // 奖品ID
                    'prize' => '热红酒1杯', // 奖品名
                    'v' => 130, // 抽中概率
                    'num' => 130, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '2' => array(
                    'id' => 5, // 奖品ID
                    'prize' => '弗朗贝匹萨1叶', // 奖品名
                    'v' => 5150, // 抽中概率
                    'num' => 715, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '3' => array(
                    'id' => 6, // 奖品ID
                    'prize' => '儿童护肤品1份', // 奖品名
                    'v' => 195, // 抽中概率
                    'num' => 195, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '4' => array(
                    'id' => 7, // 奖品ID
                    'prize' => '每日早餐、坚果（小袋）', // 奖品名
                    'v' => 1840, // 抽中概率
                    'num' => 1840, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '5' => array(
                    'id' => 8, // 奖品ID
                    'prize' => '大米粒手工皂', // 奖品名
                    'v' => 140, // 抽中概率
                    'num' => 140, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '6' => array(
                    'id' => 9, // 奖品ID
                    'prize' => '烤奶酪', // 奖品名
                    'v' => 300, // 抽中概率
                    'num' => 300, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '7' => array(
                    'id' => 10, // 奖品ID
                    'prize' => '安悦护肤品', // 奖品名
                    'v' => 60, // 抽中概率
                    'num' => 60, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '8' => array(
                    'id' => 11, // 奖品ID
                    'prize' => '东方宝石沐浴系列', // 奖品名
                    'v' => 40, // 抽中概率
                    'num' => 40, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '9' => array(
                    'id' => 12, // 奖品ID
                    'prize' => 'Y+N胸针', // 奖品名
                    'v' => 30, // 抽中概率
                    'num' => 30, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '10' => array(
                    'id' => 13, // 奖品ID
                    'prize' => '车载手机支架', // 奖品名
                    'v' => 30, // 抽中概率
                    'num' => 30, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                
                '11' => array(
                    'id' => 100,
                    'prize' => '谢谢惠顾',
                    'v' => 100,
                    'num' => 40000000,
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                )
            ) // 奖品图片


    ),


);


?>