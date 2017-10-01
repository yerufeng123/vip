<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=320,user-scalable=no">
		<meta itemprop="name" content="浓情粽意端午节" />
		<meta itemprop="image" content="http://pai0.qpic.cn/paipai/hcCu0QXJg2lmJ5YLgYDIiaChPT4L5ngo8yf5OsV0xZ5g/2000" />
		<meta name="description" itemprop="description" content="端午吃什么？感受老字号带给你的浓浓端午味儿！" />
                <meta >
        <title>全聚德 浓情粽意端午节</title>
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
        <link rel="stylesheet" href="<?php echo _STATIC_; ?>vip/quanjude/css/common.css<?php echo (Yii::app()->params['common']['isradom']) ? '?radom=' . time() : ''; ?>">
        <script>
            var game = {
                _height: 0, //场景高度
                gold_width: 30, //球的宽度  //修改04-22
                gold_height: 33, //球的高度  //修改04-22
                j_height: 150, //判定高度  //修改04-22
                //l_height:0,     //离开高度  //修改04-22
                rec_val: 0, //入口编号
                receive: 20, //入口大小  //修改04-22
                receive0: 96, //入口1   //修改04-22
                receive1: 198, //入口2   //修改04-22
                _interval: 4000, //金币口切换的间隔
                _time: null, //金币口切换
                _fly: false, //金币是否在上飞行
                over: false, //游戏是否结束
                _sore: 0, //分数
                _id: "", //用户ID
                timeout: 40, //结束时间
                gold_sore: 10, //金币的分数
            };

            //游戏结束
            function gameOver(_sore) {
                if (_sore < 60) {
                    $('#mask').show();
                    $('.dialog').hide();
                    $('#gxdfal').show();
                } else if (_sore < 150) {
                    $('#mask').show();
                    $('.dialog').hide();
                    desc = '我吃了' + parseInt(_sore / 10) + '个粽子,快来挑战吧!';
                    wxflash();
                    $('#gxdsucc1').show();
                } else if (_sore < 200) {
                    $('#mask').show();
                    $('.dialog').hide();
                    desc = '我吃了' + parseInt(_sore / 10) + '个粽子,快来挑战吧!';
                    wxflash();
                    $('#gxdsucc2').show();
                } else if (_sore < 250) {
                    $('#mask').show();
                    $('.dialog').hide();
                    desc = '我吃了' + parseInt(_sore / 10) + '个粽子,快来挑战吧!';
                    wxflash();
                    $('#gxdsucc3').show();
                } else {
                    $('#mask').show();
                    $('.dialog').hide();
                    desc = '我吃了' + parseInt(_sore / 10) + '个粽子,快来挑战吧!';
                    wxflash();
                    $('#gxdsucc4').show();
                }
                clearInterval(game._time);
            }
            //游戏开始
            /*game_star();*/
        </script>
    </head>
    <body>
        <div id="wrap" class="getGold">
            <ul id="stage" speed="1">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/game_foot.png" class="stage_foot">
                <span id="time">40</span>
                <span id="sore">0</span>
                <div  id="receive1" class='mouth'></div>
                <div  id="receive2"></div>

                <!-- <div class="boat"></div> -->
               <!--  <img src="img/food.png" class="food_fly"> -->
            </ul>
        </div>
        <div id="mask"  style="display:none">
            <div class="dialog dia_false"  id="gxdfal" style="display:none">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/faile.png" class="false">
                <p class="false_text">很遗憾，没有成功，<br/>再来一次吧！<br/>再接再厉！</p>
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/buy.png" class="btn_close btn">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/conti_btn.png" class="btn_conti btn">
            </div>
            <div class="dialog dia_success "  id="gxdsucc1" style="display:none">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/success.png" class="success">
                <p class="success_text">恭喜你中了满200减10元奖券，点击右上角分享，和朋友分享你的惊人食量吧！<br/>现在领取！</p>
                <a href="http://z.paipai.com/ZPfIJd" class="btn_good btn"></a>
                <a href="http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1" class="btn_buy btn"></a>
        <!--                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/good_btn.png" class="btn_good btn" onclick="javascript:location.href = 'http://z.paipai.com/n8VPnS'">-->
            </div>
            <div class="dialog dia_success "  id="gxdsucc2" style="display:none">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/success.png" class="success">
                <p class="success_text">恭喜你中了满300减15元奖券，点击右上角分享，和朋友分享你的惊人食量吧！<br/>现在领取！</p>
                <a href="http://z.paipai.com/2Olooa" class="btn_good btn"></a>
                <a href="http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1" class="btn_buy btn"></a>
<!--                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/good_btn.png" class="btn_good btn" onclick="javascript:location.href = 'http://z.paipai.com/2Olooa'">-->
            </div>
            <div class="dialog dia_success "  id="gxdsucc3" style="display:none">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/success.png" class="success">
                <p class="success_text">恭喜你中了满500减30元奖券，点击右上角分享，和朋友分享你的惊人食量吧！<br/>现在领取！</p>
                <a href="http://z.paipai.com/wsua48" class="btn_good btn"></a>
                <a href="http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1" class="btn_buy btn"></a>
                <!--                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/good_btn.png" class="btn_good btn" onclick="javascript:location.href = 'http://z.paipai.com/wsua48'">-->
            </div>
            <div class="dialog dia_success " id="gxdsucc4"  style="display:none">
                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/success.png" class="success">
                <p class="success_text">恭喜你中了5元奖券，点击右上角分享，和朋友分享你的惊人食量吧！<br/>现在领取！</p>
                <a href="http://z.paipai.com/26JnuM" class="btn_good btn"></a>
                <a href="http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1" class="btn_buy btn"></a>
<!--                <img src="<?php echo _STATIC_; ?>vip/quanjude/img/good_btn.png" class="btn_good btn" onclick="javascript:location.href = 'http://z.paipai.com/26JnuM'">-->
            </div>
        </div>
        <audio preload="auto" id="eat" src="<?php echo _STATIC_; ?>vip/quanjude/video/oneTime.mp3"></audio>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_; ?>vip/quanjude/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_; ?>vip/quanjude/js/init.js<?php echo (Yii::app()->params['common']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['common']['wxappid'], Yii::app()->params['common']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
            var title = '全聚德 浓情粽意端午节';//分享标题
            var desc = '端午吃什么？感受老字号带给你的浓浓端午味儿！';//分享描述
            var link = 'http://' + window.location.host + '/quanjude/index?_wv=1&random='+Math.random();//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/quanjude/img/share.png?radom=<?php echo time(); ?>';//分享图标
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
                        title: desc, // 分享标题
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

                function wxflash() {
                    //分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: desc, // 分享标题
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
                }
    </script>
    <script>
        $(function() {
            document.addEventListener('touchmove', function(e) {
                e.preventDefault()
            })
            //单击重玩
            $('.btn_conti').bind('click', function() {
                $('#mask').hide();
                $('.dialog').hide();
                game_star();
            });

            //单击关闭
            $('.btn_close').bind('click', function() {
                $('#mask').hide();
                $('.dialog').hide();
                //location.href = "/quanjude/index";
                location.href = "http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1";
            });
        });
        document.addEventListener('WeixinJSBridgeReady', function() {
            document.getElementById('eat').play();
        }, false);
    </script>
</html>