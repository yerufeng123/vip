<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>闪电理财</title>
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
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/licai/css/game.css">
    </head>
    <body>
        <div id="wrap" class="page_home">
            <header class="top_bg">
                <div class="logo2" ></div>
                <div class="mytime" id="mtimer">30</div>
            </header>
            <ul id="page_list">
                <!-- 游戏页 -->
                <li class="page_game page" id="page3" scene="3">
                    <ul id="stage" speed="4">
                        <div id="receive" ></div>

                    </ul>
                    <div class="jifen" id="sore_pic"></div>
                    <div class="jifenzhi" id="sore">0</div>

                </li>
                <!-- 遮罩层 -->
                <section id="mask" style="display:none">
                    <!-- 去抽奖 -->
                    <section class="dialog first_place" id="false" style="display:none">
                        <img class="mask_child" src="<?php echo _STATIC_ ?>vip/licai/img/child.png" />
                        <span class="hint">主人，工作在忙， 也要记得吃热饭哦！</span>
                        <a href="javascript:void(0)" class="draw"><span>分享再来一次</span><img src="<?php echo _STATIC_ ?>vip/licai/img/drop_up.png" /></span></a> 
                    </section>
                    <!-- 去抽奖 -->
                    <section class="dialog first_place" id="success" style="display:none">
                        <img class="mask_child" src="<?php echo _STATIC_ ?>vip/licai/img/child.png" />
                        <span class="hint">主人，工作在忙， 也要记得吃热饭哦！</span>
                        <a href="javascript:void(0)" class="draw"><span>现在去抽奖！</span><img src="<?php echo _STATIC_ ?>vip/licai/img/drop_up.png" /></span></a> 
                    </section>

                    <!--分享-->
                    <section class="share" id="share" style="display:none">
                        <span>点击以上位置分享朋友圈哦</span>
                    </section> 
                </section>

                <!---倒计时图片---->
                <section class="numbers" id="numbers" style="display:none">

                    <div class="number" id="number"><img id="number_img" src="<?php echo _STATIC_ ?>vip/licai/img/hjy/3.png" />
                    </div>

                </section>

                <!---游戏结束图片---->
                <section class="gameoveralert" id="gameoveralert" style="display:none">

                    <div class="gameovediv" id="gameovediv"><img id="gameoverimg" src="<?php echo _STATIC_ ?>vip/licai/img/hjy/gameover.png" />
                    </div>

                </section>
                <audio id="audio" loop="loop" preload='auto' src="<?php echo _STATIC_ ?>vip/licai/video/bg.mp3"></audio>
            </ul>
        </div>
    </body>
    <script src="<?php echo _STATIC_ ?>vip/licai/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="<?php echo _STATIC_ ?>vip/licai/js/game.js?random=<?php echo time();?>" type="text/javascript"></script>
    <script src="<?php echo _STATIC_ ?>vip/licai/js/slide2.js" type="text/javascript"></script>
    <script>
        document.addEventListener('WeixinJSBridgeReady', function () {
            document.getElementById('audio').play();
        }, false);
    </script>
    <script>
        function gameend(score) {
            $.post('/licai/ajaxsetscore', {'score': score}, function (data) {
                var list = eval('(' + data + ')');
                if (list.code != '10000') {
                    alert(list.result);
                } else {
                    location.href = '/licai/login';
                }
            });
        }
    </script>
</html>
