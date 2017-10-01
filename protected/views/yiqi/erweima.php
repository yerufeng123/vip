<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="prefetch" href="game.html" /> 
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
        <title>一汽丰田</title>
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
        <div id="wrap" class="index" >
            <img src="/<?php echo $erweima;?>" style="width: 150px;display: block;position: absolute;left: 50%;margin-left:-75px;top:50%;margin-top:-75px;margin-bottom:-100px;padding-bottom:101px;">
        </div>
        <script type="text/javascript" src="<?php echo _STATIC_; ?>vip/quanjude/js/zepto.min.js"></script>
    </body>
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
                                    var title = '锐志2015狂欢周末，打造最嗨夏日狂欢，惊艳开启。';//分享标题
                                    var desc = '“志成一派”狂欢周末，等你来HIGH！';//分享描述
                                    var link = 'http://' + window.location.host + '/yiqi/index';//分享链接
                                    var imgUrl = '<?php echo _STATIC_; ?>vip/yiqi/img/img12.jpg?radom=<?php echo time(); ?>';//分享图标
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
</html>