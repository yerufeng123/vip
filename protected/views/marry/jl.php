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
    <meta id="viewport" name="viewport" content="width=415,minimum-scale=0.5,maximum-scale=2.0,user-scalable=no">
    <title>我们结婚了--婚礼邀请函</title>
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
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/marry/css/page.css">
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/marry/css/common.css">
    
    <style>
    	#preload{ position:fixed; top:0;right:0;bottom:0;left:0; background-color:#fff; z-index:9999;}
		#pre_time{position:absolute;left:50%;top:50%; margin-left:-94px;margin-top:-94px;width:188px;height:187px;}
		#pre_h{position:absolute;left:50%;top:50%;margin-left:-3px;margin-top:-50px;width:6px;height:68px;
			-webkit-transform: rotate(330deg);transform: rotate(330deg);-webkit-transform-origin: center 80%; transform-origin: center 80%;
		}
		#pre_m{position:absolute;left:50%;top:50%;margin-left:-5px;margin-top:-74px;width:9px;height:104px;
			-webkit-transform-origin: center 74%; transform-origin: center 74%;
			}
		#pre_tit{position:absolute;left:50%;top:50%;margin-left:-115px;margin-top:150px;width:230px; height:20px; opacity:0;
			-webkit-transition:opacity .3s;transition:opacity .3s;}
    </style>
    <script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:2,			//懒加载页面个数
			preload 	:false,
			bg_audio	:"<?php echo _STATIC_ ?>vip/marry/video/bg.mp3",		//背景音乐URL和对背景音乐的操作对象
		}
	</script>
  </head>
  <body> 
 	<div id="preload">
 		<img src="<?php echo _STATIC_ ?>vip/marry/img/pre_time.png" id="pre_time">
 		<img src="<?php echo _STATIC_ ?>vip/marry/img/pre_h.png" id="pre_h">
 		<img src="<?php echo _STATIC_ ?>vip/marry/img/pre_m.png" id="pre_m">
 		<img src="<?php echo _STATIC_ ?>vip/marry/img/pre_tit.png" id="pre_tit">
 	</div>
 	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/marry/js/loading.js"></script>
  	<div id="wrap" style="display:none">
  		<ul id="page_list" stage="">
  			<li class="page show" id="p1" scene="1" stop-move="-1">
  				<div class="page_body"> 
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon2.png" class="p1_cloud2 out-more_left" delay="400">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon1.png" class="p1_cloud1 out-more_left" delay="600">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon1.png" class="p1_cloud3 out-more_right" delay="500">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon3.png" class="p1_flower1 active_rotate" delay="300">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon3.png" class="p1_flower2">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon3.png" class="p1_flower3 active_rotate" delay="300">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/p1_photo1.png" class="p1_photo1 layer" data-mask="1" data-depth="0.8">
  					<img src="<?php echo _STATIC_ ?>vip/marry/img/p1_photo2.png" class="p1_photo2 layer" data-mask="2" data-depth="0.8">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p1_tit.png" class="p1_tit out-more_bottom"  delay="300">

  				</div>
  				<!-- picture控制显示的照片的序列 -->
  				<div id="p1_mask" class="mask" picture="1" style="display:none;"></div>
  			</li>
  			
  			<li class="page" id="p2" scene="2">
				<div class="page_body">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_ligth.png" class="p2_light active_rotate" delay="300">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon1.png" class="p2_cuoud1  out-more_left" delay="600">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_sun.png" class="p2_sun">
					
					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon4.png" class="p2_cuoud2  out-more_right" delay="800">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/icon4.png" class="p2_cuoud3  out-more_right" delay="1000">

					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_kettle.png" class="p2_kettle out-biter_rotate" delay="1000">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_photo1.png" class="p2_photo1 active_shake-l"data-mask="1" delay="300">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_photo2.png" class="p2_photo2 active_shake-r"data-mask="2" delay="300">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_water.gif" class="p2_water out-opacity" delay="1000">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_plant.png" class="p2_plant">

					<img src="<?php echo _STATIC_ ?>vip/marry/img/p2_tit.png" class="p2_tit out-more_bottom"  delay="300">
  				</div>
  				<!-- picture控制显示的照片的序列 -->
  				<div id="p2_mask" class="mask" picture="1" style="display:none;"></div>
  			</li>

  			<li class="page" id="p3" scene="3">
				<div class="page_body">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_tree.png" class="p3_tree">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_heart1.png" class="p3_heart1 active_beat"data-mask="1" delay="300">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_bird1.png" class="p3_bird1 active_shake" delay="500">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_bird2.png" class="p3_bird2 active_shake" delay="1250">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_house.png" class="p3_house active_shake" delay="300">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_bar.png" class="p3_bar">
					<ul class="p3_hearts"> 
						<li class="p3_left" delay="200"></li>
						<li class="p3_right" delay="400"></li>
						<li class="p3_left" delay="600"></li>
						<li class="p3_right" delay="800"></li>
					</ul>
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_people.png" class="p3_people active_shakeX" delay="">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p3_tit.png" class="p3_tit out-more_bottom" delay="300">
				</div>
				<div id="p3_mask" class="mask" style="display:none;"></div>
  			</li>
  			<li class="page" id="p4" scene="4">
				<div class="page_body">
					<div class="p4_photo p4_photo1 active_shake active" style=" background-image:url(<?php echo _STATIC_ ?>vip/marry/img/p4_show1.jpg) "data-mask="1" delay="800"></div>
					<div class="p4_photo p4_photo2 active_shake active" style=" background-image:url(<?php echo _STATIC_ ?>vip/marry/img/p4_show2.jpg) "data-mask="2" delay="400"></div>
					<div class="p4_photo p4_photo3 active_shake active" style=" background-image:url(<?php echo _STATIC_ ?>vip/marry/img/p4_show3.jpg) "data-mask="3" delay="500"></div>
					<div class="p4_photo p4_photo4 active_shake active" style=" background-image:url(<?php echo _STATIC_ ?>vip/marry/img/p4_show4.jpg) "data-mask="4" delay="600"></div>
					<div class="p4_photo p4_photo5 active_shake active" style=" background-image:url(<?php echo _STATIC_ ?>vip/marry/img/p4_show5.jpg) "data-mask="5" delay="700"></div>
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p4_fly1.png" class="p4_fly1 active_rotate" delay="">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p4_fly2.png" class="p4_fly2 active_rotate-r" delay="">
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p4_tit.png" class="p4_tit out-more_bottom" delay="300">
				</div>
				<!-- picture控制显示的照片的序列 -->
				<div id="p4_mask" class="mask"  picture="1" style="display:none;"> 
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p4_text.png" class="p4_text">
				</div>
  			</li>

  			<li class="page" id="p5" scene="5">
				<div class="page_body">
					<dl class="p5_list active" delay="300">
						<dt class="p5_head"></dt>
						<img src="<?php echo _STATIC_ ?>vip/marry/img/p5_photo.jpg" class="p5_photo out-opacity"delay="2400">
						<dd class="p5_li out-more_right"delay="3000">8:00 — 10:00  嘉宾签到</dd>
						<dd class="p5_li out-more_right"delay="3500">10:00 — 11:00  婚礼仪式</dd>
						<dd class="p5_li p5_li_last out-more_right"delay="4000">12:00 — 15:00  婚礼宴席</dd>
					</dl>
					<img src="<?php echo _STATIC_ ?>vip/marry/img/p5_tit.png" class="p5_tit out-more_bottom"  delay="300">
				</div>
  			</li>
  			<li class="page" id="p6" scene="6" stop-move="1">
				<!--
				<div class="page_body">
						<div class="mail mail1"></div>
						<div class="mail mail2"></div>
						<div class="mail mail3"></div>
						<div class="mail mail4"></div>
						<div class="mail mail5"></div>
						<div class="mail mail6"></div>
						<img src="<?php echo _STATIC_ ?>vip/marry/img/p6_tit.png" class="p6_tit"> 
				</div>
				-->
				<section class="inv_inf"> 
					<p class="p6_text p6_text1">沉浸在幸福中的我们将于：<br/>2015年5月3日 星期日 举办结婚典礼</p>
					<p>时间：上午十点之前（10:00 AM）<br/>席设：蓝地时尚庄园(会议中心)<br/>朝阳区北苑东路88号</p>
					<p class="p6_text">新郎：周建<img src="<?php echo _STATIC_ ?>vip/marry/img/figuer.jpg" class="figuer active_beat" delay="300">新娘：刘柳</p>
					<p class="p6_text">诚意邀请您共同分享这份喜悦<br/>我们期待您的光临</p>
					<label class="p6_input">嘉宾姓名：<input type="text" placeholder="请输入您的姓名" id="name"></label>
					<label class="p6_input">嘉宾手机：<input type="text" placeholder="请输入您的手机号" id="phone"></label>
					<span class="btn" id="sub">参加</span>
				</section>
				<div id="p6_mask" class="mask" style="display:none;"> 
					<span class="p6_word" id="p6_word">感谢您的关注与祝福<br/>婚礼邀请函会尽快发送给您！</span>
				</div>
  			</li>
  		</ul>
  		<div id="bg_music" class="on">
  			<img src="<?php echo _STATIC_ ?>vip/marry/img/music_off.png" id="music">
  		</div>
  		<img id="drop_down" src="<?php echo _STATIC_ ?>vip/marry/img/drop_down.png">
    </div> 
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/marry/js/slide.js" defer="defer"></script>
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/marry/js/parallax.js"></script>
	<script type="text/javascript" src="<?php echo _STATIC_ ?>vip/marry/js/zepto.min.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/marry/js/init.js"></script>
    <script>
            $(function() {
                //单击提交
                $('#sub').bind('click', function() {
                    //判断姓名和手机号是否合理
                    var name = $('#name').val();
                    var phone = $('#phone').val();
                    //var ask=$('#ask').val();
                    if (name == '') {
                        alert('请输入姓名');
                        return false;
                    }
                    if (phone == '') {
                        alert('请输入手机号');
                        return false;
                    }
                    if (!check_phone(phone)) {
                        alert('手机号格式不正确，请重新填写');
                        return false;
                    }
                    //异步报名
                    $.post('/marry/ajaxsign', {'username': name, 'mobile': phone}, function(data) {
                        var res = eval('(' + data + ')');
                        
                        if (res.msg == '报名成功') {
                            $('#p6_mask').show();
                        } else {
                            alert(res.msg);
                        }
                    });
                });

                //单击遮罩
                $('#p6_mask').bind('click', function() {
                    $('#p6_mask').hide();
                });

            });
            //验证手机
            function check_phone(phone) {
                var reg = /^1[3|4|5|7|8][0-9]\d{8}$/;
                if (!reg.test(phone)) {
                    return false;
                } else {
                    return true;
                }
            }
        </script>
  </body>
</html>