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
    <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
    <title>大众进口汽车</title>
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/dazhong/css/page.css">
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/dazhong/css/common.css">
    <script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:1,			//懒加载页面个数
			preload 	:true,
			bg_audio	:"<?php echo _STATIC_ ?>vip/dazhong/video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
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
 	
	<div id="preload" style="">
 	</div>
  	<div id="wrap" style="display:;">
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<div class="page_body"> 
					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p1_tit1.png" class="p1_tit1 out-top-t quicker" delay="600">
					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p1_tit2.png" class="p1_tit2 active_big quick" delay="800">
					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/means.png" class="means">
  				</div>
  			</li>
  			<li class="page" id="p2" scene="2">
				  <div class="page_body">
  					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p2_tit1.png" class="p2_tit1 out-top-t quicker" delay="600">
  					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p2_tu.jpg" class="p2_tu quicker" delay="900">
  					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p2_car.png" class="p2_car slower" delay="1200">
            <ul class="p2_list">
              <li class="out-right quicker" delay="1500">最大功率150kW</li>
              <li class="out-right quicker" delay="1600">峰值扭距350N·m</li>
              <li class="out-right quicker" delay="1700">0-100km/h 加速时需7.6秒</li>
              <li class="out-right quicker" delay="1800">最高时速可达202km/h</li>
            </ul>
  					 <img src="<?php echo _STATIC_ ?>vip/dazhong/img/means.png" class="means">
  				</div>
  			</li>
  			<li class="page" id="p3" scene="3" >
  				<div class="page_body">
  					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/p3_tit1.png" class="p3_tit1 out-top-t quicker" delay="600">
            <div class="p3_tit2 quicker" delay="800">
  					 <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p3_tit2.png">
            </div>
  					<img src="<?php echo _STATIC_ ?>vip/dazhong/img/means.png" class="means">
  				</div>
  			</li>

        <li class="page" id="p4" scene="4">
          <div class="page_body">
              <ul class="p4_tit">
                  <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tit1.png" class="p4_tit1 out-right quick" delay="600" class="p4_tit1"></li>
                  <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tit2.png" class="p4_tit2 out-right quick" delay="800"></li>
                  <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tit3.png" class="p4_tit3 out-right quick" delay="1000"></li>
              </ul>
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tu1.png" class="p4_tu1 out-right slower" delay="1200">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tu2.png" class="p4_tu2 out-left slower" delay="1400">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p4_tu3.png" class="p4_tu3 out-right slower" delay="1600">
          </div>
        </li>

        <li class="page" id="p5" scene="5" >
          <div class="page_body">
              <ul class="p5_tit">
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tit1.png" class="p5_tit1 out-top-t quick" delay="600"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tit2.png" class="p5_tit2 out-bottom-b quick" delay="800"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tit3.png" class="p5_tit3 out-bottom-b quick" delay="1000"></li>
            </ul>
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tu1.jpg" class="p5_tu1 out-right slower" delay="1200">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tu2.jpg" class="p5_tu2 out-left slower" delay="1300">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p5_tu3.jpg" class="p5_tu3 out-right slower" delay="1400">
          </div>
        </li>

        <li class="page" id="p6" scene="6">
        <div class="page_body">
            <ul class="p6_tit">
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tit1.png" class="p6_tit1 out-top-t quick" delay="600"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tit2.png" class="p6_tit2 out-left slower" delay="800"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tit3.png" class="p6_tit3 out-right slower" delay="1000"></li>
            </ul>
            <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tu1.jpg" class="p6_tu1 out-right slower" delay="1200">
            <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tu2.jpg" class="p6_tu2 out-left slower" delay="1300">
            <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p6_tu3.jpg" class="p6_tu3 out-right slower" delay="1400">
        </div>
        </li>

        <li class="page" id="p7" scene="7">
          <div class="page_body">
              <ul class="p7_tit">
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p7_tit1.png" class="p7_tit1 out-top-t quick" delay="600"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p7_tit2.png" class="p7_tit2 out-bottom-b slower" delay="800"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/dazhong/img/p7_tit3.png" class="p7_tit3 out-bottom-b slower" delay="1000"></li>
            </ul>
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p7_tu1.jpg" class="p7_tu1 out-right slower" delay="1200">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p7_tu2.jpg" class="p7_tu2 out-right slower" delay="1400">
          </div>
        </li>

       <!-- <li class="page" id="p8" scene="8">
          <div class="page_body">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p8_tit1.png" class="p8_tit1 out-top-t quicker" delay="600">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p8_tit2.png" class="p8_tit2 out-bottom-b quicker" delay="800">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p8_tit3.png" class="p8_tit3 out-bottom-b quicker" delay="1000">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p8_tit4.png" class="p8_tit4 out-bottom-b quicker" delay="1200">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/means.png" class="means">
          </div>
        </li>-->

        <li class="page" id="p9" scene="9" stop-move="1">
          <div class="page_body">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p9_tit1.png" class="p9_tit1 out-top-t quicker" delay="600">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p9_tit2.png" class="p9_tit2 active_big quick" delay="900">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/p9_tu.jpg" class="p9_tu out-bottom-b quicker" delay="1200">
              <img src="<?php echo _STATIC_ ?>vip/dazhong/img/means.png" class="means">
          </div>
        </li>
  		</ul>
      <div id="bg_music" class="on"></div>
  		<img id="drop_down" src="<?php echo _STATIC_ ?>vip/dazhong/img/drop_down.png">
    </div> 
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/js/slide.js" defer="defer"></script>
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/js/zepto.min.js"></script>
  <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/dazhong/js/init.js?1"></script>
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
            var title = '全新Golf GTE，演绎极速全新形态';//分享标题
            var desc = '';//分享描述
            var link = 'http://' + window.location.host + '/dazhong/index?_wv=1';//分享链接
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
  </body>
</html>