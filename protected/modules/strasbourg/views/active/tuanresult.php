<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>斯特拉斯堡圣诞小镇</title>
</head>
<style type="text/css">
/******************通用*******************/
html,body{-webkit-tap-highlight-color:rgba(0,0,0,0);color:#302e31;font:13px/1.6 "微软雅黑",Helvetica;margin:0;padding:0;-webkit-user-select:none;width:100%;height:100%;position:relative}
form,table,td,h1,h2,h3,h4,ul,ol,li,p{margin:0;padding:0;border:0;list-style:none}
input,img{vertical-align:middle}
html,body{min-width:100%;background:#EAEAEC;}
body{-webkit-text-size-adjust:none;}
img{border:0 none;max-width:100%;height:auto;}
ol,ul{list-style:none;}
:focus{outline:0;}
textarea{resize:none;overflow:auto;}
a{-webkit-touch-callout:none;-webkit-user-select:none;text-decoration:none}
a:link {-webkit-tap-highlight-color:rgba(229,59,44,0)}
table{border-collapse: collapse;border-spacing: 0;}
input:focus,textarea:focus{outline:0}
.tuned{ position:absolute;top:50%;left:50%;-webkit-transform: translate(-50%,-50%);font-size:48px;color:#bdbdd3;}


</style>

<body>
    团购总人数：<?php echo $data['setting']['nowpeple'];?>人<br>
  团购价格：<?php echo $data['setting']['nowprice'];?>元<br>
  <button id="sub_btn">微信支付</button>

</body>
<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo _STATIC_ ?>/js/globals.js"></script>
<script>
var order_sn=null;
$(function(){
	$('#sub_btn').bind('click',function(){
		$.post('/strasbourg/active/create_order',{'type':'<?php echo Constant::CHANNEL_GROUP?>'},function(data){
			var list=eval(data);
			  if(list.code != 1000){
				    alert(list.msg);
			  }else{
				  order_sn=list.data.out_trade_no;
					  //异步传入参数，获取微信支付字符串
				    $.post('/orderpay/ajaxweixinpaynew', {'body': list.data.body, 'out_trade_no': list.data.out_trade_no, 'total_fee': list.data.total_fee,'project':'strasbourg','callback':'http://'+window.location.host+'/orderpay/strasbourg','openid':'<?php echo $openid; ?>'}, function (data) {
		 		        orderstring = data;
		 		        callpay();//调起微信支付
		 		    });
			  }
		},'json');
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
                            	window.location.href = '<?php echo $this->createUrl('active/payok'); ?>'+'?ordersn=' + order_sn+'&channel=<?php echo Constant::CHANNEL_GROUP?>';
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
</html>
