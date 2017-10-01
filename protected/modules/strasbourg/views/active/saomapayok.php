<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_;?>vip/strasbourg/css/shake_detail.css" rel="stylesheet">
<title>石景山洋庙会</title>
</head>

<body>

<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_;?>vip/strasbourg/img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>

  <!-------------------------弹出框 ---------------------->
<div class="mask_diag" data-move style="display:none">
  <img src="<?php echo _STATIC_;?>vip/strasbourg/img/shake_tu1.png" class="shake_tu1">
  <div class="mask_main">
      <div class="mask_one">
          <div class="jp_tu_main">
             <p class="yz_tu"><span id="checkresult">验证<br/>成功</span></p>
        </div>
      </div>
  </div>
</div>
<div id="wrap" class="pay_one" data-move>
    <div class="p_main">
    <div class="pay_main">
      <div class="pay_ps">
          <img src="<?php echo _STATIC_;?>vip/strasbourg/img/pay_new_success.png" class="pay_new_success">
          <p class="new_yuan">已支付<?php echo $orderdata['price']?>元</p>
          <p class="new_notice">1.请在<?php echo $business->roomnumer;?>领取商品。<br/>2.付款成功请由商家验证,并领取物品。</p>
      </div>
    </div>
    <img src="<?php echo _STATIC_;?>vip/strasbourg/img/shake_tu1.png" class="shake_tu1">
    <span class="pay_com pay_bnt">验证</span>
    <img src="<?php echo _STATIC_;?>vip/strasbourg/img/pay_bt.png" class="pay_bt">
    </div>
</div>

<script src="<?php echo _STATIC_;?>vip/strasbourg/js/zepto.min.js"></script>
<script type="text/javascript">
var ordersn='<?php echo $ordersn;?>';
	$(function(){
		
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })

      $('.pay_bnt').bind('click',function(){
          if(!confirm('请让商户验证，此二维码只能验证一次，验证后二维码失效.')){
              return false;
          }
          $.post('/strasbourg/saoyisao/checkordersn',{'ordersn':ordersn},function(data){
      	     var list=eval(data);
      	     if(list.code != '10000'){
          	     $('.yz_tu').css('background','#999');
          	     $('#checkresult').html('验证<br/>失败');
       	    	$('.mask_diag').show();
          	 }else{
           		$('.yz_tu').css('background','#993023');
           		$('#checkresult').html('验证<br/>成功');
       	    	$('.mask_diag').show();
             }
          },'json');
  	     
       });
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
