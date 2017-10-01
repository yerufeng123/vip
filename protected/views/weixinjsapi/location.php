<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>设备接口</title>
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
            <input type="button" value="查看位置" onclick="map();">
            <input type="button" value="获取地理位置" onclick="location1();">
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
                        'openLocation',
                        'getLocation',
                    ]
                });

                //使用微信内置地图查看位置接口
                function map() {
                    wx.openLocation({
                        latitude: 39.998330, // 纬度，浮点数，范围为90 ~ -90
                        longitude: 116.338840, // 经度，浮点数，范围为180 ~ -180。
                        name: '清华同方科技广场D座', // 位置名
                        address: '北京市海淀区王庄路1号院4', // 地址详情说明
                        scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
                        infoUrl: 'http://www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转
                    });
                }

                //获取地理位置接口
                function location1() {
                    wx.getLocation({
                        success: function (res) {
                            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                            var speed = res.speed; // 速度，以米/每秒计
                            var accuracy = res.accuracy; // 位置精度
                            alert('纬度：'+latitude);
                            alert('经度：'+longitude);
                            alert('速度：'+speed);
                            alert('位置经度：'+accuracy);
                        }
                    });
                }
    </script>
</html>
