<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_; ?>vip/yaoyiyao/css/common.css?random=<?php echo time(); ?>" rel="stylesheet">
        <title>盛景摇一摇</title>
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
    </head>
    <body>
        <div id="wrap" class="wrap">
            <div class="mask_top">
                <div id="line">
                    <ul id="thelist"></ul>
                </div>
            </div>
            <div class="img_box" id="center">
                <ul id="page_list">
                    <?php foreach ($media as $k => $v): ?>
                        <li class="page page1"><a href="javascript:void(0)"><img src="<?php echo $v; ?>"/></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="mask_bot">
                <div class="dialog">
                    <span><?php echo $text; ?></span>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
        </script>	
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/jquery-2.1.1.min.js?random=<?php echo time(); ?>"></script>
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/script.js?random=<?php echo time(); ?>"></script>
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/slide.js?random=<?php echo time(); ?>"></script>
    </body>
</html>
