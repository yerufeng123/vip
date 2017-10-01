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
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/huangfeihong/css/common.css?random=<?php echo time(); ?>">
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
            <ul id="page_list">
                <li class="page_game page" id="page3" scene="3">
                    <header class="top_bg"></header>
                    <div class="logo2"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/logo2.png"/></div>
                    <div class="jifen" id="sore"></div>
                </li>
                <!-- 遮罩层 -->
                <section id="mask">
                    <!--分享-->
                    <section class="share" id="share" style="display:none"></section> 
                    <!-- 奖项 -->
                    <section class="dialog" id="lottery_box" style="display:block">
                        <!-- 刮奖区 -->
                        <div class="gj_text1"><span class="num_one nums" id="lottery_level"></span></div>
                        <div class="gj_mask" id="gj_mask" style="position:absolute;left:50%;margin:151px 0 0 -111px">
                            <canvas id="canvas_one" class="canvas" width="230" height="64"></canvas>
                        </div>
                        <span class="hint hint_two" id="lottery_text" style="display: none;margin-left:auto;margin-right:auto; text-align:center;"><?php echo $describe; ?></span>
                        <?php if ($flag == '1'): ?>
                            <a href="javascript:void(0)" class="draw draw_fill_inf" id="sub_btn"><span>填写信息</span><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/drop_up.png" /></span></a>
                        <?php else: ?>
                            <a href="javascript:void(0)" class="draw draw_fill_inf" id="share_btn"><span>分享好友</span><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/drop_up.png" /></span></a>
                            <?php endif; ?>
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
        /*遮罩层*/
        function getPageWidth() {
            var PageWidth;
            PageWidth = $(".gj_mask").width();
            return PageWidth;
        }
        function getPageHeight() {
            var PageHeight;
            PageHeight = $(".gj_mask").height();
            return PageHeight;
        }

        function getClientX(cssX) {
            var canvasX;
            canvasX = document.getElementById("gj_mask").clientWidth;
            return canvasX;
        }
        function getClientY(cssY) {
            var canvasY;
            canvasY = document.getElementById("gj_mask").clientHeight;
            return canvasY;
        }
        var img = new Image();
        img.src = "<?php echo _STATIC_ ?>vip/huangfeihong/img/gj_mask.png";
        img.load = function(err) {
            var originW = img.width;
            var originH = img.height;
        }
        img.width = getPageWidth();
        img.height = getPageHeight();
        var canvas = document.querySelector("canvas");
        var ctx = canvas.getContext("2d");
        var drawm;
        img.onload = function() {
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0);
        }
        var isMousedown = false;
        canvas.addEventListener("touchstart", mousedownHD, false)
        function mousedownHD(e) {
            $('#lottery_level').text('<?php echo $giftlevel ?>');
            isMousedown = true;
            if (drawm)
                clearTimeout(drawm);
            ctx.beginPath();
            e.preventDefault();
            return false;
        }
        canvas.addEventListener("touchmove", mousemoveHD, false)
        var canvasOffset = canvas.getBoundingClientRect();
        function mousemoveHD(e) {
            if (isMousedown) {
                ctx.lineWidth = 50;
                ctx.lineCap = "round";
                ctx.lineJoin = "round";
                ctx.globalCompositeOperation = "destination-out";
                ctx.lineTo(e.touches[0].clientX - canvasOffset.left, e.touches[0].clientY - canvasOffset.top, 10, 10);
                ctx.stroke();
            }
            e.preventDefault();
        }
        document.addEventListener("touchend", mouseupHD, false)
        function mouseupHD() {
            isMousedown = false;
            $('#lottery_text').show();
            //drawm = setTimeout("hiddenfengmian()", 2000);
            return false;
        }
//        function hiddenfengmian() {
//            $('#lottery_text').show();
////            $(".gj_mask").animate({opacity: "0"}, 800, function() {
////                //$(".gj_mask").hide();
////                //$(".gj").hide();
////                //$(".one_place").show();
////            });
//        }
    </script>

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

//        function play(coupon1, coupon2) {
//            if (coupon1 === '' || coupon2 === '') {
//                alert('缺少参数');
//                return false;
//            }
//            $.post('/bolonigame/ajaxsetcoupon', {'coupon1': coupon1, 'coupon2': coupon2}, function(data) {
//                var res = eval('(' + data + ')');
//                if (res.code != '10000') {
//                    alert(res.result);
//                }
//            });
//        }
        function shareok() {
            //更新分享时间
            $.post('/huangfeihong/ajaxsetsharetime', {}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                    return false;
                }else{
                    window.location.href="/huangfeihong/index";
                }
            });
            
        }
    </script>
    <script>
        //单击填写信息
        $('#sub_btn').bind('click', function() {
            window.location.href = '/huangfeihong/register';
        });
        //单击分享
        $('#share_btn').bind('click', function() {
            $('#mask').show();
            $('#share').show();
        });

        //单击遮罩
        $('#share').bind('click', function() {
            $('#share').hide();
        });
    </script>
    <script>
        document.addEventListener("touchmove", function(e) {
            e.preventDefault();
        })
    </script>
</html>