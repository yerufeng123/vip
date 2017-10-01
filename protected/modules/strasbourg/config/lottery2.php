<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动
return array(
    Constant::CHANNEL_LOTTERY2 => array( // 抽奖
        'name' => '斯特拉斯堡大抽奖活动'.date('Y年m月d日'), // 活动名
        'prize_begin_time' => '2015-12-2 10:40:00', // 开始时间
        'prize_stop_time' => '2037-1-4 23:59:59', // 结束时间
        'option_limit' =>10000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
            '0' => array(
                'id' => 10, // 奖品ID
                'prize' => '圣诞宝宝一个', // 奖品名
                'v' => 126, // 抽中概率
                'num' => 4, // 奖品数量
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ), // 奖品图片
            '1' => array(
                'id' => 11,
                'prize' => '果酱一瓶',
                'v' => 126,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ), // 奖品图片
            '2' => array(
                'id' => 12,
                'prize' => '德国面包干一袋',
                'v' => 126,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ), // 奖品图片
            '3' => array(
                'id' => 13,
                'prize' => '白猪后腿一只',
                'v' => 126,
                'num' => 2,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ), // 奖品图片
            '4' => array(
                'id' => 14,
                'prize' => '柯蓝儿童用品一瓶',
                'v' => 126,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ), // 奖品图片
            '5' => array(
                'id' => 15,
                'prize' => '安悦系列产品一瓶',
                'v' => 126,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ),
            '6' => array(
                'id' => 16,
                'prize' => '东方宝石系列产品一瓶',
                'v' => 126,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ),
            '7' => array(
                'id' => 17,
                'prize' => '车载手机支架',
                'v' => 12,
                'num' => 20,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                'shop_num' => 'stlsb108',
            ),
            '8' => array(
                'id' => 100,
                'prize' => '谢谢惠顾',
                'v' => 126,
                'num' => 1000000000,
                'pic' => _STATIC_.'vip/strasbourg/img/jp_logo.png',
                //'shop_name' => '天天买',
                //'shop_phone' => 18301194528,
                'shop_num' => 'stlsb108',
          
            
            )
        ) // 奖品图片

        
    ),
    

);
?>