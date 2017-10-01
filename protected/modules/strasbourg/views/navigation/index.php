<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css" href="<?php echo _STATIC_; ?>vip/strasbourg/css/pay_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>

<body>
<!--请将屏幕竖向浏览-->
  <div class="orientation_set">
    <div>
      <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
    </div>
  </div>
<div id="wrap" class="game_index" data-move>
    <div class="game_list_main">
      <ul class="g_list">
      <?php if($starttime1 == '1'):?>
          <li  id="time1" class='active' onclick="javascript:location.href='/strasbourg/active/prize?lotterystyle=y'"><span>抽奖开始</span></li>
      <?php elseif($endtime1 == '0'):?>
          <li  id="time1"><span >抽奖结束</span></li>
      <?php else:?>
          <li  id="time1"><span >00:00:00</span></li>
      <?php endif;?>
      <?php if($starttime2 == '1'):?>
          <li  id="time2" class='active' onclick="javascript:location.href='/strasbourg/active/miaoindex'"><span>秒拍开始</span></li>
      <?php elseif($endtime2 == '0'):?>
          <li  id="time2"><span >秒拍结束</span></li>
      <?php else:?>
          <li  id="time2"><span >00:00:00</span></li>
      <?php endif;?>
      <?php if($starttime3 == '1'):?>
          <li  id="time3" class='active' onclick="javascript:location.href='/strasbourg/active/auction_goods'"><span>竞拍开始</span></li>
      <?php elseif($endtime3 == '0'):?>
          <li  id="time3"><span >竞拍结束</span></li>
      <?php else:?>
          <li  id="time3"><span >00:00:00</span></li>
      <?php endif;?>
      </ul>    
    </div>
    <img src="<?php echo _STATIC_; ?>vip/strasbourg/img/g_tit_name.png" class="g_tit_name">
</div>

<script src="<?php echo _STATIC_; ?>vip/strasbourg/js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
		})
</script>
<?php $nowtime = time();?>
<script type="text/javascript">
var timer_rt1=null;
var flag1=true;//团购
var flag2=true;//秒拍
var flag3=true;//竞拍
var endflag1='<?php echo $endtime1;?>';
var endflag2='<?php echo $endtime2;?>';
var endflag3='<?php echo $endtime3;?>';

	var EndTime1=new Date(<?php echo strtotime($begintime1)*1000;?>);//抽奖开始时间
	var EndTime2=new Date(<?php echo strtotime($begintime2)*1000;?>);//秒拍开始时间
	var EndTime3=new Date(<?php echo strtotime($begintime3)*1000;?>);//竞拍开始时间
	
	var NowTime=new Date(<?php echo $nowtime*1000;?>);
	EndTime1=EndTime1.getTime();
	EndTime2=EndTime2.getTime();
	EndTime3=EndTime3.getTime();
	NowTime=NowTime.getTime();
	function GetRTime(){
		//var NowTime = new Date();
		//var nMS = EndTime - NowTime.getTime();
		var nMS1 = EndTime1 - NowTime;
	    var nMS2 = EndTime2 - NowTime;
	    var nMS3 = EndTime3 - NowTime;
		
		NowTime=parseInt(NowTime)+1000;
		var nD1 = Math.floor(nMS1/(1000 * 60 * 60 * 24));
		var nD2 = Math.floor(nMS2/(1000 * 60 * 60 * 24));
		var nD3 = Math.floor(nMS3/(1000 * 60 * 60 * 24));
		var nH1 = addZero(Math.floor(nMS1/(1000*60*60)) % 24);
		var nH2 = addZero(Math.floor(nMS2/(1000*60*60)) % 24);
		var nH3 = addZero(Math.floor(nMS3/(1000*60*60)) % 24);
		var nM1 = addZero(Math.floor(nMS1/(1000*60)) % 60);
		var nM2 = addZero(Math.floor(nMS2/(1000*60)) % 60);
		var nM3 = addZero(Math.floor(nMS3/(1000*60)) % 60);
		var nS1 = addZero(Math.floor(nMS1/1000) % 60);
		var nS2 = addZero(Math.floor(nMS2/1000) % 60);
		var nS3 = addZero(Math.floor(nMS3/1000) % 60);
		
		if (nMS1 < 0){
			if(endflag1 == '0'){
				$("#time1").attr('onclick',"");
				$("#time1").html('<span>抽奖结束</span>');
				$("#time1").removeClass('active');
			}else if(flag1){
				flag1=false;
				$("#time1").attr('onclick',"javascript:location.href=\'/strasbourg/active/prize?lotterystyle=y\'");
				$("#time1").html('<span>抽奖开始</span>');
				$("#time1").addClass('active');
				}
		}else{
			$("#time1").attr('onclick',"");
				$("#time1").html('<span>'+nH1+':'+nM1+':'+nS1+'</span>');
				$("#time1").removeClass('active');
		}

		if (nMS2 < 0){
			if(endflag2 == '0'){
				$("#time2").attr('onclick',"");
				$("#time2").html('<span>秒拍结束</span>');
				$("#time2").removeClass('active');
			}else if(flag2){
				flag2=false;
				$("#time2").attr('onclick',"javascript:location.href=\'/strasbourg/active/miaoindex\'");
			    $("#time2").html('<span>秒拍开始</span>');
			    $("#time2").addClass('active');
			}
        }else{
        	$("#time2").attr('onclick',"");
        	$("#time2").html('<span>'+nH2+':'+nM2+':'+nS2+'</span>');
        	$("#time2").removeClass('active');
        }
		if (nMS3 < 0){
			if(endflag3 == '0'){
				$("#time3").attr('onclick',"");
				$("#time3").html('<span>竞拍结束</span>');
				$("#time3").removeClass('active');
			}else if(flag3){
				flag3=false;
				$("#time3").attr('onclick',"javascript:location.href=\'/strasbourg/active/auction_goods\'");
			    $("#time3").html('<span>竞拍开始</span>');
			    $("#time3").addClass('active');
			}
    	}else{
    		$("#time3").attr('onclick',"");
    			$("#time3").html('<span>'+nH3+':'+nM3+':'+nS3+'</span>');
    			$("#time3").removeClass('active');
    	}
	}

	function addZero(num){
	    if(num < 10){
	        return '0'+ num.toString();
		}else{
		    return num;
	    }
	}

	
	$(document).ready(function () {
	    	timer_rt1 = window.setInterval("GetRTime()", 1000);
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
var title = '快来参加圣诞小镇活动';//分享标题
var desc = ' 斯特拉斯堡圣诞小镇诚邀您参加活动。';//分享描述
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
