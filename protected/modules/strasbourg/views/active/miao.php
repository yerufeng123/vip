<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport"
	content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
<link type="text/css"
	href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/jp_detail.css"
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
	<!--弹出框二维码-->

	<!-------------------------弹出框 ---------------------->
	<div class="mask_diag" style='<?php if($mylog){ echo 'display:block;';}else{ echo 'display:none;';}?>' data-move>
		<div class="mask_main">
			<img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png"
				class="diag_jp_logo">
			<div class="mask_one">
				<h3>秒拍成功</h3>
				<p style="height:20px;margin-tpop:-10px;">第<span id='miaonum'><?php echo $miaonum['count(1)'];?></span>个秒拍成功者</p>
				<p style="height:20px;">
					秒拍成功价格：<span id='myprice'><?php echo $price; ?></span>元
				</p>
				<p style="height:20px;">请在5分钟内付款</p>
				<a href="javascript:void(0)" id='wxpay' class="diag_close mp_diag_close">微信支付</a>
			</div>
		</div>
	</div>

	<div id="wrap" class="mp_web" data-move>
		<div class="jp_tp"></div>
		<img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png"
			class="jp_logo"><img
			src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/mp_tu1.png"
			class="jp_tu1 mp_tu1">
		<div class="jp_main">
			<div class="jp_tu_main">
				<img src="<?php echo _STATIC_ . 'vip/strasbourg/img/'.$this->setting[Constant::CHANNEL_SECKILL]['setting']['img'];?>"
					class="jp_img">
			</div>
			<div class="jp_bg">
				<p>
					本次秒拍倒计时<br /> <span id='timer'>00:00:00 <span>
				
				</p>
			</div>

			<p class="my_num">
				秒拍产品数量：<span><?php echo $num;?></span> 个
			</p>
			<p class="my_price">
				秒拍价格：<span><?php echo $price; ?></span> 元
			</p>
		</div>
		<span class="jp_enter jp_btn mp_btn" id='pai'>我要秒拍</span>
		<div class="jp_bt"></div>
	</div>
<?php $nowtime = time();?>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/touch.js"></script>
	<script type="text/javascript">

	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
	})
    var option;
    var type='<?php echo Constant::CHANNEL_SECKILL;?>';
	$('#pai').click(function(){
    if(option == 1){
        return false;
     }
     option=1;
	 $.post('<?php echo $this->createUrl('active/miaopai');?>',{},function(data){
		  option=0;
       if(data.code == 1000){
           $('#myprice').html(data.price);
    	   $(".mask_diag").show();
    	   $('#miaonum').html(data.miaonum);
        }else{
         	 $(".mask_diag").hide();
            alert(data.msg);
        }
	  },'json');
     });
    var timer='00:00:00';
	var EndTime=new Date(<?php echo $endttime* 1000;?> );
	var NowTime=new Date(<?php echo $nowtime*1000;?>);
	EndTime=EndTime.getTime();
	NowTime=NowTime.getTime();
	function GetRTime(){
		var nMS = EndTime - NowTime;
		NowTime=parseInt(NowTime)+1000;
		var nD = Math.floor(nMS/(1000 * 60 * 60 * 24));
		var nH = (Math.floor(nMS/(1000*60*60)) % 24)+(nD*24);
		var nM = Math.floor(nMS/(1000*60)) % 60;
		var nS = Math.floor(nMS/1000) % 60;
		if (nMS < 0){
			clearInterval(timer_rt);
		}else{
	       timer=nH+' :'+nM+' : '+nS;
	       $('#timer').html(timer);
		}
	}
 var timer_rt = window.setInterval("GetRTime()", 1000);

</script>
	<!--微信支付相关-->
	<script type="text/javascript">
      var order_sn='';
      var flock;
      $('#wxpay').click(function(){
      	  if(flock == 1){
        	  return false;
          }
    	  flock = 1;
    	  setTimeout(function(){
 		    flock = 0;
 	      },3000);
          $.post('<?php echo $this->createUrl('active/create_order');?>',{type:'seckill'},function(data){
             var string=eval(data);
             if(string['code'] == 1000){
            	 getstring(string['data']); 
              }else{
                  alert('微信支付小二忙不过来了，请您重新支付');
              }
           },'json');
      });
      
       function getstring(string){
         order_sn=string['out_trade_no'];
   	   //异步传入参数，获取微信支付字符串
          $.post('/orderpay/ajaxweixinpaynew', {'body': '<?php echo $this->setting[Constant::CHANNEL_SECKILL]['setting']['name'];?>', 'out_trade_no': string['out_trade_no'], 'total_fee': string['total_fee'],'project':'strasbourg','callback':'http://'+window.location.host+'/orderpay/strasbourg','openid':'<?php echo $this->openid; ?>'}, function (data) {
              orderstring = data;
              callpay();//调起微信支付
          });
       }
        //调用微信JS api 支付
        function jsApiCall()
        {
            var orderstring_1 = new Function("return " + orderstring)();//将字符串转为字符串对象（只有异步获取的才是字符串，通过页面php获取的，本来就是字符串对象）
            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    orderstring_1,
                    function (res) {
                        switch (res.err_msg) {
                            case 'get_brand_wcpay_request:ok':
                                //异步调用查询方法，获取订单是否真的完成
                                //如果 支付成功
                                //否则支付异常
                                window.location.href = '<?php echo $this->createUrl('active/payok'); ?>'+'?ordersn=' + order_sn+'&channel=seckill';
                                return false;
                            case 'get_brand_wcpay_request:fail':
                                alert('微信支付小二忙不过来了，请您重新支付！');
                                break;
                            case 'get_brand_wcpay_request:cancel':
                                break;
                            default :
                                alert(res.err_msg);
                        }
                    }
            );
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        }
        

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
var title = '快来参加圣诞小镇秒拍';//分享标题
var desc = '斯特拉斯堡圣诞小镇诚邀您参加秒拍活动。';//分享描述
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
