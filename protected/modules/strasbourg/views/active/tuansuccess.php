<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>斯特拉斯堡圣诞小镇</title>
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>js/jquery-1.8.3.min.js"></script> 
</head>
<body>
<h1>支付成功</h1>
恭喜您已团购价购得
奖品名：<?php echo $tuandata['setting']['name']?>
团购总人数：<?php echo $data['setting']['nowpeple'];?>
团购价格：<?php echo $orderdata['price']?>
获得积分：<?php echo $tuandata['credit']?>
<?php echo "<pre>"?>
<?php var_dump($tuandata);?>
<?php var_dump($orderdata);?>
<button onclick="javascript:location.href='/strasbourg/active/certificate_web?ordersn=<?php echo $orderdata['order_sn']?>&type=<?php echo $orderdata['type']?>'">获取凭证</button>
</body>
</html>