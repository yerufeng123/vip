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
        <meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
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
        <title>京东大客户</title>
        <style>
            html,body{width:100%;height: 100%;}
            #preload{ position: fixed;left: 0;top: 0;right: 0;bottom:0; background: url(<?php echo _STATIC_ ?>vip/jingdong/img/pre_bg.jpg) no-repeat center bottom; background-size: 320px auto; z-index: 99;}
            #pre_pot{ position: absolute; left: 50%; margin-left: -28px; bottom: 129px; width: 62px; height: 60px; font:16px/60px "黑体"; text-align: center; color: #fff;}
            #pre_pot.active{ background: url(<?php echo _STATIC_ ?>vip/jingdong/img/fingure.png) no-repeat center; background-size: 45px 44px;}
            #pre_icon{position: absolute;left:0;top:0; width: 115px; height: 111px; transform-origin:-28px -66px;-webkit-transform-origin:-28px -66px;}
            #pre_icon.rotate{ transform:translate(0,-20px) rotate(-540deg) scale(0.01);-webkit-transform:translate(0,-20px) rotate(-540deg) scale(0.01); -webkit-transition:-webkit-transform 2.5s ease-in;}
            #pre_rate{ position: absolute; bottom: 110px; left: 50%; margin-left: 65px;overflow: hidden; width: 16px; height: 96px;opacity: 0;}
            #pre_rate.active{ opacity: 1;}
            #pre_bar{ position: absolute; left: 0;top: 0; width: 16px; height: 96px;}
            #pre_bar_body{position: absolute; left: 0;bottom: 0;width: 16px; height: 0; border-radius: 8px;  background: -webkit-linear-gradient(#006ca6, #00131f);-webkit-transition:height 0.5s;transition:height 0.5s;}
            .active #pre_bar_body{ height: 100%;}
            #pre_text{ position: absolute;opacity: 0; left: 50%; margin-left: -103px; bottom: 234px; width:207px; height:64px;}
            #pre_point{position: absolute; display: none; left: 50%; bottom: 66px;width: 52px; height: 83px; background: url(<?php echo _STATIC_ ?>vip/jingdong/img/point.png) no-repeat center; background-size: cover;}
            #pre_point.active{display:block;-webkit-animation:opacity 1s linear infinite alternate;animation:opacity 1s linear infinite alternate;}
            #pre_b{ position: absolute; width: 329px; height: 327px; left: 50%; top: 50%; margin-left: -160px; margin-top: -410px; opacity: 0; }
            @-webkit-keyframes opacity{
                0%{opacity: 0;}
                100%{opacity: 1;}
            }
            @keyframes opacity{
                0%{opacity: 0;}
                100%{opacity: 1;}
            }
            @-webkit-keyframes shake{
                0%{-webkit-transform:translate(0,-10px);}
                100%{-webkit-transform:translate(0,10px);}
            }
            @keyframes shake{
                0%{transform:translate(0,-10px);}
                100%{transform:translate(0,10px);}
            }
        </style>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/jingdong/css/page.min.css">
        <script>
            var h5 = {
                skip: "jump",
                //页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
                move: 1, //1为竖直滑动切换，0为水平滑动切换
                clear: true, //页面清除动画
                address: "", //默认地址
                lazy: 3, //懒加载页面个数
                preload: false,
                //bg_audio  :"video/bg.mp3",    //背景音乐URL和对背景音乐的操作对象
            }

        </script>

    </head>
    <body>
        <script type="text/javascript">
            (function () {
                var _width = document.body.clientWidth;
                var _dom = document.querySelector('#viewport');
                var scale = _width / 320;
                _dom.setAttribute('content', 'width=320,user-scalable=no,initial-scale=' + scale);
            })()
        </script>
        <div id="preload">
            <img src="<?php echo _STATIC_ ?>vip/jingdong/img/pre_block.png" id="pre_b">
            <div id="pre_pot">0%</div>
            <div id="pre_rate">
                <div id="pre_bar_body"></div>
                <img src="<?php echo _STATIC_ ?>vip/jingdong/img/pre_rate.png" id="pre_bar">
            </div>
            <img src="<?php echo _STATIC_ ?>vip/jingdong/img/pre_text.png" id="pre_text">
            <div id="pre_point"></div>
            <img src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" id="pre_icon">
        </div>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jingdong/js/loading.js"></script>
        <div id="wrap"styel="display:none">
            <ul id="page_list" stage="">
                <li class="page show page_move" id="page1" scene="1" stop-move="-1">
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p1_btn.png" class="p1_btn">
                    <div class="p1_t1 out-small light" touch-delay></div>
                    <div class="p1_t2 out-small light" touch-delay></div>
                    <div class="p1_t3 out-small light" touch-delay></div>
                    <div class="p1_t4 out-small light" touch-delay></div>

                    <div class="p1_touch1 p1_touch"></div>
                    <div class="p1_touch2 p1_touch"></div>
                    <div class="p1_touch3 p1_touch"></div>
                    <div class="p1_touch4 p1_touch"></div>
                    <div class="p1_touch5"></div>
                    <div class="p1_point" step="0"></div>

                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon" delay="1800">
                </li>
                <li class="page logo" id="page2" scene="2">
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p2_tit.png" class="p2_tit out-top" delay="500">
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon" delay="1200">
                </li>

                <li class="page logo" id="page3" scene="3" stop-move="1">
                    <div pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon1.png" class="p3_i1 p3_i out-small" delay="500"></div>
                    <div pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon2.png" class="p3_i2 p3_i out-small" delay="700"></div>
                    <div pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon3.png" class="p3_i3 p3_i out-small" delay="900"></div>
                    <div pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon4.png" class="p3_i4 p3_i out-small" delay="1100"></div>
                    <span class="p3_t1 light out-top" delay="1000">办公通</span>
                    <span class="p3_t2 light out-top" delay="1200">积分通</span>
                    <span class="p3_t3 light out-top" delay="1400">乐采通</span>
                    <span class="p3_t4 light out-top" delay="1600">兑换通</span>
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon" delay="2000">
                </li>

                <li class="page line_top" id="page4" scene="4">
                    <div class="p4_b p4_b1 out-small" delay="500">
                        <span class="p4_t out-top" delay="1000"></span>
                    </div>
                    <div class="p4_b p4_b2 out-small" delay="800">
                        <span class="p4_t out-top" delay="1300"></span>
                    </div>
                    <div class="p4_b p4_b3 out-small" delay="1100">
                        <span class="p4_t out-top" delay="1600"></span>
                    </div>
                    <div class="p4_b p4_b4 out-small" delay="1400">
                        <span class="p4_t out-top" delay="1900"></span>
                    </div>
                    <div class="st_icon"></div>
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon" delay="2200">
                </li>

                <li class="page line_top" id="page5" scene="5">
                    <span class="p5_t1 out-left" delay="500">助企业积分消纳，减轻运营压力 </span>
                    <span class="p5_t2 out-left" delay="800">京东优质合作伙伴可将客户积分<br/>进行规整兑换合作机构积分 </span>
                    <span class="p5_t3 out-bottom" delay="1100">兑换通让进入积分商城的用户拿积分进行兑换 </span>
                    <span class="p5_t4 out-bottom" delay="1400">强大的供应商礼品资源及强大的物流网络覆盖 </span>
                    <div class="st_icon"></div>
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon" delay="2000">


                </li>

                <li class="page line_top" id="page6" scene="6">
                    <span class="p6_tit out-big" delay="500">J-shop</span>
                    <span class="p6_t1 out-left" delay="1000">福利换来的是员工的认同感和归属感 </span>
                    <span class="p6_t2 out-left" delay="1300">针对员工福利需求开发的解决方案<br/>基于京东强大的营销系统——</span>
                    <span class="p6_t3 out-bottom" delay="1600">集合京东大数据，通过云计算技术和<br/>模式识别技术的支持，能够让企业比<br/>员工自己更了解自己，
                    </span>
                    <span class="p6_t4 out-bottom" delay="1900">让了解和关怀从物质延伸到情感，<br/>创造企业文化的新磁场。</span>
                    <div class="st_icon"></div>

                </li>
                <li class="page line_top" id="page7" scene="7">
                    <div class="p7_b p7_b1 out-small" delay="500">
                        <span class="p7_t"></span>
                    </div>
                    <div class="p7_b p7_b2 out-small" delay="700">
                        <span class="p7_t"></span>
                    </div>
                    <div class="p7_b p7_b3 out-small" delay="900">
                        <span class="p7_t"></span>
                    </div>
                    <div class="p7_b p7_b4 out-small" delay="1100">
                        <span class="p7_t"></span>
                    </div>
                    <div class="p7_b p7_b5 out-small" delay="1300">
                        <span class="p7_t"></span>
                    </div>
                    <div class="p7_b p7_b6 out-small" delay="1500">
                        <span class="p7_t"></span>
                    </div>
                    <span class="p7_t1 out-bottom" delay="1800">基于多家大型厂商渠道奖励的实际需求，<br/>结合京东特有优势打造的全新的实物奖励系统</span>
                    <span class="p7_t2 out-bottom" delay="2100">高度可控，操作简便，数据透明，服务专业 </span>
                    <span class="p7_t3 out-bottom" delay="2400">及时贴切的激励方案充分激发渠道潜能，<br/>加强企业和渠道之间的绑定</span>
                    <span class="p7_t4 out-bottom" delay="2700">让激励机制充分融入渠道管理体系，<br/>让单项的传递转化为一对一的真正的互动。</span>
                    <div class="st_icon"></div>

                </li>
                <li class="page logo" id="page8" scene="8">
                    <img src="<?php echo _STATIC_ ?>vip/jingdong/img/point.png" class="p8_point" delay="1200">
                    <div class="p8_i1 out-big" delay="500"></div>
                    <div class="p8_i2 out-big" delay="800"></div>
                    <div class="p8_i3 out-big" delay="1100"></div>

                    <span class="p8_t out-bottom"  delay="1400">京东大客户，<br/>让采购变得阳光、高效、简单、快乐</span>

                </li>
                <li class="page logo" id="page9" scene="9" stop-move="1">
                    <span class="p9_l p9_l1" delay="500"></span>
                    <span class="p9_l p9_l2" delay="800"></span>
                    <span class="p9_l p9_l3" delay="1100"></span>
                    <span class="p9_l p9_l4" delay="1400"></span>
                    <span class="p9_l p9_l5" delay="1700"></span>

                    <span class="p9_l p9_l6" delay="2000"></span>
                    <span class="p9_l p9_l7" delay="2300"></span>
                    <span class="p9_l p9_l8" delay="2600"></span>
                    <span class="p9_l p9_l9" delay="2900"></span>
                    <span class="p9_l p9_l10" delay="3200"></span>

                    <span class="p9_l p9_l11" delay="3800"></span>
                    <span class="p9_l p9_l12" delay="3500"></span>
                    <span class="p9_l p9_l13" delay="4200"></span>
                    <span class="p9_l p9_l14" delay="4500"></span>
                    <span class="p9_l p9_l15" delay="4800"></span>

                    <span class="p9_l p9_l16" delay="5200"></span>
                    <span class="p9_l p9_l17" delay="5500"></span>
                    <span class="p9_l p9_l18" delay="5800"></span>

                    <span class="p9_l p9_l19" delay="6100"></span>
                    <span class="p9_l p9_l20" delay="6300"></span>
                    <span class="p9_l p9_l21" delay="6700"></span>

                    <span class="p9_l p9_l22" delay="6900"></span>
                    <span class="p9_l p9_l23" delay="7200"></span>
                    <span class="p9_l p9_l24" delay="7500"></span>

                    <span class="p9_l p9_l25" delay="7800"></span>
                    <span class="p9_l p9_l26" delay="8100"></span>
                    <span class="p9_l p9_l27" delay="8300"></span>

                    <span class="p9_l p9_l28" delay="8500"></span>
                    <span class="p9_l p9_l29" delay="8800"></span>
                    <span class="p9_l p9_l30" delay="9100"></span>



                                <!-- <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/icon.png" class="jd_icon"> -->
                </li>
                <li class="page" id="page10" scene="10" stop-move="1">
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p10_logo.png" class="p10_logo out-top" delay="500">
                    <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p10.png" class="p10_t out-bottom" delay="1000">
                    <span class="add_btn out-bottom" delay="1200" onclick="location.href='http://sale.jd.com/act/Mj5ihGQeJaZz70d6.html'">更多联系</span>
					 <a class="p10_btn out-top" href="tel:400-656-0055" delay="1500">400-656-0055</a>
					  <!--<img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/powerd.png" class="pow" onclick="location.href='http://www.hui.net/'">-->
                </li>
            </ul>
            <img id="drop_down" class="active_drop_down" src="<?php echo _STATIC_ ?>vip/jingdong/img/drop.png" style="display:none">
            <div class="p8_mask" style="display:none">
                <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/diag_tit.png" class="diag_tit"><!--20150715 add jia -->
                <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p8_tit.png" class="p8_tit">

                <div class="p8_dia">
                    随着时代的发展和互联网技术的深度渗透，企业管理的信息化程度也有了极大地提高，在这样的基础上，有着深厚的互联网基因的京东凭借着自身的服务优势、技术优势赢得了日新月异的企业市场的青睐</div>
                <div class="diag_bg"></div><!--20150715 add jia -->
                <img pre-src="<?php echo _STATIC_ ?>vip/jingdong/img/p8_btn.png" class="p8_btn">
            </div>
            <audio id="audio" loop="loop" preload='auto' src="<?php echo _STATIC_ ?>vip/jingdong/video/bg.mp3"></audio>
            <div id="music" class='on'></div>
        </div> 
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jingdong/js/slide.js" defer="defer"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jingdong/js/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/jingdong/js/init.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
                window.onload = function () {
                    $('.p8_mask').bind('touchmove', function (e) {
                        e.preventDefault();
                    })
                    $('#page8 .out-big').on('click', function () {
                        $('.p8_dia').html(page._text[$(this).index() - 1]);
                        $('.p8_mask').show();
                    })
                    $('.p8_btn').on('touchend', function () {
                        $('.p8_mask').hide();
                    })
                }
        </script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['common']['wxappid'], Yii::app()->params['common']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
            /*
             * 注意：
             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
             */
            var title = '宇宙第一 没有之一';//分享标题
            var desc = '京东大客户 让企业采购变的阳光、高效、简单、快乐！';//分享描述
            var link = 'http://' + window.location.host + '/jingdong/index';//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/jingdong/img/share.png';//分享图标
            var type = '';// 分享类型,music、video或link，不填默认为link
            var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appId"]; ?>',
                timestamp: <?php echo $signPackage["timestamp"]; ?>,
                nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                signature: '<?php echo $signPackage["signature"]; ?>',
                jsApiList: [
                    // 所有要调用的 API 都要加到这个列表中
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareWeibo',
                ]
            });
            wx.ready(function () {
                //分享到朋友圈
                wx.onMenuShareTimeline({
                    title: desc, // 分享标题
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('friends');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('friends');
                    }
                });

                //分享给朋友
                wx.onMenuShareAppMessage({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    type: type, // 分享类型,music、video或link，不填默认为link
                    dataUrl: dataUrl, // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('friend');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('friend');
                    }
                });

                //分享到QQ
                wx.onMenuShareQQ({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('qq');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        //sharecancel('qq');
                    }
                });

                //分享到腾讯微博
                wx.onMenuShareWeibo({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: link, // 分享链接
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        //shareok('weibo');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        // sharecancel('weibo');
                    }
                });

            });
        </script>
    </body>
</html>