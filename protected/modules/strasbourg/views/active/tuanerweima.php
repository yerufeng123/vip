<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>斯特拉斯堡圣诞小镇</title>
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>js/jquery-1.8.3.min.js"></script> 
</head>
<body>
<h1>支付成功</h1>
商品名称：<?php echo $tuandata['setting']['name']?>
二维码编号：<?php echo $orderdata['ewm']['code'];?>
二维码图片：<img src="/<?php echo $orderdata['ewm']['erweimaurl'];?>">
<?php echo '<pre>';?>
<?php var_dump($tuandata);?>
<?php var_dump($orderdata);?>
</body>
</html>