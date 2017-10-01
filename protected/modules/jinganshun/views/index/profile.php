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
<title>公司简介</title>
</head>

<body>
<div class="wrap" id="security_first">
  <div class="top">
    <div class="logo"> <img src="<?php echo _STATIC_?>vip/jinganshun/images/logo.png"> <span>京安顺</span> </div>
    
    <div class="logo_nav"> 
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/first_bg.png" class="first_bg_tu">
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/first_tu.png" class="first_tu">
      <p class="welcome_tit">走进京安顺</p>
      <p class="intro_tit">公司简介<br/>
        <span>Company profile</span></p>
      <p class="about_tit">关于京安顺</p>
    </div>
  </div>
  <div class="sec_main">
    <div class="first_main_bg"></div>
    <div class="sec_block1">
      <p class="detail1 detail_com">北京京安顺保安服务有限公司成立于2004年，是北京市公安局批准的标杆保安企业之一。</p>
      <img src="<?php echo _STATIC_?>vip/jinganshun/images/cion_line.png" class="cion_line1"> <img src="<?php echo _STATIC_?>vip/jinganshun/images/tu_ren1.png" class="tu_ren1">
      <p class="detail2 detail_com">公司主要为政府机关、企事业单位、小区物业、大型文体、商业活动提供保安服务。公司一直秉承"客户至上，专业服务，诚信为本。"的经营宗旨以及"注重人员素质，关注人才培养，员工与公司共发展"的团队管理理念。经公司的努力经营，公司规模现不断扩大，现已发展为注册资本1000万，千人以上的专业保安队伍。 </p>
      <img src="<?php echo _STATIC_?>vip/jinganshun/images/cion_line.png" class="cion_line1 cion_line2"> </div>
    <div class="sec_block2">
      <p class="detail3 detail_com">光荣完成过2008年奥运会、国庆60周年大阅兵、中非论坛、亚欧合作论坛等重大保安服务项目。</p>
      <img src="<?php echo _STATIC_?>vip/jinganshun/images/cion_line.png" class="cion_line1 cion_line3"> <img src="<?php echo _STATIC_?>vip/jinganshun/images/tu_ren2.png" class="tu_ren2">
      <p class="detail4 detail_com">目前公司合作的项目有：国网电力、京电集团、电力医院、北京新世界、长安责任保险等，为一百五十多家行政和企事业单位负责安全保卫工作，每年保卫国家、企业资产数十亿。公司以规范的管理、良好的信誉、优秀的队伍，获得服务单位的广泛好评。</p>
      <img src="<?php echo _STATIC_?>vip/jinganshun/images/cion_line.png" class="cion_line1 cion_line4">
      <p class="detail5 detail_com">"服务客户，关怀员工。"一直是公司的核心理念，为客户提供高质量的服务，让员工体会家庭式企业文化，是我们永远不变的承诺！</p>
    </div>
  </div>
</div>
</body>
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
</html>
