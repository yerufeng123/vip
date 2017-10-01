<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动

return array(

    Constant::CHANNEL_LOTTERY4 => array( // 抽奖
        'name' => '斯特拉斯堡支付抽奖活动'.date('Y年m月d日'), // 活动名
        'prize_begin_time' => '2015-12-2 10:40:00', // 开始时间
        'prize_stop_time' => '2037-1-4 23:59:59', // 结束时间
        'option_limit' => 10000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
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
                    'v' => 300,
                    'num' => 400000,
                    'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                    //'shop_name' => '天天买',
                    //'shop_phone' => 18301194528,
                    'shop_num' => 'stlsb108'
                )
            ) // 奖品图片


    ),


);


?>