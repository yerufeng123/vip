<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
        <title>闪电理财</title>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/licai/css/common.css">
        <!--百度统计代码-->
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?eeaa8a516c91370264450e1eee60e97d";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
    </head>
    <body>
        <div id="wrap" class="page_home">
            <ul id="page_list" >
                <li class="page_game page" id="page3" scene="3">
                    <header class="top_bg"></header>
                    <!--
                    <div class="logo2"><img src="img/logo2.png"/></div>
                                    <div class="jifen" id="sore"></div>
                    -->

                    <div class="bird3" "><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/bird3.png"/></div>

                    <div class="qiandai3" id="qiandai3"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/qiandai3.png"/></div>
                    <div class="shandianlicai" id="shandianlicai"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/shandianlicai.png"/></div>
                    <div class="caifu" id="caifu"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/caifu.png"/></div>
                    <div class="caifuzhi" id="caifuzhi">0</div>
                    <div class="wenzi" id="wenzi"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/wenzi1.png"/>
                        <input class="haoma" type="text" style="background:transparent;"maxlength="11" name="shouji"  id="haoma" onkeypress="intOnly()" style="ime-mode:Disabled" />
                    </div>
                    <div class="hongbao" id="hongbao"><img id="hongbaoImg" src="<?php echo _STATIC_ ?>vip/licai/img/hjy/hongbao1.png"/></div>

                    <div class="btn_box" id="btn_box">
                        <a href="javascript:void(0)" class="submitbtn" id="submit_btn" href="javascript:void(0)">  </a>
                    </div>

                    <div class="caoheqiang" ><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/caoheqiang.png"/></div>


                    <section class="fuceng3" id="fc3" style="display:none">
                        <div class="fucengborad3"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/fuceng3.png" />

                            <div class="sharebox">
                                <a href="javascript:void(0)" class="sharebtn" id="share_btn" href="javascript:void(0)">   </a>
                            </div>


                            <div class="step1" id="step1"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/step1.png"/></div>
                            <div class="step2" id="step2"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/step2.png"/></div>
                            <div class="step3" id="step3"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/step3.png"/></div>
                            <div class="step4" id="step4"><img src="<?php echo _STATIC_ ?>vip/licai/img/hjy/step4.png"/></div>


                        </div>
                    </section>


                </li>


            </ul>
        </div>
    </body>
    <script src="<?php echo _STATIC_ ?>vip/licai/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/globals.js"></script>
    <script>
                            var count = 0;
                            //if (isiPhone()) {
                            //} else {
                            window.onresize = function () {
                                setTimeout(function () {
                                    //alert("aaaa");
                                    if (count == 1) {
                                        count = 0;
                                        document.getElementById("qiandai3").style.marginTop = "-70px";

                                    } else {
                                        count = 1;
                                        document.getElementById("qiandai3").style.marginTop = "-170px";

                                    }
                                }, 1000);
                            }

                            //}

                            /*
                             $(document).keydown(function (event) {
                             alert("这按钮的ASCII码,是" + event.keyCode);
                             });
                             */
                            //输入框避免虚拟键盘遮挡
                            /*
                             $("#haoma").bind("click",function(e){
                             e.preventDefault();
                             if (isiPhone()) {
                             } else {
                             setTimeout(function(){
                             document.getElementById("qiandai3").style.marginTop="-170px";
                             },200)
                             }
                             })
                             
                             $("input").blur(function(){
                             if (isiPhone()) {
                             } else {
                             setTimeout(function(){
                             document.getElementById("qiandai3").style.marginTop="-70px";
                             },200)
                             
                             }
                             });
                             */

                            var hongbaozhi;
                            var game_score = sessionStorage.getItem("game_score");
                            $("#caifuzhi").text(game_score);
                            convertScore(game_score);
                            showInSequence();

                            document.addEventListener("touchmove", function (e) {
                                e.preventDefault();
                            })
                            $("#submit_btn").bind("click", function () {
                                //读取手机号
                                var phoneNumber = document.getElementById("haoma").value;
                                //红包值 hongbaozhi
                                if (!check_phone(phoneNumber)) {
                                    alert('手机号格式不正确！');
                                } else {
                                    $.post('/licai/ajaxsetphone', {'phone': phoneNumber}, function (data) {
                                        var list = eval('(' + data + ')');
                                        if (list.code != '10000') {
                                            alert(list.result);
                                        } else {
                                            $(".fuceng3").show();
                                            showAlerInsequence();
                                        }
                                    });
                                }
                            })
                            $("#share_btn").bind("click", function () {
                                window.location.href = "/licai/share"
                            })

                            //只允许输入数字,左右移动键,删除键,回车键
                            function intOnly() {
                                var codeNum = event.keyCode;
                                if (codeNum == 8 || codeNum == 37 || codeNum == 39 || (codeNum >= 48 && codeNum <= 57)) {
                                    event.returnValue = codeNum;
                                } else {
                                    event.returnValue = false;
                                }
                            }

                            //积分规则 转化红包
                            function convertScore(score) {
                                if (score >= 610) {
                                    hongbaozhi = 8;
                                    document.getElementById("hongbaoImg").src = "<?php echo _STATIC_ ?>vip/licai/img/hjy/hongbao1.png";
                                } else if (score >= 410) {
                                    hongbaozhi = 5;
                                    document.getElementById("hongbaoImg").src = "<?php echo _STATIC_ ?>vip/licai/img/hjy/hongbao2.png";
                                } else if (score >= 210) {
                                    hongbaozhi = 3;
                                    document.getElementById("hongbaoImg").src = "<?php echo _STATIC_ ?>vip/licai/img/hjy/hongbao3.png";
                                } else if (score >= 90) {
                                    hongbaozhi = 2;
                                    document.getElementById("hongbaoImg").src = "<?php echo _STATIC_ ?>vip/licai/img/hjy/hongbao4.png";
                                } else {
                                    //失败
                                }
                                //document.getElementById("hongbao").innerHTML='<img src="img/hjy/hongbao1.png"/>';
                                // $("#hongbao").style.backgroundImage="url('img/hjy/hongbao3.png')";
                            }

                            //依次显示财富页
                            function showInSequence() {
                                //document.getElementById("qiandai3").style.visibility="visible";
                                var time = 400;
                                setTimeout("document.getElementById('qiandai3').style.visibility='visible'", time);
                                setTimeout("document.getElementById('shandianlicai').style.visibility='visible'", time * 2);
                                setTimeout("document.getElementById('caifu').style.visibility='visible'", time * 3);
                                setTimeout("document.getElementById('caifuzhi').style.visibility='visible'", time * 3);
                                /*
                                 setTimeout("document.getElementById('wenzi').style.visibility='visible'",time*4);
                                 setTimeout("document.getElementById('hongbao').style.visibility='visible'",time*5);
                                 setTimeout("document.getElementById('submit_btn').style.visibility='visible'",time*6);
                                 */
                            }

                            //依次显示浮窗
                            function showAlerInsequence() {
                                var time = 400;
                                setTimeout("document.getElementById('step1').style.visibility='visible'", time);
                                setTimeout("document.getElementById('step2').style.visibility='visible'", time * 2);
                                setTimeout("document.getElementById('step3').style.visibility='visible'", time * 3);
                                setTimeout("document.getElementById('step4').style.visibility='visible'", time * 4);

                            }

                            function isiPhone() {
                                return (
                                        (navigator.platform.indexOf("iPhone") != -1) ||
                                        (navigator.platform.indexOf("iPod") != -1)
                                        );
                            }



    </script>



    <script>
        //遮罩层
        function getPageWidth() {
            var PageWidth;
            PageWidth = $(".gj_mask").width();
            return PageWidth;
        }
        function getPageHeight() {
            var PageHeight;
            PageHeight = $(".gj_mask").height();
            return PageHeight;
        }

        function getClientX(cssX) {
            var canvasX;
            canvasX = document.getElementById("gj_mask").clientWidth;
            return canvasX;
        }
        function getClientY(cssY) {
            var canvasY;
            canvasY = document.getElementById("gj_mask").clientHeight;
            return canvasY;
        }
        var img = new Image();
        img.src = "<?php echo _STATIC_ ?>vip/licai/img/gj_mask.png";
        img.load = function (err) {
            var originW = img.width;
            var originH = img.height;
        }
        img.width = getPageWidth();
        img.height = getPageHeight();
        var canvas = document.querySelector("canvas");
        var ctx = canvas.getContext("2d");
        var drawm;
        img.onload = function () {
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0);
        }
        var isMousedown = false;
        canvas.addEventListener("touchstart", mousedownHD, false)
        function mousedownHD(e) {
            isMousedown = true;
            if (drawm)
                clearTimeout(drawm);
            ctx.beginPath();
            e.preventDefault();
            return false;
        }
        canvas.addEventListener("touchmove", mousemoveHD, false)
        var canvasOffset = canvas.getBoundingClientRect();
        function mousemoveHD(e) {
            if (isMousedown) {
                ctx.lineWidth = 50;
                ctx.lineCap = "round";
                ctx.lineJoin = "round";
                ctx.globalCompositeOperation = "destination-out";
                ctx.lineTo(e.touches[0].clientX - canvasOffset.left, e.touches[0].clientY - canvasOffset.top, 10, 10);
                ctx.stroke();
            }
            e.preventDefault();
        }
        document.addEventListener("touchend", mouseupHD, false)
        function mouseupHD() {
            isMousedown = false;
            drawm = setTimeout("hiddenfengmian()", 2000);
            return false;
        }
        function hiddenfengmian() {
            $(".gj_mask").animate({opacity: "0"}, 800, function () {
                //$(".gj_mask").hide();
                //$(".gj").hide();
                //$(".one_place").show();

            });
        }


    </script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php
    $jssdk = new JSSDK(Yii::app()->params['common']['wxappid'], Yii::app()->params['common']['wxappsecret']);
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
