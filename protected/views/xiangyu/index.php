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
    <meta id="viewport" name="viewport" content="width=360,maximum-scale=3,minimum-scale=0.3,user-scalable=no">
    <title>相寓</title>
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/xiangyu/css/page.css?random=<?php echo time();?>">
    <script>
		var h5 = { 
			skip 		:"draw",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
      move    :1,//1为竖直滑动切换，0为水平滑动切换
			clear 	:true,		//页面清除动画
			address :"",		//默认地址
			lazy 		:3,			//懒加载页面个数
			//bg_audio	:"video/onlyTime.mp3",		//背景音乐URL和对背景音乐的操作对象
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
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
          <div class="logo out-top " delay="500"></div>
          <span class="p1_t out-top " delay="1000"></span>
          <span class="p1_p out-bottom " delay="1000"></span>
          <div class="p1_i out-rotateY" delay="1500">
            <canvas id='canvas' class=" icon"  width="403" height="391">你的版本不支持canvas，请使用最新的版本</canvas>
          </div>
          <div class="p1_point out-bottom "  delay="2000"></div>
          <div class="p1_shou active_move" delay="2500"></div>
          
  			</li>
        <li class="page " id="p2" scene="2">
          <div class="p2_i out-more_top" delay="2500">
            <div class="icon "></div>
          </div>
          <span class="p2_t out-right " delay="500"></span>
          <span class="p2_p1 out-right " delay="1000"></span>
          <span class="p2_p2 out-big " delay="1500"></span>
          <span class="p2_p3 out-bottom " delay="2000"></span>
        </li>
        <li class="page " id="p3" scene="3">
          <span class="p3_t out-top " delay="500"></span>

          <ul class="p3_list" delay="1000">
            <li class="p3_li" style="background-image:url(<?php echo _STATIC_ ?>vip/xiangyu/img/phone.jpg)"></li>
            <li class="p3_li select" style="background-image:url(<?php echo _STATIC_ ?>vip/xiangyu/img/phone.jpg)"></li>
            <li class="p3_li" style="background-image:url(<?php echo _STATIC_ ?>vip/xiangyu/img/phone.jpg)"></li>
            <li class="p3_li" style="background-image:url(<?php echo _STATIC_ ?>vip/xiangyu/img/phone.jpg)"></li>
            <li class="p3_li" style="background-image:url(<?php echo _STATIC_ ?>vip/xiangyu/img/phone.jpg)"></li>
          </ul>
          <div class="p3_i active_rotate " delay="1500"></div>
          <span class="p3_p out-bottom " delay="2500"></span>
        </li>
        <li class="page " id="p4" scene="4">
          <span class="p4_t out-top " delay="500"></span>
          <span class="p4_p out-right " delay="1000"></span>
          <ul class="p4_list">
            <li class="p4_li1 " delay="2000"></li>
            <li class="p4_li2 " delay="2500"></li>
            <li class="p4_li3 " delay="3000"></li>
            <li class="p4_li4 " delay="3500"></li>
            <li class="p4_li5 out-small " delay="1500"></li>
          </ul>
          <span class="p4_p2 out-top " delay="4000"></span>
          <div class="icon out-bottom " delay="4500"></div>
        </li>
        <li class="page " id="p5" scene="5">
          <span class="p5_t out-big " delay="500"></span>
          <span class="p5_p out-right " delay="1000"></span>
          <div class="p5_i out-big" delay="1500">
            <span class="p5_w out-bottom" delay="2000">相寓：利用先进的互联网技术、<br/>智能科技、金融资本和社交媒体等资源，<br/>打造一个能够Plus更多，Link更多<br/>金融类和生活类资源的房屋<br/>资产管理服务平台。</span>
          </div>
        </li>
        <li class="page " id="p6" scene="6">
          <span class="logo out-top " delay="500"></span>
          <dl class="p6_list out-bottom" delay="800">
            <div class="p6_line"></div>
            <dt class="p6_li">发布会日程</dt>
            <dd class="p6_li out-right" delay="1000">14:00-14:30 签到入场</dd>
            <dd class="p6_li out-right" delay="1300">14:30-14:40 开场视频</dd>
            <dd class="p6_li out-right" delay="1600">14:40-14:50 伟业我爱我家集团副总裁胡景晖致辞</dd>
            <dd class="p6_li out-right" delay="1900">14:50-14:55 相寓品牌发布仪式</dd>
            <dd class="p6_li out-right" delay="2200">14:55-15:25 相寓PARK产品发布</dd>
            <dd class="p6_li out-right" delay="2500">15:25-15:55 北京相寓总经理刘洋演讲<br/><span class="font_hide">15:25-15:55 </span>金融让租住更美好</dd>
            <dd class="p6_li out-right" delay="2800">15:55-16:35 因改变而生<br/><span class="font_hide">15:55-16:35 </span>新租住&nbsp;新金融&nbsp;新生活主题论坛</dd>
            <dd class="p6_li out-right" delay="3100">16:35-17:00 温馨茶点&emsp;活动淡出</dd>
            
          </dl>
          <div class="p6_i out-small " delay="3600"></div>
        </li>
        <li class="page " id="p7" scene="7">
          <span class="logo out-top " delay="500"></span>
          <div class="p7_cnt">
            <p class="p7_p out-bottom" delay="1000">日期：2015年9月23日</p>
            <p class="p7_p out-bottom" delay="1500">时间：14:00-17:00 </p>
            <p class="p7_p out-bottom" delay="2000">地点：北京市朝阳区酒仙桥路2号</p>
            <p class="p7_p out-bottom" delay="2500">798艺术区751D·PARK时尚设计广场 中央大厅</p>
          </div>
          <div class="p7_i out-small " delay="3000"></div>
        </li>
        <li class="page " id="p8" scene="8" stop-move="1">
          <span class="logo out-top " delay="1000"></span>
          <span class="p8_p out-right " delay="1500"></span>
          <div class="p8_i out-small" delay="500">
            <div class="icon"></div>
          </div>
        </li>
  		</ul>
      <img id="drop_down" src="<?php echo _STATIC_ ?>vip/xiangyu/img/btn_down.png">
      <audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/xiangyu/video/bg4.mp3"></audio>
      <div id="music"  class='on'></div>
    </div> 
      <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/xiangyu/js/zepto.min.js?random=<?php echo time();?>"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/xiangyu/js/init.js?random=<?php echo time();?>"></script>
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
            var title = '邀请函';//分享标题
            var desc = '相寓品牌发布会暨金融服务战略合作启动仪式邀请函';//分享描述
            var link = 'http://' + window.location.host + '/xiangyu/index?_wv=1';//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/xiangyu/img/share.png';//分享图标
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