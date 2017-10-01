<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="email=no">
        <meta id="viewport" name="viewport" content="width=415,minimum-scale=0.5,maximum-scale=2.0,user-scalable=no">
        <title>成长路径</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/jinganshun/h5/css/page.css">
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/jinganshun/h5/css/common.css">

        <script>
            var h5 = {
                skip: "jump",
                //页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
                clear: true, //页面清除动画
                address: "", //默认地址
                lazy: 1, //懒加载页面个数
                preload: true,
                //bg_audio	:"video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
            }
        </script>
    </head>
    <body> 

        <div id="preload" style=""></div>
        <div id="wrap">
            <ul id="page_list" stage="">
                <li class="page show" id="p1" scene="1" stop-move="-1">
                    <div class="page_body"> 
                        <img src="<?php echo _STATIC_ ?>vip/jinganshun/h5/img/logo.png" class="logo out-small quicker" delay="600">
                        <h3 class="grow_tit out-bottom quicker" delay="800" >成长路径</h3>
                    </div>
                </li>

                <li class="page" id="p2" scene="2">
                    <div class="page_body">
                        <div class="p2_tit out-left-l quicker" delay="600">
                            <img src="<?php echo _STATIC_ ?>vip/jinganshun/h5/img/logo.png">
                            <h3>成长路径</h3>
                        </div>
                        <p class="p2_detail out-top-t quicker" delay="800">京安顺为进入公司的员工建立职业发展的多重通道，其中既包括</p>
                        <div class="p2_grow">
                            <span class="p2_left p2_com out-left-l quicker" delay="1000">领导类通道</span><span class="p2_right p2_com out-right-r quicker" delay="1000">专业类通道</span>
                        </div>
                        <p class="p2_room out-bottom-b quicker" delay="1200">员工根据自身的特长在公司内有更广阔的发展空间。公司也将进行专业培训，让员工能够不断地提高专业任职能力。</p>

                    </div>
                </li>

                <li class="page" id="p3" scene="3">
                    <div class="page_body">
                        <div class="p2_tit out-left-l quicker" delay="600">
                            <img src="<?php echo _STATIC_ ?>vip/jinganshun/h5/img/logo.png">
                            <h3>成长阶梯图</h3>
                        </div>

                        <ul class="show_list quicker" delay="800">
                            <li class="show_btn show_btnjl quicker" delay="1000">项目经理</li>
                            <li class="show_btn quicker" delay="1200">保安队长</li>
                            <li class="show_btn quicker" delay="1400">保安班长</li>
                            <li class="show_btn quicker" delay="1600">保安员</li>
                        </ul>


                    </div>
                </li>

                <li class="page" id="p4" scene="4" stop-move="1">
                    <div class="page_body">
                        <img src="<?php echo _STATIC_ ?>vip/jinganshun/h5/img/logo.png" class="p3_logo out-big quicker" delay="600">
                        <ul class="p3_detail">
                            <li class="out-right quicker" delay="900">只要你肯努力</li>
                            <li class="out-right quicker" delay="1100">京安顺一定是你职业发展的舞台。</li>
                        </ul>

                    </div>


                </li>



            </ul>

            <img id="drop_down" src="<?php echo _STATIC_ ?>vip/jinganshun/h5/img/drop_down.png">
        </div> 
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/h5/js/slide.js" defer="defer"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/h5/js/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jinganshun/h5/js/init.js?1"></script>
    </body>
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