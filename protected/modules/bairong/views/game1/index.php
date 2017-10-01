<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>玩游戏，赢大奖</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ . 'vip/bairong/' ?>css/common.css">
    </head>
    <body>
        <div id="wrap" class="index">
            <a  class="btn" id="star_btn" href="/bairong/game1/game1"></a>
            <a  class="btn" id="inf_btn" href="javascript:void(0)"></a>
            <a  class="btn" id="share_btn" href="javascript:void(0)"></a>
            <article id="rule" style="display: none"> 
                <header class="rule_tit">投奖规则：</header>
                <section> 
                    <br>
                    &emsp;&emsp;亲，请用手指拖动屏幕底端的购物车，然后用你灵巧的双手尽量去接取天上掉下的各类商品，不过要小心隐藏其中的炸弹哦，接到炸弹，游戏结束，接满1000分者，还会有神秘礼品相赠，还等什么呢，赶快开始吧！	
                    <span class="btn_ok" id="btn_ok">确认</span>
                </section>

            </article>
            <section id="share" style="display: none"></section>
        </div>
        <audio src="<?php echo _STATIC_ . 'vip/bairong/' ?>video/bg.mp3" style="visibility:hidden"></audio>
    </body>
    <script src="<?php echo _STATIC_ . 'vip/bairong/' ?>js/zepto.min.js" type="text/javascript"></script>
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
        var title = '玩游戏领奖品';//分享标题
        var desc = '看看谁是朋友圈里最牛的购物狂人吧！';//分享描述
        var link = '<?php echo Yii::app()->request->hostInfo ?>/bairong/game1/index';//分享链接
        var imgUrl = '<?php echo _STATIC_ . 'vip/bairong/' ?>/img/baironglogo.png';//分享图标
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
    <script>
        $(function() {
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
            $('#btn_ok').bind('click', function() {
                $('#rule').hide();
            });
            $('#inf_btn').bind('click', function() {
                $('#rule').show();
            });
            $('#share_btn').bind('click', function() {
                $('#share').show();
            });
            $('#share').bind('click', function() {
                $('#share').hide();
            });
        });
    </script>
</html>