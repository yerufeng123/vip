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
     <title>斯特拉斯堡圣诞小镇</title>
    <!--<link rel="stylesheet" href="css/page.css">-->
    <!--<link rel="stylesheet" href="css/common.css">-->
    <script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:1,			//懒加载页面个数
			preload 	:true,
			bg_audio	:"<?php echo _STATIC_?>vip/strasbourg/video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
		}
	</script>
 
  </head>
  <body> 
   <style>
    #preload{ position:fixed; left:0; top:0; right:0; bottom:0; background-color:#030314 url(<?php echo _STATIC_?>vip/strasbourg/img/page1_bg.jpg) no-repeat center; z-index:9999; text-align:center; font-size:16px;}
    .pre_main h3{font-size:14px;color:#fff; position:absolute;top:50%;left:0;bottom:0px;right:0;}
    #load_num{ position:absolute; left:0; top:55%; width:100%;font-size:14px;color:#fff;}
    </style>
    
 	<div id="preload">
      <div class="pre_main"><h3>精彩正在加载...</h3><br/><span id="load_num"></span></div>
    </div>
  <script type="text/javascript" src="<?php echo _STATIC_?>vip/strasbourg/js/loading.js"></script>
  	<div id="wrap" style="display:;">
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<div class="page_body"> 
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu1.png" class="p1_tu1 p1_first slower" delay="600">
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_l.png" class="p1_tu_l out-left quicker" delay="900">
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_r.png" class="p1_tu_r out-right quicker" delay="900">
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_name.png" class="p1_tit_name out-bottom-b quicker" delay="1200">
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_time.png" class="p1_tit_time out-bottom-b quicker" delay="1600">
              <div class="p1_tu_bt quicker" delay="1800">
                <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_bt.png">
              </div>
  				</div>
  			</li>
  			
  			<li class="page" id="p2" scene="2">
				  <div class="page_body">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu1.png" class="p1_tu1 p2_tu2 layer" data-depth="0.8">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p2_tit.png" class="p2_tit out-bottom-b quicker" delay="600">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p2_tit_light.png" class="p2_tit_light icon_small quicker" delay="800">
            <p class="p2_deatil_one out-right quicker" delay="1000">法国斯特拉斯堡圣诞集市起源于1570年，至今已有445年的历史，其影响力使得斯特拉斯堡被誉为"圣诞之都"。超过300间的木屋摊铺，提供各种圣诞主题的商品。每届斯特拉斯堡集市都吸引了来自全球数百万游客。</p>
            <div class="p2_tu quicker" delay="1200">
              <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p2_tu.png">
            </div>
            <p class="p2_deatil_two out-bottom-b quick" delay="1600">享誉世界并传承五百年的圣诞集市首次来到中国，国内最浓郁且纯正的欧洲圣诞文化与风情只有在这里才能体验，北京圣诞狂欢新地标即将崭新呈现。</p>
  				</div>
  			</li>

  			<li class="page" id="p3" scene="3">
				<div class="page_body">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu1.png" class="p1_tu1 p2_tu2 layer" data-depth="0.8">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p3_tit.png" class="p3_tit out-bottom-b quicker" delay="600">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p2_tit_light.png" class="p2_tit_light icon_small quicker" delay="800">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p3_tu1.png" class="p3_tu1 out-right slower" delay="1000">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p3_tu2.png" class="p3_tu2 out-left slower" delay="1800">
           <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p3_tu3.png" class="p3_tu3 out-bottom-b slower" delay="2600">
           <p class="p3_detail_one out-bottom-b slower" delay="1400">60万人见证了斯特拉斯堡圣诞集市的诞生每年成为人们最期待的盛会。</p>
           <p class="p3_detail_two out-bottom-b slower" delay="2200">斯特拉斯堡圣诞集市开始将欢乐洒向世界，650万人感受到了斯特拉斯堡圣诞集市的魅力。</p>
           <p class="p3_detail_three out-bottom-b slower" delay="3000">北京·斯特拉斯堡圣诞集市上大部分为欧洲特色美食,售卖商品淋漓尽致地代表欧洲风情,大多数为纯手工制品,所有木屋均来自欧洲,人们不出国门即可体验原汁原味的欧洲文化,享受欧洲美食,领略欧洲风情。</p>


				</div>
  			</li>
  			<li class="page" id="p4" scene="4" >
				<div class="page_body">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu1.png" class="p1_tu1 p2_tu2 layer" data-depth="0.8">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p4_tit.png" class="p4_tit out-bottom-b quicker" delay="600">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p2_tit_light.png" class="p2_tit_light icon_small quicker" delay="800">
            <div class="p4_main quicker" delay="1000">
                <ul>
                    <li class="out-right quicker" delay="1200">时间：12月5日~1月4日 10:00-22：00 </li>
                    <li class="out-right quicker" delay="1400">地点：北京市朝阳区蓝色港湾国际商务区</li>
                </ul>
                <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p4_map.png" class="p4_map out-bottom-b quicker" delay="1600">
            </div>
        <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p4_tu.png" class="p4_tu out-bottom-b quicker" delay="1800">
        <ul class="p4_detail quicker" delay="2000">
            <li class="p4_li word_pre">化妆舞会  白衣派对</li>
            <li class="p4_li word_now">假面舞会</li>
            <li class="p4_li word_next">圣诞老人大游行</li>
        </ul>
				</div>
  			</li>

        <li class="page" id="p5" scene="5" stop-move="1">
        <div class="page_body">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_l.png" class="p1_tu_l p5_tu_l out-left quicker" delay="600">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_r.png" class="p1_tu_r p5_tu_r out-right quicker" delay="600">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_name.png" class="p1_tit_name p5_tit_name out-bottom-b quicker" delay="900">
            <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tit_time.png" class="p1_tit_time p5_tit_time out-bottom-b quicker" delay="1200">
            <form id="myform" method="post" action="/strasbourg/register/useradd">
            <ul class="form_offer">
                <li class="out-right quicker" delay="1500"><label>姓名</label><input type="text" id="name" name="name"></li>
                <li class="out-right quicker" delay="1600"><label>电话</label><input type="text" id="phone" name="phone"></li>
                <li><a href="javascript:void(0)" class="offer_btn icon_small slow" delay="1800" id="sub_btn">确定</a></li>
            </ul>
            </form>
           <div class="p1_tu_bt quicker" delay="2300">
                <img pre-src="<?php echo _STATIC_?>vip/strasbourg/img/p1_tu_bt.png">
            </div>
          
        </div>
        </li>

  		</ul>
		  <div id="bg_music" class="on"></div>
  		<img id="drop_down" pre-src="<?php echo _STATIC_?>vip/strasbourg/img/drop_down.png">
    </div> 
	

  <script type="text/javascript" src="<?php echo _STATIC_?>vip/strasbourg/js/slide.js" defer="defer"></script>
	<script type="text/javascript" src="<?php echo _STATIC_?>vip/strasbourg/js/parallax.js"></script>
	<script type="text/javascript" src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
  <script type="text/javascript" src="<?php echo _STATIC_?>vip/strasbourg/js/init.js"></script>
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
  <script type="text/javascript">
    var scene = document.getElementById('wrap');
    var parallax = new Parallax(scene); 

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
	  	    this.findError('请输入手机号');
	  	  	return false;
	  	 }
 	     if(!check_phone(this.phone)){
  	    this.findError('手机号格式不正确');
    	  	return false;
 	   	 }
  	 return true;
    }

    function shareok(){
        $.post('/strasbourg/register/ajaxaddsharenum',{},function(data){});
    }

  </script>
  <script>
  //捕捉到单击提交事件
  $('#sub_btn').bind('click',function(){
	    person.name=$('#name').val();
	    person.phone=$('#phone').val();
	    if(person.checkInput()){
	        $('#myform').submit();
		}
  });
  </script>
  </body>
</html>