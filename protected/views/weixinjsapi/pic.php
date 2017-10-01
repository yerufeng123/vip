<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>图像接口</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .main{
                width: 400px;
                height: 300px;
                background: #cccccc;
                position: absolute;
                left: 50%;
                top:50%;
                margin-left: -200px;
                margin-top: -150px;
                text-align: center;
                line-height: 50px;
            }
        </style>
    </head>
    <body>
        <div><img src="http://g.hiphotos.baidu.com/image/pic/item/5243fbf2b21193132e1c095661380cd790238dfd.jpg"  width="100px;" height="100px" onclick="yulan();"><img src="" id="img1" width="100px;" height="100px"><img src="" id="img2" width="100px;" height="100px"></div>
        <div class="main">
            <input type="button" value="拍照" onclick="paizhao();">
            <input type="button" value="预览图片" onclick="yulan();">
            <input type="button" value="上传图片" onclick="shangchuan();">
            <input type="button" value="下载图片" onclick="xiazai();">
            <input type="hidden" value="" id="localIds">
            <input type="hidden" value="" id="serverId">
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js<?php echo (Yii::app()->params['common']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['common']['wxappid'], Yii::app()->params['common']['wxappsecret']);
    $signPackage = $jssdk->GetSignPackage();
    ?>
    <script>
                /*
                 * 注意：
                 *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
                 */

                wx.config({
                    debug: true,
                    appId: '<?php echo $signPackage["appId"]; ?>',
                    timestamp: <?php echo $signPackage["timestamp"]; ?>,
                    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                    signature: '<?php echo $signPackage["signature"]; ?>',
                    jsApiList: [
                        // 所有要调用的 API 都要加到这个列表中
                        'chooseImage',
                        'previewImage',
                        'uploadImage',
                        'downloadImage',
                    ]
                });

                //拍照或从手机中选择
                function paizhao() {
                    wx.chooseImage({
                 	    count: 1, // 默认9
                  	    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                    	sourceType: ['camera'], // 可以指定来源是相册还是相机，默认二者都有
                        success: function (res) {
                            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                            if(localIds.length == 0){
                                alert('请先选择照片');
                                return false;
                            }
                            if(localIds.length > 1){
                                alert('目前上传只支持单张');
                                return false;
                            }
                            $('#img1').attr('src', localIds);
                            $('#localIds').val(localIds);
                        }
                    });
                }

                //预览图片接口
                function yulan() {
                    wx.previewImage({
                        current: 'http://f.hiphotos.baidu.com/image/pic/item/37d3d539b6003af3af0b2a86312ac65c1138b6a7.jpg', // 当前显示图片的http链接---》就是打开预览后，先显示第几张图片
                        urls: ['http://g.hiphotos.baidu.com/image/pic/item/5243fbf2b21193132e1c095661380cd790238dfd.jpg', 'http://f.hiphotos.baidu.com/image/pic/item/37d3d539b6003af3af0b2a86312ac65c1138b6a7.jpg', 'http://f.hiphotos.baidu.com/image/pic/item/0823dd54564e92580cb870089882d158cdbf4e4c.jpg'] // 需要预览的图片http链接列表
                    });
                }

                //上传图片接口---->('大图片就会失败’)
                function shangchuan() {
                    wx.uploadImage({
                        localId: $('#localIds').val(), // 需要上传的图片的本地ID，由chooseImage接口获得
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var serverId = res.serverId; // 返回图片的服务器端ID
                            $('#serverId').val(serverId);
                            $.post('/weixinjsapi/ajaxgetmetarial',{'serverId':serverId},function(data){
                                $('#img2').attr('src',data);
                            });
                        }
                    });
                }

                //下载图片接口---->('未成功')
                function xiazai() {
                    wx.downloadImage({
                        serverId: $('#serverId').val(), // 需要下载的图片的服务器端ID，由uploadImage接口获得
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var localId = res.localId; // 返回图片下载后的本地ID
                            alert(localId);
                        }
                    });
                }
    </script>
</html>
