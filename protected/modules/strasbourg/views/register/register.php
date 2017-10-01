<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_;?>vip/strasbourg/css/page_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<div id="wrap" class="login" data-move>
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_l.png" class="p1_tu_l">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_r.png" class="p1_tu_r">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_name.png" class="p1_tit_name">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_time.png" class="p1_tit_time">
  <ul class="form_offer">
      <li><label style= "display: inline-block;line-height: 21px;padding: 0;">请留下您宝贵的资料信息<br>以便中奖或礼品兑换时核销信息</label></li>
      <li><label>姓名</label><input type="text" id="name"></li>
      <li><label>电话</label><input type="text" id="phone"></li>
<!--       <li><label>家乡</label><input type="text" id="hometown"></li> -->
      <li><a href="javascript:void(0)" class="offer_btn" id="sub_btn">确定</a></li>
  </ul>
  <div class="p1_tu_bt">
      <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_bt.png">
  </div>
</div>

<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
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
                                            var title = '邀请函';//分享标题
                                            var desc = '斯特拉斯堡圣诞集市诚邀您参加活动，好吃好玩好礼尽在这里！';//分享描述
                                            var link = 'http://' + window.location.host + '/strasbourg/register/index';//分享链接
                                            var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share.png';//分享图标
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
<script type="text/javascript">
	$(function(){
     $("body").height($("body").height());
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
     
		})
</script>
<script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
  <script>
  var person={
	   'name':'',
	   'phone':'',
	   'hometown':'',
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
//  	   	 if(this.hometown == ''){
//   	   		this.findError('请输入家乡');
// 	  	  	return false;
//  	 	 }
  	 return true;
    }

  </script>
  <script>
  //捕捉到单击提交事件
  $('#sub_btn').bind('click',function(){
	    person.name=$('#name').val();
	    person.phone=$('#phone').val();
	    //person.hometown=$('#hometown').val();
	    if(person.checkInput()){
	       $.post('/strasbourg/register/register',{'name':person.name,'phone':person.phone,'channel':'<?php echo empty($_GET['channel'])? 'certificate' :$_GET['channel'];?>'},function(data){
	    	   var list=eval('('+data+')');
	    	   if(list.code != '10000'){
	                alert(list.result);
	            }else{
	                window.location.href="<?php echo $_GET['callback'];?>";
	            }
		   });
		}
  });
  </script>
  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
?>
<script>

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
        'showMenuItems',
        'hideOptionMenu'
    ]
});
</script>
<script>
wx.ready(function() {
	wx.hideOptionMenu();
});
</script>
</body>
</html>
