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
            <div class="flower1"></div>
            <div class="watch">
                <div class="time_m" value="0"></div>
                <div class="time_h" value="0"></div>
            </div>
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/bg.png" class="bg">
            <div class="flower"></div>
            <div class="point">START</div>
            <img src="<?php echo _STATIC_ ?>vip/enicar/img/logo.png" class="logo">
        </div>
        <div class="mask" style="display: none">
            <!-- 恭喜中奖 -->
            <div class="dialog dia_success" style=" display: none">
                <p class="dia_text">恭喜您，中奖啦，请点击里获取礼品</p>
                <a href="/enicard/signup" class="dia_btn">获取礼品</a>
            </div>
            <!-- 分享增加一次机会 -->
            <div class="dialog dia_add" style=" display: none">
                <p class="dia_text">Oops, 还差一点哦，分享给朋友为自己增加一次机会吧！</p>
                <a href="javascript:void(0)" class="dia_btn">分享给好友</a>
            </div>
            <!-- 次数用完 -->
            <div class="dialog dia_over" style="display:none">
                <p class="dia_text">您今天的挑战次数已用完，明天再来吧！</p>
                <a href="/enicard/index" class="dia_btn">返回首页</a>
            </div>
            <!-- 分享 -->
            <div class="dia_share" style=" display: none">
                <img src="<?php echo _STATIC_ ?>vip/enicar/img/share.png" class="share">
            </div>

        </div>
    </body>
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
                } else {
                    window.location.href = '/enicard/index'
                }
            });
        }

        //分享取消回调函数
        function sharecancel(type) {

        }
    </script>
    <script>
        document.addEventListener('touchmove', function (e) {
            e.preventDefault()
        })
        var game = {
            _start: false,
            _prize: 0	  //后端需要重新赋值
        }
        $(document).ready(function (e) {
            document.addEventListener('touchstart', function (e) {
                if (e.target.className == 'mask') {
                    $('dialog').hide();
                    $('.dia_share').hide();
                    $('.mask').hide();
                    game_reset();
                }
            }, false)
            $('.point').bind('touchstart', function () {
                var _min = 4;
                var _house = 5;
                //随机中奖
                if(rd(0, 99)< 25){
                    game._prize = 0
                }else{
                    game._prize =1;
                }

                $('.time_h,.time_m').addClass("run");
                //不中奖
                if (!game._prize) {
                    _house = Math.floor(Math.random() * 12);
                    _min = Math.floor(Math.random() * 12);
                    if (_house == 5 && _min == 4) {
                        _min = 3;
                    }
                }
                stop(_min, _house);
                $(this).hide();
                game._start = true;
            })
            document.addEventListener('transitionEnd', function (e) {
                isStop($(e.target))
            });
            document.addEventListener('webkitTransitionEnd', function (e) {
                isStop($(e.target))
            });
            //手表停止转动
            function stop(m_deg, h_deg) {
                m_deg = 1800 + m_deg * 30;
                h_deg = 720 + h_deg * 30;
                time_run($('.time_h'), h_deg);
                time_run($('.time_m'), m_deg);
            }
            //手表转动
            function time_run(_dom, _deg) {
                $(_dom).css('-webkit-transform', 'rotate(' + _deg + 'deg)');
            }
            //手表是否停止
            function isStop(that) {
                if (!game._start) {
                    return false;
                }
                if (that.hasClass('time_m')) {
                    game_over();
                }
            }
            //游戏结束
            function game_over() {
                if (game._prize) {
                    $('.mask').show();
                    $('.dialog').hide();
                    $('.dia_success').show();
                } else {
                    $.post('/enicard/ajaxcheckenable', {}, function (data) {
                        var res = eval('(' + data + ')');
                        if (res.code != '10000') {
                            alert(res.result);
                            return false;
                        }
                        switch (res.result) {
                            case 'no':
                                $('.mask').show();
                                $('.dialog').hide();
                                $('.dia_over').show();
                                break;
                            case 'share':
                                $('.mask').show();
                                $('.dialog').hide();
                                $('.dia_add').show();
                                break;
                            default:
                                $('.mask').show();
                                $('.dialog').hide();
                                $('.dia_add').show();
                                return true;
                        }
                        return false;
                    });
                }
                //alert('游戏结束');
                //game_reset();
            }
            //游戏重置
            function game_reset() {
                $('.time_h,.time_m').removeClass("run");
                game._start = false;
                game._prize = 0;//后端需要重新赋值
                $('.time_h,.time_m').attr("style", "");
                $('.time_h,.time_m').attr("value", 0);
                $('.point').show();
                $('.mask').hide();
                $('.dialog').hide();
                $('.dia_share').hide();
            }

            //游戏开始
            function game_start() {
                $.post('/enicard/ajaxcheckenable', {}, function (data) {
                    var res = eval('(' + data + ')');
                    if (res.code != '10000') {
                        alert(res.result);
                        return false;
                    }
                    switch (res.result) {
                        case 'no':
                            $('.mask').show();
                            $('.dialog').hide();
                            $('.dia_over').show();
                            break;
                        case 'share':
                            $('.mask').show();
                            $('.dialog').hide();
                            $('.dia_add').show();
                            break;
                        default:
                            //增加游戏次数
                            $.post('/enicard/ajaxaddnum', {}, function (data) {
                                var res = eval('(' + data + ')');
                                if (res.code != '10000') {
                                    alert(res.result);
                                    return false;
                                }
                                $('.time_h,.time_m').addClass("run");
                                time_run($('.time_m'), 720);
                                time_run($('.time_h'), 360);
                                $('.point').html("STOP");
                                game._start = true;
                            });
                    }
                    return false;
                });
            }

            //单击分享给好友
            $('.dia_btn').bind('click', function () {
                $('.mask').show();
                $('.dia_share').show();
                $('.dia_add').hide();
            });

            //单击遮罩
            $('.dia_share').bind('click', function () {
                $('.mask').hide();
                $('.dia_share').hide();
                game_reset();
            });

        })
    </script>
</html>