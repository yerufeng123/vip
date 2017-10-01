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
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <title>英纳格手表</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/enicar/css/common.css<?php echo (Yii::app()->params['enicar']['isradom']) ? '?radom=' . time() : ''; ?>">
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
        <div id="wrap" class="index">
            <div class="flower1"></div>
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/watch.png" class="index_icon">
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/bg1.png" class="bg">
            <div class="flower"></div>
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/tit.png" class="index_tit">
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/logo.png" class="logo">

            <a href="javascript:void(0)" class="btn btn_shart" id="gstart">开始游戏</a>
            <a href="javascript:void(0)" class="btn btn_rule" id="grule">游戏说明</a>
            <a href="javascript:void(0)" class="btn btn_share" id="gshare">分享游戏</a>

        </div>
        <div class="mask" style=" display: none">
            <div class="dialog dia_rule" style=" display: none">
                <h4 class="dia_tit red_font">游戏说明</h4>
                <p class="dia_text">&emsp;&emsp;按下开始按钮女神腕表指针将开始转动并渐渐停止，指在5点20分时游戏成功。每人每天有一次机会，分享好友还能获得更多次挑战次数，让我们一起让时间停止在520吧！</p>
                <p class="dia_text red_font">*英纳格对此游戏享有最终解释权</p>
                <span class="dia_btn">关闭</span>
            </div>
            <div class="dia_share" style=" display: none">
                <img src="<?php echo _STATIC_ ?>vip/enicar/img/share.png" class="share">
            </div>
        </div>
    </body>
    <script>
        document.addEventListener("touchmove", function (e) {
            e.preventDefault()
        })
    </script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/enicar/js/zepto.min.js<?php echo (Yii::app()->params['enicar']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['enicar']['wxappid'], Yii::app()->params['enicar']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
        /*
         * 注意：
         *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
         */
        var title = '英纳格送爱分秒不息';//分享标题
        var desc = '英纳格520.用礼物替你说出心里的话';//分享描述
        var link = 'http://' + window.location.host + '/enicard/share';//分享链接
        var imgUrl = '<?php echo _STATIC_; ?>vip/enicar/img/share.jpg';//分享图标
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
                    shareok('friends');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('friends');
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
                    shareok('friend');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('friend');
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
                    shareok('qq');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('qq');
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
                    shareok('weibo');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('weibo');
                }
            });

        });

        //分享成功回调函数
        function shareok(type) {
            //增加一次分享
            $.post('/enicard/ajaxaddshare', {}, function (data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                    return false;
                } else {
                    window.location.href = '/enicard/index'
                }

            });
        }

        //分享取消回调函数
        function sharecancel(type) {

        }
    </script>
    <script>
        $(function () {
            //单击开始游戏
            $('#gstart').bind('click', function () {
                var enable = "<?php echo $enable; ?>";
                switch (enable) {
                    case 'no':
                        alert('次数已用完，请明天再玩！');
                        break;
                    case 'share':
                        alert('次数已用完，分享后还能继续玩哦！');
                        break;
                    default :
                        window.location.href = '/enicard/game';
                        return false;
                }
                return false;
            });
            //单击游戏说明
            $('#grule').bind('click', function () {
                $('.mask').show();
                $('.dia_share').hide();
                $('.dia_rule').show();
            });

            //单击游戏说明关闭按钮
            $('.dia_btn').bind('click', function () {
                $('.mask').hide();
                $('.dia_rule').hide();
            });

            //单击分享游戏
            $('#gshare').bind('click', function () {
                $('.mask').show();
                $('.dia_share').show();
                $('.dia_rule').hide();
            });

            //单击遮罩
            $('.dia_share').bind('click', function () {
                $('.mask').hide();
                $('.dia_share').hide();
            });
        });
    </script>
</html>