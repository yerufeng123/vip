<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/shake_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>

<div id="wrap" class="pay_one" data-move>
    <div class="p_main">
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/pay_tit_tu.png" class="pay_tit_tu">
    <h3 class="pay_one_tit">恭喜您，获得<?php echo $good['prize'];?></h3>
    <div class="pay_main pay2_main">
      <div class="pay_ps">
        <p>恭喜你，抽中斯特拉斯堡圣诞小镇护照签证
大奖，同时请留下您宝贵的资料信息。<br/>
我们将在12月25日圣诞节当天抽取三位欧洲
双人游大奖，敬请关注！</p>
      </div>
    </div>
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/shake_tu1.png" class="shake_tu2">
    <ul class="shake_form">
        <li><label>姓名</label><input type="text" id='name'></li>
        <li><label>手机</label><input type="text" id='phone'></li>
    </ul>

    <span class="pay_com pay_bnt" id='sub_btn'>领取中奖凭证</span>
    <img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/pay_bt.png" class="pay_bt" style="z-index: -99">
    </div>
</div>

<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
		})
</script>
<script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
  <script>
  var person={
	   'name':'',
	   'phone':'',
  }
  //用户报告错误
      person.findError=function(errMsg,type){
         switch(type){
         case 1:
             //完善信息框
             $('.diag_block').hide();
        	 $(".mask").show();
        	 $('.info_block').show();
             break;
         default :
             //普通错误
        	 alert(errMsg);
             break;
         }
  	   
  	    return false;
      }

    //用户检查输入
    person.checkInput=function(){
	    if(this.name == ''){
	  	    this.findError('请输入姓名');
	  	  	return false;
	  	 }
  	  if(this.phone == ''){
	  	    this.findError('请输入手机');
	  	  	return false;
	  	 }
 	     if(!check_phone(this.phone)){
  	    this.findError('手机号格式不正确');
    	  	return false;
 	   	 }
  	 return true;
    }

  </script>
  <script>
  //捕捉到单击提交事件
  $('#sub_btn').bind('click',function(){
	    person.name=$('#name').val();
	    person.phone=$('#phone').val();
	    if(person.checkInput()){
	       $.post('/strasbourg/active/ajaxuseradd',{'name':person.name,'phone':person.phone,'type':'<?php echo Constant::CHANNEL_LOTTERY2;?>'},function(data){
	    	   var list=eval(data);
	    	   if(list.code != '10000'){
	                alert(list.result);
	            }else{
	            	location.reload();
	            }
		   },'json');
		}
  });
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
</body>
</html>
