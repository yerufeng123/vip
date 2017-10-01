<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>微信支付-扫码支付</title>
    </head>

    <body>  
        <form action="/orderpay/native" method="post" id="myform">
            <div style="margin-left:2%;">商品名：</div><br/>
            <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的名称（必填）" value="" id="goodname" name="goodname"/><br /><br />
            <div style="margin-left:2%;">商品描述：</div><br/>
            <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的描述（选填）" value="" id="gooddescribe" name="gooddescribe"/><br /><br />
            <div style="margin-left:2%;">商品数量：</div><br/>
            <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的数量（必填）" value="" id="goodnum" name="goodnum"/><br /><br />
            <div style="margin-left:2%;">商品单价：</div><br/>
            <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的单价（必填：元,精确到小数点后两位）" value="" id="goodprice" name="goodprice"/><br /><br />
            <div style="margin-left:2%;">商品ID：</div><br/>
            <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的ID" value="" id="goodid" name="goodid"/><br /><br />
            <input type="hidden" name="goodordernum" id="goodordernum" value="">
            <input type="hidden" name="goodtotalfee" id="goodtotalfee" value="">
            <div align="center">
                <input type="button" value="生成订单" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;"  onclick="weixin()" />
            </div>
        </form>
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
                    $('#goodordernum').val(ordernum);
                    $('#goodtotalfee').val(totalprice);
                    $('#myform').submit();
                }


    </script>
</html>