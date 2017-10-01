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
    <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.5,minimum-scale=0.5,user-scalable=no">
    <title>大众汽车</title>
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
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/two/js/loading.js"></script>
  	<div id="wrap" style="visibility: hidden"> 
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/car1.png" class="car1 out-bottom" delay="1300">
          <div class="p1_p word out-top" delay="600"></div>
  			</li>
        <li class="page" id="p2" scene="2" >
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg2_1.jpg" class="p2_pic1" delay="300">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg2_2.jpg" class="p2_pic2" delay="900">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg2_3.jpg" class="p2_pic3" delay="1500">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg2_4.jpg" class="p2_pic4" delay="2100">
          <div class="p2_p out-bottom" delay="3200">
            <div class="word"></div>
          </div>
        </li>
        <li class="page" id="p3" scene="3">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg3_1.jpg" class="p3_pic1 out-more_top" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg3_2.jpg" class="p3_pic2 out-more_bottom" delay="600">
          <div class="p3_p1 word out-right" delay="1600"></div>
          <div class="p3_p2 word out-left" delay="2000"></div>
        </li>
        <li class="page" id="p4" scene="4">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg4_1.jpg" class="p4_pic1 out-most_top" delay="300">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg4_2.jpg" class="p4_pic2 out-most_bottom" delay="900">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg4_3.jpg" class="p4_pic3 out-most_top" delay="1500">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg4_4.jpg" class="p4_pic4 out-most_bottom" delay="2100">
          <div class="p4_icon">
            
            <div class="p4_p out-big" delay="2800">
              <div class="word"></div>
            </div>
            <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/car2.png" class="car2 out-more_left" delay="4000">
          </div>
        </li>

        <li class="page" id="p5" scene="5">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg5_1.jpg" class="p5_pic1 out-more_top" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg5_2.jpg" class="p5_pic2 out-more_bottom" delay="600">
          <div class="p5_p">
            <div class="p5_text out-most_left" delay="1500">
              <div class="word out-big"  delay="2700"></div>
            </div>
          </div>
        </li>

        <li class="page" id="p6" scene="6">
          <div class="p6_w">
            <div class="p6_p out-most_left" delay="600">
              <div class="word"></div>
            </div>
          </div>
          
        </li>

        <li class="page " id="p7" scene="7">
          <div class="p7_p1 word out-more_bottom" delay="600"></div>
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/car3.png" class="car3 out-small" delay="1500">
          <div class="p7_p2 word out-more_bottom" delay="2400"></div>
        </li>

        
		<li class="page" id="p8" scene="8">
		  <ul class="p8_list" delay="2500">
			<img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg9_1.jpg" class="p9_pic1 out-most_bottom" delay="600">
            <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg9_2.jpg" class="p9_pic2 out-most_bottom" delay="1400">
            <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg9_3.jpg" class="p9_pic3 out-most_bottom" delay="2200">
          </ul>
		</li>
		<li class="page " id="p9" scene="9">
            <div class="p8_li li1 out-bottom" delay="900"></div>
            <!-- <div class="p8_li li2 out-bottom" delay="1700"></div>
            <div class="p8_li li3 out-bottom" delay="2500"></div> -->
            <div class="p8_li li4 out-bottom" delay="1700"></div>
            <!-- <div class="p8_li li5 out-bottom" delay="4100"></div> -->
            <div class="p8_li li6 out-bottom" delay="2500"></div>
            <div class="p8_li li7 out-bottom" delay="3300"></div>
        </li>
        <li class="page" id="p10" scene="10" stop-move="1">
          <img pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/bg10.jpg" class="p10_pic"  delay="1200">
          <div class="p10_p word out-top" delay="600"></div>
        </li>
  		</ul>
      <img id="drop_down" pre-src="<?php echo _STATIC_ ?>vip/dazhong/two/img/btn_down.png">
      <!--<audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/dazhong/two/video/bg.mp3"></audio>-->
      <div id="music" class='on'>
        <div class="logo"></div>
      </div>
    </div> 
	  <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/two/js/slide.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/two/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/two/js/init.js"></script>
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
            var title = '全新Golf GTE，演绎疾速全新形态';//分享标题
            var desc = '';//分享描述
            var link = 'http://' + window.location.host + '/dazhong/indextwo?_wv=1';//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/dazhong/img/share1.png';//分享图标
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