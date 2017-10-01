
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
<style type="text/css">
/*公共样式*/
html,body{-webkit-tap-highlight-color:rgba(0,0,0,0);color:#302e31;font:13px "微软雅黑",Helvetica;font-size:13px;line-height:160%;margin:0;padding:0;-webkit-user-select:none;}
form,table,td,h1,h2,h3,h4,ul,ol,li,p{margin:0;padding:0;border:0;list-style:none}
input,img{vertical-align:middle}
html,body{width:100%;}
body{-webkit-text-size-adjust:none;background:#ffffff;}
img{border:0 none;max-width: 100%;height: auto;}
ol, ul {list-style: none;}
:focus {outline: 0;}
textarea{resize:none;overflow:auto;}
a{-webkit-touch-callout:none;-webkit-user-select:none;text-decoration:none}
a:link {-webkit-tap-highlight-color:rgba(229, 59, 44, 0.4)}
table {border-collapse: collapse;border-spacing: 0;}
input:focus,textarea:focus{outline:0}
a:link,a:visited,a:hover,a:active{color:#fff;}
html{font-size:10px;}
.er_bg_send{width:146px;height:147px;margin:50px auto -100px;padding-bottom:100px;display:block; vertical-align: top;}
.share h3{font-size:12px;text-align:center;font-weight:normal;}
</style>
<title>二维码</title>
</head>
<body class="thunder_bg">
<div class="share" id="thunder">
		<img src="<?php echo _STATIC_; ?>vip/aotocom/img/erweima.jpg" class="er_bg_send">
		<h3>长按二维码，关注公众号</h3>
	

</div>
<script type="text/javascript" src="<?php echo _STATIC_; ?>vip/aotocom/js/zepto.min.js"></script>
<script>
        //页面大小初始化
        (function(){ 
            var _width = document.body.clientWidth;
            console.log(_width);
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
        })()

    </script>
</body>
</html>
