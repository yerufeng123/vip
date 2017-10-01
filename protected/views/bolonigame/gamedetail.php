<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,user-scalable=no">
        <title>Boloni百万现金等你来抢</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/bolonigame/css/common.css?randnum=<?php echo time()?>">
        <script>
            var game = {
                _width: 0, //场景宽度
                //j_height: 0, //判定高度
                //l_height: 0, //离开高度
                gold_width: 70, //球的宽度
                gold_height: 70, //球的高度
                gold_val: 0, //小球编号
                rec_val: 0, //入口编号
                receive: 55, //入口大小
                receive0: 120, //入口1
                receive1: 190, //入口2
                _interval: 3000, //金币口切换的间隔
                _time: null, //金币口切换
                _fly: false, //金币是否在上飞行
                over: false, //游戏是否结束
                // play: false, //游戏是否可玩
                _sore1: 0, //分数1
                _sore2: 0, //分数2
                _id: "", //用户ID
                timeout: 60, //结束时间
                bg_audio:"<?php echo _STATIC_ ?>vip/bolonigame/video/bg.mp3"//背景音乐 //修改04-22
            };
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
        <div id="wrap" class="getGold">
            <ul id="stage" speed="1">
                <div id="people">
                    <img src="<?php echo _STATIC_ ?>vip/bolonigame/img/head.png" class="head">
                </div>
                <span id="time">60</span>
                <div  id="receive" value="0"></div>
            </ul>
            <section id="result" style="display:none">
                <div class="result_text">您本次共获得
                    厨柜正价产品代金券：累计<span id="sore1">XX</span>元
                    非厨柜正价产品代金券：累计<span id="sore2">XX</span>元
                    请再接再励！

                    <span id="playtext">每个ID每天可玩游戏2次</span>，
                    转发朋友圈后当日可再多玩1次
                    代金券请至活动现场换取！
                </div>
                <a href="javascript:void(0)" class="btn_again"></a>
                <a href="javascript:void(0)" class="btn_share" id="btn_share"></a> 
            </section>
        </div>
        <div id="mask" style="display:none"></div>
        <!-- <audio autoplay="autoplay" loop="loop" id="audio"></audio> --> 
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/bolonigame/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/bolonigame/js/init.js?randnum=<?php echo time()?>"></script>
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
        function start() {
            //增加游戏次数（第一次开始，或者重玩）
            $.post('/bolonigame/ajaxaddnum', {}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    $('#playtext').html(res.result);
                    return false;
                } else {
                    $('#result').hide();
                    game._sore1 = parseInt(res.result.coupon1);
                    game._sore2 = parseInt(res.result.coupon2);
                    game_star();
                }
            });
        }
        function play(coupon1, coupon2) {
            if (coupon1 === '' || coupon2 === '') {
                alert('缺少参数');
                return false;
            }
            $.post('/bolonigame/ajaxsetcoupon', {'coupon1': coupon1, 'coupon2': coupon2}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                }
            });
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
        //单击分享
        $('.btn_share').bind('click', function() {
            $('#mask').show();
        });
        //单击遮罩
        $('#mask').bind('click', function() {
            $('#mask').hide();
        });
        //单击重玩
        $('.btn_again').bind('click',function(){
            start();
        });
        $(function() {
            start();
        });
    </script>
</html>