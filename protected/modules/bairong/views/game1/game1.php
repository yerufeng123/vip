<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>玩游戏，赢大奖</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ . 'vip/bairong/' ?>css/common.css">
        <style>
            .notclick{
                background-color: #bbb;
            }
        </style>
        <script>
            var game = {
                _width: 0, //场景宽度
                j_height: 0, //判定高度
                l_height: 0, //离开高度
                gold_width: 55, //球的宽度
                gold_height: 51, //球的高度
                receive_left: 0, //左距离
                receive_width: 95, //人的宽度
                receive_height: 105, //人的高度
                num: 0, //页面中物品的个数
                level: 1, //难度等级
                _interval: 0, //出现金币间隔
                over: false, //游戏是否结束
                _sorc: 0, //分数
                _max: 0, //最高分数
                _id: "", //用户ID
                timeout: 300, //结束时间
                bg_audio: "<?php echo _STATIC_ . 'vip/bairong/' ?>video/bg.mp3", //背景音乐
            };
        </script>
    </head>
    <body>
        <div id="wrap" class="getGold">
            <article id="main">
                <ul id="stage" speed="1">
                    <span id="sore">0</span>
                    <div id="receive"></div>
                </ul>
            </article>
            <section id="mask" style="display:none;"> 
                <!-- 失败 -->
                <section class="dialog" id="false">
                    <img src="<?php echo _STATIC_ . 'vip/bairong/' ?>img/icon1.png" class="false_icon">
                    <span class="false_tit">您接到了炸弹，<br/>不要灰心哟~</span>
                    <span class="btn_ok again" id="again">再玩一次</span>
                    <span class="btn_ok share">分享给朋友</span>

                </section>
                <!-- 成功 -->
                <section class="dialog" id="sussess" style="display:none;"> 
                    <img src="<?php echo _STATIC_ . 'vip/bairong/' ?>img/icon2.png" class="sussess_icon">
                    <span class="sussess_tit">恭喜您！获得<b>1000</b>积分，<br/>请输入手机号：</span>
                    <input type="text" class="phone" id="phone"><span class="btn_get">领奖</span>

                </section>
                <!-- 获奖 -->
                <section class="dialog" id="goods" style="display:none;">
                    <img src="<?php echo _STATIC_ . 'vip/bairong/' ?>img/icon3.png" class="goods_icon">
                    <span class="goods_tit">获得了天堂牌<br/>“<b>晴雨伞</b>”一把！</span>
                    <span class="btn_ok share">分享给朋友</span>

                </section>
            </section>
            <section id="share" style="display:none;"></section>
        </div>
    </body>

    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/bairong/' ?>js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/bairong/' ?>js/slide.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/bairong/' ?>js/init.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/globals.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['minsheng']['wxappid'], Yii::app()->params['minsheng']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
        /*
         * 注意：
         *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
         */
        var title = '玩游戏领奖品';//分享标题
        var desc = '看看谁是朋友圈里最牛的购物狂人吧！';//分享描述
        var link = '<?php echo Yii::app()->request->hostInfo ?>/bairong/game1/index';//分享链接
        var imgUrl = '<?php echo _STATIC_ . 'vip/bairong/' ?>/img/baironglogo.png';//分享图标
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
        wx.ready(function() {
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: title, // 分享标题
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function() {
                    // 用户确认分享后执行的回调函数
                    //shareok('friends');
                },
                cancel: function() {
                    // 用户取消分享后执行的回调函数
                    //sharecancel('friends');
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
                success: function() {
                    // 用户确认分享后执行的回调函数
                    //shareok('friend');
                },
                cancel: function() {
                    // 用户取消分享后执行的回调函数
                    //sharecancel('friend');
                }
            });

            //分享到QQ
            wx.onMenuShareQQ({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function() {
                    // 用户确认分享后执行的回调函数
                    //shareok('qq');
                },
                cancel: function() {
                    // 用户取消分享后执行的回调函数
                    //sharecancel('qq');
                }
            });

            //分享到腾讯微博
            wx.onMenuShareWeibo({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function() {
                    // 用户确认分享后执行的回调函数
                    //shareok('weibo');
                },
                cancel: function() {
                    // 用户取消分享后执行的回调函数
                    // sharecancel('weibo');
                }
            });

        });
    </script>

    <script>
        $(function() {
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
            $('#mask').children().hide();
            $('#mask').hide();
            //单击分享
            $('.share').bind('click', function() {
                $('#share').show();
            });
            //单击遮罩
            $('#share').bind('click', function() {
                $('#share').hide();
            });
            //点击重玩
            $('#again').bind('click', function() {
                $('#mask').children().hide();
                $('#mask').hide();

                game_star();
            });
            //点击领奖
            $('.btn_get').bind('click', function() {
                var phone = $('#phone').val();
                if ($(".btn_get").hasClass('notclick')) {
                    return false;
                }
                play(phone);
            });
        });
    </script>
    <script>
        function play(phone) {
            $(".btn_get").addClass('notclick');
            //验证手机
            if (phone == undefined || phone == '' || !check_phone(phone)) {
                alert('手机号错误');
                $(".btn_get").removeClass('notclick');
                return false;
            }
            $.post('/game1/ajaxgetpost', {'key': 'setgame1score', 'phone': phone}, function(data) {
                //data为奖品名称
                if (data.indexOf('天堂牌晴雨伞') < 0) {
                    alert(data);
                    $(".btn_get").removeClass('notclick');
                    return false;
                }
                $(".btn_get").removeClass('notclick');
                $('#mask').show();
                $('#mask').children().hide();
                $('#goods').show();
            });
        }
    </script>
        <!--<script src="js/weichat_share.js"></script>-->
</html>