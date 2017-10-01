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
    <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
     <title>DS汽车</title>
    <link rel="stylesheet" href="<?php echo _STATIC_ ;?>vip/dspicture/css/page.css">
    <link rel="stylesheet" href="<?php echo _STATIC_ ;?>vip/dspicture/css/common.css">
    <script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:1,			//懒加载页面个数
			preload 	:true,
			bg_audio	:"<?php echo _STATIC_ ;?>vip/dspicture/video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
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
 <!--	<script type="text/javascript" src="js/loading.js"></script>-->
  	<div id="wrap" style="display:;">
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<div class="page_body"> 
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
					     <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_tit.png" class="p1_tit out-top-t quicker" delay="600">
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_tu.png" class="p1_tu out-bottom-b quicker" delay="800">
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_jane.png" class="p1_jane out-bottom-t slower" delay="1000">
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_peter.png" class="p1_peter out-bottom-t slower" delay="1200">
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_mark.png" class="p1_mark out-bottom-t slower" delay="1400">
               <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p1_car.png" class="p1_car quicker" delay="1600">

  				</div>
  			</li>
  			
  			<li class="page" id="p2" scene="2">
				  <div class="page_body">
             <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
  					 <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p2_name.png" class="p2_name out-top-t quicker" delay="600">
             <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p2_tu.png" class="p2_tu out-bottom-b quicker" delay="800">
             <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p2_car.png" class="p2_car slower quicker" delay="1000">
             <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p2_tit.png" class="p2_tit icon_big quicker" delay="1400">
  				</div>
  			</li>

  			<li class="page" id="p3" scene="3">
				<div class="page_body">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p3_tu.png" class="p3_tu out-bottom-b quicker" delay="600">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p3_name.png" class="p3_name out-bottom-b quicker" delay="1000">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p3_car.png" class="p3_car slower quicker" delay="1400">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p3_tit.png" class="p3_tit icon_big quicker" delay="1800">
				</div>
  			</li>
  			<li class="page" id="p4" scene="4">
				<div class="page_body">
					 <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p4_name.png" class="p4_name out-bottom-b quicker" delay="600">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p4_tu.png" class="p4_tu out-bottom-b quicker" delay="1000">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p4_car.png" class="p4_car slower quicker" delay="1400">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p4_tit.png" class="p4_tit icon_big quicker" delay="1800">
				</div>
				
  			</li>

  			<li class="page" id="p5" scene="5">
				<div class="page_body">
					 <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p5_mh_bg.png" class="p5_mh_bg out-bottom-b quicker" delay="600">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/bt_tu.png" class="bt_tu">
           <p class="camera"></p>
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/hand_cursor.gif" class="hand_cursor quicker" delay="1000">
				</div>
  			</li>

  			<!--<li class="page" id="p6" scene="6">
				<div class="page_body">
					 <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
           <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_mh_bg.png" class="p6_mh_bg out-bottom-b quicker" delay="600">
				</div>
  			</li>-->

        <li class="page" id="p7" scene="7" stop-move="1">
         <div class="share_bg" style="display: ;">
                <p><span><b>左右滑动选择车型,
                <br/>点击车型快快体验吧！</b></span></p>
          </div>
        <div class="page_body">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_show.png" class="p6_show">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_cion.png" class="p6_cion icon_beat slower" delay="600">
            <div class="list_tu out-bottom-b quicker" delay="1000">
                <img class="left_btn" src="<?php echo _STATIC_ ;?>vip/dspicture/img/icon_left.png">
                <div class="cont" >
                   <ul class="img_box">
                     <li class="select"><img src="<?php echo _STATIC_ ;?>vip/dspicture/img/list_tu1.png" /></li>
                      <li><img src="<?php echo _STATIC_ ;?>vip/dspicture/img/list_tu2.png" /></li>
                      <li><img src="<?php echo _STATIC_ ;?>vip/dspicture/img/list_tu3.png" /></li>
                   </ul>
                </div>
                <img class="right_btn" src="<?php echo _STATIC_ ;?>vip/dspicture/img/icon_right.png"> 
            </div>
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_cion.png" class="p6_cion2 icon_beat slower" delay="800">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_tit.png" class="p6_tit icon_big quicker" delay="1400">
        </div>
        </li>

        <li class="page" id="p8" scene="8" stop-move="1">
        <div class="page_body">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_show.png" class="p6_show">
            <div class="p8_form out-bottom-b quicker" delay="600">
                <ul>
                    <li><input type="text" id="name"></li>
                    <li><input type="text" id="phone"></li>
                    <li class="parentCls">
                        <input type="text" class="inputElem">
                        <input type="hidden" class="hiddenCls" id="city"/>
                    </li>
                    <li id="take_photo"><span class="my_camera"></span></li>
                <ul>
            </div>
            <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p8_car.png" class="p8_car icon_big quicker" delay="1000">
        </div>
        </li>
  		</ul>
		  <div id="bg_music" class="on"></div>
  		<img id="drop_down" src="<?php echo _STATIC_ ;?>vip/dspicture/img/drop_down.png">
      <div class="tiang_icon"></div>
    </div> 
	

    <script type="text/javascript" src="<?php echo _STATIC_ ;?>vip/dspicture/js/slide.js" defer="defer"></script>
	<script type="text/javascript" src="<?php echo _STATIC_ ;?>vip/dspicture/js/parallax.js"></script>
  <script src="<?php echo _STATIC_ ;?>vip/dspicture/js/jquery-1.11.2.min.js"></script>

	<!--<script type="text/javascript" src="js/zepto.min.js"></script>-->
    <script type="text/javascript" src="<?php echo _STATIC_ ;?>vip/dspicture/js/init.js"></script>
    <script type="text/javascript">
     $(function(){
         $(".share_bg").bind("touchmove",function(e){
            e.preventDefault();
          })
        $('.share_bg').bind('click', function() {
             $('.share_bg').hide();
          });

    })
        
    </script>
    <script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
 <script src="<?php echo _STATIC_ ;?>vip/dspicture/js/autocomplete.js"></script>
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
    <script>
    //图片对象
    function Pic(id,localIds,serverId,path){
    	this.id=id;
    	this.localIds=localIds;
    	this.serverId=serverId;
    	this.path=path;
    }
    var pic=new Pic();
    //用户对象
    var person={
  	    uid:'',
		    name:'',//姓名
          phone:'',//手机
          city:'',//城市
          pic:{},//身份证图片
          openid:'',//用户微信识别码
          text:'',//输入文本
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
    	  if(this.city == ''){
	  	    this.findError('请输入城市');
	  	  	return false;
	  	 }
  	 return true;
    }

    //用户选择照片或者拍照
    person.paizhao=function(pic){
	                        wx.chooseImage({
	                        	count: 1,
	                            success: function (res) {
	                            	pic.localIds = res.localIds+''; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
	                                if (res.localIds.length == 0) {
	                                	person.findError('请选择照片');
	                                	return false;
	                                }
	                                if (res.localIds.length > 1) {
	                                	person.findError('目前上传只支持单张');
	                                    return false;
	                                }
	                                wx.uploadImage({
	                                    localId:pic.localIds, // 需要上传的图片的本地ID，由chooseImage接口获得：需要普通字符串，字符串对象不认识
	                                    isShowProgressTips:1, // 默认为1，显示进度提示
	                                    success: function (res) {
	                                    	pic.serverId = res.serverId; // 返回图片的服务器端ID
	                                    	person.shangchuan(pic);
	                                    }
	                                });
	                            }
	                        });
        }

    //用户上传照片---->('大图片可能失败：其实是从微信服务端下载图片到生成环境文件夹中’)
    person.shangchuan=function(pic){
        $.post('/dspicture/ajaxgetmetarial', {'serverId': pic.serverId}, function (data) {
            var list = eval('(' + data + ')');
            if (list.code != '10000') {
                if (list.result == 'media_id missing') {
              	  person.findError('图片选择异常');
                    return false;
                }
                person.findError(list.result);
            } else {
                pic.path=list.result;
                person.pic=pic;
                person.register();
            }
        });
        }

    //注册用户
    person.register=function(){
    	$.post('/dspicture/ajaxuseradd',{'name':person.name,'phone':person.phone,'city':person.city},function(data){
            var list=eval('('+data+')');
            if(list.code != '10000'){
                alert(list.result);
            }else{
                window.location.href="/dspicture/takephoto?path="+person.pic.path;
            }
        });   
    }

    

    //捕捉到用户单击拍照
    $('#take_photo').bind('click',function(){
        person.name=$('#name').val();
        person.phone=$('#phone').val();
        person.city=$('#city').val();
        
        if(person.checkInput()){
            person.paizhao(pic);
        }

     });


    </script>
  </body>
</html>