<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/pay_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<div id="wrap" class="pay_one" data-move>
    <div class="p_main">
    <h3 class="pay_hx_tit">凭证核销成功</h3>
    <div class="pay_main pay_hx_main">

      <div class="pay_ps">
          <ul class="hx_tp">
              <li>凭证持有者：<span><?php if($user['name']){ echo $user['name'];}else{ echo '/';}?></span></li>
              <li>凭证手机号：<a href="tel:12394827193"><?php if($user['phone']){ echo $user['phone'];}else{ echo '/';}?></a></li>
          </ul>
          <div class="hx_mid">
              <div class="hx_md_tp">
                  <h4><?php echo  '  获得'.$goods['setting']['name'];?></h4>
                <?php if($channel != Constant::CHANNEL_GAME){ ?>  <!-- <p>（<?php echo $channel;?>  奖励优惠券）</p> --><?php } ?>
              </div>
               
              <?php if($data['code'] == 1000){?>
                  <p class="pay_hx_tit1">请您给予发放</p>
              <?php }else{?>
                  <p class="pay_hx_tit1"><?php echo $msg;?></p>
              <?php }?>
          
          </div>
          <ul class="hx_bt <?php if($type != 1 && !$goods['roomnumer']){ echo  'hx_bt2';}?>">
   
            <?php if($type == 1){?>
                 <li>商户：
                <?php if($channel == Constant::CHANNEL_GAME){ echo $goods['shop_name'];} ?>   
                 <?php if($goods['roomnumer']){?>
                  <?php echo $goods['roomnumer']; ?>
                 <?php } ?>
                 </li>
              <li>商户手机号：<a href="tel:<?php echo $goods['shop_phone'];?>"><?php echo $goods['shop_phone'];?></a></li>
              <?php }else{?>
                 <li>商户：
                  <?php if($channel == Constant::CHANNEL_GAME){ echo $goods['shop_name'];} ?>   
                 <?php if($goods['roomnumer']){?>
                  <?php echo $goods['roomnumer']; ?>
                 <?php } ?>
                </li>
                <li>商户手机号：<a href="tel:<?php echo $goods['shop_phone'];?>"><?php echo $goods['shop_phone'];?></a></li>
              <?php } ?>
          </ul>

      </div>
    </div>
    <p class="hx_rule"> 
           规则说明：<br/>
      1、持凭证二维码页面，去北京蓝色港湾核销兑换<br/>
      2、兑换时间：<?php if($channel == Constant::CHANNEL_GAME){ echo '12月5号、10号、11号、12号、17号';}else{ echo '2015年12月5日-2016年1月4日'; }?><br/>
      3、活动解释归属于北京艺慧国际文化发展有限公司<br/>
    </p>
    
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/pay_bt.png" class="pay_bt">
    </div>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
		})
</script>
 <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->getSignPackage();
?>
<script>

wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"]; ?>',
    timestamp: <?php echo $signPackage["timestamp"]; ?>,
    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
    signature: '<?php echo $signPackage["signature"]; ?>',
    jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'closeWindow',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideOptionMenu'
    ]
});
</script>
<script>
wx.ready(function() {
	wx.hideOptionMenu();
});
</script>
</body>
</html>
