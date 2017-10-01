<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/game_index.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
    <div class="orientation_set">
            <div>
                <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
            </div>
    </div>
<!--请将屏幕竖向浏览-->
<div id="wrap" class="game_er" data-move>
      <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_snow_tu.png" class="snow_tu">
      <div class="g_er_main">
          <div class="g_er_ps">
              <img src="<?php echo  Yii::app()->request->hostInfo.'/'.$ewm['erweimaurl']; ?>" class="g_er_tu">
              <span class="g_er_num"><?php echo $ewm['code']; ?></span>
              <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_er_tit.png" class="g_er_tit">

          </div>
      </div>

      <!-- login_offer_two 两个数据   login_offer_three 三个数据-->
      <ul class="login_offer er_offer">
        <li class="g_er_btn"><a href='<?php echo $this->createUrl('active/my_certificate',array('type'=>1,'atype'=>Constant::CHANNEL_GAME));?>'>兑换凭证管理</a></li>
      </ul>
      <p class="g_er_detail">保存二维码页面，或在“斯特拉斯堡圣诞集市”公众号个人中心兑换凭证中管理兑换凭证，并在12月5号、10号、11号、12号、17号到蓝色港湾处兑换礼品。</p>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
  		//页面大小初始化
      (function(){
          var _width = document.body.clientWidth;
          var _dom = document.querySelector('#viewport');
          var scale = _width/320;
          _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
      })()
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
     function check(){
         $.post('<?php echo $this->createUrl('active/certificate_validate');?>',{qrcode:'<?php echo $ewm['code']; ?>',ctype:2},function(data){
             if(data.code == 2000){
                location.href='<?php echo $this->createUrl('active/certificate_validate');?>'+'?qrcode='+<?php echo $ewm['code']; ?>+'&ctype=2';
             }

         },'json');
     }
     var start= setInterval(function(){
    	 check();
       }, 3000);
})

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
