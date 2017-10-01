<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/strasbourg/css/page_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
  <div class="mask_diag" data-move  style="display:;" >
  <div class="mask_main mask_yx_main hx_login">
    <a href="javascript:void(0)" class="close_btn"></a>
      <div class="mask_one mask_login">
          <h3>尊敬的商家您好，请填写您的手机号和木屋编号，该手机将用于本次活动用户礼品码的核销。</h3>
         
      </div>
  </div>
</div>
<div id="wrap" class="login" data-move>
  <div class="login_main">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_l.png" class="p1_tu_l">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_r.png" class="p1_tu_r">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_name.png" class="p1_tit_name">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_time.png" class="p1_tit_time">
  <ul class="form_offer">
      <li><label>核销手机</label><input type="text" id="phone"></li>
      <li><label>木屋编号</label><input type="text" id="roomnumer"></li>
      <li><a href="javascript:void(0)" class="offer_btn" id="sub_btn">确定</a></li>
  </ul>
  <div class="p1_tu_bt">
      <img src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_bt.png">
  </div>
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

</script>
 <script>
                 
                                        wx.ready(function() {
                                        	wx.hideMenuItems({
                                        	    menuList: [
                                        	       'menuItem:share:appMessage',
                                        	       'menuItem:share:timeline',
                                        	       'menuItem:share:qq',
                                        	       'menuItem:share:weiboApp',
                                        	       'menuItem:favorite',
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
      $(".close_btn").bind("click", function() {
          $(".mask_diag").hide();
      })

		})
</script>
<script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
  <script>
  var person={
	   'roomnumer':'',
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
	   
  	  if(this.phone == ''){
	  	    this.findError('请输入手机');
	  	  	return false;
	  	 }
//  	     if(!check_phone(this.phone)){
//   	    this.findError('手机号格式不正确');
//     	  	return false;
//  	   	 }
  	    if(this.roomnumer == ''){
	  	    this.findError('请输入木屋编号');
	  	  	return false;
	  	 }
  	 return true;
    }

  </script>
  <script>
  //捕捉到单击提交事件
  $('#sub_btn').bind('click',function(){
	    person.roomnumer=$('#roomnumer').val();
	    person.phone=$('#phone').val();
	    if(person.checkInput()){
	       $.post('/strasbourg/register/bregister2',{'roomnumer':person.roomnumer,'phone':person.phone},function(data){
	    	   var list=eval('('+data+')');
	    	   if(list.code != '10000'){
	                alert(list.result);
	            }else{
		            alert('注册成功');
	                //window.location.href="<?php echo $callback;?>";
	            }
		   });
		}
  });
  </script>
</body>
</html>
