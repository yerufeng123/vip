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
<!-- 修改 --><meta id="viewport" name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=2.0,user-scalable=no">
    <title>民生信用卡十周年庆典邀请函</title>
	<link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/minsheng/css/common.css<?php echo (Yii::app()->params['minsheng']['isradom']) ? '?radom=' . time() : ''; ?>">
    <script>
		var h5 = { 
			skip 		:"draw",	
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:2,			//懒加载页面个数
			bg_audio	:"<?php echo _STATIC_ ?>vip/minsheng/video/bg.mp3<?php echo (Yii::app()->params['minsheng']['isradom']) ? '?radom=' . time() : ''; ?>"//背景音乐
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
	<script>
		//页面大小初始化
		(function(){
			var _width = document.body.clientWidth;
			var _dom = document.querySelector('#viewport');
			var scale = _width/320;
			_dom.setAttribute('content', 'width=320,user-scalable=no,initial-scale='+scale);
		})()
	</script>
  	<div id="wrap" >
		<div id="preload"></div>
  		<ul id="page_list" stage="">
<!-- 修改开始 -->
  			<li class="page show" id="p1" scene="1" stop-move="-1">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/logo.png" class="logo" delay="0">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p1_icon1.png" class="p1_icon" delay="0">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p1_tit.png" class="p1_tit move_up" delay="1000">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p1_icon2.png" class="p1_icon2" delay="2000">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p1_text.png" class="p1_text move_big" delay="1000">
  			</li>
  			<li class="page" id="p2" scene="2">
				<h3 class="p2_tit move_left" delay="500">尊敬的阁下：</h3>
                                <p class="p2_text1" delay="1500">
				&emsp;&emsp;为答谢您对民生信用卡长期以来的支持与关爱,诚邀您拔冗莅临2015年6月16日于北京国贸大酒店举办的“民生信用卡发卡十周年庆典”与我们共同见证成长,分享荣耀！
                                </p>
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p2_text.png" class="p2_text2 move_up" delay="2500">
				<div class="p2_add move_big" delay="3500">
					<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p2_add2.png" class="p2_point active_big" delay="4500">
					<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p2_add3.png" class="p2_addicon active_opacity" delay="5000">
					<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p2_add4.png" class="p2_addText move_big" delay="4500">
				</div>
  			</li>

  			<li class="page" id="p3" scene="3" stop-move="1">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p3_tit.png" class="p3_tit move-more_up" delay="1000">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p3_text.png" class="p3_text move_big" delay="2500">
				<img src="<?php echo _STATIC_ ?>vip/minsheng/img/p3_logo.png" class="p3_logo move_up" delay="500">
  			</li>
<!-- 修改结束 -->
  		</ul>
		<div id="audio"></div>
	<img id="drop_down" src="<?php echo _STATIC_ ?>vip/minsheng/img/icon_up.png">
    </div> 
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/minsheng/js/slide.js<?php echo (Yii::app()->params['minsheng']['isradom']) ? '?radom=' . time() : ''; ?>" defer="defer"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/minsheng/js/zepto.min.js<?php echo (Yii::app()->params['minsheng']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/minsheng/js/init.js<?php echo (Yii::app()->params['minsheng']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['minsheng']['wxappid'], Yii::app()->params['minsheng']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
            var title = '民生信用卡发卡十周年庆典\n邀请函';//分享标题
            var desc = '';//分享描述
            var link = 'http://' + window.location.host + '/minsheng/index';//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/minsheng/img/share.png?radom=<?php echo time();?>';//分享图标
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
            wx.ready(function() {
                //分享到朋友圈
                wx.onMenuShareTimeline({
                    title: title, // 分享标题
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function() {
                        // 用户确认分享后执行的回调函数
                        //shareok('friends');
                    },
                    cancel: function() {
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
                    success: function() {
                        // 用户确认分享后执行的回调函数
                        //shareok('friend');
                    },
                    cancel: function() {
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
                    success: function() {
                        // 用户确认分享后执行的回调函数
                        //shareok('qq');
                    },
                    cancel: function() {
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
                    success: function() {
                        // 用户确认分享后执行的回调函数
                        //shareok('weibo');
                    },
                    cancel: function() {
                        // 用户取消分享后执行的回调函数
                        // sharecancel('weibo');
                    }
                });

            });
        </script>
  </body>
</html>