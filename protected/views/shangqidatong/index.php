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
        <meta id="viewport" name="viewport" content="width=320,minimum-scale=0.5,maximum-scale=2.0,user-scalable=no">
        <title>上汽大通</title>
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
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/shangqidatong/css/common.css?random=<?php echo time(); ?>">
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?1a46ffe21468cb2c719575f1a46460a1";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
        <script>
            var h5 = {
                skip: "jump",
                //页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
                clear: true, //页面清除动画
                address: "", //默认地址
                lazy: 2, //懒加载页面个数
                preload: false,
                //bg_audio: "<?php echo _STATIC_ ?>vip/shangqidatong/video/bg.mp3", //背景音乐URL和对背景音乐的操作对象
            }
        </script>
    </head>
    <body> 
        <!--  	
                <div id="preload">
                        <img src="img/pre_time.png" id="pre_time">
                        <img src="img/pre_h.png" id="pre_h">
                        <img src="img/pre_m.png" id="pre_m">
                        <img src="img/pre_tit.png" id="pre_tit">
                </div>
                <script type="text/javascript" src="js/loading.js"></script> 
        -->
        <div id="wrap">
            <div id="page_list" stage="">
                <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/logo.png" class="logo">
                <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/cloud1.png" class="cloud3">
                <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/ball.png" class="ball layer" data-depth="2">
                <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/cloud1.png" class="cloud1">
                <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/cloud2.png" class="cloud2 layer" data-depth="5">



                <div class="index show" scene="1">
                    <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/tit1.png" class="tit1" delay="1000">
                    <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/tit2.png" class="tit2" delay="1500">
                    <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/head_left.png" class="head_left" delay="2500">
                    <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/head_right.png" class="head_right" delay="2500">
                    <div class="road"  delay="500">
                        <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/car.png" class="car" delay="2000">
                    </div>
                    <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/btn_star.png" class="btn_star" delay="3500">
                </div>
                <dl class="question max_select" scene="2" id="q1">
                    <dt class="ask">大大的MPV上汽大通G10拥有大动力！以下哪款发动机是TA的动力来源？</dt>
                    <dd class="ans right">2.0T高性能发动机</dd>
                    <dd class="ans right">2.4L节能环保发动机</dd>
                    <dd class="ans">1.6L发动机</dd>
                    <dd class="ans">1.8L发动机</dd>
                    <dd class="ans">2.5L发动机</dd>
                    <span class="btn_next">确定</span>
                </dl>
                <dl class="question only_select" scene="3" id="q2">
                    <dt class="ask">作为一辆可以让人在第二排跷二郎腿的大大的MPV,你知道TA的第二排最大间距是多少吗？</dt>
                    <dd class="ans">900mm</dd>
                    <dd class="ans">970mm</dd>
                    <dd class="ans">1000mm</dd>
                    <dd class="ans">1030mm</dd>
                    <dd class="ans right">1070mm</dd>
                    <span class="btn_next">确定</span>
                </dl>
                <dl class="question only_select" scene="4" id="q3">
                    <dt class="ask">大大的MPV更有大大的行李箱！你知道上汽大通G10的行李箱空间的最大尺寸吗？</dt>
                    <dd class="ans">2000L</dd>
                    <dd class="ans">2300L</dd>
                    <dd class="ans right">2500L</dd>
                    <dd class="ans">2800L</dd>
                    <dd class="ans">3000L</dd>
                    <span class="btn_next">确定</span>
                </dl>
                <dl class="question max_select" scene="5" id="q4">
                    <dt class="ask">没有大大的科技的MPV不是大大的MPV！以下哪项是上汽大通G10的大科技配置？</dt>
                    <dd class="ans right">一键启动</dd>
                    <dd class="ans right" style=" font-size:12px;">博世最新一代ESP 9.1电子稳定辅助系统</dd>
                    <dd class="ans right">Layer Build双层焊接技术</dd>
                    <dd class="ans right">一体化车身设计</dd>
                    <dd class="ans right">天幕式全景天窗</dd>
                    <span class="btn_next">确定</span>
                </dl>
                <dl class="question max_select" scene="6" id="q5">
                    <dt class="ask">你一定已经很熟悉上汽大通G10的“国宾车”头衔了吧？你知道拥有大形象的G10服务过以下哪个重大会议吗？</dt>
                    <dd class="ans right">APEC官方指定用车</dd>
                    <dd class="ans right">全国两会媒体用车</dd>
                    <dd class="ans right">博鳌亚洲论坛会议服务用车</dd>
                    <dd class="ans right">青年奥林匹克运动会商务用车</dd>
                    <dd class="ans right">亚信峰会指定用车</dd>
                    <span class="btn_next">确定</span>
                </dl>

                <div class="resule"  style="display:none">
                    <!-- 通过弹框 -->
                    <div class="dia dia_ok" style="display:none">
                        恭喜你！<br/>你已通过大大的MPV的大考核了！<br>试驾上汽大通G10<br>就有机会赢滴滴专车百元红包哦！
                        <span class="btn" id="redpacket">试驾大大的MPV赢滴滴专车红包</span>
                    </div>
                    <!-- 失败弹框 -->
                    <div class="dia dia_no"  style="display:none">
                        好遗憾！<br/>你没有通过大大的MPV的大考核。成功通关就有机会赢滴滴专车百元红包哦!
                        <span class="btn" onclick="javascript:location.href = '/shangqidatong/index'">再试一次</span>
                    </div>
                    <!-- 恭喜弹框 -->
                    <div class="dia dia_cong" style="display:none">
                        恭喜你！<br/>您已成功获得滴滴专车百元红<br/>包抽奖机会！<br/>请密切关注上汽大通官方微信，<br/>结果将在一周后公布！
                        <span class="btn" id="follow">关注官方微信</span>
                        <span class="btn" id="gxd_share">呼唤朋友来通关</span>
                    </div>
                    <!-- 分享弹框 -->
                    <div class="dia dia_share" style="display:none">
                        <img src="<?php echo _STATIC_ ?>vip/shangqidatong/img/weicode.jpg" class="wecode">
                        <div class="share_text">请长按识别图中二维码<br/>关注上汽大通官方微信</div>
                    </div>
                    <!-- 填写信息弹框 -->
                    <div class="dia dia_write" style="display:none">
                        <ul class="dia_input">
                            <li class="input_li">
                                <label class="lab" for="name" >姓名</label>
                                <input type="text" placeholder="请输入姓名" id="name">
                            </li>
                            <li class="input_li">
                                <label class="lab" for="phone" >手机</label>
                                <input type="text" placeholder="请输入手机" id="phone">
                            </li>
                            <li class="input_li">
                                <label class="lab">选择车型</label>
                                <select class="dia_select" id="cartype">
                                    <option value="">请选择车型</option>
                                    <option value="豪华行政版">豪华行政版</option>
                                    <option value="行政版">行政版</option> 
                                    <option value="豪华版">豪华版</option>
                                    <option value="精英版">精英版</option> 
                                    <option value="时尚版">时尚版</option>
                                </select>
                            </li>
                            <li class="input_li">
                                <label class="lab">省</label>
                                <select class="dia_select" id="province" onchange="provincchange();">
                                    <option value="">请选择省</option>
                                    <?php if (isset($list) && is_array($list)): ?>
                                        <?php foreach ($list as $key => $value): ?>
                                            <option value="<?php echo $value['province']; ?>"><?php echo $value['province']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </li>
                            <li class="input_li">
                                <label class="lab">市</label>
                                <select class="dia_select" id="city" onchange="citychange();">
                                    <option value="">请选择市</option>
                                </select>
                            </li>
                            <li class="input_li">
                                <label class="lab">选择经销商</label>
                                <select class="dia_select" id="business">
                                    <option value="">请选择经销商</option>
                                </select>
                            </li>
                            <span class="btn" id='sub_btn'>提交</span>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="mask"  style="display:none">
                <div class="ans_dia" id="mask_ok" style="display:none">
                    <div class="dia_close"></div>
                    <!-- 分别位置是0%、25%、50%、75%、100% -->
                    <div class="ans_photo" style="background-position:75% center;"></div>
                    <span class="ans_h">恭喜您！答对啦！</span>
                    <span class="ans_p askmsg">上汽大通G10拥有2.0T高性能发动机
                        和2.4L节能环保发动机的双擎动力，
                        搭配ZF 6速手自一体变速箱，使最高
                        时速达到190Km/h！</span>
                    <span class="btn">继续</span>
                </div>
                <div class="ans_dia" id="mask_err" style="display:none">
                    <div class="dia_close"></div>
                    <!-- 分别位置是0%、25%、50%、75%、100% -->
                    <div class="ans_photo" style="background-position:75% center;"></div>
                    <span class="ans_h">答错啦......</span>
                    <span class="ans_p askmsg">上汽大通G10拥有2.0T高性能发动机
                        和2.4L节能环保发动机的双擎动力，
                        搭配ZF 6速手自一体变速箱，使最高
                        时速达到190Km/h！</span>
                    <span class="btn">继续</span>
                </div>
            </div>
            <div id="share" style="display:none"></div>
            <div id="music"class='on'></div>
            <audio id="audio" loop="loop"  preload='auto' src="<?php echo _STATIC_ ?>vip/shangqidatong/video/bg.mp3"></audio>
        </div> 
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/shangqidatong/js/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/shangqidatong/js/parallax.js?random=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/shangqidatong/js/init.js?random=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ ?>js/globals.js?random=<?php echo time(); ?>"></script>
    </body>
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
                                    var title = '上汽大通';//分享标题
                                    var desc = '答5题就能赢百元滴滴专车券，别说我没告诉你！';//分享描述
                                    var link = 'http://' + window.location.host + '/shangqidatong/index';//分享链接
                                    var imgUrl = '<?php echo _STATIC_; ?>vip/shangqidatong/img/sharepic.png?radom=<?php echo time(); ?>';//分享图标
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
                                        wx.ready(function() {
                                            //分享到朋友圈
                                            wx.onMenuShareTimeline({
                                                title: desc, // 分享标题
                                                link: link, // 分享链接
                                                imgUrl: imgUrl, // 分享图标
                                                success: function() {
                                                    // 用户确认分享后执行的回调函数
                                                    //shareok('friends');
                                                },
                                                cancel: function() {
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
                                                success: function() {
                                                    // 用户确认分享后执行的回调函数
                                                    //shareok('friend');
                                                },
                                                cancel: function() {
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
                                                success: function() {
                                                    // 用户确认分享后执行的回调函数
                                                    //shareok('qq');
                                                },
                                                cancel: function() {
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
                                                success: function() {
                                                    // 用户确认分享后执行的回调函数
                                                    //shareok('weibo');
                                                },
                                                cancel: function() {
                                                    // 用户取消分享后执行的回调函数
                                                    // sharecancel('weibo');
                                                }
                                            });

                                        });
    </script>
    <script>
        $(function() {
            document.getElementById('audio').play();
            //单击提交
            $('#sub_btn').bind('touchstart', function() {
                var name = $('#name').val();
                var phone = $('#phone').val();
                var cartype = $('#cartype').val();
                var province = $('#province').val();
                var city = $('#city').val();
                var business = $('#business').val();
                if (!check_phone(phone)) {
                    alert('手机号格式不正确！');
                    return false;
                }
                $.post('/shangqidatong/ajaxregister', {'name': name, 'phone': phone, 'cartype': cartype, 'province': province, 'city': city, 'business': business}, function(data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '100000') {
                        alert(list.result);
                        return false;
                    } else {
                        $('.resule').show();
                        $('.dia').hide();
                        $('.dia_cong').show();
                    }
                });
            });
        });
    </script>
    <script>
        function provincchange() {
            var province = $('#province').val();
            //异步获取下属城市
            $.post('/shangqidatong/ajaxgetcity', {'province': province}, function(data) {
                var list = eval('(' + data + ')');
                if (list.code != '100000') {
                    alert(list.result);
                    return false;
                }
                $('#city').html('');
                for (var i in list.result) {
                    $('#city').append('<option value="' + list.result[i].city + '" >' + list.result[i].city + '</option>');
                }
                $('#city').val(list.result[0].city);
                citychange();
            });
        }

        function citychange() {
            var province = $('#province').val();
            var city = $('#city').val();
            //异步获取下属供销商
            $.post('/shangqidatong/ajaxgetbusiness', {'province': province, 'city': city}, function(data) {
                var list = eval('(' + data + ')');
                if (list.code != '100000') {
                    alert(list.result);
                    return false;
                }
                $('#business').html('');
                for (var i in list.result) {
                    $('#business').append('<option value="' + list.result[i].business + '" >' + list.result[i].business + '</option>');
                }
            });
        }

    </script>
</html>