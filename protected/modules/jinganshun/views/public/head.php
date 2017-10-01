<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>京安顺后台管理程序</title>
        <link type="text/css" href="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>css/common.css?radom=<?php echo time();?>" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>css/gxd.css?radom=<?php echo time();?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo _STATIC_ ?>extension/uploadify/uploadify.css?radom=<?php echo time();?>" />
    </head>

    <body>
        <div class="wrap"> 
            <div class="main">
                <div class="header">
                    <img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/text.png?radom=<?php echo time();?>" />
                    <span class="STYLE time"><span class="STYLE2"></span> 今天是：<?php echo date("Y-m-d"); ?> &emsp;&emsp;当前用户：<?php echo $this->user_name; ?></span>
                </div>
                <div class="nav">
                    <span>访问量：<b><?php echo $this->accessnum; ?></b></span>
                    <div class="nav_list">
                        <a href="/jinganshun/admin/index"></a>
                        <a href="javaScript:history.go(-1)"></a>
                        <a href="javaScript:history.go(1)"></a>
                        <a href="javaScript:location.reload()"></a>
                        <a href="/jinganshun/login/loginout"></a>
                    </div>
                </div>
