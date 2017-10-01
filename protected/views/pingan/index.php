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
        <title>平安银行</title>
        <style>
        </style>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/pingan/css/page.css?random=<?php echo time(); ?>">
        <script>
            var h5 = {
                skip: "draw",
                //页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
                move: 1, //1为竖直滑动切换，0为水平滑动切换
                clear: true, //页面清除动画
                address: "", //默认地址
                lazy: 3, //懒加载页面个数
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
  <!--   	<script>
          //页面大小初始化
                  纲
      </script> -->
        <div id="wrap">

            <ul id="page_list" stage="">
                <li class="page show" id="page1" scene="1" stop-move="-1">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/logo.png" class="p1_logo">
                    <div class='line trans_h' delay="1000">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/line1.png"/>
                    </div>
                    <div src="<?php echo _STATIC_ ?>vip/pingan/img/p1_icon.png" class="p1_icon out-big" delay="3400"></div>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p1_icon2.png" class="p1_icon2 out-top" delay="4300">
                    <div class="p1_point"  delay="4800"></div>
                    <ul class="p1_line_b">
                        <li class="p1_line" delay="400"></li>
                        <li class="p1_line" delay="900"></li>
                        <li class="p1_line" delay="1400"></li>
                        <li class="p1_line" delay="1900"></li>
                        <li class="p1_line" delay="2400"></li>
                        <li class="p1_line" delay="2900"></li>
                    </ul>
                </li>
                <li class="page" id="page2" scene="2" >
                    <div class='line trans_h' delay="500">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/line2.png"/>
                    </div>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p2_tit.png" class="p2_tit out-bottom" delay="1500">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p2_text1.png" class="p2_text1 out-right" delay="2000">
                    <div class="p2_icon trans_w" delay="4000">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/p2_icon.png">
                    </div>
                </li>
                <li class="page" id="page3" scene="3">
                    <div class='line trans_h' delay="500">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/line3.png"/>
                    </div>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p3_text1.png" class="p3_text1 out-right" delay="1300">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p3_text2.png" class="p3_text2 out-right" delay="1600">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p3_text3.png" class="p3_text3 out-right" delay="1900">
                    <ul class="p3_list">
                        <li class="p3_li out-opacity" delay="2500">08:30-09:00  嘉宾签到、艺术品鉴赏</li>
                        <li class="p3_li out-opacity" delay="2700">09:00-09:40  事业部成立仪式</li>
                        <!-- 修改开始2015-07-12 -->
                        <li class="p3_li out-opacity" delay="2900" style="line-height:20px;">09:40-10:20  健康金融产品发布及健康荟启动仪式<br/><span style="margin-left:68px;">文旅金融产品发布及文旅荟启动仪式</span></li>
                        <li class="p3_li out-opacity" delay="3100" style="line-height:20px;">10:20-10:40  金橙医疗健康俱乐部、金橙文化旅游俱乐部<br/><span style="margin-left:68px;">成立及签约仪式</span></li>
                        <!-- 修改结束2015-07-12 -->
                    </ul>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p3_icon.png" class="p3_icon active_rotate" delay="3500">

                </li>
                <li class="page" id="page4" scene="4">
                    <div class='line trans_h' delay="500">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/line4.png"/>
                    </div>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p4_tit.png" class="p4_tit out-top" delay="1800">
                    <dl class="p4_list">
                        <dt class="p4_dt out-top" delay="2300">演讲嘉宾：</dt>
                        <dd class="p4_dd out-right" delay="2400">胡跃飞   平安银行副行长</dd>
                        <dd class="p4_dd out-right" delay="2500">王忠军   华谊兄弟董事长</dd>
                        <dd class="p4_dd out-right" delay="2600">梁信军   复星集团CEO</dd>
                        <dd class="p4_dd out-right" delay="2700">王志纲   智纲智库（王志纲工作室）创始人</dd>
                        <dd class="p4_dd out-right" delay="2800">陈少峰   北大文化产业研究院副院长</dd>
                        <dd class="p4_dd out-right" delay="2900">赵&emsp;力   艺术北京、青年100创始人</dd>
                    </dl>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p4_icon.png" class="p4_icon out-bottom" delay="3400">

                </li>
                <li class="page" id="page5" scene="5" stop-move="1">
                    <div class='line trans_h' delay="500">
                        <img src="<?php echo _STATIC_ ?>vip/pingan/img/line5.png"/>
                    </div>
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/logo.png" class="p5_logo out-right" delay="1500">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_tit.png" class="p5_tit out-big" delay="3000">

                    <div src="<?php echo _STATIC_ ?>vip/pingan/img/p5_text1.png" class="p5_text1 out-more_rotatY" delay="2700"></div>
                    <div src="<?php echo _STATIC_ ?>vip/pingan/img/p5_text2.png" class="p5_text2 out-more_rotatY" delay="2900"></div>
                    <div src="<?php echo _STATIC_ ?>vip/pingan/img/p5_text3.png" class="p5_text3 out-more_rotatY" delay="3100"></div>

                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_icon1.png" class="p5_icon1 out-bottom" delay="3900">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_icon2.png" class="p5_icon2 out-bottom" delay="3700">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_icon3.png" class="p5_icon3 out-bottom" delay="3600">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_icon4.png" class="p5_icon4 out-bottom" delay="3500">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_icon5.png" class="p5_icon5 out-bottom" delay="3300">
                    <img src="<?php echo _STATIC_ ?>vip/pingan/img/p5_end.png" class="p5_end out-bottom" delay="4000">
                </li>
                <li class="page" id="page6" scene="6" stop-move="1"></li>
            </ul>
            <img id="drop_down" src="<?php echo _STATIC_ ?>vip/pingan/img/btn_down.png">
            <audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/pingan/video/bg1.mp3"></audio>
            <div id="music" class='on'></div>
        </div> 
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/js/slide.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/js/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/js/init.js"></script>
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
            var desc = '健康·文旅金融论坛暨平安银行医疗健康文化旅游金融事业部开业仪式';//分享描述
            var link = 'http://' + window.location.host + '/pingan/index?_wv=1&random=' + Math.random();//分享链接
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