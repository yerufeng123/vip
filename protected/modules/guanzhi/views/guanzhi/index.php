<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=750, user-scalable=no, maximum-scale=10.0, minimum-scale=0.1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>挑战你与百万豪车的缘分</title>
  <link rel="stylesheet" href="<?php echo _STATIC_?>vip/guanzhi/css/index.css">
  <script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?eeaa8a516c91370264450e1eee60e97d";
        var s = document.getElementsByTagName("script")[0]; 
        s.parentNode.insertBefore(hm, s);
    })();
    </script>
</head>
<body>
    <div id="wrap">
        <div id="tips"></div>
        <div id="load" class="page">
            <div class="spinner"></div>
            <div class="load_text">0%</div>
        </div>
        <div id="main" style="display:none;">
            <img id="music" src="<?php echo _STATIC_?>vip/guanzhi/img/music.png"/>
            <img id="logo" src="<?php echo _STATIC_?>vip/guanzhi/img/logo.png" />
            <div id="index" class="page" style="display:none;">

            </div>
            <div id="question" class="page" style="display:none;">
                <img src="" class="qusetion_bg">
                <div id="cnt"></div>
                <!-- 分享页面 -->
                <div class="question_share"></div>
                <!-- 光线 -->
                <div class="question_lights lights" style="display:none;">
                    <img class="light10" src="<?php echo _STATIC_?>vip/guanzhi/img/r6.png">
                    <img class="light9" src="<?php echo _STATIC_?>vip/guanzhi/img/r5.png">
                    <img class="light8" src="<?php echo _STATIC_?>vip/guanzhi/img/r4.png">
                    <img class="light7" src="<?php echo _STATIC_?>vip/guanzhi/img/r3.png">
                    <img class="light6" src="<?php echo _STATIC_?>vip/guanzhi/img/r2.png">
                    <img class="light5" src="<?php echo _STATIC_?>vip/guanzhi/img/r1.png">
                    <img class="light4" src="<?php echo _STATIC_?>vip/guanzhi/img/l4.png">
                    <img class="light3" src="<?php echo _STATIC_?>vip/guanzhi/img/l3.png">
                    <img class="light2" src="<?php echo _STATIC_?>vip/guanzhi/img/l2.png">
                    <img class="light1" src="<?php echo _STATIC_?>vip/guanzhi/img/l1.png">
                </div>
                <!-- 汽车 -->
                <div class="question_cars cars" style="display:none;">
                    <img class="car5" src="<?php echo _STATIC_?>vip/guanzhi/img/car5.png">
                    <img class="car4" src="<?php echo _STATIC_?>vip/guanzhi/img/car4.png">
                    <img class="car3" src="<?php echo _STATIC_?>vip/guanzhi/img/car3.png">
                    <img class="car2" src="<?php echo _STATIC_?>vip/guanzhi/img/car2.png">
                    <img class="car1" src="<?php echo _STATIC_?>vip/guanzhi/img/car1.png">
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo _STATIC_?>vip/guanzhi/js/zepto.js"></script>
    <script src="<?php echo _STATIC_?>vip/guanzhi/js/load.js"></script>
    <script src="<?php echo _STATIC_?>vip/guanzhi/js/index.js"></script>
    <script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['guanzhi']['wxappid'], Yii::app()->params['guanzhi']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
                                            /*
                                             * 注意：
                                             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
                                             */
                                            var title = '观致汽车';//分享标题
                                            var desc = '观致汽车邀你闯关抽奖！';//分享描述
                                            var link = 'http://' + window.location.host + '/guazhi/guanzhi/index';//分享链接
                                            var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share.png';//分享图标
                                                var type = '';// 分享类型,music、video或link，不填默认为link
                                                var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
                                                wx.config({
                                                    debug: false,
                                                    appId: '<?php echo $signPackage["appId"]; ?>',
                                                    timestamp: <?php echo $signPackage["timestamp"]; ?>,
                                                    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                                                    signature: '<?php echo $signPackage["signature"]; ?>',
                                                    jsApiList: [
                                                        'chooseImage',
                                                        'previewImage',
                                                        'uploadImage',
                                                        'downloadImage',
                                                        'closeWindow',
                                                        'onMenuShareTimeline',
                                                        'onMenuShareAppMessage',
                                                        'onMenuShareQQ',
                                                        'onMenuShareWeibo',
                                                        'onMenuShareQZone',
                                                        'hideMenuItems',
                                                        'showMenuItems'
                                                    ]
                                                });
                                                wx.ready(function () {
                                                    wx.hideMenuItems({
                                                        menuList: [
                                                           //'menuItem:share:appMessage',
                                                           //'menuItem:share:timeline',
                                                           'menuItem:share:qq',
                                                           'menuItem:share:weiboApp',
                                                           //'menuItem:favorite',
                                                           'menuItem:share:facebook',
                                                           'menuItem:share:QZone',
                                                           'menuItem:editTag',
                                                           'menuItem:delete',
                                                           'menuItem:copyUrl',
                                                           'menuItem:originPage',
                                                           'menuItem:readMode',
                                                           'menuItem:openWithQQBrowser',
                                                           'menuItem:openWithSafari',
                                                           'menuItem:share:email',
                                                           'menuItem:share:brand'
                                                           
                                                       ] 
                                                    });
                                                    wx.showMenuItems({
                                                        menuList: [
                                                              'menuItem:share:appMessage',
                                                              'menuItem:share:timeline',
                                                              //'menuItem:share:qq',
                                                              //'menuItem:share:weiboApp',
                                                              //'menuItem:favorite',
                                                              //'menuItem:share:facebook',
                                                              //'menuItem:share:QZone',
                                                          ]
                                                    });
                                                    //分享到朋友圈
                                                    wx.onMenuShareTimeline({
                                                        title: title, // 分享标题
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