<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>职位申请</title>
</head>
<body>
<div class="wrap" id="apply_deail">
  	<h3 class="apply_tit">第一项目部介绍</h3>
    <div class="detail_main">
    	<div class="detail_block1">
            <p class="first_ba_tit">第一项目部驻勤单位主要分布于北京市区内，以写字楼、办公区、医院为主，部分驻勤单位为物资仓库。项目部主要服务北京市电力医院、国网北京市电力公司物资分公司、长安保险大厦、燕京大厦、新世界家园等单位。</p>

            <h3>环境:</h3>
            <ul class="tu_list">
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/list_one1.jpg"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/list_one2.jpg"></li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/list_one3.jpg"></li>
            </ul>
            <h3>主要位置：</h3>
            <ul class="tu_list tu_pic_list">
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map1.jpg">电力医院</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map2.jpg">丰益花园</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map3.jpg">国家电力角门</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map4.jpg">国家电力客服中心</li>
                 <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map5.jpg">国网电力物资公司</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map6.jpg">华腾大厦</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map7.jpg">新世界地产</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map8.jpg">新世界家园</li>
                <li><img src="<?php echo _STATIC_ ?>vip/jinganshun/images/one_map9.jpg">长安保险大厦</li>
            </ul>
        </div>
    </div>
     <div class="clear"></div>
     <a href="/jinganshun/index/recruitadd?position=<?php echo $name;?>" class="apply_btn app_com">职位申请</a>
    
</div>
<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/js/zepto.min.js"></script>
<script>
        //页面大小初始化
        (function(){ 
            var _width = document.body.clientWidth;
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
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
                wx.ready(function() {
                    //隐藏右上角菜单
                    wx.hideOptionMenu();
                });
        </script>
</body>
</html>
