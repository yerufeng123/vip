<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>界面操作</title>
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

        <div class="main">
            <input type="button" value="拉取卡券列表" onclick="product();">
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
                        'chooseCard',
                    ]
                });



    </script>
    <script>
        function product() {
            wx.chooseCard({
                shopId: '', // 门店Id
                cardType: '', // 卡券类型
                cardId: '', // 卡券Id
                timestamp: <?php echo $sign['timestamp']?>, // 卡券签名时间戳
                nonceStr: '<?php echo $sign['nonce_str']?>', // 卡券签名随机串
                signType: 'SHA1', // 签名方式，默认'SHA1'
                cardSign: '<?php echo $sign['cardsign']?>', // 卡券签名
                success: function (res) {
                    var cardList = res.cardList; // 用户选中的卡券列表信息
                    alert(cardList);
                }
            });
        }
    </script>
</html>
