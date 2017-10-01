<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title></title>
</head>

<body>  
	<form action="/orderpay/swingok" method="post">
        <div style="margin-left:2%;">商品描述：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;"  value="" name="gooddescribe" /><br /><br />
        <div style="margin-left:2%;">支付金额：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;" value="" name="totalprice" /><br /><br />
        <div style="margin-left:2%;">授权码：</div><br/>
        <input type="text" style="width:96%;height:35px;margin-left:2%;" name="auth_code" /><br /><br />
       	<div align="center">
			<input type="submit" value="提交刷卡" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" />
		</div>
	</form>
</body>
</html>