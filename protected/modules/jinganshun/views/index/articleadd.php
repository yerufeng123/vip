<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css?random=<?php echo time();?>" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css?random=<?php echo time();?>" rel="stylesheet">
        <title>有奖征稿</title>
    </head>
    <body>
        <div class="wrap wrap_act1" id="apply_deail">
            <h3 class="apply_tit apply_tit_act"><?php echo $data['content']; ?> </h3>
            <img class="close_btn" src="<?php echo _STATIC_ ?>vip/jinganshun/images/close.png" />
            <div class="act_det">
                <label>标题</label><br>
                <input type="text" id="title" value="<?php echo $list['title'] ?>"/>
                <div class="clear"></div>
                <label>正文</label><br>
                <textarea id="content"><?php echo $list['content'] ?></textarea>
                <div class="offer">
                    <a href="javascript:void(0)" class="apply_btn act_save_btn1" id='temp_btn'>存稿</a>
                    <a href="javascript:void(0)" class="apply_btn act_save_btn2" id='sub_btn'>提交</a>
                </div>
            </div>
        </div>

        <div class="diag_success" style="display:none;">
            <div class="diag_block">
                <a href="javascript:void(0)" class="close">X</a>
                <p><br>提交成功<br/>您的文章我们已经收到，稿<br>件一经采用，公司将于次月<br>16日发放200元奖励。</p>
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
                    'closeWindow',
                ]
            });
            wx.ready(function () {
                //隐藏右上角菜单
                wx.hideOptionMenu();
            });
        </script>
        <script>
            $(document).ready(function () {
                $(".close_btn").on("click", function () {
                    $(this).hide();
                    $(".apply_tit_act").hide();
                })
            })
        </script>
        <script>
            $(function () {
                $(".close").bind("click", function () {
                    $(".diag_success").hide();
                     wx.closeWindow();
                })


                $("body").bind("touchmove", function (e) {
                    e.preventDefault();

                })
                //单击提交
                $('#sub_btn').bind('click', function () {
                    var title = $('#title').val();
                    var content = $('#content').val();
                    $.post('/jinganshun/index/articleadd', {'title': title, 'content': content}, function (data) {
                        var list = eval('(' + data + ')');
                        if (list.code != '100000') {
                            alert(list.result);
                        } else {
                            $('.diag_success').show();
                            $('#title').val('');
                            $('#content').val('');
                           
                        }
                    });
                });

                //单击存稿
                $('#temp_btn').bind('click', function () {
                    var title = $('#title').val();
                    var content = $('#content').val();
                    $.post('/jinganshun/index/articletempadd', {'title': title, 'content': content}, function (data) {
                        var list = eval('(' + data + ')');
                        if (list.code != '100000') {
                            alert(list.result);
                        } else {
                            alert('存稿成功');
                            //location.reload();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
