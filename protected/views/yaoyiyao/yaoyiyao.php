<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <!--<meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">-->
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_; ?>vip/yaoyiyao/css/common.css?random=<?php echo time(); ?>" rel="stylesheet">
        <title>盛景摇一摇</title>
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
        <div id="wrap" class="" style="line-height:0;font-size:0;">
            <img src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/logo.png" class="logo">
            <div class="mask_box">
                <img class="s_people" src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/people.png" />
                <img class="s_text" src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/s_text.png"  />
            </div>
            <div class="shake_top"></div>
            <div class="shake_bot"></div>
        </div>
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/jquery-2.1.1.min.js"></script>
        <script>
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
        </script>	
        <script type="text/javascript">
            var SHAKE_THRESHOLD = 750;//摇晃速度临界值
            var last_update = 0;
            var x, y, z, last_x, last_y, last_z;
            var times = 2;//超出几次临界值，算成功
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
                            set_i++;
                        }
                        if (set_i == times) {
                            $("body").height($(window).height()).css({"overflow": "hidden"});
                            $(".shake_bot").addClass("s_bot");
                            $(".shake_top").addClass("s_top");
                            //获取摇奖类型
                            getStyle();
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
            //获取摇奖类型
            function getStyle() {
                $.post('/yaoyiyao/ajaxgetstyle', {}, function(data) {
                    set_i = 0;
                    if (data != 'no') {
                        var list = eval('(' + data + ')');
                        setTimeout(function() {
                            window.location.href = "/yaoyiyao/detail?type=" + list.type+'&wechat_card_js=1';
                        }, 1500);
                    }

                });
            }
        </script>
    </body>
</html>
