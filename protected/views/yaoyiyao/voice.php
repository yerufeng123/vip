<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_; ?>vip/yaoyiyao/css/common.css" rel="stylesheet">
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
        <div id="wrap" class="wrap">
            <!-- 修改开始2015-05-19 -->
            <div class="voice_photo">
                <img class="icon_head" src="<?php echo $pic ?>" />
            </div>
            <div class="click_voice" id="voice_box">
                <audio SRC="<?php echo $media; ?>" preload="auto"  width=0 height=0 visibility="hidden" id="voiceplay"/>
            </div>
            <!-- 修改结束2015-05-19 -->
        </div>
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/jquery-2.1.1.min.js"></script>
        <script>
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
        </script>	
        <script>
            $(document).ready(function() {
                $('#voice_box').bind('click', function() {
                    if ($('#voiceplay').hasClass('play')) {
                        $('#voiceplay').addClass('pause').removeClass('play');
                        $('#voiceplay')[0].pause();
                        $(this).css('background','rgba(0, 0, 0, 0) url("<?php echo _STATIC_; ?>vip/yaoyiyao//img/voice_box.png") no-repeat scroll center center / auto 65px');
                    } else {
                        $(this).css('background','rgba(0, 0, 0, 0) url("<?php echo _STATIC_; ?>vip/yaoyiyao//img/voice_box.gif") no-repeat scroll center center / auto 65px');
                        $('#voiceplay').addClass('play').removeClass('pause');
                        $('#voiceplay')[0].load();
                        $('#voiceplay')[0].play();
                    }
                });

            });
        </script>	
    </body>
</html>
