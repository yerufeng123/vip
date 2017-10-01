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
    <script>
        var page_list = [];	//页面动画动画元素
        var page = {
            _width: 0, //页面宽度
            _height: 0, //页面高度
            _zoom: 1, //页面适配缩放比
            _index: 0, //当前显示第几个页面
            _num: 0, //页面个数
            sign: true, //页面跳转标识
            clear: true, //页面清除动画标识
            skip: "card", //页面换页方式{卡片:card;跳转:jump;旋转:rotat;风车:wind;连线:line|翻页:book;}
            _dir: -1, //页面切换的方向（-1为向下，1为向上）
            _top: 0, //滚动元素到页面顶上的距离
            _pre: false,
        };
    </script>
    <body>
        <div id="wrap" class="page_home">
            <ul id="page_list">
                <!-- 展示页 -->
                <li class="page page1 show" id="page1" scene="1">
                    <!-- 首页 -->
                <li class="page2 page" id="page2" scene="2">
                    <div class="fly"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/index_fly.png" /></div>
                    <div class="logo"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/logo.png"/></div>
                    <div class="index_text1"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/index_text1.png" /></div>
                    <div class="index_text2"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/index_text2.png"/></div>
                    <div class="index_child"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/index_child.png" /></div>
                    <div class="btn_box">
                        <a href="javascript:void(0)" class="btn" id="star_btn" href="javascript:void(0)">开始游戏</a>
                        <a href="javascript:void(0)" class="btn" id="inf_btn" href="javascript:void(0)">游戏说明</a>
                        <a href="javascript:void(0)" class="btn" id="share_btn" href="javascript:void(0)">分享好友</a>
                    </div>
                    <div class="index_page"><img src="<?php echo _STATIC_ ?>vip/huangfeihong/img/index_bag.png" /></div>
                    
                    <!--分享-->
                    <section class="share" id="share" style="display:none">
                    </section> 
                </li>
            </ul>
            <!-- 游戏规则 -->
            <section class="rule_inf rule_mask" id="mask" style="display:none">
                <div class="rule" style="overflow: hidden">
                    <h4 class="rule_tit" style="padding: 23px 0 10px 0;">游戏说明</h4>
                    <p style="color:#333;padding: 15px 25px 0 25px;overflow: auto;height:196px">&emsp;&emsp;亲，请用手指拖动屏幕底端的盒饭，然后用你灵巧的双手尽量去接取天上掉下的花椒、辣椒和花生，不过要小心隐藏其中的炸弹哦，接到炸弹，游戏结束。游戏金币超过500个，就有机会抽取奖品（apple watch 或麻辣小鱼干花生）每个ID每天3次挑战机会，分享好友获取更多次数（朋友点开链接才算哦），但每人每天至多可以挑战6次！温馨提示：中奖的消费者，若不慎退出填写信息的页面，请及时微信联系小编，提交正确的信息领奖信息。</p>
                     <a href="javascript:void(0)" class="close btn">关闭</a>
                </div>
               
            </section>
            <section class="game_null rule_mask share_none" id="mask" style="display:none">
                <div class="rule" style="height:200px;margin-top:-100px">
                    <p style="margin-top:15px;color:#333">&emsp;&emsp;亲，您今天的三次机会已用完啦，分享还能继续玩哦！</p>
                </div>
                <a href="javascript:void(0)" class="close btn" style="top:51%">关闭</a>
            </section>
            <section class="game_null rule_mask game_none" id="mask" style="display:none">
                <div class="rule" style="height:200px;margin-top:-100px">
                    <p style="margin-top:15px;color:#333">&emsp;&emsp;亲，您今天的挑战次数已用完啦，明天再来玩吧！</p>
                </div>
                <a href="javascript:void(0)" class="close btn" style="top:51%">关闭</a>
            </section>
            <img id="drop_down" src="<?php echo _STATIC_ ?>vip/huangfeihong/img/drop_down.png" />
        </div>
    </body>
    <script src="<?php echo _STATIC_ ?>vip/huangfeihong/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="<?php echo _STATIC_ ?>vip/huangfeihong/js/slide.js" type="text/javascript"></script>
    <script src="<?php echo _STATIC_ ?>vip/huangfeihong/js/init.js" type="text/javascript"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
        //判定用户是否可以玩
        function checkplay() {
            switch (flag) {
                case 'none':
                    $('.share_none').hide();
                    $('.game_none').show();
                    return false;
                    break;
                case 'share':
                    $('.game_none').hide();
                    $('.share_none').show();
                    return false;
                    break;
                default :
                    //可以玩游戏
                    return true;
            }
        }
        function shareok() {
            //更新分享次数
            $.post('/huangfeihong/ajaxsetsharetime', {}, function(data) {
                var res = eval('(' + data + ')');
                if (res.code != '10000') {
                    alert(res.result);
                    return false;
                }
            });
        }
    </script>
    <script>
        
        $("#inf_btn").bind("click", function() {
            $('.game_null').hide();
            $(".rule_inf").show();
        })
        $(".close").bind("click", function() {
            $(".rule_mask").hide();
        })
    </script>
    <script>
        var flag = "<?php echo $flag; ?>";
        $(function() {
            $("#page_list").bind("touchmove",function(e){ 
                e.preventDefault();
    })
            //单击玩游戏
            $('#star_btn').bind('click', function() {
                if (checkplay()) {
                    window.location.href = "/huangfeihong/game";
                }
            });


            //单击分享好友
            $('#share_btn').bind('click', function() {
                $('.rule_inf').hide();
                $('#share').show();
            });

            //单击遮罩
            $('#share').bind('click', function() {
                $('#share').hide();
            });

        });
    </script>
</html>