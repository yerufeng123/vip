<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/strasbourg/css/page_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
          <div class="orientation_set">
              <div>
                  <img src="<?php echo _STATIC_?>vip/strasbourg/img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
              </div>
          </div>
<!--弹出框二维码-->
<div class="mask_diag" data-move style="display:;" >
  <div class="mask_main">
      <div class="mask_one">
          <img src="/<?php echo $certificate->erweimaurl;?>" class="er_img">
          <h3>凭此码可享受现场优惠</h3>
          <p>具体使用详情请关注公众号<br/><a href="http://mp.weixin.qq.com/s?__biz=MzAwODcyNzQ0OA==&mid=400101983&idx=1&sn=5783012ad3f94b57195a18e38a2d8dea&scene=1&srcid=1029GPxnSFMJm7NyqgVwLz6J&from=singlemessage&isappinstalled=0#wechat_redirect" target="_blank">“斯特拉斯堡圣诞集市”</a></p>
          <a href="/strasbourg/register/tag" class="diag_btn">点亮集市铭牌</a>
      </div>
  </div>
</div>
<div id="wrap" class="er_diag">


      
</div>

<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
?>
 <script>

/*
 * 注意：
 *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
 */

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
        'showMenuItems'
    ]
});

</script>
 <script>
                 
                                        wx.ready(function() {
                                        	wx.hideMenuItems({
                                        	    menuList: [
                                        	       'menuItem:share:appMessage',
                                        	       'menuItem:share:timeline',
                                        	       'menuItem:share:qq',
                                        	       'menuItem:share:weiboApp',
                                        	       'menuItem:favorite',
                                        	       'menuItem:share:facebook',
                                        	       'menuItem:share:QZone',
                                        	       'menuItem:editTag',
                                        	       'menuItem:delete',
                                        	       'menuItem:copyUrl',
                                        	       'menuItem:originPage',
                                        	       'menuItem:readMode',
                                        	       'menuItem:openWithQQBrowser',
                                        	       'menuItem:openWithSafari',
                                        	       'menuItem:share:email',
                                        	       'menuItem:share:brand'
                                        	       
                                        	   ] 
                                        	});

                                        });
    </script>
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
		})
</script>
</body>
</html>
