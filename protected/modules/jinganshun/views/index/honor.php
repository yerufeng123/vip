<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css?random=<?php echo time();?>" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css?random=<?php echo time();?>" rel="stylesheet">
<title>公司荣誉</title>
</head>

<body>
<div class="wrap" id="Honor">
  	<div class="top">
    	<div class="logo">
        	<img src="<?php echo _STATIC_ ?>vip/jinganshun/images/logo.png">
        </div>
        <div class="logo_nav honor_nav">
            <p class="intro_tit">公司荣誉<br/><span>Company profile</span></p>
        </div>
        
    </div>
    
    <div class="main">
    	<div class="honor_tu">
            
        	<span class="honor_tu1" data-mask="1"></span>
            <span class="honor_tu2" data-mask="2"></span>
            <span class="honor_tu3" data-mask="3"></span>
            <span class="honor_tu4" data-mask="4"></span>
            <span class="honor_tu5" data-mask="5"></span>
            <span class="honor_tu6" data-mask="6"></span>
            <span class="honor_tu7" data-mask="7"></span>
            <span class="honor_tu8" data-mask="8"></span>
        </div>
        <div id="p2_mask" class="pic_mask" picture="1" style="display:none;">
            <span class="close close_btn_h">X</span>
        </div>
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


        $(function(){
            $(".close_btn_h").on("click",function(){ 
        $(".pic_mask").hide();
         })
        $(".pic_mask").bind("touchmove",function(e){ 
        e.preventDefault();
         })
        $("[data-mask]").on("click",function(){ 
            //alert(1);
             var val = $(this).attr("data-mask");
             $(this).parent().siblings(".pic_mask").show().attr("picture",val)
        })
        })
    </script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['jinganshun']['wxappid'], Yii::app()->params['jinganshun']['wxappsecret']);
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
                    'hideOptionMenu',
                ]
            });
            wx.ready(function () {
                //隐藏右上角菜单
                wx.hideOptionMenu();
            });
        </script>

</body>
</html>
