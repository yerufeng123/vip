<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/diantong/css/common.css" rel="stylesheet">
        <title>一汽丰田</title>
    </head>

    <body>
        <div id="wrap">
            <div class="diag_mask" style="display: none">
                <div class="rule" style="overflow: hidden">
                    <p id="textvalue">&emsp;&emsp;</p>
                    <a href="javascript:void(0)" class="close btn">确 认</a>
                </div>
            </div>
            <div class="logo"><img src="<?php echo _STATIC_ ?>vip/diantong/images/logo.png"></div>
            <div class="main">
                <img src="<?php echo _STATIC_ ?>vip/diantong/images/shake.png" class="shake"/>
                <img src="<?php echo _STATIC_ ?>vip/diantong/images/hand.png" class="hand"/>
                <img src="<?php echo _STATIC_ ?>vip/diantong/images/hb.png" class="hb"/>
            </div>
            <audio id="audio" preload='auto' src="<?php echo _STATIC_ ?>vip/diantong/video/yao.mp3"></audio>
            <audio id="audio2" preload='auto' src="<?php echo _STATIC_ ?>vip/diantong/video/yaozhong.mp3"></audio>
        </div>	
        <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js<?php echo (Yii::app()->params['diantong']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['diantong']['wxappid'], Yii::app()->params['diantong']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */

            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appId"]; ?>',
                timestamp: <?php echo $signPackage["timestamp"]; ?>,
                nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                signature: '<?php echo $signPackage["signature"]; ?>',
                jsApiList: [
                    // 所有要调用的 API 都要加到这个列表中
                    'closeWindow',
                ]
            });




        </script>
        <script type="text/javascript">
            var SHAKE_THRESHOLD = 1500;//摇晃速度临界值
            var last_update = 0;
            var x, y, z, last_x, last_y, last_z;
            var times = 10;//超出几次临界值，算成功
            set_i = 0;//超出临界值速度次数
            function deviceMotionHandler(eventData) {
                var acceleration = eventData.accelerationIncludingGravity;
                var curTime = new Date().getTime();

                if ((curTime - last_update) > 100) {
                    var diffTime = curTime - last_update;
                    last_update = curTime;

                    x = acceleration.x;
                    y = acceleration.y;
                    z = acceleration.z;

                    var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;
                    if (speed > SHAKE_THRESHOLD) {
                        if (set_i <= times) {
                            if (document.getElementById('audio2').paused) {
                                document.getElementById('audio').play();
                            }
                            set_i++;
                        }
                        if (set_i == times) {
                            document.getElementById('audio').pause();
                            if (document.getElementById('audio').paused) {
                                document.getElementById('audio2').play();
                            }

                            //发送红包
                            send();
                        }
                    }
                    last_x = x;
                    last_y = y;
                    last_z = z;
                }
            }
            if (window.DeviceMotionEvent) {
                window.addEventListener('devicemotion', deviceMotionHandler, false);
            }
        </script>
        <script>
            function send() {
                $.post('/diantong/ajaxsendpacket', {}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        if (list.result == '帐号余额不足，请到商户平台充值后再重试') {
                            $('#textvalue').html('红包领取已经结束，谢谢您的参与！');
                            $('.diag_mask').show();
                        } else if (list.result == '更换了金额，但商户单号未更新') {
                            $('#textvalue').html('网络繁忙，请返回重试！');
                            $('.diag_mask').show();
                        } else {
                            $('#textvalue').html(list.result);
                            $('.diag_mask').show();
                        }
                    } else {
                        $('#textvalue').html(list.result);
                        $('.diag_mask').show();
                    }
                });
            }
//             document.addEventListener('WeixinJSBridgeReady', function () {
//            document.getElementById('audio').play();
//        }, false);
        </script>
        <script type="text/javascript">
            $(function () {
                $(".diag_mask").bind("touchmove", function (e) {
                    e.preventDefault();
                })
                $(".close").bind("click", function (e) {
                    $(".diag_mask").hide();
                    wx.closeWindow();
                })

            })
        </script>
    </body>
</html>
