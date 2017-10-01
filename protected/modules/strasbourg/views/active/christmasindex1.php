<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>接圣诞礼物</title>
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>js/jquery-1.8.3.min.js"></script> 
</head>
<body>
<div align="center" style="width:416px; margin:0 auto">
<h1>接圣诞礼物</h1>
<br />
<div><button id='start'>开始游戏</button></div>
<br />
<div><button id='rults'>游戏规则</button></div>

<br />
<div><button id='score'>积分查询</button></div>
<br />
</div>
</body>
<script>
 $('#start').click(function(){
	 $.post('<?php echo $this->createUrl('active/christmasindex');?>',{},function(data){
		 if(data.code == 1000){
			 window.location.href='<?php echo $this->createUrl('active/christmas');?>';
		 }else{
			 alert(data.msg);
		 }
	 },'json');
 });
</script>
</html>