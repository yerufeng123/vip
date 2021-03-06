<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="email=no">
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <title>英纳格手表</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/enicar/css/common.css<?php echo (Yii::app()->params['enicar']['isradom']) ? '?radom=' . time() : ''; ?>">
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
            <div class="mask">
                <!-- 填写信息 -->
                <div class="dialog dia_inf" style=" display: block">
                    <p class="dia_text">请输入您的姓名与电话号码</p><br/>
                    <label class="dia_name">姓名：<input type="text" class="dia_input" placeholder="请输入您的姓名：" id="name"></label>
                    <label class="dia_photo">号码：<input type="text" class="dia_input" placeholder="请输入您的号码：" id="phone"></label>
                    <div class="dia_btn" id="tijiao" >提交</div>
                </div>
                <!-- 领奖提示 -->
                <div class="dialog dia_tips"  style="display: none">
                    <p class="dia_text">5.2元话费将在游戏结束后10个工作日内充值在您的手机中，感谢您的参与。</p>
                    <div class="dia_btn" onclick="javascript:location.href = '/enicard/index'">返回首页</div>
                </div>
            </div>

        </div>
    </body>
    <script>

    </script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/enicar/js/zepto.min.js<?php echo (Yii::app()->params['enicar']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/globals.js<?php echo (Yii::app()->params['enicar']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['enicar']['wxappid'], Yii::app()->params['enicar']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
        /*
         * 注意：
         *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
         */
        var title = '英纳格送爱分秒不息';//分享标题
        var desc = '英纳格520.用礼物替你说出心里的话';//分享描述
        var link = 'http://' + window.location.host + '/enicard/share';//分享链接
        var imgUrl = '<?php echo _STATIC_; ?>vip/enicar/img/share.jpg';//分享图标
        var type = '';// 分享类型,music、video或link，不填默认为link
        var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"]; ?>',
            timestamp: <?php echo $signPackage["timestamp"]; ?>,
            nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
            signature: '<?php echo $signPackage["signature"]; ?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
            ]
        });
        wx.ready(function () {
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: desc, // 分享标题
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    shareok('friends');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('friends');
                }
            });

            //分享给朋友
            wx.onMenuShareAppMessage({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                type: type, // 分享类型,music、video或link，不填默认为link
                dataUrl: dataUrl, // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                    shareok('friend');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('friend');
                }
            });

            //分享到QQ
            wx.onMenuShareQQ({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    shareok('qq');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('qq');
                }
            });

            //分享到腾讯微博
            wx.onMenuShareWeibo({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    shareok('weibo');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    sharecancel('weibo');
                }
            });

        });

        //分享成功回调函数
        function shareok(type) {
            //增加一次分享
            $.post('/enicard/ajaxaddshare', {}, function (data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                    return false;
                }
            });
        }

        //分享取消回调函数
        function sharecancel(type) {

        }
    </script>
    <script>
        $(function () {
            //单击提交
            $('#tijiao').bind('click', function () {
                var name = $('#name').val();
                var phone = $('#phone').val();

                if (name == '') {
                    alert('请填写姓名');
                    return false;
                }

                if (phone == '') {
                    alert('请填写手机号');
                    return false;
                }
                //判断手机号
                if (!check_phone(phone)) {
                    alert('手机号格式不正确');
                    return false;
                }

                //完善玩家信息
                $.post('/enicard/ajaxsignup', {'name':name,'phone':phone}, function (data) {
                    var res = eval('(' + data + ')');
                    if (res.code != '10000') {
                        alert(res.result);
                        return false;
                    } else {
                        $('.dialog').hide();
                        $('.dia_tips').show();
                    }

                });
            });


        });
    </script>
</html>