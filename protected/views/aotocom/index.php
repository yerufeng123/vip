<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="email=no">
     <meta id="viewport" name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <title>汽车商业杂志</title>
    <link rel="stylesheet" href="<?php echo _STATIC_; ?>vip/aotocom/css/page.css">
    <link rel="stylesheet" href="<?php echo _STATIC_; ?>vip/aotocom/css/common.css">
    
    <script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:1,			//懒加载页面个数
			preload 	:true,
			//bg_audio	:"video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
		}
	</script>
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
  <body> 
 	
	<div id="preload" style="">
 	</div>
  	<div id="wrap" style="display:">
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<div class="page_body"> 
					   <img src="<?php echo _STATIC_; ?>vip/aotocom/img/weather.png" class="weather wind_shake quicker" delay="600">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/wind.png" class="wind rain quicker" delay="800">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_tu1.png" class="p1_tu1 tu_change quicker" delay="1000">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_tit.png" class="p1_tit out-left quicker" delay="1400">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo active_shake quicker" delay="1800">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt">
  				</div>
  			</li>
  			
  			<li class="page" id="p2" scene="2">
				  <div class="page_body">
					   <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p2_tit1.png" class="p2_tit1 active_left quicker" delay="600">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p2_tu2.png" class="p2_tu2 active_left quicker" delay="800">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p2_tu.png" class="p2_tu tu_change quicker" delay="1000">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p2_tit2.png" class="p2_tit2 out-left quicker" delay="1400">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo logo2 active_shake quicker" delay="1800">
             <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt p2_bt">
  				</div>
  			</li>

  			<li class="page" id="p3" scene="3">
				<div class="page_body">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p3_tu1.png" class="p3_tu1 active_left quicker" delay="600">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p3_tu.png" class="p3_tu tu_change quicker" delay="800">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p3_tit.png" class="p3_tit out-left quicker" delay="1200">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo active_shake quicker" delay="1600">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt">
				</div>
  			</li>
  			<li class="page" id="p4" scene="4">
				<div class="page_body">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p4_tit1.png" class="p4_tit1 active_left quicker" delay="600">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p4_tu1.png" class="p4_tu1 active_left quicker" delay="800">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p4_tu.png" class="p4_tu tu_change quicker" delay="1000">
					<img src="<?php echo _STATIC_; ?>vip/aotocom/img/p4_tit2.png" class="p4_tit2 out-left quicker" delay="1400">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo logo4 active_shake quicker" delay="1800">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt p4_bt">
				</div>
				
  			</li>

  			<li class="page" id="p5" scene="5">
				<div class="page_body">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p5_tu1.png" class="p5_tu1 active_left quicker" delay="600">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p5_tu2.png" class="p5_tu2 active_left quicker" delay="800">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p5_tu.png" class="p5_tu tu_change quicker" delay="1000">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p5_tit.png" class="p5_tit out-left quicker" delay="1400">
					<img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo logo4 active_shake quicker" delay="1800">
          <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt p4_bt">
				</div>
  			</li>

  			<li class="page" id="p6" scene="6">
				<div class="page_body">
           <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p6_tu1.png" class="p6_tu1 active_left quicker" delay="600">
           <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p5_tu2.png" class="p5_tu2 active_left quicker" delay="800">
           <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p6_tu.png" class="p6_tu tu_change quicker" delay="1000">
           <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p6_tit.png" class="p6_tit out-left quicker" delay="1400">
					 <img src="<?php echo _STATIC_; ?>vip/aotocom/img/logo.png" class="logo logo4 active_shake quicker" delay="1800">
           <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p1_bt.png" class="p1_bt p4_bt">
				</div>
  			</li>

        <li class="page" id="p7" scene="7" stop-move="1">
           <!-- 分享-->
              <div class="share_bg" style="display: none;">
                          <span><img src="<?php echo _STATIC_; ?>vip/aotocom/img/wechat_icon_arr.png" /><b>点击右上角选择用浏览器打开</b></span>
                       </div>
            <!-- 弹出框 -->
          <div class="mask_diag" style="display:;">
            <div class="rule">
                <div class="diag_block">
                   <p>感谢您的参与<br/>我们将于7日内发送您申请表</p>
                   <a href="javascript:void(0)" class="diag_close">关闭</a>
                </div>
            </div>
          </div>  
          <div class="page_body">
              <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p7_tu1.png" class="p7_tu1 quicker" delay="600">
              <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p7_tu2.png" class="p7_tu2 quicker" delay="800">
              <img src="<?php echo _STATIC_; ?>vip/aotocom/img/p7_tu3.png" class="p7_tu3 quicker" delay="1000">
              <p class="p7_tit out-top quicker" delay="1200">如果您是一位媒体人  如果您是一位撰稿人
如果您是一位领航者  如果您是一位思想者
留下您的信息  我们将会发送您申报表</p>

              <ul class="main_offer">
                <li class="out-right quicker" delay="1400">
                  <label>姓名</label>
                  <input type="text" class="input_text" id="name">
                </li>
                <li class="out-right quicker" delay="1600">
                  <label>电话</label>
                  <input type="text" class="input_text" id="phone">
                </li>
                <li class="out-right quicker" delay="1800">
                  <label>邮箱</label>
                  <input type="text" class="input_text" id="email">
                </li>
                <li class="out-right quicker" delay="2000">
                  <label>企业自媒体名称</label>
                  <input type="text" class="input_text" id="company">
                </li>
                <li class="out-right quicker" delay="2200">
                  <label>案例链接</label>
                  <input type="text" class="input_text" id="link">
                </li>
                <li class="input_tip out-right quicker" delay="2400">（*均为必填项）</li>
              </ul>

              <div class="main_btn">
                <span class="offer_btn btn_com out-left quicker" delay="2600" id="sub_btn">提交申请</span>
                <span class="share_btn btn_com out-right quicker" delay="2600" id="sub_share">转发分享</span>
              </div>
          </div>
        </li>
  		</ul>
  		<!--<div id="bg_music" class="on"></div>-->
  		<img id="drop_down" src="<?php echo _STATIC_; ?>vip/aotocom/img/drop_down.png">
    </div> 
	<script type="text/javascript" src="<?php echo _STATIC_; ?>vip/aotocom/js/slide.js" defer="defer"></script>
	<script type="text/javascript" src="<?php echo _STATIC_; ?>vip/aotocom/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_; ?>vip/aotocom/js/init.js?1"></script>
    <script src="<?php echo _STATIC_ ?>/js/globals.js"></script>
    <script type="text/javascript">
      $(function(){
        $(".share_btn").bind("click",function(){
          $(".share_bg").show();

        })

        $('.share_bg').bind('click', function() {
            $('.share_bg').hide();
        });

       $('.offer_btn').bind('click', function() {
            $('.mask_diag').show();
        });

        $('.diag_close').bind('click', function() {
            $('.mask_diag').hide();
        });


      



      })
    </script>
    <script>
var person={
		'name':null,
		'phone':null,
		'email':null,
		'company':null,
		'link':null,
}

//用户报告错误
      person.findError=function(errMsg,type){
         switch(type){
         case 1:
             //完善信息框
        	 alert(errMsg);//------》替换成模板提示信息
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
  	  	    this.findError('请输入电话');
  	  	  	return false;
  	  	 }
    	  if(!check_phone(this.phone)){
        	    this.findError('手机号格式不正确');
          	  	return false;
       	   	 }
    	  if(this.email == ''){
  	  	    this.findError('请输入邮箱');
  	  	  	return false;
  	  	 }
    	  if(this.company == ''){
  	  	    this.findError('请输入企业自媒体名称');
  	  	  	return false;
  	  	 }
    	 return true;
      }

      person.addUser=function(){
  	    $.post('/aotocom/ajaxuseradd',{'name':this.name,'phone':this.phone,'email':this.email,'company':this.company,'link':this.link},function(data){
    	      var list=eval('('+data+')');
    	      if(list.code != '10000'){
  	    	    person.findError(list.result);
              }else{
            	person.findError('添加成功！');
              }
  	  	});

      }

$(function(){
    //捕捉用户提交申请事件
    $('#sub_btn').bind('click',function(){
        person.name=$('#name').val();
        person.phone=$('#phone').val();
        person.email=$('#email').val();
        person.company=$('#company').val();
        person.link=$('#link').val();

        if(person.checkInput()){
        	person.addUser();
        }
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
var title = '汽车商业杂志';//分享标题
var desc = '来参与中中国汽车领域首次针对企业自媒体的评选吧！';//分享描述
var link = 'http://' + window.location.host + '/aotocom/index';//分享链接
var imgUrl = '<?php echo _STATIC_; ?>vip/aotocom/img/logo.png';//分享图标
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