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
                    <!-- 个人信息 -->
                    <section class="dialog mask_inf">
                        <ul class="uls">
                            <li><label for="name">姓名：</label><input type="text" id="name"/></li>
                            <li><label for="phone">手机：</label><input type="text" id="phone"/></li>	
                            <li><label for="city">城市：</label><input type="text" id="city"/></li>
                            <li><label for="address">地址：</label><input type="text" id="address"/></li>
                        </ul>
                        <a href="javascript:void(0)"class="draw" id="sub_btn"><span class="submit_btn">提交喽！</span><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/drop_up.png" /></span></a> 
                    </section>
                </section>
            </ul>
        </div>
    </body> 
    <script src="<?php echo _STATIC_ ?>vip/huangfeihong/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php echo _STATIC_; ?>huangfeihong/js/globals.js"></script>
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
        $(function() {
             $("#wrap").height($(window).height());
            //单击提交
            $('#sub_btn').bind('click', function() {
                var name = $('#name').val();
                var phone = $('#phone').val();
                var city = $('#city').val();
                var address = $('#address').val();

                if (name == '') {
                    alert('请输入姓名');
                    return false;
                }
                if (phone == '') {
                    alert('请输入手机');
                    return false;
                }
                if (city == '') {
                    alert('请输入城市');
                    return false;
                }
                if (address == '') {
                    alert('请输入地址');
                }
                if (!check_phone(phone)) {
                    alert("手机格式不正确");
                    return false;
                }
                $.post('/huangfeihong/ajaxadduser', {'city': city, 'name': name, 'phone': phone, 'address': address}, function(data) {
                    var res = eval('(' + data + ')');
                    if (res.code == '10000') {
                        alert('恭喜您领奖成功，请等待工作人员与您联系！');
                        //操作成功！
                        window.location.href = '/huangfeihong/index';
                    } else {
                        alert(res.result);
                    }
                });

                $('#myform').submit();
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
</html>