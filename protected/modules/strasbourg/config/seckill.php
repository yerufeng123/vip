<?php
header("Content-type: text/html; charset=utf8");
$time = time();
$seckill_timearr=array();
for ($i=0;$i<24;$i++){
    $start1=date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+$i*3600+15*60);
    $end1=date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+$i*3600+30*60);
    $start2=date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+$i*3600+45*60);
    $end2=date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+$i*3600+60*60);
    $seckill_timearr[2*$i][]=$start1;
    $seckill_timearr[2*$i][]=$end1;
    $seckill_timearr[2*$i+1][]=$start2;
    $seckill_timearr[2*$i+1][]=$end2;
}

$seckill_setting =array();
for ($i=0;$i<24;$i++){
    $data1=array( // 秒拍
        'name' => '斯特接斯堡秒拍活动'.date('Y年m月d日H时第一场'),
        'miao_begin_time' => $seckill_timearr[2*$i][0],
        'miao_stop_time' => $seckill_timearr[2*$i][1],
        'past_time' =>5,    // 秒拍商品过期时间 /分钟 未支付可重新秒拍
        'shop_num' => 'stlsb108',
        'setting' => array(
            'id' => '18', // 商品ID
            'name' => '圣诞宝宝圣诞套装版(12个)', // 商品名
            'price' => '0.01', // 商品价格
             // 'pic' => '', // 商品图片
            'sale_num' => 10, // 可售数量
            'discrption' => '圣诞宝宝全部是由手工制作、手工编制，每一件成品都有自己独特的风格',
            'img'=>'jp_img.jpg',
        )
    );
    $data2=array( // 秒拍
        'name' => '斯特接斯堡秒拍活动'.date('Y年m月d日H时第二场'),
        'miao_begin_time' => $seckill_timearr[2*$i+1][0],
        'miao_stop_time' => $seckill_timearr[2*$i+1][1],
        'past_time' =>5,    // 秒拍商品过期时间 /分钟 未支付可重新秒拍
        'shop_num' => 'stlsb108',
        'setting' => array(
            'id' => '19', // 商品ID
            'name' => '手工果酱12瓶套装版', // 商品名
            'price' => '0.02', // 商品价格
             // 'pic' => '', // 商品图片
            'sale_num' => 20, // 可售数量
            'discrption' => '果实不仅要百分百原产地，且每一颗都必须完全熟透，12种口味，期待你把它们带回家哟！',
            'img'=>'sggj.png',
        )
    );
    $seckill_setting[]=$data1;
    $seckill_setting[]=$data2;
}



foreach ($seckill_timearr as $k => $v) {
    if ( strtotime($v[0]) <= $time) {
         $seckill_set[Constant::CHANNEL_SECKILL]=$seckill_setting[$k];
    }
}

if($seckill_set){
    return  $seckill_set;
}else{
      $seckill[Constant::CHANNEL_SECKILL]=$seckill_setting[0];
      return  $seckill;
}


?>