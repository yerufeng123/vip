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
<link type="text/css"  href="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>css/jp_detail.css"  rel="stylesheet">
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
	<div class="mask_diag" style='<?php if(!$istrue && $sigle){ echo 'display:block;';}else{ echo 'display:none;';}?>' data-move>
		<div class="mask_main">
			<img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png"
				class="diag_jp_logo">
			<div class="mask_one">
				<h3 id='actres'><?php if($sigle['buyer'] == 'true'){ echo '竞拍成功';}else{echo '竞拍失败';}?></h3>
				<p>
					竞拍起拍价格：<span id='spri'><?php if($sigle['oldprice']){ echo $sigle['oldprice'];}else{ echo '0';} ?></span>元<br />竞拍成功价格：<span id='epri'><?php  if($sigle['price']){ echo $sigle['price'];}else{ echo '0';}?></span>元
				</p>
				<?php if($sigle){ 
				          if($sigle['buyer'] == 'true'){
				?>
					     <a href="javascript:void(0)" class="diag_close" id='wxpay'>微信支付</a>
			        	<?php }?>
				<?php }else{?>
						<a href="javascript:void(0)" class="diag_close" id='wxpay'>微信支付</a>
				<?php }?>
		
			</div>
		</div>
	</div>

	<div id="wrap" class="jp_web" data-move>
	 <h3 class="apply_tit apply_tit_act">
        <marquee direction="left" scrollamount="2">
                         
         </marquee>
     </h3>
		<div class="jp_tp"></div>
		<img src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_logo.png"
			class="jp_logo"><img
			src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/jp_tu1.png"
			class="jp_tu1">
		<div class="jp_main">
			<div class="jp_tu_main">
				<img src="<?php echo _STATIC_ . 'vip/strasbourg/img/'.$this->setting[Constant::CHANNEL_AUCTION]['setting']['img']; ?>"
					class="jp_img">
			</div>
			<div class="jp_bg">
				<p>
					本次竞拍倒计时<br /><span id='timer'>00:00:00</span>
				</p>
			</div>
			
		    <p class="my_num" >当前竞拍价格：<span id='nowchip'><?php  if($sigle['price']){ echo $sigle['price'];}else{ echo '2000';}?></span> 元</p>
            <span class="add_price">+<?php echo $this->setting[Constant::CHANNEL_AUCTION]['setting']['add'];?></span>
            <p class="my_price">我的竞拍金额：<span id='my_price'><?php if($nowprice){ echo $nowprice['price'];}else{ echo '0';}?></span> 元</p>

		</div>
		<span class="jp_enter jp_btn" id='pai'>我要竞拍</span>
		<div class="jp_bt"></div>
	</div>

<script  src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/zepto.min.js"></script>
<script  src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/touch.js"></script>
<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
      
   })
</script>
<script>
 function sleep(d){
	  for(var t = Date.now();Date.now() - t <= d;);
 }
	
 $('#pai').click(function(){
	var lock=$('#pai').attr('lock');
	var obj=$(this);
	if(lock == 1 || option==0){
		obj.removeClass('jx-current');
		return false;
	}
	obj.addClass('jx-current');
	$('#pai').attr('lock',1);
	 $.post('<?php echo $this->createUrl('active/auction_one');?>',{},function(data){
	    $('#pai').attr('lock',0);
	    obj.removeClass('jx-current');
       if(data.code != 1000){
           if(data.msg == '竞拍已结束'){
        	   alert(data.msg);
        	   option=0;
        	   return false;
            }else{
          	   alert(data.msg);
        	   return false;
            }

        }
       $('.add_price').addClass('add_price_active');	
        $('#my_price').html(toDecimal2(data.price));
		$('#nowchip').html(toDecimal2(data.price));  
	  },'json');
 });
    var option=1;
    var istrue='<?php echo $istrue;?>';
    var type='<?php echo Constant::CHANNEL_AUCTION;?>';
    var order=<?php if(!$istrue && $sigle){ echo json_encode($sigle['order']);}else{ echo "''";}?>;	
    function getend(){
		   $.post('<?php echo $this->createUrl('active/auction_success');?>',{},function(data){
             data=eval(data);
             if(data.price){
                 $('#spri').html(data.oldprice);
                 $('#epri').html(data.price); 
                 $('#nowchip').html(data.price);
              }
             type=data.type;
             order=data.order;
             if(data.buyer == 'true'){
	            // $('#actres').html();
           	     alert('竞拍成功');
	             window.location.reload();
	             return false;
	             $('#wxpay').css('display','block');
	             
	         }else{
	        	 $('#actres').html('竞拍失败'); 
	        	 $('#wxpay').css('display','none');
		     }
		    $('.mask_diag').show();
	    },'json');  
    }
    function toDecimal2(x) {  
        var f = parseFloat(x);  
        if (isNaN(f)) {  
            return false;  
        }  
        var f = Math.round(x*100)/100;  
        var s = f.toString();  
        var rs = s.indexOf('.');  
        if (rs < 0) {  
            rs = s.length;  
            s += '.';  
        }  
        while (s.length <= rs + 2) {  
            s += '0';  
        }  
        return s;  
    }
    
    function getdata(){
     	 var lock=$('#pai').attr('lock');
     	 if(lock == 1){
         	 return false;
          }
      	$('.add_price').removeClass('add_price_active');
        $.post('<?php echo $this->createUrl('active/auctiondata');?>',{},function(data){
             data=eval(data);
            var old=$('#nowchip').html();
            if(parseFloat(data.data.price) > parseFloat(old)){ 
               $('#nowchip').html(data.data.price);
            }
            
            var str='';
            if(data.upuser.length >= 1){
                for(var i in data.upuser){
                    str+=data.upuser[i].substring(0,1)+'** &nbsp;加价'+'<?php echo $this->setting[Constant::CHANNEL_AUCTION]['setting']['add'];?>'+'元 &nbsp;&nbsp;';
                 }
             }
            $('.apply_tit_act marquee').html(str);
            if(data.t != '00:00:00'){
          	  $('#timer').html(data.t);  
            }else{
           	$('#timer').html('00:00:00');  
  			   option=0;
  			   getend();
 	          clearInterval(setdata); 
            }
        },'json');
    }
	$(document).ready(function () {
		 if(istrue){
			 setdata = window.setInterval("getdata()", 1000);
		 }
	});
</script>

    <!--微信支付相关-->
<script type="text/javascript">
      var order_sn='';
      var flock = 0;
      $('#wxpay').click(function(){
    	  if(flock == 1){
        	  return false;
          }
    	  flock = 1;
    	 setTimeout(function(){
 		    flock = 0;
 	     },3000);
         getstring(); 
      });
      
       function getstring(){
         order_sn=order['out_trade_no'];
   	   //异步传入参数，获取微信支付字符串
         
          $.post('/orderpay/ajaxweixinpaynew', {'body':'<?php echo $this->setting[Constant:: CHANNEL_AUCTION]['setting']['name'];?>', 'out_trade_no': order['out_trade_no'], 'total_fee': order['total_fee'],'project':'strasbourg','callback':'http://'+window.location.host+'/orderpay/strasbourg','openid':'<?php echo $this->openid; ?>'}, function (data) {
              orderstring = data;
              $('#wxpay').attr('lock',0);
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
                    	$('#wxpay').attr('lock',0);
                        switch (res.err_msg) {
                            case 'get_brand_wcpay_request:ok':
                                //异步调用查询方法，获取订单是否真的完成
                                //如果 支付成功
                                //否则支付异常
                                window.location.href = '<?php echo $this->createUrl('active/payok'); ?>'+'?ordersn=' + order_sn+'&channel='+"<?php echo Constant::CHANNEL_AUCTION;?>";
                                return false;
                            case 'get_brand_wcpay_request:fail':
                                alert('微信支付小二忙不过来了，请您重新支付');
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
</body>
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
var imgUrl ='<?php echo _STATIC_; ?>vip/strasbourg/img/share_gao.png';//分享图标
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
</html>
