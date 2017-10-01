<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>百荣世贸商城后台管理程序</title>
        <link type="text/css" href="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>css/common.css" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>css/gxd.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo _STATIC_; ?>extension/uploadify/uploadify.css" />
    </head>

    <body>
        <div class="wrap"> 
            <div class="main">
                <div class="header">
                    <img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/text.png" />
                    <span class="STYLE time"><span class="STYLE2"></span> 今天是：<?php echo date("Y-m-d"); ?> &emsp;&emsp;当前用户：<?php echo $this->user_name; ?></span>
                </div>
                <div class="nav">
                    <span>&nbsp;<b></b></span>
                    <div class="nav_list">
                        <a href="/admin/index"></a>
                        <a href="javaScript:history.go(-1)"></a>
                        <a href="javaScript:history.go(1)"></a>
                        <a href="javaScript:location.reload()"></a>
                        <a href="/login/loginout"></a>
                    </div>
                </div>
