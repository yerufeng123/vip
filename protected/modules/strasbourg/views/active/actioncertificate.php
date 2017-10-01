<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>竟拍活动页</title>
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>js/jquery-1.8.3.min.js"></script> 
</head>
<body>
<?php $goods=$this->MyJsonDecode($goods);?>
<div align="center" style="width:416px; margin:0 auto">
<h1>
秒拍凭证
</h1>
<p>恭喜您以竟拍<?php echo $goods['setting']['name']?>！</p>
<br />
<br />
<p>
<?php echo $ewm['code'];?>
</p>
<br />
<img src='<?php echo '/'.$ewm['erweimaurl'];?>' />
<p>

保存二维码页面，或在“**”公众号个人中心-抽奖凭证中管理秒拍凭证，并去领奖处兑换奖品
</p>
<br />
<br />
<div><button><a href='<?php echo $this->createUrl('active/certificate_web',array('ordersn'=>$order_sn));?>'>秒拍伪证管理</a></button></div>
</div>
<br />
</body>
<script>

</script>
</html>