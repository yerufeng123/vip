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
<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>
    <?php $goods=$this->MyJsonDecode($goods);?>
<!--弹出框二维码-->
<div id="wrap" class="mp_web" data-move>
    <div class="jp_tp"></div>
    <!-- <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png" class="jp_logo"> -->
    <div class="jp_main">
        <div class="jp_tu_main jp_tu_main_er">
            <div class="jp_tu_ps">
                <img src="<?php echo  Yii::app()->request->hostInfo.'/'.$ewm['erweimaurl']; ?>" class="jp_er_img">
                <h4 class="er_tit mp_er_tit">秒拍凭证</h4>
                <p class="er_tit2 mp_er_tit2">恭喜您以秒拍价购得  <?php echo $goods['setting']['name']?>。</p>

            </div>
        </div>
        <p class="er_detail mp_er_detail">您已支付成功，请保存二维码页面，或在“斯特拉斯堡圣诞集市”公众号管理凭证，到蓝色港湾  <?php echo $shop_num;?> 木屋处兑换商品。
</p>
    </div>
    <span class="jp_enter mp_btn"><a href='<?php echo $this->createUrl('active/my_certificate',array('type'=>1,'atype'=>Constant::CHANNEL_SECKILL));?>'>秒拍凭证管理</a></span>
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
