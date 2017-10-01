<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>职位申请</title>
</head>
<body>
<div class="wrap" id="apply_deail">
  	<h3 class="apply_tit">职位详情</h3>
    <div class="apply_tp">
    	<ul>
        	<li>项目经理</li>
            <li><p><span class="yuan"></span>月薪5000+年末分红</p><p><span class="city"></span>北京</p></li>
        </ul>
    </div>
    
    <div class="detail_main">
    	<div class="detail_block1">
        	<h3>岗位职责:</h3>
        	<ul>
                <li>1.负所辖服务项目的日常管理工作；</li>
                <li>2.负责与服务单位对接人日常工作的沟通与处理。</li>
            </ul>
            <h3>应聘条件:</h3>
            <ul>
                <li>1.男性，年龄18-45周岁，身高1.70米以上；</li>
                <li>2.高中以上文化程度；</li>
                <li>3.身体健康、思想进步、品质端正，无犯罪前科；</li>
                <li>4.3年以上保安管理工作经验；</li>
                <li>5.退伍军人优先录用。</li>
            </ul>
           
        </div>
    </div>
     <div class="clear"></div>
        <a href="/jinganshun/index/recruitadd?position=项目经理" class="apply_btn app_com">职位申请</a>
    
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
                wx.ready(function() {
                    //隐藏右上角菜单
                    wx.hideOptionMenu();
                });
        </script>
</body>
</html>
