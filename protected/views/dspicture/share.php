<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_ ;?>vip/dspicture/css/share.css" rel="stylesheet">
<!--百度统计代码-->
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?eeaa8a516c91370264450e1eee60e97d";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
<title>DS汽车</title>
</head>

<body>
<div id="wrap" class="shop_login">
  	<div class="shop_share"> 
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_show.png" class="p6_show">
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/share_tit.png" class="share_tit">
        <div class="share_block">
          <div class="share_main share_main2">
            <img src="<?php echo $user->pic;?>" class="share_tu" style="position:static!important;">
            <div class="share_name">
                <h3><?php echo $user->name;?></h3>
                <span>所在城市：<?php echo $user->city;?></span>
            </div>
            <p class="share_text"><?php echo $user->text;?></p>
          </div>
         <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/join_btn.png" class="share_btn" onclick="javascript:location.href='/dspicture/index'">
        </div>
	</div>
</div>


<script type="text/javascript" src="<?php echo _STATIC_ ;?>vip/dspicture/js/zepto.min.js"></script>
<script type="text/javascript">
  $(function(){
     //页面大小初始化
        (function(){
            var _width = document.body.clientWidth;
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
        })()
    $("body").height($("body").height());
    })
</script>

</body>
</html>
