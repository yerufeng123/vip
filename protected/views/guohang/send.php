<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="Keywords" content="" />
		<meta name="Description" content="" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="<?php echo _STATIC_;?>vip/guohang/css/nprogress.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo _STATIC_;?>vip/guohang/css/style.css" />
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/nprogress.js"></script>
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/jquery-2.1.0.js"></script>
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/jquery.rotate.js"></script>
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/jquery.appear.js"></script>
		<script type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/script.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?php echo _STATIC_;?>vip/guohang/js/s_code.js"></script>
<script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on
the next lines. */
s.pageName = "";
s.channel=""
s.pageType=""
s.prop1=""
s.prop2=""
s.prop3=""
s.prop4=""
/* Conversion Variables */
s.events=""
s.products=""
s.purchaseID=""
s.eVar1=""
s.eVar2=""
s.eVar3=""
s.eVar4=""
/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
vars_code=s.t();if(s_code)document.write(s_code)//--></script>
<script language="JavaScript" type="text/javascript"><!--
if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
//--></script>
<noscript>
	<imgsrc="http://airchina.112.2o7.net/b/ss/acna-dom2-en-dev/1/H.22.1--NS/0?[AQB]&cdp=3&[AQE]"
height="1" width="1" border="0" alt="" />
</noscript>
		<title>新年送福 - 国航</title>
	</head>

	<body>
		<div class="page page_0" id="page_0" data-destination="#page_1">
			&nbsp;
		</div>
		<div class="page page_1" id="page_1" data-destination="#page_2">
			<img class="page_1_main" src="<?php echo _STATIC_;?>vip/guohang/img/page_1_main.png" />
			<img class="page_1_lady" src="<?php echo _STATIC_;?>vip/guohang/img/page_1_lady.png" />
			<img class="page_1_newyear" src="<?php echo _STATIC_;?>vip/guohang/img/page_1_newyear.png" />
			<img class="page_1_down" src="<?php echo _STATIC_;?>vip/guohang/img/down.png" />
		</div>
		<div class="page page_2" id="page_2">
			<div class="page_2_inner">
				<div class="choose_title">选择模版</div>
				<div class="choose_content">
					<a class="choose_item" href="/guohang/senddetail?type=1" data-destination="#page_3_1">恶搞无底线</a>
					<a class="choose_item" href="/guohang/senddetail?type=2" data-destination="#page_3_2">温馨小清新</a>
					<a class="choose_item" href="/guohang/senddetail?type=3" data-destination="#page_3_3">甜蜜寄语</a>
					<a class="choose_item" href="/guohang/senddetail?type=4" data-destination="#page_3_4">感恩的心</a>
				</div>
			</div>
		</div>
	</body>
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
                                            var title = '您收到一封新年贺卡';//分享标题
                                            var desc = '藏了一年的心里话，我今天必须要跟你说……';//分享描述
                                            var link = 'http://' + window.location.host + '/guohang/index';//分享链接
                                            var imgUrl = '<?php echo _STATIC_;?>vip/guohang/img/page_6_icon.png';//分享图标
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
                                                        	$.post('/guohang/ajaxshareok',{},function(){});
                                                            // 用户确认分享后执行的回调函数
                                                            //shareok('friends');
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
                                                        	$.post('/guohang/ajaxshareok',{},function(){});
                                                            // 用户确认分享后执行的回调函数
                                                            //shareok('friend');
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
</html>