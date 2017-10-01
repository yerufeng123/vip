<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_; ?>vip/strasbourg/css/shake_detail.css" rel="stylesheet">
        <title>斯特拉斯堡圣诞小镇</title>
    </head>
    <body>
        <div id="wrap" class="" style="line-height:0;font-size:0;" onclick="javascript:getStyle();">
            <!--<img src="img/logo.png" class="logo">-->
            <div class="mask_box" style="display:none">
                <img class="s_people" src="<?php echo _STATIC_; ?>vip/strasbourg/img/people.png" />
                <img class="s_text" src="<?php echo _STATIC_; ?>vip/strasbourg/img/s_text.png"  />
            </div>
            <div class="shake_top"></div>
            <div class="shake_bot"></div>
            <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/pay_bt.png" class="pay_bt shake_pay_bt">
            <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/shake_tit_name.png" class="shake_tit_name shake_active">
        </div>
        <audio id="audio" preload='auto' src="<?php echo _STATIC_ ?>vip/strasbourg/video/yao.mp3"></audio>
            <audio id="audio2" preload='auto' src="<?php echo _STATIC_ ?>vip/strasbourg/video/yaozhong.mp3"></audio>
        <script src="<?php echo _STATIC_; ?>vip/strasbourg/js/jquery-1.8.1.min.js"></script>
        <script>
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
        </script>	
        <script type="text/javascript">
            var SHAKE_THRESHOLD = 750;//摇晃速度临界值
            var last_update = 0;
            var x, y, z, last_x, last_y, last_z;
            var times = 4;//超出几次临界值，算成功
            set_i = 0;//超出临界值速度次数
            function deviceMotionHandler(eventData) {
                var acceleration = eventData.accelerationIncludingGravity;
                var curTime = new Date().getTime();

                if ((curTime - last_update) > 100) {
                    var diffTime = curTime - last_update;
                    last_update = curTime;

                    x = acceleration.x;
                    y = acceleration.y;
                    z = acceleration.z;

                    var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;
                    if (speed > SHAKE_THRESHOLD) {
                        if (set_i <= times) {
                        	set_i++;
                        	if (document.getElementById('audio2').paused) {
                                document.getElementById('audio').play();
                            }
                            
                        }
                        if (set_i == times) {
                            document.getElementById('audio').pause();
                            if (document.getElementById('audio').paused) {
                                document.getElementById('audio2').play();
                                $("body").height($(window).height()).css({"overflow": "hidden"});
                                $('.mask_box').show();
                                $(".shake_bot").addClass("s_bot");
                                $(".shake_top").addClass("s_top");
                            }
                            //获取摇奖类型
                            getStyle();
                        }
                    }
                    last_x = x;
                    last_y = y;
                    last_z = z;
                }
            }
            if (window.DeviceMotionEvent) {
                window.addEventListener('devicemotion', deviceMotionHandler, false);
            }
        </script>
        <script>
            //获取摇奖类型
            function getStyle() {
                var style='<?php echo $lotterystyle;?>';
                $.post('/strasbourg/active/make', {'lotterystyle':style}, function(data) {
                    set_i = 0;
                    var list=eval(data);
                    if(list.code != '1000'){
                        if(list.msg== '谢谢惠顾'){
                        	window.location.href='/strasbourg/active/no_prize';
                        }else{
                       	 alert(list.msg);
                        }
                       
                    }else{
                        window.location.href='/strasbourg/active/is_prize?lid='+list.data.lid+'&lotterystyle='+style;
                    }
                    

                },'json');
            }
        </script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<script>
    /*
     * 注意：
     *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
     */
var title = '快来参加圣诞小镇抽奖';//分享标题
var desc = ' 斯特拉斯堡圣诞小镇诚邀您参加抽奖活动。';//分享描述
var link = 'http://' + window.location.host + '/strasbourg/navigation/index';//分享链接
var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share_gao.png';//分享图标
    var type = '';// 分享类型,music、video或link，不填默认为link
    var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"]; ?>',
        timestamp: <?php echo $signPackage["timestamp"]; ?>,
        nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
        signature: '<?php echo $signPackage["signature"]; ?>',
        jsApiList: [
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'closeWindow',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'hideMenuItems',
            'showMenuItems'
        ]
    });
    wx.ready(function () {
    	wx.hideMenuItems({
    	    menuList: [
    	       //'menuItem:share:appMessage',
    	       //'menuItem:share:timeline',
    	       'menuItem:share:qq',
    	       'menuItem:share:weiboApp',
    	       //'menuItem:favorite',
    	       'menuItem:share:facebook',
    	       'menuItem:share:QZone',
    	       'menuItem:editTag',
    	       'menuItem:delete',
    	       'menuItem:copyUrl',
    	       'menuItem:originPage',
    	       'menuItem:readMode',
    	       'menuItem:openWithQQBrowser',
    	       'menuItem:openWithSafari',
    	       'menuItem:share:email',
    	       'menuItem:share:brand'
    	       
    	   ] 
    	});
    	wx.showMenuItems({
      	    menuList: [
                  'menuItem:share:appMessage',
                  'menuItem:share:timeline',
                  //'menuItem:share:qq',
                  //'menuItem:share:weiboApp',
                  //'menuItem:favorite',
                  //'menuItem:share:facebook',
                  //'menuItem:share:QZone',
              ]
      	});
        //分享到朋友圈
        wx.onMenuShareTimeline({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                //shareok('friends');
            	shareok();
            },
            cancel: function () {
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
            success: function () {
                // 用户确认分享后执行的回调函数
                //shareok('friend');
            	shareok();
            },
            cancel: function () {
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
            success: function () {
                // 用户确认分享后执行的回调函数
                //shareok('qq');
            },
            cancel: function () {
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
            success: function () {
                // 用户确认分享后执行的回调函数
                //shareok('weibo');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // sharecancel('weibo');
            }
        });
    
    });
 </script>
        <script>
//           $(function(){
//               getStyle();
//           });
        </script>
        
    </body>
</html>
