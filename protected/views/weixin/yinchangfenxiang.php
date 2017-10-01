<?php
require_once "jssdk.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>隐藏右上角分享按钮</title>
</head>
<body>
  
</body>
<script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
		'hideOptionMenu',
    ]
  });
  wx.ready(function () {
    wx.hideOptionMenu();
  });
</script>