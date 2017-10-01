<?php
header("Content-type: text/html; charset=utf8");
$prefix = '_第12场'; // 活动后辍 方便更换活动
$time = time();
$auction_timearr = array(
    array(date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+19*3600),date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+19*3600+15*60)),
  //  array('2015-12-5 10:00:00','2015-12-5 20:00:00'),
//     array('2015-12-4 13:41:00','2015-12-4 13:43:00'),
//     array('2015-12-4 13:45:00','2015-12-4 13:48:00'),
//     array('2015-12-4 13:51:00','2015-12-4 13:53:00'),
);

$auction_setting = array(   
    '0'=>array( // 竟拍
        'name' => '斯特接斯堡竞拍活动'.date('Y年m月d日'),
        'auction_begin_time' => $auction_timearr[0][0],
        'auction_stop_time' => $auction_timearr[0][1],
        'credit' => 200, // 活动积分
        'shop_num' => 'stlsb108',
        'setting' => array(
            'id' => '101',
            'name' => '翻糖蛋糕', // 商品名
            'price' => '0.01', // 初始价
            'add' => 0.01, // 单次加价
            'pic' => '', // 商品图片
            'discrption' => "延展性和可塑性极佳的翻糖做出来的蛋糕像艺术品一样精致完美，更厉害的是他能保存数年甚至百年。",
            'img'=>'ftdg.jpg',
        ), // 简介
    ),
    '1'=>array( // 竟拍
        'name' => '斯特接斯堡竞拍活动2015-12-05',
        'auction_begin_time' => '2015-12-5 10:00:00',
        'auction_stop_time' => '2015-12-5 20:00:00',
        'credit' => 200, // 活动积分
        'shop_num' => 'sstlsb108',
        'setting' => array(
            'id' => '102',
            'name' => '千禧酒一瓶', // 商品名
            'price' => '0.01', // 初始价
            'add' => 0.01, // 单次加价
            'pic' => '', // 商品图片
            'discrption' => "特拉斯堡圣母大教堂千禧年纪念酒,全球限量一万瓶。",
            'img'=>'jiu-01.jpg',
        ), // 简介

     ),
//    '2'=>array( // 竟拍
//         'name' => '斯特接斯堡第114场',
//         'auction_begin_time' => $auction_timearr[2][0],
//         'auction_stop_time' => $auction_timearr[2][1],
//         'credit' => 200, // 活动积分
//         'shop_num' => 'stlsb002',
//         'setting' => array(
//             'id' => '102',
//             'name' => '尊尼获加', // 商品名
//             'price' => '0', // 初始价
//             'add' => 20, // 单次加价
//             'pic' => '', // 商品图片
//              'discrption' => "竞拍规则：点击“我要竞价”进入竞拍页面，选择“我要竞拍”，每次增加竞价金额为20元。竞拍时间结束，竞价最高的人视为竞拍成功，支付竞拍款项成功后会获得竞拍商品兑换凭证，请持凭证至蓝色港湾指定的圣诞小镇木屋兑换（竞拍商品每天只有一件哦！）。",
//             'img'=>'jiu-01.jpg',
//         ), // 简介
  
//     ),
//    '3'=> array( // 竟拍
//         'name' => '斯特接斯堡第115场',
//         'auction_begin_time' =>$auction_timearr[3][0],
//         'auction_stop_time' => $auction_timearr[3][1],
//         'credit' => 200, // 活动积分
//         'shop_num' =>'stlsb002',
//         'setting' => array(
//             'id' => '102',
//             'name' => '威士忌', // 商品名
//             'price' => '0', // 初始价
//             'add' => 20, // 单次加价
//             'pic' => '', // 商品图片
//              'discrption' => "竞拍规则：点击“我要竞价”进入竞拍页面，选择“我要竞拍”，每次增加竞价金额为20元。竞拍时间结束，竞价最高的人视为竞拍成功，支付竞拍款项成功后会获得竞拍商品兑换凭证，请持凭证至蓝色港湾指定的圣诞小镇木屋兑换（竞拍商品每天只有一件哦！）。",
//             'img'=>'jiu-01.jpg',
//         ), // 简介

//     ),
);

foreach ($auction_timearr as $k => $v) {
    if (strtotime($v[0]) <= $time) {
         $auction_set['auction']=$auction_setting[$k];
    }
}

if($auction_set){
    if(time()<strtotime('2015-12-20')){
        return $auction_setting[1];
    }else{
        return $auction_set;
    }
}else{
    if(time()<strtotime('2015-12-20')){
        $auction['auction']=$auction_setting[1];
        return $auction;
    }else{
        $auction['auction']=$auction_setting[0];
        return $auction;
    }
}




?>