<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/diantong/css/common.css" rel="stylesheet">
        <title>一汽丰田</title>
    </head>

    <body>
        <div id="wrap">
            <div class="diag_mask" style="display: none">
                <div class="rule" style="overflow: hidden">
                    <p id="textvalue">&emsp;&emsp;</p>
                    <a href="javascript:void(0)" class="close btn">确 认</a>
                </div>
            </div>
            <div class="logo"><img src="<?php echo _STATIC_ ?>vip/diantong/images/logo.png"></div>
            <div class="main">
                <img src="<?php echo _STATIC_ ?>vip/diantong/images/banner_tit3.png" class="ban_tit3">
                <p class="phone_notice">输入手机号 开始摇摆红包</p>
                <div class="phone_yz">
                    <label>手机验证</label>
                    <input type="text" id="phone">
                </div>
                <span class="start_btn" id="sub_btn">开始</span>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js<?php echo (Yii::app()->params['diantong']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>js/globals.js<?php echo (Yii::app()->params['diantong']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
        <script>
            $('#sub_btn').bind('click', function () {
                var phone = $('#phone').val();
                if (!check_phone(phone)) {
                    $('#textvalue').html('手机号格式不正确');
                    $('.diag_mask').show();
                } else {
                    $.post('/diantong/ajaxadduser', {'phone': phone}, function (data) {
                        var list = eval('(' + data + ')');
                        if (list.code != '10000') {
                            $('#textvalue').html(list.result);
                            $('.diag_mask').show();
                        } else {
                            location.href = '/diantong/yaoyiyao';
                            //alert('红包已发送，请查收');
                        }
                    });
                }
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $(".diag_mask").bind("touchmove", function (e) {
                    e.preventDefault();
                })
                $(".close").bind("click", function (e) {
                    $(".diag_mask").hide();
                })

            })
        </script>
    </body>
</html>
