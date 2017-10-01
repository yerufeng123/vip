<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=320,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>百荣世贸商城</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ .'vip/bairong/'?>css/common.css">
    </head>
    <body>
        <div id="wrap" class="phone_bg">
            <img src="<?php echo _STATIC_ .'vip/bairong/'?>img/logo.png" class="logo">
            <img src="<?php echo _STATIC_ .'vip/bairong/'?>img/icon4.png" class="icon4">
            <img src="<?php echo _STATIC_ .'vip/bairong/'?>img/tit.png" class="tit">
            <input type="text" maxlength="11" class="phone_input">
            <a href="#" class="bnt_sub"></a>

        </div>
    </body>
    <script src="<?php echo _STATIC_ .'vip/bairong/'?>js/zepto.min.js" type="text/javascript"></script>
    <script src="<?php echo _STATIC_; ?>js/globals.js" type="text/javascript"></script>
    <script>
        document.addEventListener("touchmove", function(e) {
            e.preventDefault();
        })
    </script>
    <script>
        $(function() {
            //单击提交
            $('.bnt_sub').bind('click', function() {
                var phone = $('.phone_input').val();
                if (!check_phone(phone)) {
                    alert('手机格式不正确');
                    return false;
                }
                $.post('/game1/add_app', {'phone': phone, 'type': 'APP'}, function(data) {
                    var res = eval('(' + data + ')');
                    if (res.code != '10000') {
                        alert(res.msg);
                    }else{
                        
                    }
                    window.location.href="http://www.rtmap.com/bair/two.html";
                });
            });

        });
    </script>
</html>