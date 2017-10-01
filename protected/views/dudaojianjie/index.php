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
    <!-- <meta http-equiv="Cache-Control" content="max-age=720000" />
    <meta http-equiv="Expires" content="Mon, 20 Jul 2016 23:00:00 GMT" /> -->
    <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.5,minimum-scale=0.5,user-scalable=no">
    <title>独到见解</title>
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/dudaojianjie/css/common.css">
    <script>
		var h5 = { 
			skip 		:"draw",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 	:true,		//页面清除动画
			address :"",		//默认地址
      preload :false,
		}
	</script>
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
  	<div id="wrap">
  		<ul id="page_list" class="draw">
	  		<li class="page show" id="p1" scene="1" stop-move="-1">
            <img src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p1_t.png" class="p1_t">
            <div class="point"></div>
		  	</li>
        <li class="page " id="p2" scene="2">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/logo.png" class="logo">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p2_i1.png" class="p2_i1" delay="1000">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p2_i2.png" class="p2_i2" delay="2900"><!-- 修改20160313 -->
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p2_t.png" class="p2_t" delay="6000">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p2_p.png" class="p2_p" delay="8000">
        </li>
        <li class="page " id="p3" scene="3">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/logo.png" class="logo">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_t.png" class="p3_t  out-top"  delay="4000">
          <div class="p3_l" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_l.png">
            <div class="point"></div>
          </div>
          <ul class="p3List" step="1">
            <li class="p3_li select">
              <div class="p3_p1 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p1.png" delay="400"></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i1.png" class="p3_i1 p3_i" delay="3000">
            </li>
            <li class="p3_li">
              <div class="p3_p2 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p2.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i2.png" class="p3_i2 p3_i" touch-delay>
            </li>
            <li class="p3_li">
              <div class="p3_p3 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p3.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i3.png" class="p3_i3 p3_i" touch-delay>
            </li>
            <li class="p3_li">
              <div class="p3_p4 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p4.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i4.png" class="p3_i4 p3_i" touch-delay>
            </li>
            <li class="p3_li">
              <div class="p3_p5 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p5.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i5.png" class="p3_i5 p3_i" touch-delay>
            </li>
            <li class="p3_li">
              <div class="p3_p6 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p6.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i6.png" class="p3_i6 p3_i" touch-delay>
            </li>
            <li class="p3_li">
              <div class="p3_p7 p3_p out-bottom" pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_p7.png" touch-delay></div>
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p3_i7.png" class="p3_i7 p3_i" touch-delay>
            </li>
          </ul>
        </li>
        <li class="page " id="p4" scene="4">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/logo.png" class="logo">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p4_t.png" class="p4_t out-top" delay="400">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p4_p.png" class="p4_p out-bottom" delay="2500">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p4_i.png" class="p4_i" delay="4000">
        </li>
        <li class="page " id="p5" scene="5" >
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/logo.png" class="logo">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5_t.png" class="p5_t" delay="200">
          <div class="p5_pic">
            <div class="p5List1">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (01).jpg" class="p5_pic1 p5_p" delay="6200">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (02).jpg" class="p5_pic2 p5_p" delay="3800">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (03).jpg" class="p5_pic3 p5_p" delay="1600">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (04).jpg" class="p5_pic4 p5_p" delay="5400">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (05).jpg" class="p5_pic5 p5_p" delay="2400">
            </div>
            <div class="p5List2">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (06).jpg" class="p5_pic6 p5_p" delay="4600">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (07).jpg" class="p5_pic7 p5_p" delay="6600">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (08).jpg" class="p5_pic8 p5_p" delay="3200">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (09).jpg" class="p5_pic9 p5_p" delay="5800">
            </div>
            <div class="p5List3">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (10).jpg" class="p5_pic10 p5_p" delay="5000">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (11).jpg" class="p5_pic11 p5_p" delay="2000">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (12).jpg" class="p5_pic12 p5_p" delay="4200">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (13).jpg" class="p5_pic13 p5_p" delay="1200">
              <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p5 (14).jpg" class="p5_pic14 p5_p" delay="2800">
            </div>
            
          </div>
        </li>
        <li class="page " id="p6" scene="6" stop-move="1">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/logo.png" class="logo">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p6_t.png" class="p6_t" delay="200">
          <img pre-src="<?php echo _STATIC_ ?>vip/dudaojianjie/img/p6_i.png" class="p6_i"  delay="1400">
<!--           <div class="p6List">
  
</div> -->
        </li>
  		</ul>
    </div>
      <div class="mask">
      <img src="" class="dia">
    </div>
    <script src="<?php echo _STATIC_ ?>vip/dudaojianjie/js/slide.js"></script>
    <script src="<?php echo _STATIC_ ?>vip/dudaojianjie/js/loading.js"></script>
    <script src="<?php echo _STATIC_ ?>vip/dudaojianjie/js/zepto.min.js"></script>
    <script src="<?php echo _STATIC_ ?>vip/dudaojianjie/js/init.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['common']['wxappid'], Yii::app()->params['common']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
            var title = '独到见解';//分享标题
            var desc = '公司简介';//分享描述
            var link = 'http://' + window.location.host + '/dudaojianjie/index?_wv=1&random=' + Math.random();//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/pingan/five/img/logo.png';//分享图标
            var type = '';// 分享类型,music、video或link，不填默认为link
            var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appId"]; ?>',
                timestamp: <?php echo $signPackage["timestamp"]; ?>,
                nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                signature: '<?php echo $signPackage["signature"]; ?>',
                jsApiList: [
                    // 所有要调用的 API 都要加到这个列表中
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareWeibo',
                ]
            });
            wx.ready(function () {
                //分享到朋友圈
                wx.onMenuShareTimeline({
                    title: desc, // 分享标题
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('friends');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('friends');
                    }
                });

                //分享给朋友
                wx.onMenuShareAppMessage({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    type: type, // 分享类型,music、video或link，不填默认为link
                    dataUrl: dataUrl, // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('friend');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('friend');
                    }
                });

                //分享到QQ
                wx.onMenuShareQQ({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('qq');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('qq');
                    }
                });

                //分享到腾讯微博
                wx.onMenuShareWeibo({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('weibo');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        // sharecancel('weibo');
                    }
                });

            });
        </script>
  </body>
</html>