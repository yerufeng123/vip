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
<title>员工关怀</title>
</head>

<body>
<div class="wrap" id="care">
  	<div class="top">
    	<div class="logo">
        	<img src="<?php echo _STATIC_?>vip/jinganshun/images/logo.png">
        </div>
        
        <div class="logo_nav gh_nav">
            <p class="intro_tit">员工关怀<br/><span>Company profile</span></p>
        </div>
        
    </div>
    
    <div class="main">
    	<div class="gh_list">
			<div class="gh_block">
            	<h3><span>关爱员工，共同成长</span></h3>
                <p>京安顺一直坚持"以员工是公司的根本、员工与公司是一个整体"和"要关怀员工"的理念，积极为员工创建和谐快乐的家庭式的工作环境，实现员工与公司共同成长。</p>
            </div>
            
            <div class="gh_block">
            	<h3><span>创建良好员工工作环境</span></h3>
                <p>完善员工福利制度，提供工作餐、发放劳保，为一线员工提供宿舍；坚持公开、透明的招聘政策，在公平机会的前提下招聘、选用、提拔员工；保证员工薪资的按时发放。</p>
            </div>
            
             <div class="gh_block">
            	<h3><span>帮助员工发展</span></h3>
                <p>我们关注员工在公司的发展需求，为员工成才搭建更多的学习交流、竞聘平台。推行组织标准化、薪酬标准化，创新和完善员工培训体系，有计划组织开展包括专业技能、安全生产、企业文化、团队管理等各方面的培训活动。</p>
            </div>
            
             <div class="gh_block">
            	<h3><span>关爱员工生活</span></h3>
                <p>坚持以人为本，关注员工的日常生活，持续开展关爱一线员工的活动，开展送温暖、夏日送清凉、企业热线、节日慰问等丰富的活动，增强员工归属感。</p>
            </div>
			
            
        </div>
        <img src="<?php echo _STATIC_?>vip/jinganshun/images/hand.png" class="welcome_tu">
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
