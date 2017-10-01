<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
      <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css" rel="stylesheet">
        <title>有奖征稿</title>
    </head>

    <body class="share_page">
        <div class="wrap" id="rule_offer">
            <img src="<?php echo _STATIC_ ?>vip/jinganshun/images/rule_new_tu.jpg" class="rule_new_tu"/>
            <p class="logo_set"><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/logo.png" class="rule_share"><span>京安顺</span></p>
            <span class="rule_t">规则</span>
            <p class="share_detail"><?php echo $data['content']; ?></p>  
        </div>

        <a href="/jinganshun/index/articleadd" class="share_b offer_bt">写文章</a>



        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/zepto.min.js"></script>
         <script>
                       //页面大小初始化
                       (function () {
                           var _width = document.body.clientWidth;
                           var _dom = document.querySelector('#viewport');
                           var scale = _width / 320;
                           _dom.setAttribute('content', 'width=320,user-scalable=no,initial-scale=' + scale);
                       })()
        </script>
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
                    'hideOptionMenu',
                ]
            });
            wx.ready(function () {
                //隐藏右上角菜单
                wx.hideOptionMenu();
            });
        </script>
        <script type="text/javascript">
            $(function(){
            $("body").height($("body").height());
                    $("body").on("touchmove", function(e){
            e.preventDefault();
            })


        </script>

    </body>
</html>