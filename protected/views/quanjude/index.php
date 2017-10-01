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
    </head>
    <body>
        <div id="wrap" class="index">
            <img src="<?php echo _STATIC_; ?>vip/quanjude/img/logo.png" class="logo">
            <img src="<?php echo _STATIC_; ?>vip/quanjude/img/logo2.jpg" class="logo2">
            <img src="<?php echo _STATIC_; ?>vip/quanjude/img/tit.png" class="tit">
            <a href="javascript:void(0)" class="btn btn_game"></a>
            <a href="javascript:void(0)" class="btn btn_rule"></a>
            <a href="http://imgcache.gtimg.cn/club/platform/lib/mqqadapter/proxyforward.html?mqqactid=4&_wv=1" class="btn btn_buy"></a>

            <div id="mask" style="display:none">
                <div class="dialog dia_rule">
                    <h3 class="rule_tit">游戏说明</h3>
                    <p class="rule_text">
                        1、活动时间：2015.6.15-2015.6.20<br>
                        2、玩法：轻触下方小船，让尽量多粽子飞入屈原张开的口中，屈原会送你不同额度粽子优惠券哦！<br>
                        3、优惠券使用方式：
                        （1）每个额度的优惠券限领一张
                        （2）本优惠券仅限拍拍网仿膳旗舰店购买粽子商品使用<br>
                        4、本活动法律范围内最终解释权归 北京全聚德仿膳食品有限责任公司
                        <br/></p>
                    <img src="<?php echo _STATIC_; ?>vip/quanjude/img/close_btn.png" class="btn_close btn">
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo _STATIC_; ?>vip/quanjude/js/zepto.min.js"></script>
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
        </script>
        <script>
            window.onload = function() {
               
//                document.addEventListener('touchmove', function(e) {
//                    e.preventDefault()
//                })
                var _btn = document.querySelector('.btn_close');
                _btn.addEventListener('click', function(e) {
                    var mask = document.querySelector('#mask');
                    mask.style.display = 'none';
                })
                _btn = document.querySelector('.btn_rule');
                _btn.addEventListener('click', function(e) {
                    var mask = document.querySelector('#mask');
                    mask.style.display = 'block';
                })

                //单击吃
                $('.btn_game').bind('click', function() {
                    location.href = "/quanjude/game?_wv=1";
                });

            }
        </script>
    </body>
</html>