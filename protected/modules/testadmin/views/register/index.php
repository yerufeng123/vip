<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/testadmin/css/page_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
  <div class="mask_diag" data-move  style="display:none;" >
  <div class="mask_main mask_yx_main hx_login">
    <a href="javascript:void(0)" class="close_btn"></a>
      <div class="mask_one mask_login">
          <h3>尊敬的商家您好，请填写您的相关信息，以便参加后续的活动。</h3>
      </div>
  </div>
</div>
<div id="wrap" class="login" data-move>
  <div class="login_main">
  <img src="<?php echo _STATIC_?>vip/testadmin/img/p1_tu_l.png" class="p1_tu_l">
  <img src="<?php echo _STATIC_?>vip/testadmin/img/p1_tu_r.png" class="p1_tu_r">
  <img src="<?php echo _STATIC_?>vip/testadmin/img/p1_tit_name.png" class="p1_tit_name">
  <img src="<?php echo _STATIC_?>vip/testadmin/img/p1_tit_time.png" class="p1_tit_time">
  <ul class="form_offer">
      <li><label>姓名</label><input type="text" id="name"></li>
      <li><label>手机</label><input type="text" id="phone"></li>
      <li><label>区域</label>
          <select id="city" style="width: 172px;
height: 28px;
font-size: 14px;
line-height: 28px;
border: 1px solid #e9d2a6;
background: none;
color: #e9d2a6;
-webkit-border-radius: 0px;">
              <option value="朝阳区">朝阳区</option>
              <option value="海淀区">海淀区</option>
              <option value="东城区">东城区</option>
              <option value="西城区">西城区</option>
              <option value="崇文区">崇文区</option>
              <option value="宣武区">宣武区</option>
              <option value="丰台区">丰台区</option>
              <option value="石景山区">石景山区</option>
              <option value="昌平区">昌平区</option>
              <option value="顺义区">顺义区</option>
              <option value="通州区">通州区</option>
              <option value="大兴区">大兴区</option>
              <option value="房山区">房山区</option>
              <option value="门头沟区">门头沟区</option>
              <option value="延庆区">延庆区</option>
              <option value="怀柔区">怀柔区</option>
              <option value="密云区">密云区</option>
              <option value="平谷区">平谷区</option>
          </select>
      </li>
      <li><label>地址</label><textarea id="address" style="width: 166px;
height: 28px;
font-size: 14px;
line-height: 28px;
border: 1px solid #e9d2a6;
background: none;
color: #e9d2a6;
-webkit-border-radius: 0px;"></textarea></li>
      <li><a href="javascript:void(0)" class="offer_btn" id="sub_btn">预约</a></li>
  </ul>
  <div class="p1_tu_bt">
      <img src="<?php echo _STATIC_?>vip/testadmin/img/p1_tu_bt.png">
  </div>
</div>

<section class="power_by">Powered by: <a href="http://www.hui.net/" target="_blank">会点</a></section>
    
</div>

<script src="<?php echo _STATIC_?>vip/testadmin/js/zepto.min.js"></script>
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
	   'name':'',
	   'phone':'',
           'city':'',
           'address':''
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
            person.city=$('#city').val();
            person.address=$('#address').val();
	    if(person.checkInput()){
	       $.post('/testadmin/register/ajaxuseradd',{'name':person.name,'phone':person.phone,'city':person.city,'address':person.address},function(data){
	    	   var list=eval('('+data+')');
	    	   if(list.code != '10000'){
	                alert(list.result);
	            }else{
	                alert('注册成功，请后台查看信息哦！');
	            }
		   });
		}
  });
  </script>
</body>
</html>
