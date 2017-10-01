<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>招聘流程</title>
</head>

<body class="p_detail_bg">
<div class="wrap" id="process_detail">
	<div class="process_detail_main">
         <img src="<?php echo _STATIC_?>vip/jinganshun/images/process_bg_new.png" class="process_bg_new">
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/logo.png" class="p_detail_logo">

       	<ul class="p_detail_list">
        	<li><img src="<?php echo _STATIC_?>vip/jinganshun/images/wchat.png" class="wchat"><span>1 进入公司微信平台</span></li>
            <li class="pr_arrow"></li>
            <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/zp_tu.png" class="zp_tu"><span>2 选择人才招聘</span></li>
            <li class="pr_arrow"></li>
            <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/zwsq_tu.png" class="zwsq_tu"><span>3 选择职位申请</span></li> 
            <li class="pr_arrow"></li>
            <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/inf_tu.png" class="inf_tu"><span>4  填写基本信息</span></li>
            <li class="pr_arrow"></li>
            <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/yf_tu.png" class="yf_tu"><span>5 选择需要应聘的职位</span></li>
            <li class="pr_arrow"></li>
            <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/ph_tu.png" class="ph_tu"><span>6 等待公司面试通知电话</span></li>
             <li class="pr_arrow"></li>
             <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/ms_tu.png" class="ms_tu"><span>7 参加面试</span></li>
             <li class="pr_arrow"></li>
             <li><img src="<?php echo _STATIC_?>vip/jinganshun/images/sg_tu.png" class="sg_tu"><span>8 培训上岗</span></li>

        </ul>
       
    </div>
</div>
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
</body>
</html>
