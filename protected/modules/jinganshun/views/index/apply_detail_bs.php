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
        	<li>标书制作员</li>
            <li><p><span class="yuan"></span>月薪5000+年终奖金</p><p><span class="city"></span>北京</p></li>
        </ul>
    </div>
    
    <div class="detail_main">
    	<div class="detail_block1">
        	<h3>岗位职责:</h3>
        	<ul>
                <li>1.负责招投标信息的收集，投标文件的制作及标书中涉及到的相应工作；</li>
                <li>2.负责投标文件编辑、制作、审核、打印、装订、密封、投运等；</li>
                <li>3.负责招标网站信息及会员办理，产品的寻、报价管理等工作；</li>
                <li>4.协助项目授权书的申请及盖章等工作；</li>
                <li>5.整理公司产品业绩、准备投标相关资质、投标文件归档管理等工作。</li>
            </ul>
            <h3>应聘条件:</h3>
            <ul>
                <li>1.大专及以上学历，年龄20-35岁；</li>
                <li>2.两年企业标书制作经验；</li>
                <li>3.熟悉OFFICE等办公软件的使用，尤其是精通WORD、及简单的PHOTOSHAOP的使用。</li>
            </ul>
           
        </div>
    </div>
     <div class="clear"></div>
        <a href="/jinganshun/index/recruitadd?position=标书制作员" class="apply_btn app_com">职位申请</a>
    
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
