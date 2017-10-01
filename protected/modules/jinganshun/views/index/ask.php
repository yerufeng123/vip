<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/common.css?random=<?php echo time(); ?>" rel="stylesheet">
        <link type="text/css" href="<?php echo _STATIC_ ?>vip/jinganshun/css/page.css?random=<?php echo time(); ?>" rel="stylesheet">
        <title>有奖答题</title>
        <style type="text/css">
            /*20150716 add 弹出框 */
            #mask{ position:absolute; left: 0; top:118px; right: 0;bottom: 0; background-color: rgba(0,0,0,.6); z-index: 9999;}
            #mask.rule_mask{top:0}
            .rule{ position: absolute; left: 50%; top: 50%; margin-left:-140px; margin-top: -184px; height: 368px;width: 280px; color: #fff; font-size: 14px;text-align:center;line-height:24px;background:#fff;font-weight:bold}
            .rule_tit{ font-size: 27px;color: #ff4542;padding:44px 0 10px 0;font-size:16px;}
            .rule_close{width:118px;height:38px;line-height:38px;text-align:center;position:absolute;left:50%;margin-left:-59px;top:292px;background:#e30c18;display:block;-webkit-border-radius:10px;}
        </style>
    </head>

    <body>
        <div class="wrap" id="security_first">
            <div class="top">
                <div class="logo">
                    <img src="<?php echo _STATIC_ ?>vip/jinganshun/images/logo.png">
                    <span>京安顺</span>
                </div>
                <div class="logo_nav com_nav">
                    <img src="<?php echo _STATIC_ ?>vip/jinganshun/images/first_bg.png" class="first_bg_tu">
                    <img src="<?php echo _STATIC_ ?>vip/jinganshun/images/ren_t3.png" class="ren_t3">
                    <p class="welcome_tit">竞赛活动细则</p>
                    <p class="roate_tit"></p>
                    <p class="intro_tit">有奖答题<br/><span>Hr</span></p>
                </div>

            </div>

            <div class="com_main">

                <?php if (isset($list) && is_array($list)): ?>
                    <?php foreach ($list as $k => $v): ?>
                        <div class="answer">
                            <div class="ans_block">
                                <img src="<?php echo _STATIC_ ?>vip/jinganshun/images/wen_tu.png">
                                <div class="answer_detail">
                                    <h3><?php echo $k + 1; ?>.<?php echo $v['question'] ?></h3>
                                    <ul class="answer_list lab1" val='' val2='<?php echo $v['answer'] ?>'>
                                        <li class='lab2' val='1'><span>A</span><?php echo $v['option'][0] ?></li>
                                        <li class='lab2' val='2'><span>B</span><?php echo $v['option'][1] ?></li>
                                        <li class='lab2' val='3'><span>C</span><?php echo $v['option'][2] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?> 




            </div>
            <a href="javascript:void(0)" class="apply_btn app_answer" id='sub_btn'>提交</a>

            <div class="diag_success diag_success1" style="display:none;" id='da_err'>
                <div class="diag_detail">
                    <h3><span class="sorry_ren"></span>很遗憾</h3>
                    <p class="score" id='text_score' style="font-size:16px;line-height:23px;">您只得了 9 分！</p>
                    <a href="javascript:void(0)" class="apply_btn app_back">确定</a>

                </div>
            </div>  

            <div class="diag_success diag_success2" style="display:none;" id='da_ok'>
                <div class="diag_detail">
                    <h3><span class="ok_ren"></span>恭喜您</h3>
                    <p class="score" id='text_score_ok' style="font-size:16px;line-height:23px;">全部正确！！</p>
                    <a href="javascript:void(0)" class="apply_btn app_back">确定</a>

                </div>
            </div>  

        </div>
        <section class="rule_inf rule_mask" id="mask" style="display:block">
            <div class="rule" style="overflow: hidden">
                <h4 class="rule_tit" style="padding: 23px 0 10px 0;">活动规则</h4>
                <p style="color:#333;padding: 15px 25px 0 25px;overflow: auto;height:196px">&emsp;&emsp;<?php echo $content;?>  
                </p>
                <a href="javascript:void(0)" class="rule_close">确定</a>
            </div>

        </section>

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
        <script type="text/javascript" src="<?php echo _STATIC_ ?>js/gxd.js<?php echo (Yii::app()->params['jinganshun']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
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
            var _score = 0;//总分
            $(function () {
                $(".diag_success").bind("touchmove", function (e) {
                    e.preventDefault();
                })
                $("#mask").bind("touchmove", function (e) {
                    e.preventDefault();
                })

                $(".app_back").bind("click", function () {
                    $(".diag_success").hide();
                })
                //单击选项
                $('.lab2').bind('click', function () {
                    var answer_red = $(this).parent().children('.answer_red').length;
                    var answer_green = $(this).parent().children('.answer_green').length;
                    var length = answer_red + answer_green;
                    //if ($(this).hasClass('answer_red') || $(this).hasClass('answer_green')) {
                    if (length > 0) {
                        return false;
                    }

                    $(this).parent('.lab1').attr('val', $(this).attr('val'));

                    var sel = $(this).parent('.lab1').attr('val');
                    var rigt = $(this).parent('.lab1').attr('val2');
                    $(this).parent('.lab1').find('.lab2').each(function () {
                        if ($(this).attr('val') == sel) {
                            if ($(this).attr('val') == rigt) {
                                $(this).addClass('answer_green');
                                _score++;
                            } else {
                                $(this).addClass('answer_red');
                            }
                        } else {
                            if ($(this).attr('val') == rigt) {
                                $(this).addClass('answer_green');
                            }
                        }
                    });
                });
                //单击答题按钮
                $('#sub_btn').bind('click', function () {
                    var ask;
                    if (ask = getstring()) {
                        $.post('/jinganshun/index/ajaxcheckasw', {'ask': ask}, function (data) {
                            var list = eval('(' + data + ')');
                            if (list.code != '100000') {
                                if (list.code == '400002') {//答题失败
                                    $(".diag_success").hide();
                                    $('#text_score').html('您已完成本次答题,本次成绩'+ _score +'分，本月累积通过'+ list.result+'次。系统将作出记录，公司将于次月16日发放本月奖励。');
                                    $('#da_err').show();
                                } else {
                                    alert(list.result);
                                }
                            } else {
                                $(".diag_success").hide();
                                $('#text_score_ok').html('您已完成本次答题,本次成绩'+ _score +'分，本月累积通过'+ (list.result*1+1)+'次。系统将作出记录，公司将于次月16日发放本月奖励。');
                                $('#da_ok').show();
                            }
                        });
                    }
                    return false;
                });

                //单击返回首页按钮
                $('.app_back').bind('click', function () {
                    wx.closeWindow();
                });

                $(".add_share_btn").bind("click", function () {
                    $("#mask").show();
                })
                $(".rule_close").bind("click", function () {
                    $("#mask").hide();
                })

            });

            function getstring() {
                var str = '';
                for (var i = 0; i < $('.lab1').length; i++) {
                    if ($('.lab1').eq(i).attr('val') == '') {
                        alert('答题不完善');
                        return false;
                    }
                    str += $('.lab1').eq(i).attr('val');
                }
                return str;
            }
        </script>
    </body>
</html>
