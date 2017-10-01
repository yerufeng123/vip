<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta id="viewport" name="viewport"
	content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css"
	href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/game_index.css"
	rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
	<!--请将屏幕竖向浏览-->
	<div class="orientation_set">
		<div>
			<img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png"
				width="50" alt="" class="translate"><br>请将屏幕竖向浏览
		</div>
	</div>
	<!--请将屏幕竖向浏览-->
	<!-------------------------弹出框 ---------------------->
	<div class="mask_diag" data-move>
		<div class="mask_main">
			<a href="javascript:void(0)" class="close_btn" data-dialog-close></a>
	 <!--  	<img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake"> <img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake_one"> <img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake_two"> <img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake_three"> <img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake_four"> <img
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
				class="g_cake_five">-->
<!-- 			<div class="mask_one"> -->
<!-- 				<h3>游戏说明</h3> -->
<!-- 				<div class="rule_detail"> -->
<!-- 					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;叮铃~叮铃~圣诞老人驾着满车惊喜赶去送礼的路上，突然发现被可恶的乌鸦叼破货囊，惊慌的马卡龙掉落云端，圣诞老人惊呼：“麋鹿！麋鹿！快帮我拯救那些可怜的马卡龙~</p> -->
<!-- 					<h4>游戏规则：</h4> -->
<!-- 					<p>在每次30s的游戏中（不限次数），接住掉落的马卡龙，可获得积分奖励。累计游戏积分，即可以领取法国马卡龙。</p> -->
					<!-- 				<h4>游戏时间：</h4>  -->
					<!-- 					<p>每天不限游戏次数；</p>  -->
					<!-- 					<p>每次30s游戏时间。</p> -->
<!-- 					<h4>马卡龙兑换：</h4> -->
<!-- 					<p>持积分换取的斯特拉斯堡圣诞小镇美食兑换凭证，可到蓝色港湾木屋领取美味马卡龙。兑换凭证可通过关注“斯特拉斯堡圣诞集市”公众号进行管理。</p> -->
<!-- 				</div> -->
<!-- 			</div> -->
		</div>
	</div>
	<div id="wrap" class="game_login" data-move>
		<img
			src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_snow_tu.png"
			class="snow_tu"><img
			src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_mascot_tu.png"
			class="g_mascot_tu">
		<!-- login_offer_two 两个数据   login_offer_three 三个数据-->
		<ul
			class="login_offer 	<?php if(!$hascertif){?>login_offer_two	<?php }else{ ?> login_offer_three<?php } ?>">
			<li class="g_start" id='start'>开始游戏</li>
<!-- 			<li class="g_rule" id='rults'>游戏规则</li> -->
			<li class="g_win" id='score'><a
				href='<?php echo $this->createUrl('active/my_certificate',array('type'=>1,'atype'=>Constant::CHANNEL_GAME));?>'>查看中奖凭证</a></li>
		</ul>
	</div>

	<script
		src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
	<script type="text/javascript">
	$(function(){
  		//页面大小初始化
      (function(){
          var _width = document.body.clientWidth;
          var _dom = document.querySelector('#viewport');
          var scale = _width/320;
          _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
      })()
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
      //游戏规则
      $(".g_rule").bind("click",function(){
          $(".mask_diag").show();
      })
      //弹出框关闭
    $("[data-dialog-close]").bind("click", function() {
        $(".mask_diag").hide();
    })

     $.post('<?php echo $this->createUrl('active/my_certificate');?>',{type:1,atype:'game'},function(data){
		if(data > 0){
		   	$('.login_offer').removeClass('login_offer_two');
	    	$('.login_offer').addClass('login_offer_three');
	     }else{
		 	$('.login_offer').removeClass('login_offer_three');
	        $('.login_offer').addClass('login_offer_two'); 
		 }
	 },'html');
  	 
     $('#start').click(function(){
	 $.post('<?php echo $this->createUrl('active/christmasindex');?>',{},function(data){
		 if(data.code == 1000){
			 window.location.href='<?php echo $this->createUrl('navigation/gamerule');?>';
		 }else{
			 alert(data.msg);
		 }
	 },'json');
      });
})
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
var title = '快来拯救马卡龙吧！';//分享标题
var desc = ' 斯特拉斯堡圣诞集市诚邀您参与游戏互动，动动手指，就能品尝地道的法国马卡龙，心动不如行动呦~';//分享描述
var link = 'http://vip2.hui.net/strasbourg/active/christmasindex?_wv=1';//分享链接
var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share_pic.png';//分享图标
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
</body>
</html>
