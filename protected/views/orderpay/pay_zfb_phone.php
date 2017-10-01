<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>支付宝支付-页面支付</title>
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
            <input  value="确认支付" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="zfb()" />
        </div>
        <form action="/orderpay/zhifubaophone" method="post" name="zhifubao" id="zhifubao">
            <input type="hidden" name="goodname" id="goodnamevalue" value="" />
            <input type="hidden" name="gooddescribe" id="gooddescribevalue" value="" />
            <input type="hidden" name="ordernum" id="ordernumvalue" value="" />
            <input type="hidden" name="totalprice" id="totalpricevalue" value="" />
        </form>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/globals.js"></script>
    <script>
                var goodname = ''; //商品名
                var gooddescribe = ''; //商品描述
                var goodnum = 1; //商品数量
                var goodprice = 0.01; //商品单价(元)
                var totalprice = goodnum * goodprice;
                var ordernum = ''; //订单号
                function getparam() {
                    goodname = $('#goodname').val();
                    gooddescribe = $('#gooddescribe').val();
                    goodnum = parseInt($('#goodnum').val());
                    goodprice = parseFloat($('#goodprice').val());
                    totalprice = goodnum * goodprice;
                    gooddescribe = $('#gooddescribe').val();
                    ordernum = new Date().getTime();
                }
                //支付宝支付
                function zfb() {
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
                    $('#goodnamevalue').val(goodname);
                    $('#gooddescribevalue').val(gooddescribe);
                    $('#ordernumvalue').val(ordernum);
                    $('#totalpricevalue').val(totalprice);
                    //如果是手机提交另一个路径
                    if (checkIsPhone()) {
                        $('#zhifubao').submit();
                    } else {
                        alert('请使用手机访问');
                        return false;
                    }
                }




    </script>



</html>