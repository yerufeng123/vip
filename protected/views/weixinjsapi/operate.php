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
            <input type="button" value="隐藏右上角菜单" onclick="hideOptionMenu();">
            <input type="button" value="显示右上角菜单接口" onclick="showOptionMenu();">
            <input type="button" value="关闭当前网页窗口接口" onclick="closeWindow();">
            <input type="button" value="批量隐藏功能按钮接口" onclick="hideMenuItems();">
            <input type="button" value="批量显示功能按钮接口" onclick="showMenuItems();">
            <input type="button" value="隐藏所有非基础按钮接口" onclick="hideAllNonBaseMenuItem();">
            <input type="button" value="显示所有功能按钮接口" onclick="showAllNonBaseMenuItem();">
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
                        'hideOptionMenu',
                        'showOptionMenu',
                        'closeWindow',
                        'hideMenuItems',
                        'showMenuItems',
                        'hideAllNonBaseMenuItem',
                        'showAllNonBaseMenuItem',
                    ]
                });

                function hideOptionMenu() {
                    wx.hideOptionMenu();
                }
                function showOptionMenu() {
                    wx.showOptionMenu();
                }
                function closeWindow() {
                    wx.closeWindow();
                }
                function hideMenuItems() {
                    wx.hideMenuItems({
                        menuList: ['menuItem:share:appMessage','menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                    });
                }
                function showMenuItems() {
                    wx.showMenuItems({
                        menuList: ['menuItem:share:appMessage','menuItem:share:timeline','menuItem:share:qq'] // 要显示的菜单项，所有menu项见附录3
                    });
                }
                function hideAllNonBaseMenuItem() {
                    wx.hideAllNonBaseMenuItem();
                }
                function showAllNonBaseMenuItem() {
                    wx.showAllNonBaseMenuItem();
                }

    </script>
</html>
