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
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/bolonigame/css/common.css?randnum=<?php echo time() ?>">
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
        <div id="wrap" class="login">
            <div id="main">
                <img src="<?php echo _STATIC_ ?>vip/bolonigame/img/logo.png" class="login_logo">
                <img src="<?php echo _STATIC_ ?>vip/bolonigame/img/login_tit1.png" class="login_tit1">
                <img src="<?php echo _STATIC_ ?>vip/bolonigame/img/login_tit2.png" class="login_tit2">
                <span class="btn_check checked" val="贵阳">贵&emsp;&emsp;阳</span>
                <span class="btn_check" val="江阴">江&emsp;&emsp;阴</span>
                <input type="text" class="btn_input" placeholder="姓&emsp;&emsp;名" id="name">
                <input type="text" class="btn_input" placeholder="联系电话" id="phone" maxlength="11">
                <a href="javascript:void(0)" class="btn_sublime" id="sub_btn">点击提交</a>
            </div>

        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/bolonigame/js/zepto.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo _STATIC_ ?>vip/bolonigame/js/globals.js"></script>
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
        $(function() {
            //单击提交
            $('#sub_btn').bind('click', function() {
                var city = '';
                for (var i = 0; i < $('.btn_check').length; i++) {
                    if ($('.btn_check').eq(i).hasClass('checked')) {
                        city = $('.btn_check').eq(i).attr('val');
                    }
                }
                //var city = $('#city').val();//暂且定为是输入的吧
                var name = $('#name').val();
                var phone = $('#phone').val();
                if (city == '') {
                    alert('请输入城市');
                    return false;
                }
                if (name == '') {
                    alert('请输入姓名');
                    return false;
                }
                if (phone == '') {
                    alert('请输入手机');
                    return false;
                }
                if (!check_phone(phone)) {
                    alert("手机格式不正确");
                    return false;
                }
                $.post('/bolonigame/ajaxadduser', {'city': city, 'name': name, 'phone': phone}, function(data) {
                    var res = eval('(' + data + ')');
                    if (res.code == '10000') {
                        //操作成功！
                        window.location.href = '/bolonigame/game';
                    } else {
                        alert(res.result);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            document.addEventListener("touchmove", function(e) {
                e.preventDefault()
            })
            $(".btn_check").on("click", function() {
                $(this).addClass("checked").siblings(".checked").removeClass("checked");
            })
        })
    </script>
    <script>
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
</html>