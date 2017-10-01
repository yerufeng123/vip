<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>支付页面</title>

    </head>
    <body>
        <h3>输出参数，单击图片调起支付</h3>
        <div>
            商品名：<input type="text" value="" id="goodname"/>(微信必填)<br>
            商品描述:<input type="text" value="" id="gooddescribe"><br>
            商品数量：<input type="text" value="1" id="goodnum">(必填)<br>
            商品单价：<input type="text" value="" id="goodprice">(必填:单位元，可精确到小数点后两位)<br>
        </div>
        <div>
            <img src="<?php echo _STATIC_ ?>img/weixinlogo.jpg" width="100px" height="40px" onclick="weixin();"/>
            <img src="<?php echo _STATIC_ ?>img/zhifubaologo.jpg" width="100px" height="40px" style="margin-left: 20px;" onclick="zfb();"/>
            <img src="<?php echo _STATIC_ ?>img/yinlianlogo.jpg" width="100px" height="40px" style="margin-left: 20px;" onclick="yinlian();"/>
        </div>
        <form action="/orderpay/zhifubao" method="post" name="zhifubao" id="zhifubao">
            <input type="hidden" name="goodname" id="goodnamevalue" value="" />
            <input type="hidden" name="gooddescribe" id="gooddescribevalue" value="" />
            <input type="hidden" name="ordernum" id="ordernumvalue" value="" />
            <input type="hidden" name="totalprice" id="totalpricevalue" value="" />
        </form>
    </body>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
                var goodname = ''; //商品名
                var gooddescribe = ''; //商品描述
                var goodnum = 1; //商品数量
                var goodprice = 0.01; //商品单价(元)
                var totalprice = goodnum * goodprice;
                var ordernum = ''; //订单号
                var orderstring = ''; //微信支付字符串
                function getparam() {
                    goodname = $('#goodname').val();
                    gooddescribe = $('#gooddescribe').val();
                    goodnum = parseInt($('#goodnum').val());
                    goodprice = parseFloat($('#goodprice').val());
                    totalprice = goodnum * goodprice;
                    gooddescribe = $('#gooddescribe').val();
                    ordernum = new Date().getTime();
                }

                //微信支付
                function weixin() {
                    getparam();
                    //异步传入参数，获取微信支付字符串
                    $.post('/orderpaywx/ajaxweixin', {'body': goodname, 'out_trade_no': ordernum, 'total_fee': totalprice}, function(data) {
                        orderstring = data;
                        callpay(); //调起微信支付
                    });
                }

                //支付宝支付
                function zfb() {
                    getparam();
                    $('#goodnamevalue').val(goodname);
                    $('#gooddescribevalue').val(gooddescribe);
                    $('#ordernumvalue').val(ordernum);
                    $('#totalpricevalue').val(totalprice);
                    //如果是手机提交另一个路径
                    if(checkStyle()){
                        $('#zhifubao').attr('action','/orderpay/zhifubaophone');
                    }
                    $('#zhifubao').submit();
                }

                //银联支付
                function yinlian() {
                    alert('这是银联支付');
                }
    </script>

    <!--微信支付相关-->
    <script type="text/javascript">

        //调用微信JS api 支付
        function jsApiCall()
        {
            var orderstring_1 = new Function("return " + orderstring)(); //将字符串转为字符串对象（只有异步获取的才是字符串，通过页面php获取的，本来就是字符串对象）
            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    orderstring_1,
                    function(res) {
                        WeixinJSBridge.log(res.err_msg);
                        switch (res.err_msg) {
                            case 'get_brand_wcpay_request:ok':
                                //异步调用查询方法，获取订单是否真的完成
                                //如果 支付成功
                                //否则支付异常
                                alert('支付成功');
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
    <script>
        function checkStyle() {
            /*
             * 智能机浏览器版本信息:
             *
             */
            var browser = {
                versions: function() {
                    var u = navigator.userAgent, app = navigator.appVersion;
                    return {//移动终端浏览器版本信息
                        trident: u.indexOf('Trident') > -1, //IE内核
                        presto: u.indexOf('Presto') > -1, //opera内核
                        webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                        mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                        ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                        android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                        iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                        iPad: u.indexOf('iPad') > -1, //是否iPad
                        webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                    };
                }(),
                language: (navigator.browserLanguage || navigator.language).toLowerCase()
            }

//判断方法如下：
            if (browser.versions.android || browser.versions.iPhone || browser.versions.iPad) {
                return true;
            }
            return false;
        }

    </script>
</html>
