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
    <meta http-equiv="Cache-Control" content="max-age=720000" />
    <meta http-equiv="Expires" content="Mon, 20 Jul 2016 23:00:00 GMT" />
    <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.5,minimum-scale=0.5,user-scalable=no">
    <title>平安银行</title>
<!-- 修改2015-10-22 --><!-- <link rel="stylesheet" href="css/common.css"> -->
    <script>
		var h5 = { 
			skip 		:"draw",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 	:true,		//页面清除动画
			address :"",		//默认地址
      //修改2015-10-22
      preload :false,
		}
	</script>
  </head>
  <body>
<!-- 修改开始2015-10-22 -->
    <style>
      #preload{ position: fixed; left: 0; top: 0; right: 0; bottom: 0; background-color: #000; z-index: 999;}
      #load_num{ position:absolute; left: 50%;top: 50%;-webkit-transform:translate(-50%,-50%); transform:translate(-50%,-50%); color: #fff; font-size: 40px;}
    </style>
    <div id="preload">
      <span id="load_num"></span>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan3/js/loading.js"></script>
<!-- 修改结束2015-10-22 -->
  	<div id="wrap">
  		<ul id="page_list">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/logo.png" width="145" height="27" class="logo">
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p1_i.png" class="p1_i1 out-bottom" width="390" height="355" delay="600">
  				<img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p1_t.png" width="227" height="100" class="p1_t out-small" delay="1200">
	  		</li>
	        <li class="page" id="p2" scene="2" >
	          <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/logo.png" width="145" height="27" class="logo">
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p2_t.png" width="304" height="95" class="p2_t out-top" delay="600">
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p2_p.png" width="193" height="61" class="p2_p out-bottom" delay="1200">
	        </li>
	        <li class="page" id="p3" scene="3">
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/logo.png" width="145" height="27" class="logo">
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p3_i.png" width="366" height="206" class="p3_i layer" data-depth="0.8">
            <div class="p3_p1 out-top" delay="600"><span class="font_red">时间：</span>2015年11月4日  (周三)  8:30-12:00</div>
	          <div class="p3_p2 out-top" delay="1200"><span class="font_red">地点：</span>四川乐山峨眉山市红珠山宾馆<br/><span class="font_hide">地点：</span>5号楼2层名山厅</div>
            <ul class="p3_list">
              <li class="p3_li out-right" delay="1600"><span class="p3_t">8:30-9:00</span>嘉宾签到、艺术品鉴赏</li>
              <li class="p3_li out-right" delay="2000"><span class="p3_t">9:00-9:35</span>嘉宾致辞</li>
              <li class="p3_li out-right" delay="2200"><span class="p3_t">9:35-9:55</span>平安文旅荟视频<br/><span class="font_hide" style="display:inline-block; width:70px;margin-left:9px">9:35-9:55  </span>平安文旅荟中原盛世项目发布仪式</li>
              <li class="p3_li out-right" delay="2400"><span class="p3_t">9:55-10:05</span>战略客户签约仪式</li>
              <li class="p3_li out-right" delay="2600"><span class="p3_t">10:05-10:25</span>金橙文化旅游俱乐部新会员入会仪式</li>
              <li class="p3_li out-right" delay="2800"><span class="p3_t">10:25-10:45</span>乐山市政府与平安银行战略合作签字仪式</li>
              <li class="p3_li out-right" delay="3000"><span class="p3_t">10:45-12:00</span>论坛（融合的力量）</li>
            </ul>
	        </li>
<!-- 修改20151022 --><li class="page" id="p4" scene="4" stop-move="1">
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/logo.png" width="145" height="27" class="logo  out-top"  delay="600">
	          <div class="p4_t"  delay="1200"></div>
            <img pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/p2_t.png" width="304" height="95" class="p4_p  out-small"  delay="1600">
            <div class="p4_restart  out-right"  delay="2000">重复播放</div>
	        </li>
  		</ul>
      <img id="drop_down" pre-src="<?php echo _STATIC_ ?>vip/pingan3/img/btn_down.png">
      <audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/pingan3/video/bg.mp3"></audio>
      <div id="music" class='on'></div>
    </div> 
	  <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan3/js/slide.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan3/js/parallax.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan3/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan3/js/init.js"></script>
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
            var desc = '金橙文化旅游俱乐部2015年会员峰会，邀你一起参加。';//分享描述
            var link = 'http://' + window.location.host + '/pingan3/index?_wv=1&random=' + Math.random();//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/pingan3/img/share.png';//分享图标
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