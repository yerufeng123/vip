<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>黄飞红</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/huangfeihong/css/game.css?random=<?php echo time();?>">
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
        <div id="wrap" class="page_home">
            <header class="top_bg">
                <div class="logo2"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/logo2.png"/></div>
                <div class="jifen" id="sore">0积分</div>
            </header>
            <ul id="page_list">
                <!-- 游戏页 -->
                <li class="page_game page" id="page3" scene="3">
                    <ul id="stage" speed="4">
                        <div id="receive" ></div>
                    </ul>
                </li>
                <!-- 遮罩层 -->
                <section id="mask" class="mask_share" style="display:">
                    <!--分享-->
                    <section class="share" id="share">
                        
                    </section> 
                </section>
            </ul>
        </div>
    </body>
    <script src="<?php echo _STATIC_ ?>vip/huangfeihong/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['enicar']['wxappid'], Yii::app()->params['enicar']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
        var title = '出手吧，就现在！';//标题
        var desc = "刷新纪录，赢金币，Apple Watch带回家。";//描述
        var link = "http://vip.jellyideas.net/huangfeihong/share?oid=<?php echo $openid; ?>";//链接
        var pic = "<?php echo _STATIC_ ?>vip/huangfeihong/img/huangfeihong.gif";//分享图片
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"]; ?>',
            timestamp: <?php echo $signPackage["timestamp"]; ?>,
            nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
            signature: '<?php echo $signPackage["signature"]; ?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
            ]
        });
        wx.ready(function() {
            wx.onMenuShareAppMessage({
                title: title,
                desc: desc,
                link: link,
                imgUrl: pic,
                trigger: function(res) {
                    //alert('用户点击发送给朋友');
                },
                success: function(res) {
                    //alert('已分享');
                    shareok();
                },
                cancel: function(res) {
                    //alert('已取消');
                },
                fail: function(res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareTimeline({
                title: desc,
                link: link,
                imgUrl: pic,
                trigger: function(res) {
                    //alert('用户点击分享到朋友圈');
                },
                success: function(res) {
                    //alert('已分享');
                    shareok();
                },
                cancel: function(res) {
                    //alert('已取消');
                },
                fail: function(res) {
                    //alert(JSON.stringify(res));
                }
            });
        })

    </script>
    <script>
        function shareok() {
            //更新分享时间
            $.post('/huangfeihong/ajaxsetsharetime', {}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                    return false;
                } else {
                    window.location.href = "/huangfeihong/index";
                }
            });

        }
    </script>
    <script>
        document.addEventListener("touchmove", function(e) {
            e.preventDefault()
        })
    </script>
</html>