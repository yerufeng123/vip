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
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css" rel="stylesheet">
        <title>员工嘉奖</title>
    </head>
    <body>
        <div class="wrap wrap_act2" id="apply_deail">
            <h3 class="apply_tit apply_tit_act"><marquee direction="left" scrollamount="2"><?php echo $data ?></marquee></h3>
            <img class="close_btn" src="<?php echo _STATIC_ ?>vip/jinganshun/images/close.png" />
            <h6 class="h6_tit">优秀队长</h6>
            <div class="act_inf">
                <ul>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $k => $v): ?>
                            <?php if ($v['type'] == '1'): ?>
                                <li>
                                    <div class="header_l">
                                        <div class="header_box">
                                            <img src="/<?php echo $v['pic']?>" />
                                        </div>
                                        <span class="staff_name"><?php echo $v['name'];?></span>
                                    </div>
                                    <div class="act_det_r">
                                        <?php echo $v['content'];?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <h6 class="h6_tit">优秀队员</h6>
            <div class="act_inf">
                <ul>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $k1 => $v1): ?>
                            <?php if ($v1['type'] == '2'): ?>
                                <li>
                                    <div class="header_l">
                                        <div class="header_box">
                                            <img src="/<?php echo $v1['pic']?>" />
                                        </div>
                                        <span class="staff_name"><?php echo $v1['name'];?></span>
                                    </div>
                                    <div class="act_det_r">
                                        <?php echo $v1['content'];?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <h6 class="h6_tit">优秀内勤</h6>
            <div class="act_inf">
                <ul>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $k2 => $v2): ?>
                            <?php if ($v2['type'] == '3'): ?>
                                <li>
                                    <div class="header_l">
                                        <div class="header_box">
                                            <img src="/<?php echo $v2['pic']?>" />
                                        </div>
                                        <span class="staff_name"><?php echo $v2['name'];?></span>
                                    </div>
                                    <div class="act_det_r">
                                        <?php echo $v2['content'];?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                wx.ready(function() {
                    //隐藏右上角菜单
                    wx.hideOptionMenu();
                });
        </script>
        <script>
            $(document).ready(function() {
                $(".close_btn").on("click", function() {
                    $(this).hide();
                    $(".apply_tit_act").hide();
                })
            })
        </script>
    </body>
</html>
