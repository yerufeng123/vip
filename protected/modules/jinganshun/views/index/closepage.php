<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/jquery-2.1.1.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['jinganshun']['wxappid'], Yii::app()->params['jinganshun']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
                wx.config({
                    debug: false,
                    appId: '<?php echo $signPackage["appId"]; ?>',
                    timestamp: <?php echo $signPackage["timestamp"]; ?>,
                    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                    signature: '<?php echo $signPackage["signature"]; ?>',
                    jsApiList: [
                        // 所有要调用的 API 都要加到这个列表中
                        'closeWindow',
                    ]
                });
                wx.ready(function() {
                    //隐藏右上角菜单
                    wx.closeWindow();
                });
        </script>
</html>
