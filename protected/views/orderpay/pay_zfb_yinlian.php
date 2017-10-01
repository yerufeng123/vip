<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>支付宝支付-网银支付</title>
        <style type="text/css">
        ul {
            margin-left:10px;
            margin-right:10px;
            margin-top:10px;
            padding: 0;
        }
        li {
            width: 32%;
            float: left;
            margin: 0px;
            margin-left:1%;
            padding: 0px;
            height: 100px;
            display: inline;
            line-height: 100px;
            color: #fff;
            font-size: x-large;
            word-break:break-all;
            word-wrap : break-word;
            margin-bottom: 5px;
        }
        a {
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:link{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:visited{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:hover{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:active{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
    </style>
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
        <div style="margin-left:2%;">商品展示地址：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  placeholder="请输入商品的展示地址(带http)" value="" id="goodaddress" /><br /><br />
       	<ul>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zggsyh.jpg" style="width: 85%;height: auto;" onclick="yinlian('ICBCB2C');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zgzsyh.jpg" style="width: 85%;height: auto" onclick="yinlian('CMB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zgjsyh.jpg" style="width: 85%;height: auto" onclick="yinlian('CCB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/shpdfzyh.jpg" style="width: 85%;height: auto" onclick="yinlian('SPDB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zgyh.jpg" style="width: 85%;height: auto" onclick="yinlian('BOCB2C');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zgyzcxyh.jpg" style="width: 85%;height: auto" onclick="yinlian('POSTGC');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/zgnyyh.jpg" style="width: 85%;height: auto" onclick="yinlian('ABC');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/xyyh.jpg" style="width: 85%;height: auto" onclick="yinlian('CIB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/fdyh.jpg" style="width: 85%;height: auto" onclick="yinlian('FDB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/gfyh.jpg" style="width: 85%;height: auto" onclick="yinlian('GDB');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/hzyh.jpg" style="width: 85%;height: auto" onclick="yinlian('HZCBB2C');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/shyh.jpg" style="width: 85%;height: auto" onclick="yinlian('SHBANK');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/nbyh.jpg" style="width: 85%;height: auto" onclick="yinlian('NBBANK');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/payh.jpg" style="width: 85%;height: auto" onclick="yinlian('SPABANK');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/visa.jpg" style="width: 85%;height: auto" onclick="yinlian('abc1003');"></li>
            <li style="overflow: hidden"><img src="<?php echo _STATIC_ ?>/img/master.jpg" style="width: 85%;height: auto" onclick="yinlian('abc1004');"></li>
        </ul>
        
        
        
        <form action="/orderpay/yinlianpay" method="post" name="zhifubao" id="zhifubao">
            <input type="hidden" name="goodname" id="goodnamevalue" value="" />
            <input type="hidden" name="gooddescribe" id="gooddescribevalue" value="" />
            <input type="hidden" name="ordernum" id="ordernumvalue" value="" />
            <input type="hidden" name="totalprice" id="totalpricevalue" value="" />
            <input type="hidden" name="yhcode" id="yhcode" value="" />
            <input type="hidden" name="goodaddress" id="goodaddressvalue" value="" />
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
                    goodaddress=$('#goodaddress').val();
                    ordernum = new Date().getTime();
                }
                //支付宝支付
                function yinlian(code) {
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
                    $('#goodaddressvalue').val(goodaddress);
                    $('#yhcode').val(code);
                    //如果是手机提交另一个路径
                    if(checkIsPhone()){
                        alert('请使用电脑访问');
                        return false;
                    }
                    $('#zhifubao').submit();
                }
                
               


    </script>


    
</html>