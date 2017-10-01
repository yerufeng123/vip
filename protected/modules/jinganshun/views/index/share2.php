<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0,user-scalable=0" />
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>分享有礼</title>
<style type="text/css">
    html{font-size:13px;}
</style>
</head>

<body class="thunder_bg">
<div class="wrap" id="thunder">
		<img src="<?php echo _STATIC_ ?>vip/jinganshun/images/share_line.png" class="share_line_btn">
		<img src="<?php echo _STATIC_ ?>vip/jinganshun/images/ewm.jpg" class="er_bg_send">
		<h3 class="active_bg">分享有惊喜</h3>
		<p class="add_share"><span class="cion_line"></span><span class="cion_d">您的好友是京安顺的员工哦！是他“瓷器儿”
就帮他转发吧。 你转发他收益！</span></p>

<p class="add_share add_share_two"><span class="cion_line"></span><span class="cion_d">现在加入京安顺，马上开始得收益！</span></p>
		<a href="javascript:void(0)" class="add_share_btn">帮他分享</a>
	

</div>
    <div class="diag_success" style="display:none;">
        <a href="#" class="know_btn">知道了</a>
        <span class="share_line"></span>
    </div> 
<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/zepto.min.js"></script>
<script>
        //页面大小初始化
        (function(){ 
            var _width = document.body.clientWidth;
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
        })()
    </script>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
             $(function () {
                 $("body").height($("body").height());
                 $("body").on("touchmove", function (e) {
                     e.preventDefault();

                 })

                 $(".close").bind("click", function () {
                     $(".diag_success").hide();
                 })

                 $(".add_share_btn").bind("click", function () {
                     $(".diag_success").show();
                 })

                 $(".know_btn").bind("click", function () {
                     $(".diag_success").hide();
                 })
             })
    </script>

    <?php
    $jssdk = new JSSDK(Yii::app()->params['jinganshun']['wxappid'], Yii::app()->params['jinganshun']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
        /*
         * 注意：
         *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
         */
        var title = '京安顺';//分享标题
        var desc = '点击进入，成为我们中的一员，京安顺保安公司期待您的加入，关注之后更多惊喜！';//分享描述
        var link = 'http://' + window.location.host + '/jinganshun/index/share2?openid=<?php echo $openid; ?>';//分享链接
        var imgUrl = '<?php echo _STATIC_; ?>vip/jinganshun/images/logo.png?radom=<?php echo time(); ?>';//分享图标
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
</html>
