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
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/common.css" rel="stylesheet">
<link type="text/css" href="<?php echo _STATIC_?>vip/jinganshun/css/page.css" rel="stylesheet">
<title>职位申请</title>
</head>
<body>
<div class="wrap" id="apply_deail" style="overflow:inherit;padding-bottom:10px;">
  	<h3 class="apply_tit">职位详情</h3>
    <div class="apply_tp">
    	<ul>
        	<li>保安班长</li>
            <li><p><span class="yuan"></span>月薪2千-3千+过节费</p><p><span class="city"></span>北京</p><p><span class="sex"></span>男性</p></li>
        </ul>
    </div>
    
    <div class="detail_main">
    	<div class="detail_block1">
        	<h3>岗位职责:</h3>
        	<ul>
                <li>1.负责对所辖驻勤点保安员的日常管理；</li>
                <li>2.每天进行不定时查岗和不定时查夜，并及时纠正保安员的违纪行为；</li>
                <li>3.人员住宿和离职人员宿舍物品监收，对宿舍财物维护及检查；</li>
                <li>4.制定每月值班安排表。 </li>
            </ul>
            <h3>应聘条件:</h3>
            <ul>
                <li>1.男性，年龄18-40周岁，身高1.70米以上；</li>
                <li>2.初中以上文化程度；</li>
                <li>3.身体健康、思想进步、品质端正，无犯罪前科；</li>
                <li>4.1年以上保安管理工作经验；</li>
                <li>5.退伍军人优先录用。</li>
            </ul>

            <a href="/jinganshun/index/baoan?positiontype=one&positionname=保安班长" class="first_btn ba_btn">第一项目部介绍</a>
            <a href="/jinganshun/index/baoan?positiontype=two&positionname=保安班长" class="two_btn ba_btn">第二项目部介绍</a>
            <a href="/jinganshun/index/baoan?positiontype=three&positionname=保安班长" class="three_btn ba_btn">第三项目部介绍</a>



    </div>
     <div class="clear"></div>
        <a href="/jinganshun/index/recruitadd?position=保安班长" class="apply_btn app_com" style="display:block">职位申请</a>
   </div> 
</div>
<script type="text/javascript" src="<?php echo _STATIC_?>vip/jinganshun/js/zepto.min.js"></script>
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
