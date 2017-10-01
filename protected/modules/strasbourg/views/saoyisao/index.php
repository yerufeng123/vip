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
	href="<?php echo _STATIC_;?>vip/strasbourg/css/pay_detail.css"
	rel="stylesheet">
<title>石景山洋庙会</title>
</head>

<body>
	<div id="wrap" class="pay_one" data-move>
		<div class="p_main">
			<img src="<?php echo _STATIC_;?>vip/strasbourg/img/pay_tit_tu.png"
				class="pay_tit_tu">
			<h3 class="pay_one_tit">
				您将在石景山洋庙会<span><?php echo $business->roomnumer?></span>支付购物
		    </h3>
			<div class="pay_main">
				<div class="pay_ps">
					<img src="<?php echo _STATIC_;?>vip/strasbourg/img/pay_tit1.png"
						class="pay_tit1">
					<p class="pay_money">
						<span>支付金额</span>&ensp;<input type="text" class="input_text"
							id="goodprice" maxlength="7">&ensp;<span>元</span>
					</p>
					<p class="pay_notice">请您和商家确定金额，输入支付后领取商品。</p>
				</div>
			</div>

			<span class="pay_com pay_bnt" id="sub_btn">支付购物</span> <img
				src="<?php echo _STATIC_;?>vip/strasbourg/img/pay_bt.png"
				class="pay_bt" style="z-index:-999">
		</div>
	</div>

	<script src="<?php echo _STATIC_;?>vip/strasbourg/js/zepto.min.js"></script>
	<script type="text/javascript">
	$(function(){
    $("body").height($("body").height());
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
		})
</script>
	<script type="text/javascript"
		src="<?php echo _STATIC_ ?>/js/globals.js"></script>
	<script>
var order_sn=null;
$(function(){
	$('#sub_btn').bind('click',function(){
		
			var price=parseFloat($('#goodprice').val());
			price=Math.round(price*100)/100;
			if(isNaN(price) || price <0.01){
				alert('您输入有效的金额');
			    return false;
		    }else{
		    	if(!$('#sub_btn').hasClass('pay_btn_gray')){
					$('#sub_btn').addClass('pay_btn_gray');
					setTimeout(function(){
						$('#sub_btn').removeClass('pay_btn_gray');
					},5000);
		    	
			$.post('/strasbourg/saoyisao/create_order',{'type':'<?php echo Constant::CHANNEL_SAOMA?>','price':price,'paycode':'<?php echo $paycode;?>'},function(data){
				var list=eval(data);
				  if(list.code != '10000'){
					    alert(list.msg);
				  }else{
					  order_sn=list.result.out_trade_no;
						  //异步传入参数，获取微信支付字符串
					    $.post('/orderpay/ajaxweixinpaynew', {'body': list.result.body, 'out_trade_no': list.result.out_trade_no, 'total_fee': list.result.total_fee,'project':'strasbourg','callback':'http://'+window.location.host+'/orderpay/strasbourg','openid':'<?php echo $openid; ?>'}, function (data) {
			 		        orderstring = data;
			 		        callpay();//调起微信支付
			 		    });
				  }
			},'json');
		    }
		    }
		
    });
});



</script>
	<!--微信支付相关-->
	<script type="text/javascript">
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
                            	window.location.href = '<?php echo $this->createUrl('active/payok'); ?>'+'?ordersn=' + order_sn+'&channel=<?php echo Constant::CHANNEL_SAOMA?>';
                                return false;
                            case 'get_brand_wcpay_request:fail':
                                alert('支付失败');
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
            'showMenuItems',
            'hideOptionMenu'
        ]
    });
    wx.ready(function () {
    	wx.hideOptionMenu();
    });
    </script>

</body>
</html>
