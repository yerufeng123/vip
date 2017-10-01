<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动
$nowtime = Date('Y-m-d H:i:s',time());
$lottery3_timearr=array(
    array('2015-12-5 18:10:00','2015-12-5 18:45:00'),
    array(date('Y-m-d H:i:s',strtotime(date('Y-m-d'))),date('Y-m-d H:i:s',strtotime(date('Y-m-d',strtotime('+1 day'))))),
    
    //array('2015-12-2 19:16:00','2015-12-2 19:46:00'),
    //array('2015-12-2 20:16:00','2015-12-2 20:46:00'),
);

$lottery3_setting = array(
    0 => array(
        Constant::CHANNEL_LOTTERY3 => array( // 抽奖
            'name' => '斯特拉斯堡摇一摇抽奖活动2015年12月05日', // 活动名
            'prize_begin_time' => $lottery3_timearr[0][0], // 开始时间
            'prize_stop_time' => $lottery3_timearr[0][1], // 结束时间
            'option_limit' => 2, // 可抽奖几次
            'overtime' => 0, // 凭证过期时间 /小时 0永不过期
            'setting' => array(
                '0' => array(
                    'id' => 1, // 奖品ID
                    'prize' => '千禧酒一瓶', // 奖品名
                    'v' => 1, // 抽中概率
                    'num' => 1, // 奖品数量
                    'pic' => _STATIC_.'uploads/strasbourg/jiu-01.jpg',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                
                '1' => array(
                    'id' => 100,
                    'prize' => '谢谢惠顾',
                    'v' => 50,
                    'num' => 500000000,
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                )
            ) // 奖品图片

        )
    ),
    1 => array(
        Constant::CHANNEL_LOTTERY3 => array( // 抽奖
            'name' => '斯特拉斯堡摇一摇抽奖活动'.date('Y年m月d日'), // 活动名
            'prize_begin_time' => $lottery3_timearr[1][0], // 开始时间
            'prize_stop_time' => $lottery3_timearr[1][1], // 结束时间
            'option_limit' => 2, // 可抽奖几次
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
                    'v' => 415, // 抽中概率
                    'num' => 415, // 奖品数量
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
                    'id' => 14, // 奖品ID
                    'prize' => 'walkers通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '12' => array(
                    'id' => 15, // 奖品ID
                    'prize' => 'vivi docle冰淇淋优惠券5折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '13' => array(
                    'id' => 16, // 奖品ID
                    'prize' => '欧扎克通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '14' => array(
                    'id' => 17, // 奖品ID
                    'prize' => 'New York Pizza通用优惠券88折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '15' => array(
                    'id' => 18, // 奖品ID
                    'prize' => '鱼邦通用优惠券5折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '16' => array(
                    'id' => 19, // 奖品ID
                    'prize' => '卢卡斯通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '17' => array(
                    'id' => 20, // 奖品ID
                    'prize' => '美妙世界通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '18' => array(
                    'id' => 21, // 奖品ID
                    'prize' => '龙舌兰小馆通用优惠券8折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '19' => array(
                    'id' => 22, // 奖品ID
                    'prize' => '北京鸿福莱酒家通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '20' => array(
                    'id' => 23, // 奖品ID
                    'prize' => '北京鸿福莱酒家通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '21' => array(
                    'id' => 24, // 奖品ID
                    'prize' => '江户前通用优惠券85折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '22' => array(
                    'id' => 25, // 奖品ID
                    'prize' => '酒乡通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '23' => array(
                    'id' => 26, // 奖品ID
                    'prize' => '北德风尚香肠堡免费优惠券', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '24' => array(
                    'id' => 27, // 奖品ID
                    'prize' => '后辽荣通用优惠券5折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '25' => array(
                    'id' => 28, // 奖品ID
                    'prize' => '埃丽金啤酒屋通用优惠券85折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '26' => array(
                    'id' => 29, // 奖品ID
                    'prize' => 'don chicken炸鸡优惠券5折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '27' => array(
                    'id' => 30, // 奖品ID
                    'prize' => '后辽荣热果汁优惠券8折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '28' => array(
                    'id' => 31, // 奖品ID
                    'prize' => '新洲福德通用优惠券9折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '29' => array(
                    'id' => 32, // 奖品ID
                    'prize' => '德南面包房通用优惠券95折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '30' => array(
                    'id' => 33, // 奖品ID
                    'prize' => '奶牛梦工厂通用优惠券85折', // 奖品名
                    'v' => 150, // 抽中概率
                    'num' => 150, // 奖品数量
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                ), // 奖品图片
                '31' => array(
                    'id' => 100,
                    'prize' => '谢谢惠顾',
                    'v' => 1000,
                    'num' => 400000,
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                )
            ) // 奖品图片
    
        )
    ),
    
    
    
    

);

foreach($lottery3_timearr as $k=>$v){
    if($nowtime < $v[1] && $nowtime > $v[0]){
        return $lottery3_setting[$k];
    }
}

if($nowtime <$lottery3_timearr[0][0]){
    return $lottery3_setting[0];
}else{
    return $lottery3_setting[$k];
}
?>