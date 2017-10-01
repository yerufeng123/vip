<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="email=no">
    <meta name="viewport" content="width=415,minimum-scale=.6,maximum-scale=4.0,user-scalable=no">
    <title>奇正藏药</title>
    <link rel="stylesheet" href="<?php echo _STATIC_?>h5/css/page.css">
    <link rel="stylesheet" href="<?php echo _STATIC_?>h5/css/common.css">
  </head>
  <body> 
  	<div id="wrap" >
  		<ul id="page_list" stage="">
  			<li class="page show page5" id="page1" scene="1" stop-move="-1">
  				<div class="photo"></div>
  			</li>
  			<li class="page page6" id="page2" scene="2" stop-move="1">
  				<div class="photo"></div>
  			</li>
  		</ul>
  		<img id="drop_down" class="active_drop_up" src="<?php echo _STATIC_?>h5/img/icon_up.png">
    </div> 
  </body>
    <script>
		var h5 = { 
			skip 		:"line",
			maskX		:50,
			maskY		:50,
			maskZ		:100,
			x 			:50,
			y 			:50,
			z      		:100,
			sign 		:false
		}
		
	</script>
	<script type="text/javascript" src="<?php echo _STATIC_?>h5/js/slide.js" defer="defer"></script>
    <script type="text/javascript" src="<?php echo _STATIC_?>h5/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_?>h5/js/init.js"></script>
</html>