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
    <meta id="viewport" name="viewport" content="width=415,minimum-scale=0.5,maximum-scale=2.0,user-scalable=no">
    <title>个人视频秀</title>
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
    <style>
        html,body{-webkit-tap-highlight-color:rgba(0,0,0,0);color:#302e31;font:13px/1.6 "微软雅黑",Helvetica;margin:0;padding:0;-webkit-user-select:none;width:100%;height:100%;}
        form,table,td,h1,h2,h3,h4,ul,ol,li,p{margin:0;padding:0;border:0;list-style:none}
        input,img{vertical-align:middle}
        html,body{min-width:100%;background:#000;}
        body{-webkit-text-size-adjust:none;}
        img{border:0 none;max-width:100%;height:auto;}
        ol,ul{list-style:none;}
        :focus{outline:0;}
        textarea{resize:none;overflow:auto;}
        a{-webkit-touch-callout:none;-webkit-user-select:none;text-decoration:none}
        a:link {-webkit-tap-highlight-color:rgba(229,59,44,0)}
        table{border-collapse: collapse;border-spacing: 0;}
        input:focus,textarea:focus{outline:0}
    </style>
  </head>
  <body style="background-size:cover;background-image: url('<?php echo _STATIC_ ?>vip/marry/img/mybackground.jpg')"> 
        <video id="myvideo" src="<?php echo _STATIC_ ?>vip/marry/video/test5.mp4" controls="controls" width=100% height=100% preload>
            your browser does not support the video tag
        </video>
  </body>
</html>