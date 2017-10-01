<?php
require_once "jssdk.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>微信扫一扫</title>
</head>
<body>
	<form>
		<input type="button" onclick="sao();" value="扫一扫" />
	</form>
</body>
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
		'scanQRCode',
    ]
  });
</script>

<script>
	function sao(){
		wx.scanQRCode({
			 needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果（不跳转），
			 scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
			 success: function (res) {
			 var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
			 //res 为 {"resultStr":"http://www.baidu.com","errMsg":"scanQRCode:ok"}
			}
		});
	}
</script>