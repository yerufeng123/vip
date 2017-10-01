<?php
require_once "jssdk.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>拍照或从手机相册中选图接口</title>
</head>
<body>
	<form>
		<input type="button" onclick="choose();" value="拍照或选择" /><br><br><br><br><br>
		<input type="button" onclick="upload('weixin://resourceid/ab43e721ff74a6d04628e31ee97fe692');" value="上传照片" />
		<input type="hidden" id="weixinpic" value="" />
	</form>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名     weixin://resourceid/ab43e721ff74a6d04628e31ee97fe692
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
		'chooseImage',
		'uploadImage',
    ]
  });
</script>

<script>
	function choose(){
		wx.chooseImage({
			success: function (res) {
				var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
					
				
				
			}
		});
			
	}
	function upload(localIds){
		alert(localIds);
	//	var arrIds=localIds.split(",");
	//	alert(arrIds);
		wx.uploadImage({
			localId: localIds, // 需要上传的图片的本地ID，由chooseImage接口获得
			isShowProgressTips: 1, // 默认为1，显示进度提示
			success: function (res) {
				var serverId = res.serverId; // 返回图片的服务器端ID
				alert(serverId);
			}
		});
	}
</script>