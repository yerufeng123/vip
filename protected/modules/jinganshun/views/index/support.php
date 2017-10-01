<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<!--<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0,user-scalable=0" />
	<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css" rel="stylesheet">
	<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/pagetwo.css" rel="stylesheet">
	<title>京安顺</title>
</head>
<body class="thunder_bg2">
	<div class="wrap2" id="thunder">
		<img class="dj_logo" src="<?php echo _STATIC_ ?>vip/jinganshun/images/dj_logo.png" />
		<div class="dj_mask">
			<img src="<?php echo _STATIC_ ?>vip/jinganshun/images/dj_img.png" />
			<p>谢谢您<br>点赞成功了！</p>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/zepto.min.js"></script>
	<script>
		//页面大小初始化
		(function(){ 
			var _width = document.body.clientWidth;
			var _dom = document.querySelector('#viewport');
			var scale = _width/320;
			_dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
		})()
	</script>
</body>
</html>
