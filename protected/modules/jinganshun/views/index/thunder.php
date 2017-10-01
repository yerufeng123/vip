<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>员工风采</title>
</head>

<body>
    
<div class="wrap" id="Honor">


  	<div class="top">
    	<div class="logo">
        	<img src="<?php echo _STATIC_?>vip/jinganshun/images/logo.png">
        </div>
        <div class="logo_nav ygfc_nav">
            <p class="intro_tit">员工风采<br/><span>Company profile</span></p>
            <img src="<?php echo _STATIC_?>vip/jinganshun/images/fc_tu1.png" class="fc_tu1">
            <img src="<?php echo _STATIC_?>vip/jinganshun/images/fc_tu2.png" class="fc_tu2">
            <img src="<?php echo _STATIC_?>vip/jinganshun/images/fc_tu3.png" class="fc_tu3">
        </div>
        
    </div>
    
    <div class="ygfc_main">
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/coffee.png" class="coffee">
        <div class="ygfc_ren">
            <span class="ygfc_t1 ygfc_com"></span>
            <span class="ygfc_t2 ygfc_com"></span>
            <span class="ygfc_t3 ygfc_com"></span>
            <span class="ygfc_t4 ygfc_com"></span>
            <span class="ygfc_t5 ygfc_com"></span>
            <span class="ygfc_t6 ygfc_com"></span>
            <span class="ygfc_t7 ygfc_com"></span>
        </div>
    </div>
    <div class="mask" style="display:none">
        <span class="close_btn_new">X</span>

    	<div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu3.jpg" class="hx_photo select">
    	     <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu1.jpg" class="hx_photo">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu12.jpg" class="hx_photo">
        </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu10.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu2.jpg" class="hx_photo">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu13.jpg" class="hx_photo">
	    </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu6.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu5.jpg" class="hx_photo">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu14.jpg" class="hx_photo">
	    </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu8.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu7.jpg" class="hx_photo">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu15.jpg" class="hx_photo">
	    </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu4.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu16.jpg" class="hx_photo">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu19.jpg" class="hx_photo">
	    </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu9.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu17.jpg" class="hx_photo">
	    </div>

	    <div class="sh_diag">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu11.jpg" class="hx_photo select">
             <img src="<?php echo _STATIC_?>vip/jinganshun/images/thunder_tu18.jpg" class="hx_photo">
	    </div>
	</div>

<script type="text/javascript" src="<?php echo _STATIC_?>vip/jinganshun/js/slide.js"></script>   	
    
    
<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/zepto.min.js"></script>
         <script>
                       //页面大小初始化
                       (function () {
                           var _width = document.body.clientWidth;
                           var _dom = document.querySelector('#viewport');
                           var scale = _width / 320;
                           _dom.setAttribute('content', 'width=320,user-scalable=no,initial-scale=' + scale);
                       })()
        </script>
<script type="text/javascript">
    $(function(){
//关闭效果
	    $(".ygfc_com").on("touchstart",function(){
	    	$('.mask').show();
	    	$('.sh_diag').removeClass('show').eq($(this).index()).addClass('show');
	    })
	    function _address(_index){
	        $('.hx_photo').attr('src','img/'+_index+'.jpg');
	        $('.mask_tit').html(page.mask_tit[_index]);
		}
    	$(".mask_diag").bind("touchmove",function(e){e.preventDefault();})
 //划动效果
    $( ".cont .left_btn" ).bind("touchstart", function (){
        play(-1);
    });
    $( ".cont .right_btn" ).bind("touchstart", function (){
        play(1);
    });

    var slide = new Slide(".mask");
    slide.SlideX = function(_dir){
    	play(_dir);
    }
    //图片滚动切换
    function play(_dir){
    	var _mask = $('.mask .sh_diag.show');
    	var _photo = $('.mask .sh_diag.show .hx_photo');
    	var _index = _mask.find(".select").removeClass('select').index();
    	var _length = _photo.length;
    	_index = (_index+_length + _dir)%_length;
    	_photo.eq(_index).addClass('select');
    }
    $(".close_btn_new").bind("touchstart",function(){
        $(".mask").hide();

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
</div>
</body>
</html>
