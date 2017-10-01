<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>微信支付-新页面支付</title>
    </head>

    <body>  
        <div style="margin-left:2%;">商品名：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的名称（必填）" value="" id="goodname" /><br /><br />
        <div style="margin-left:2%;">商品描述：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的描述（选填）" value="" id="gooddescribe" /><br /><br />
        <div style="margin-left:2%;">商品数量：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的数量（必填）" value="" id="goodnum" /><br /><br />
        <div style="margin-left:2%;">商品单价：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的单价（必填：元,精确到小数点后两位）" value="" id="goodprice" /><br /><br />
       	<div align="center">
            <input type="submit" value="确认支付" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="weixin()" />
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/globals.js"></script>
    <script>
                var goodname = '';//商品名
                var gooddescribe = '';//商品描述
                var goodnum = 1;//商品数量
                var goodprice = 0.01;//商品单价(元)
                var totalprice = goodnum * goodprice;
                var ordernum = '';//订单号
                var orderstring = '';//微信支付字符串
                var addressstring = '';//微信收货地址字符串
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
                    if (goodname == '') {
                        alert('请输入商品名');
                        return false;
                    }
                    if (ordernum == '') {
                        alert('请输入商品数量');
                        return false;
                    }
                    if (totalprice == '') {
                        alert('请输入商品价格');
                        return false;
                    }
                    //异步传入参数，获取微信支付字符串
                    $.post('/orderpay/ajaxweixinpaynew', {'body': goodname, 'out_trade_no': ordernum, 'total_fee': totalprice}, function (data) {
                        orderstring = data;
                        callpay();//调起微信支付
                    });
                }


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
        //获取共享地址
        function editAddress()
        {
            //var addressstring_1 = new Function("return " + addressstring)();//将字符串转为字符串对象（只有异步获取的才是字符串，通过页面php获取的，本来就是字符串对象）
            WeixinJSBridge.invoke(
                    'editAddress',
<?php echo $editAddress; ?>,
                    function (res) {
                        if (res.err_msg == 'edit_address:cancel') {
                            //不使用地址
                        }
                        if (res.err_msg == 'edit_address:ok') {
                            //获得了地址信息，是否用于项目，自己决定
                            var value1 = res.proviceFirstStageName;//所在省：比如 河南省/北京市
                            var value2 = res.addressCitySecondStageName;//所在市  比如 周口市/北京市
                            var value3 = res.addressCountiesThirdStageName;//所在县区 比如 淮阳县/海淀区
                            var value4 = res.addressDetailInfo;//详细地址  比如 清华同方科技广场D座东楼802室
                            var value5 = res.nationalCode;// 比如：110108
                            var value6 = res.addressPostalCode;//邮政编码 比如：100089
                            var tel = res.telNumber;//手机号

                            alert(value1 + value2 + value3 + value4 + ":" + tel);
                        }

                    }
            );
        }

        window.onload = function () {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', editAddress, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', editAddress);
                    document.attachEvent('onWeixinJSBridgeReady', editAddress);
                }
            } else {
                editAddress();
            }
        };

    </script>
</html>