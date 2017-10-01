<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_; ?>vip/strasbourg/css/shake_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>
<div id="wrap" class="pay_one" data-move>
    <div class="p_main">
    <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/pay_tit_tu.png" class="pay_tit_tu">
    <h3 class="pay_one_tit">恭喜您，获得<?php echo $good['prize'];?>,请到<?php echo $business->roomnumer;?>木屋兑换领取</h3>
    <div class="pay_main pay_main_er">
      <div class="pay_ps">
          <img src="<?php echo  Yii::app()->request->hostInfo.'/'.$order['ewm']['erweimaurl']; ?>" class="shake_er"/>
          <h4 class="shake_tit">中奖凭证</h4>
      </div>
    </div>
    <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/shake_mz.png" class="shake_mz">
    <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/pay_bt.png" class="pay_bt">
    </div>
</div>

<script src="<?php echo _STATIC_; ?>vip/strasbourg/js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
		})
</script>
<script>
function check(){
    $.post('<?php echo $this->createUrl('active/certificate_validate');?>',{qrcode:'<?php echo $order['ewm']['code']; ?>',ctype:2},function(data){
        if(data.code == 2000){
           location.href='<?php echo $this->createUrl('active/certificate_validate');?>'+'?qrcode='+<?php echo $order['ewm']['code']; ?>+'&ctype=2';
        }

    },'json');
}
var start= setInterval(function(){
	 check();
  }, 3000);

</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
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
