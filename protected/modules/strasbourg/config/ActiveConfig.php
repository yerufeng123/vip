<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动
return array(
    Constant::CHANNEL_LOTTERY => array( // 抽奖
        'name' => 'prize' . $prefix, // 活动名
        'prize_begin_time' =>0, // 开始时间
        'prize_stop_time' => 0, // 结束时间
        'option_limit' => 3000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
            '0' => array(
                'id' => 10, // 奖品ID
                'prize' => '电脑一台', // 奖品名
                'v' => 1, // 抽中概率
                'num' => 10, // 奖品数量
                'pic' => 'http://img0.imgtn.bdimg.com/it/u=3965306929,1867766385&fm=21&gp=0.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
,
            '1' => array(
                'id' => 11,
                'prize' => '啤酒一瓶',
                'v' => 10,
                'num' => 20,
                'pic' => 'http://pic.nipic.com/2007-11-15/200711159631616_2.gif',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
,
            '2' => array(
                'id' => 12,
                'prize' => '美女一个',
                'v' => 40,
                'num' => 2,
                'pic' => 'http://bj.ruideppt.com/upfile/proimage/201142918164560826.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
,
            '3' => array(
                'id' => 13,
                'prize' => '帅哥一枚',
                'v' => 50,
                'num' => 30,
                'pic' => 'http://www.pptbz.com/Soft/UploadSoft/200911/2009110522430362.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
,
            '4' => array(
                'id' => 14,
                'prize' => '美食一顿',
                'v' => 60,
                'num' => 40,
                'pic' => 'http://www.ruideppt.net/upfile/proimage/201161713394918022.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
,
            '5' => array(
                'id' => 15,
                'prize' => '苹果一个',
                'v' => 70,
                'num' => 10,
                'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
            ) // 奖品图片
            ,
            '6' => array(
                'id' => 100,
                'prize' => '谢谢惠顾',
                'v' => 70,
                'num' => 50,
                    'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                            'shop_num' => 'stlsb004',
                                ) // 奖品图片

        )
    ),
    Constant::CHANNEL_LOTTERY2 => array( // 抽奖
        'name' => 'prize2' . $prefix, // 活动名
        'prize_begin_time' => 0, // 开始时间
        'prize_stop_time' => 0, // 结束时间
        'option_limit' => 3000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
            '0' => array(
                'id' => 10, // 奖品ID
                'prize' => '电脑一台', // 奖品名
                'v' => 1, // 抽中概率
                'num' => 10, // 奖品数量
                'pic' => 'http://img0.imgtn.bdimg.com/it/u=3965306929,1867766385&fm=21&gp=0.jpg',
                'shop_num' => 'stlsb001',
            ), // 奖品图片
            '1' => array(
                'id' => 11,
                'prize' => '大啤酒一瓶',
                'v' => 10,
                'num' => 2,
                'pic' => 'http://pic.nipic.com/2007-11-15/200711159631616_2.gif',
                'shop_num' => 'stlsb001',
            ), // 奖品图片
            '2' => array(
                'id' => 12,
                'prize' => '大美女一个',
                'v' => 40,
                'num' => 20,
                'pic' => 'http://bj.ruideppt.com/upfile/proimage/201142918164560826.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '3' => array(
                'id' => 13,
                'prize' => '大帅哥一枚',
                'v' => 50,
                'num' => 3,
                'pic' => 'http://www.pptbz.com/Soft/UploadSoft/200911/2009110522430362.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '4' => array(
                'id' => 14,
                'prize' => '大美食一顿',
                'v' => 60,
                'num' => 4,
                'pic' => 'http://www.ruideppt.net/upfile/proimage/201161713394918022.jpg',
                'shop_num' => 'stlsb001',
            ), // 奖品图片
            '5' => array(
                'id' => 15,
                'prize' => '大苹果一个',
                'v' => 70,
                'num' => 10,
                'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_num' => 'stlsb004',
            ),
            '6' => array(
                'id' => 100,
                'prize' => '谢谢惠顾',
                'v' => 70,
                'num' => 50,
                'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                'shop_num' => 'stlsb004',
          
            
            )
        ) // 奖品图片

        
    ),
    Constant::CHANNEL_LOTTERY3 => array( // 抽奖
        'name' => 'prize3' . $prefix, // 活动名
        'prize_begin_time' => '2015-11-24 13:55:00', // 开始时间
        'prize_stop_time' => 0, // 结束时间
        'option_limit' => 3000, // 可抽奖几次
        'overtime' => 0, // 凭证过期时间 /小时 0永不过期
        'setting' => array(
            '0' => array(
                'id' => 10, // 奖品ID
                'prize' => '电脑一台', // 奖品名
                'v' => 1, // 抽中概率
                'num' => 12, // 奖品数量
                'pic' => 'http://img0.imgtn.bdimg.com/it/u=3965306929,1867766385&fm=21&gp=0.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '1' => array(
                'id' => 11,
                'prize' => '摇啤酒一瓶',
                'v' => 10,
                'num' => 20,
                'pic' => 'http://pic.nipic.com/2007-11-15/200711159631616_2.gif',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '2' => array(
                'id' => 12,
                'prize' => '摇美女一个',
                'v' => 40,
                'num' => 20,
                'pic' => 'http://bj.ruideppt.com/upfile/proimage/201142918164560826.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '3' => array(
                'id' => 13,
                'prize' => '摇帅哥一枚',
                'v' => 50,
                'num' => 30,
                'pic' => 'http://www.pptbz.com/Soft/UploadSoft/200911/2009110522430362.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '4' => array(
                'id' => 14,
                'prize' => '摇美食一顿',
                'v' => 60,
                'num' => 40,
                'pic' => 'http://www.ruideppt.net/upfile/proimage/201161713394918022.jpg',
                'shop_num' => 'stlsb004',
            ), // 奖品图片
            '5' => array(
                'id' => 15,
                'prize' => '摇苹果一个',
                'v' => 70,
                'num' => 10,
                'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_num' => 'stlsb004',
            ),
       '6' => array(
                'id' => 100,
                'prize' => '谢谢惠顾',
                'v' => 70,
                'num' => 50,
                    'pic' => 'http://www.ppt123.net/beijing/UploadFiles_8374/201202/2012022812393142.jpg',
                'shop_name' => '天天买',
                'shop_phone' => 18301194528,
                            'shop_num' => 'stlsb004',
                                ) // 奖品图片

        )

        
    ),
    Constant::CHANNEL_SECKILL => array(       // 秒拍
        'name' => 'miaookiei6',
        'miao_begin_time' => '2015-11-3 17:40:00',
        'miao_stop_time' => '2015-11-24 11:59:00',
        'past_time' => 0.5,      // 秒拍商品过期时间 /分钟 未支付可重新秒拍
        'shop_num'=>12101,
        'setting' => array(
            'id' => '17',       // 商品ID
            'name' => '法国红酒',    // 商品名
            'price' => '0.01',  // 商品价格
        //    'pic' => '',        // 商品图片
            'sale_num' => 3,    // 可售数量
            'discrption' => '这是一瓶酒，好喝，真好喝。。。。。'  // 简介
        ) 

    ),
    Constant::CHANNEL_AUCTION => array(      // 竟拍
        'name' => '竞拍测试e',
        'auction_begin_time' => 0,
        'auction_stop_time' => '2015-11-24 15:10:00',
        'credit'=>200,//活动积分
        'shop_num'=>12101,
        'setting' => array(
            'id' => '104',
            'name' => '测试商品红酒12',      // 商品名
            'price' => '0',     // 初始价
            'add' => '100',        // 单次加价
            'pic' => '',           // 商品图片
            'discrption' => '竟拍开始了。。。'     // 简介
        ) 
      
    ),
    Constant::CHANNEL_GAME => array(      // 接圣诞
        'name' => '拯救马卡龙',
        'christmas_begin_time' => '2015-11-3',   // 活动开始
        'christmas_stop_time' => '2015-11-30',         // 活动结束
        'continue_time' => 0.5,               // 单场游戏时间 /分钟
        'sigle_score' => 100,                 // 单个奖励
   //     'total_score' => 20,                // 单场总分限制
        'day_limit' => 100000,                    //游戏场限制   1天/几场
        'convert'=>3000 ,                     //兑换积分   分/个
        'shop_num'=>12101,
    ),
    Constant::CHANNEL_H5 => array(      // H5
        'name' => 'h5' . $prefix,   // 活动名
        'shop_name'=>'天天买',
        'shop_phone'=>18301194528,
        'shop_num'=>12101,
        'setting' => array(
            1 => array(
                'name' =>'测试礼品名1',   // 奖品名
                'pic' => '',     //奖品图片
                'num' => 1,    // 奖品数量
                'price'=>0,//   //奖品价格
            ),
            2 => array(
                'name' =>'测试礼品名2',// 奖品名
                'pic' => '',     //奖品图片
                'num' => 1,    // 奖品数量
                'price'=>0,//   //奖品价格
            ),
        )
    )

);
?>