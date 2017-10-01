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
    <meta id="viewport" name="viewport" content="width=415,maximum-scale=8,minimum-scale=0.2,user-scalable=no">
    <title>平安银行</title>
    <style>
    </style>
    <!-- <link rel="stylesheet" href="css/page.css"> -->
    <script>
		var h5 = { 
			skip 		:"draw",	
      move    :1,//1为竖直滑动切换，0为水平滑动切换
			clear 	:true,		//页面清除动画
			address :"",		//默认地址
      preload :false,
			lazy 		:3,			//懒加载页面个数
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
  	<style>
      html,body{margin:0;width: 100%;height: 100%;}
      #preload{ position: fixed; left: 0; top: 0; right: 0; bottom: 0; background-color: #000; z-index: 999;}
      #load_num{ position:absolute; left: 50%;top: 50%;-webkit-transform:translate(-50%,-50%); transform:translate(-50%,-50%); color: #fff; font-size: 40px;}
    </style>
    <div id="preload">
      <div id="load_num">0%</div>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/two/js/loading.js"></script>
  	<div id="wrap"> 
  		<ul id="page_list" stage=" visibility: hidden;">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/logo.png" class="logo">
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p1_tit.png" class="p1_tit out-top" delay="300">
  				<div class="p1_light1 light  out-top" delay="300">
  					<span delay="1300"></span>
  				</div>
  				<div class="p1_light2 light  out-top" delay="300">
  					<span delay="1800"></span>
  				</div>
  				<div class="p1_i">
  					<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p1_i1.png" class="p1_i1 active_rotate" delay="1800">
  				</div>
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p1_i2.png" class="p1_i2 out-bottom"  delay="600">
  			</li>
	        <li class="page" id="p2" scene="2" >
	        	<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/logo.png" class="logo">
				<div class="p2_p1 out-bottom" delay="300">诚 挚 邀 请 阁 下 莅 临 盛 典</div>
				<div class="p2_p2 out-bottom" delay="800">时 间：2015年12月8日（星期二）</div>
				<div class="p2_p3 out-bottom" delay="1300">签到时间：10:00-10:30</div>
				<div class="p2_p4 out-bottom" delay="1800">典礼时间：10:40-11:40</div>
				<div class="p2_p5 out-bottom" delay="2300">地 点：北京朝阳区新源南路1号 （燕莎桥西100米路北）</div>
				<img src="<?php echo _STATIC_ ?>vip/pingan/two/img/boat.png" class="p2_i layer" data-depth="0.2">
				<span class="flash" delay="600"></span>
				<span class="flash" delay="800"></span>
				<span class="flash" delay="1000"></span>
	        </li>
	        <li class="page" id="p3" scene="3">
	        	<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/logo.png" class="logo">

	        	<dl class="p3_list">
	        		<dt class="p3_lt">典  礼  流  程</dt>
	        		<dd class="p3_li out-more_right" delay="300"><span>10:00 － 10:30</span>迎宾签到</dd>
	        		<dd class="p3_li out-more_right" delay="800"><span>10:38 － 10:40</span>主持人开场</dd>
	        		<dd class="p3_li out-more_right" delay="1300"><span>10:40 － 10:45</span>总行领导致辞</dd>
	        		<dd class="p3_li out-more_right" delay="1800"><span>10:45 － 10:50</span>分行领导致辞</dd>
	        		<dd class="p3_li out-more_right" delay="2300"><span>10:50 － 10:55</span>宣传片播放</dd>
	        		<dd class="p3_li out-more_right" delay="2800"><span>10:55 － 11:00</span>授卡仪式</dd>
	        		<dd class="p3_li out-more_right" delay="3300"><span>11:00 － 11:05</span>启动仪式</dd>
	        		<dd class="p3_li out-more_right" delay="3800"><span>11:05 － 11:10</span>合影留念</dd>
	        		<dd class="p3_li out-more_right" delay="4300"><span>11:10 － 11:40</span>入场参观</dd>
	        		<dd class="p3_li out-more_right" delay="4800"><span>11:40</span>典礼结束</dd>
	        		<div class="p3_i" delay="300"></div>
	        	</dl>
	        	<span class="flash" delay="300"></span>
				<span class="flash" delay="600"></span>
				<span class="flash" delay="900"></span>
				<span class="flash" delay="1200"></span>
	        </li>
	        <li class="page" id="p4" scene="4">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/logo.png" class="logo">
				<div class="p4_p">典 礼 地 址</div>
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p4_i1.png" class="p4_i1 out-small" delay="300">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p4_i2.png" class="p4_i2 active_down" delay="1800">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p4_i3.png" class="p4_i3 out-right" delay="1300">
				<span class="flash" delay="600"></span>
				<span class="flash" delay="300"></span>
				<span class="flash" delay="1200"></span>
				<span class="flash" delay="900"></span>
	        </li>

	        <li class="page" id="p5" scene="5" stop-move="1">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/logo.png" class="logo">
				<div class="p5_light1 light out-bottom"  delay="300"></div>
  				<div class="p5_light2 light out-bottom"  delay="900"></div>
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i1.png" class="p5_i1 out-bottom" delay="300">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i2.png" class="p5_i2 out-bottom" delay="900">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i3.png" class="p5_i3 out-bottom" delay="1500">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i4.png" class="p5_i4 out-bottom" delay="2100">

				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i5.png" class="p5_i5 out-right" delay="3000">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i6.png" class="p5_i6 out-left" delay="3000">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i7.png" class="p5_i7 wave1">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/p5_i8.png" class="p5_i8 wave2">
				<img pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/boat.png" class="p5_i9 layer" data-depth="0.2">

	        </li>
  		</ul>
      <img id="drop_down" pre-src="<?php echo _STATIC_ ?>vip/pingan/two/img/btn_down.png">
      <audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/pingan/two/video/bg.mp3"></audio>
      <div id="music" class='on'>
        <div class="logo"></div>
      </div>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/two/js/parallax.js"></script>
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/two/js/slide.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/two/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/two/js/init.js"></script>
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
            var title = '平安银行北京分行智能旗舰店开业典礼邀请函';//分享标题
            var desc = '平安银行北京分行智能旗舰店诚挚邀请阁下莅临盛典';//分享描述
            var link = 'http://' + window.location.host + '/pingan/indextwo?_wv=1&random=' + Math.random();//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/pingan/img/share.png';//分享图标
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
        <script>
            $(function () {
                document.addEventListener('WeixinJSBridgeReady', function () {
                    document.getElementById('audio').play();
                }, false);
            });
        </script>
  </body>
</html>