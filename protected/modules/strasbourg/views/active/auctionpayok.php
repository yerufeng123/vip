<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/jp_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<?php $goods=$this->MyJsonDecode($goods);?>
<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>
<!--弹出框二维码-->
<div id="wrap" class="jp_web" data-move>
    <div class="jp_tp"></div>
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png" class="jp_logo">
    <div class="jp_main">
        <div class="jp_tu_main jp_pay_main">
              <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_tit1.png" class="jp_tit1">
              <p class="pay_tit1">恭喜您以竞拍价格购得</p>
              <p class="pay_tit2"><?php echo $goods['setting']['name']?></p>
              <div class="pay_price">
                  <p>竞拍价格：<span><?php echo $price;?></span> 元</p>
              </div>

             
        </div>
    </div>
    <span class="jp_enter jp_btn"><a href='<?php echo $this->createUrl('active/certificate_web',array('cid'=>$cid,'type'=>Constant::CHANNEL_AUCTION));?>'>领取竞拍凭证</a></span>
    <div class="jp_bt"></div>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/touch.js"></script>
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
