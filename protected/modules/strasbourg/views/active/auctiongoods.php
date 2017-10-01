<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/jp_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>
<!--弹出框二维码-->
<!-------------------------弹出框 ---------------------->
<div class="mask_diag" data-move>
  <div class="mask_main mask_main_product">
      <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png" class="diag_jp_logo">
      <div class="mask_one">
          <div class="jp_tu_main">
            <img src="<?php echo _STATIC_ . 'vip/strasbourg/img/'.$this->setting[Constant::CHANNEL_AUCTION]['setting']['img']; ?>" class="jp_img">
        </div>
        <div class="jp_bg jp_bg_product">
             <p><?php echo $this->setting[Constant::CHANNEL_AUCTION]['setting']['discrption'];?>
              </p>
        </div>
          <a href="javascript:void(0)" class="diag_close diag_product">关闭</a>
      </div>
  </div>
</div>
<div id="wrap" class="jp_web" data-move>
    <div class="jp_tp"></div>
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png" class="jp_logo">
    <!--<img src="img/jp_tu1.png" class="jp_tu1">-->
    <div class="jp_main">
        <div class="jp_tu_main jp_rule_main">
            <ul>
                <li>竞拍规则：</li>
                <li>1、点击“马上竞价”进入竞拍页面，选择“我要竞拍”，每次增加竞价金额为<?php echo $this->setting[Constant::CHANNEL_AUCTION]['setting']['add'];?>元。</li>
                <li>2、竞拍结束，出价最高者视为成功，支付竞拍款项后会获得竞拍商品兑换凭证，请持凭证至蓝色港湾指定的圣诞小镇木屋兑换。</li>
                <li>3、竞拍商品每天仅限一件！</li>
            </ul>
        </div>
        

    </div>
    <span class="jp_enter jp_btn jp_two" id="nowauction"><a href="#">马上竞价<a></span>

     <span class="jp_product jp_btn">产品介绍</span>

    <div class="jp_bt"></div>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/touch.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })

      $(".jp_product").bind("click",function(){
        $(".mask_diag").show();
      })
      $(".diag_close").bind("click",function(){
        $(".mask_diag").hide();
      })

      $('#nowauction').bind('click',function(){
  	    $.post('/strasbourg/navigation/ajaxauction',{},function(data){
    	      var list=eval(data);
    	      if(list.code != '10000'){
  	    	    alert(list.result);
        	  }else{
      		    location.href="/strasbourg/active/auction";
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
var title = '快来参加圣诞小镇竞拍';//分享标题
var desc = ' 斯特拉斯堡圣诞小镇诚邀您参加竞拍活动,抢限量千禧酒';//分享描述
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
</body>
</html>
