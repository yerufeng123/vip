<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta content="telephone=no" name="format-detection" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
        <title>一汽丰田</title>
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
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/yiqi/css/common.css?random=<?php echo time(); ?>">
    </head>
    <body>
        <div id="wrap" style='max-width: 640px;margin:auto'>
            <h3>“志成一派”狂欢周末，等你来HIGH！</h3>
            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img12.jpg" />
            <p>锐志，一个令无数人疯狂的名字。这一次，让青春与音乐为伍，让时尚和尖叫狂欢。这是为锐志车主和想要拥有锐志的你，打造的一次激情大趴。在这里，以个性为核心，我们志成一派！赶快来参加，这里的激情等你体验！</p>
            <h6>体验锐志清凉泡泡趴</h6>
            <P>被热情炙烤的仲夏夜，我们欢迎每一位狂热分子！在游戏里放肆畅快，在漫天的泡泡中挥洒自我，让我们，志成一派！尽情畅爽热力盛夏。</p>

            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img2.jpg" />
            <h6>感受极致天使魅惑</h6>

            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img3.jpg" />
            <h6>激情互动，火力全开</h6>
            <p>各类休闲竞技体验，团队协作抑或单枪匹马，尽可前来一试，力赢丰厚狂欢礼。</p>

            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img4.jpg" />
            <h6>光影交错，HIGH翻全场</h6>
            <p>激情摇滚，动感DJ，光影交错中尽情摇摆，时尚、潮流尽现眼底，让热情HIGH翻全场。</p>

            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img5.jpg" />
            <h6>激情礼遇：</h6>
            <p>1、通过网络及现场的激情互动游戏，你将得到活动现场的专属惊喜礼遇。<br>2、每位到场来宾均可获得精美礼品一份；开锐志车到场可增获锐志车模一个，参与现场活动，有机会获得终极神秘大奖。</p>

            <img src="<?php echo _STATIC_ ?>vip/yiqi/img/img6.jpg" />
            <ul class="uls uls1">
                <li>
                        <label>具体活动时间：</label><!-- <input type="text" /> --><?php echo $business ?>
                </li>
                <li>
                        <label>具体活动地点：</label><!-- <input type="text" /> --><?php echo $address2 ?>
                </li>
            </ul>
            <h6>报名方式：</h6>
            <p class="text">1、经销店报名——报名方法及活动详情请咨询当地经销商</p>
            <p class="text">2、网络平台报名——一汽丰田官方网站报名</p>
            <p class="text">3、微信互动报名——点击识别二维码进行报名</p>
            <ul class="uls uls2">
                <li>
                        <label>当地经销店地址：</label><!-- <input type="text" /> --><?php echo $address1 ?>
                </li>
                <li>
                        <label>联系电话：</label><a class="p_tel" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a><!-- <input type="text" /> -->

                </li>
                <li>
				<label>微信公众账号：</label><?php echo $weixin; ?>
			</li>
		</ul>
		<img class="img7" src="<?php echo _STATIC_ ?>vip/yiqi/img/img7.jpg" /><p class="wechat_change">微信互动</p>

        </div> 
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/yiqi/js/jquery-2.1.1.min.js"></script>
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
                                    var title = '锐志2015狂欢周末，打造最嗨夏日狂欢，惊艳开启。';//分享标题
                                    var desc = '“志成一派”狂欢周末，等你来HIGH！';//分享描述
                                    var link = 'http://' + window.location.host + '/yiqi/index';//分享链接
                                    var imgUrl = '<?php echo _STATIC_; ?>vip/yiqi/img/img12.jpg?radom=<?php echo time(); ?>';//分享图标
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
</html>