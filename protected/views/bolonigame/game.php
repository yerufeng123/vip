<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- 修改开始 -->
        <!-- 预加载页面 -->
        <link rel="prefetch" href="/bolonigame/gamedetail" /> 
        <!-- 修改开始 -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,user-scalable=no">
        <title>Boloni百万现金等你来抢</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/bolonigame/css/common.css">
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
            <div class="index_tit"></div>
            <!-- 移除class：none则按钮变黄 -->
            <!-- 修改 --><a href="javascript:void(0)" class="btn_play none" id='play'></a>
            <dl class="rule">
                <dt class="rule_tit">游戏规则：</dt>
                <dd class="rule_text">当金币滚动到变色的O正下方，点击金币，金币进入O中方视为金额领取成功</dd>
                <dd class="rule_text">黄色币为正价厨柜代金券，红色币为非厨柜类正价产品代金券</dd>
                <dd class="rule_text">每个ID每天可玩游戏2次，转发朋友圈后当日可再多玩1次</dd>
            </dl>
            <!-- 修改开始 -->
            <section id="result" style="display:none">
                <div class="result_text">
                    <p class="let_share" style="display:none">您当前还可以玩<span>0</span>次，
                        转发朋友圈后当日可再多玩1次</p>
                    <p class="none_share" style="display:none">您当天可玩的次数已用完</p>
                </div>
                <a href="javascript:void(0)" class="btn_share" style="left:50%;margin-left:-81px"></a> 
            </section>
            <div id="mask" style="display:none"></div>
            <!-- 修改结束 -->
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/bolonigame/js/zepto.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['enicar']['wxappid'], Yii::app()->params['enicar']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
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
                title: '全屋定制，开业庆典',
                desc: '全屋定制，开业庆典',
                link: 'http://vip.jellyideas.net/bolonigame/game',
                imgUrl: '<?php echo _STATIC_; ?>vip/bolonigame/img/biao1.jpg',
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
                title: '全屋定制，开业庆典',
                link: 'http://vip.jellyideas.net/bolonigame/game',
                imgUrl: '<?php echo _STATIC_; ?>vip/bolonigame/img/biao1.jpg',
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
        var flag = "<?php echo $flag; ?>";
        $(function() {
            checkplay();

            //单击玩游戏
            $('#play').bind('click', function() {
                if (checkplay('text')) {
                    window.location.href = "/bolonigame/gamedetail";
                }
            });

            //单击结果层
            $('#result').bind('click', function() {
                $('.none_share').hide();
                $('.let_share').hide();
                $('#result').hide();
            });

            //单击分享按钮
            $('.btn_share').bind('click', function() {
                $('#mask').show();
            });

            //单击分享遮罩层
            $('#mask').bind('click', function() {
                $('#mask').hide();
            });
        });
    </script>
    <script>
        //判定用户是否可以玩
        function checkplay(type) {
            switch (flag) {
                case 'none':
                    $('#play').addClass('none');
                    if (type == 'text') {
                        $('#result').show();
                        $('.none_share').show();
                        $('.let_share').hide();
                    }
                    return false;
                    break;
                case 'share':
                    $('#play').removeClass('none');
                    if (type == 'text') {
                        $('#result').show();
                        $('.none_share').hide();
                        $('.let_share').show();
                    }
                    return false;
                    break;
                default :
                    //可以玩游戏
                    $('#mask').hide();
                    $('#result').hide();
                    $('#play').removeClass('none');
                    return true;
            }
        }
        function shareok() {
            //更新分享时间
            $.post('/bolonigame/ajaxsetsharetime', {}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
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