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
    <!-- <meta http-equiv="Cache-Control" content="max-age=720000" />
    <meta http-equiv="Expires" content="Mon, 20 Jul 2016 23:00:00 GMT" /> -->
    <meta id="viewport" name="viewport" content="width=415,maximum-scale=2.5,minimum-scale=0.5,user-scalable=no">
    <title>平安银行</title>
    <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/pingan/four/css/common.css">
    <script>
		var h5 = { 
			skip 		:"draw",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 	:true,		//页面清除动画
			address :"",		//默认地址
      //修改2015-10-22
      preload :false,
		}
	</script>
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
<!-- 修改开始2015-10-22 -->
     <style>
  #preload{ position: fixed; left: 0; top: 0; right: 0; bottom: 0; background-color: #000; z-index: 999;}
  #load_num{ position:absolute; left: 50%;top: 50%;-webkit-transform:translate(-50%,-50%); transform:translate(-50%,-50%); color: #fff; font-size: 40px;}
</style>
<div id="preload">
  <span id="load_num"></span>
</div>

<!-- 修改结束2015-10-22 -->
  	<div id="wrap">
  		<ul id="page_list">
        <!-- <img pre-src="img/p1_t.png" width="227" height="100" class="p1_t out-small" delay="1200"> -->
  			<li class="page show" id="p1" scene="1" stop-move="-1">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg1.png" class="p1_bg1 layer" data-depth="0.4">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg2.png" class="p1_bg2 layer" data-depth="0.3">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg1.png" class="p1_bg3 out-opacity" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/logo.png" class="logo out-left" delay="1200">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_t.png" class="p1_t out-small" delay="2000">
	  		</li>
        <li class="page" id="p2" scene="2" >
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg1.png" class="p1_bg1 layer" data-depth="0.4">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg2.png" class="p1_bg2 layer" data-depth="0.3">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p1_bg1.png" class="p1_bg3 out-opacity" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/logo.png" class="logo out-left" delay="1200">

          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p2_t.png" class="p2_t1 out-rotateX" delay="1800">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p2_t3.png" class="p2_t2 out-bottom" delay="2400" style="width:343px;height:15px;">
          <dl class="p2_w">
            <dt class="p2_t out-more_bottom" delay="3000" style="font-size: 16px;">诚挚邀请阁下莅临</dt>
            <dd class="p2_p out-bottom" delay="3600" style="font-weight: bold;font-size: 14px;">时间：2016年2月20日17点</dd>
            <dd class="p2_p out-bottom" delay="4200" style="font-weight: bold;font-size: 14px;">地点：中国职工之家饭店C座3层报告厅<br/>
            <span class="font_hide">地点：</span><span style="font-size: 13px;margin-left: -5px;margin-top: -5px;">(北京市西城区复兴门外大街真武庙路1号)</span></dd>
          </dl>
        </li>
        <li class="page" id="p3" scene="3">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/logo.png" class="logo out-left" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p3_w1.png" class="p3_w1 out-top" delay="1200" style="width: 66px;height: 60px;">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p3_i.png" class="p3_i1 out-small" delay="1800">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p3_i2.png" class="p3_i2" delay="2400">
        </li>
        <li class="page" id="p4" scene="4">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/logo.png" class="logo out-left" delay="600">
          <dl class="p4_w">
            <dt class="p4_t out-bottom active" delay="1200" style="margin-bottom: 36px;font-size: 19px;color: #9c0b0b;font-weight: bold;">活动议程：</dt>
            <dd class="p4_p out-bottom" delay="1800">17:00—18:00  签到，分行经营管理和企业<br/><span class="font_hide">17:00—18:00  </span>文化展示</dd>
            <dd class="p4_p out-bottom" delay="2400">18:00—19:00  分行领导、干部代表和家属<br/><span class="font_hide">18:00—19:00  </span>代表发言，员工才艺展示和<br/><span class="font_hide">18:00—19:00  </span>互动游戏</dd>
            <dd class="p4_p out-bottom" delay="3000">19:00—21:00  晚宴</dd>
          </dl>
        </li>

        <li class="page" id="p5" scene="5" stop-move="1">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/logo.png" class="logo out-left" delay="600">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p2_t.png" class="p5_t1 out-big" delay="1200">
          <img pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/p2_t3.png" class="p5_t2 out-bottom" delay="1800" style="width:343px;height:15px;">
          <span class="p5_w out-right"  delay="2600" style="left: 75%;width: 75px;font-size: 18px;">返回首页</span>
        </li>
  		</ul>
      <img id="drop_down" pre-src="<?php echo _STATIC_ ?>vip/pingan/four/img/btn_down.png">
      <audio id="audio" loop="loop" autoplay="autoplay" preload='auto' src="<?php echo _STATIC_ ?>vip/pingan/four/video/bg.mp3"></audio>
      <div id="music" class='on'></div>
    </div>
<!-- loading.js -->
    <script>
var preLoad=function(){this.baseurl=""||h5.address;this.res=[];this.res_num=this.res.length;this.fail=[];this.num=0;this.preLoad=null;this.preText=null;this.pre_icon=null;this.pre_bar=null;this._height=0;this.init()};preLoad.prototype={bind_fn:function(obj,func){return function(){func.apply(obj,arguments)}},init:function(){this.preLoad=document.querySelector("#preload");this.preText=document.querySelector("#load_num");document.addEventListener("touchmove",function(e){e.preventDefault()});this.addres()},addres:function(){var doms=document.querySelectorAll("[pre-src]");for(var i=doms.length-1;i>0;i--){var dom=doms[i];var obj={type:dom.tagName,src:dom.getAttribute("pre-src")};this.res.push(obj)}this.res_num=this.res.length;this.loadRes()},loadRes:function(){var arr=this.res;var dom=null;for(var i=this.res_num-1;i>=0;i--){dom=arr[i];switch(dom.type){case"IMG":this.loadImg(dom);break;case"js":this.loadJs(dom);break;case"css":this.loadCss(dom);break;case"AUDIO":this.loadAudio(dom);break;case"VIDEO":this.loadVideo(dom);break;default:console.log("error")}}},loadImg:function(res){var img=new Image();img.src=this.baseurl+res.src;img.addEventListener("load",this.bind_fn(this,this.ok));img.addEventListener("error",this.bind_fn(this,this.no))},loadJs:function(res){var _script=document.createElement("script");_script.type="text/javascript";_script.src=this.baseurl+res.src;document.body.insertBefore(_script,document.body.lastChild);this.ok()},loadCss:function(res){var _style=document.createElement("link");_style.rel="stylesheet";_style.href=this.baseurl+res.src;document.body.insertBefore(_style,document.body.firstChild);this.ok()},loadVideo:function(res){var _video=document.createElement("video");_video.src=this.baseurl+res.src;_video.addEventListener("load",this.bind_fn(this,this.ok));_video.addEventListener("error",this.bind_fn(this,this.no))},loadAudio:function(res){var _audio=document.createElement("audio");_audio.src=this.baseurl+res.src;_audio.addEventListener("load",this.bind_fn(this,this.ok));_audio.addEventListener("error",this.bind_fn(this,this.no))},ok:function(){this.num++;this.callback(true)},no:function(){this.num++;this.callback(false)},callback:function(sign){var prentent=parseInt(this.num/this.res_num*100);this.preText.innerHTML=prentent+"%";if(this.num==this.res_num){this.over()}},over:function(){this.preText.innerHTML="100%";var _dom=document.querySelectorAll("[pre-src]");for(var i=0;i<_dom.length;i++){var this_dom=_dom[i];var _src=this_dom.getAttribute("pre-src");if(this_dom.tagName=="IMG"){this_dom.setAttribute("src",_src)}else{this_dom.style.backgroundImage="url("+_src+")"}}h5.preload=true}};var preLoad=new preLoad();
    </script>
  <!-- slide.js -->
	  <script>
  function Slide(a){this.wrap=document.querySelectorAll(a);this.touchStart="touchstart";this.touchMove="touchmove";this.touchEnd="touchend";this.degreeX=120;this.degreeY=90;this.degree=200;this.moveSign=true;this.transX=0;this.transY=0;this.pointX=0;this.pointY=0;this.X_dir=0;this.Y_dir=0;this.etime=0;this.isIE=false;if(window.navigator.msPointerEnabled){this.isIE=true}if(this.isIE){this.touchStart="MSPointerDown";this.touchMove="MSPointerMove";this.touchEnd="MSPointerUp"}this.init(this.wrap)}Slide.prototype={init:function(){for(var a=0;a<this.wrap.length;a++){this.wrap[a].addEventListener(this.touchStart,this.bind_fn(this,this.touch_start));this.wrap[a].addEventListener(this.touchMove,this.bind_fn(this,this.touch_move));this.wrap[a].addEventListener(this.touchEnd,this.bind_fn(this,this.touch_end))}},bind_fn:function(b,a){return function(){a.apply(b,arguments)}},touch_start:function(b){this.pointX=this.point(b).x;this.pointY=this.point(b).y;var a=new Date();this.etime=a.getTime()},touch_move:function(a){this.transX=this.point(a).x-this.pointX;this.transY=this.point(a).y-this.pointY;this.moving(this.transX,this.transY);a.stopPropagation();a.preventDefault()},touch_end:function(d){if(d.touches.length){return 0}var c=new Date();this.etime=c.getTime()-this.etime;var g=this.transX;var f=this.transY;var b=g/this.etime*this.degree;var a=f/this.etime*this.degree;if((f>this.degreeY)||(a>this.degreeY)){this.Y_dir=-1}else{if((f<-this.degreeY)||(a<-this.degreeY)){this.Y_dir=1}}if((g<-this.degreeX)||(b<-this.degreeX)){this.X_dir=1}else{if((g>this.degreeX)||(b>this.degreeX)){this.X_dir=-1}}this.over()},point:function(c){var b=0;var a=0;if(this.isIE){b=c.pageX;a=c.pageY}else{b=c.touches[0].pageX;a=c.touches[0].pageY}return{x:b,y:a}},over:function(){if(this.Y_dir){this.SlideY(this.Y_dir)}if(this.X_dir){this.SlideX(this.X_dir)}this.X_dir=this.Y_dir=this.etime=this.transX=this.transY=0},SlideY:function(a){},SlideX:function(a){},moving:function(a,b){},};
    </script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/four/js/parallax.js"></script>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/pingan/four/js/zepto.min.js"></script>
<!-- init.js -->
    <script>var page={_width:0,_height:0,_delay:0,_last:300,_zoom:1,_index:0,_num:0,sign:true,_top:0,_temp:0,_list:[],_static:[],_lazy:[],};$(document).ready(function(e){document.addEventListener("touchmove",function(e){e.preventDefault()},false);page._num=$("[scene]").length;page._height=$("body").height();page._width=$("body").width();$("#page_list").addClass(h5.skip);$("#page_list").css({"-webkit-transform":"translateY(0px) translateZ(0)"});$("#music").on("click",function(){if($(this).hasClass("on")){_audioOff();$(this).removeClass("on")}else{_audioon();$(this).addClass("on")}});$(".p5_w").bind("click",function(){page_move(-4)});$("body").one("touchstart",function(){$(this).addClass("on");_audioon()});init();var slide=new Slide("#page_list");if(h5.skip=="jump"||h5.skip=="draw"||h5.skip=="line"||h5.skip=="normal"||h5.skip=="card"){slide.SlideY=function(dir){if(dir){page_move(dir)}}}else{if(h5.skip=="rotat"||h5.skip=="wind"||h5.skip=="book"||h5.skip=="banner"){slide.SlideX=function(dir){if(dir){page_move(dir)}}}}if(h5.skip=="line"||h5.skip=="normal"){slide.moving=function(x,y,points,rotate,longe){page_moving("[stage]",x,y)};if(h5.skip=="line"){$("#page_list").bind("touchend",function(){page_skip()})}else{$("#page_list").bind("touchend",function(){page._top=page._temp})}}$("#drop_down").bind("click",function(){page_move(1)});$(window).resize(function(){page._height=$("body").height();page._width=$("body").width();$("#page_list").height(page._height)});var timer=setInterval(function(){if(h5.preload){$("#preload").hide();ani_run(0);clearInterval(timer)}},500);var scene=document.getElementById("wrap");var parallax=new Parallax(scene)});function init(){for(var i=0;i<page._num;i++){var scene=$("[scene]").eq(i);var _Dom=scene.find("[delay]");var _Num=_Dom.length;var _Top=scene.offset().top;var _stop=scene.attr("stop-move")||0;page._list.push({"_dom":_Dom,"_num":_Num,"_top":-_Top,"_stop":_stop,});_Dom=scene.find("[lazy-src]");_Num=scene.find("[lazy-src]").length;page._lazy.push({"_dom":_Dom,"_num":_Num})}}function page_move(_index){if(!page.sign){return false}var _stop=page._list[page._index]._stop;if(_stop==_index){return false}page.sign=false;_index=page._index+_index;if($("#drop_down").length){if(_index<0||_index>=page._num){page.sign=true;return false}page._index=_index;var moveSign=page._list[_index]._stop||0;if(moveSign==1){$("#drop_down").hide()}else{if(_stop==1){$("#drop_down").show()}}}if(h5.clear){$(".active").removeClass("active")}setTimeout(function(){$(".page").removeClass("show").eq(_index).addClass("show")},page._delay);setTimeout(function(){page.sign=true},page._delay+page._last);ani_run(_index)}function page_skip(){page._top=page._list[page._index]._top;$("#page_list").css({"-webkit-transform":"translate(0,"+(page._top)+"px) translateZ(0)","-webkit-transition-duration":page._last+"ms"})}function page_moving(_dom,_x,_y){page._temp=page._top+_y;if(page._temp>0){page._temp=0}if(page._temp<-(page._num-1)*page._height){page._temp=-(page._num-1)*page._height}$(_dom).css({"-webkit-transform":"translate(0,"+(page._temp)+"px) translateZ(0)","-webkit-transition-duration":"0"})}function ani_run(_index){var _list=page._list[_index];var _t=0;var _d=null;for(var i=0;i<_list._num;i++){_d=$(_list._dom[i]);_t=$(_d).attr("delay");var c=function(_DOM,_TIME){setTimeout(function(){$(_DOM).addClass("active")},_TIME)}(_d,_t)}}function lazy_load(_index){}function _audioon(){var audio=document.getElementById("audio");audio.play()}function _audioOff(){var audio=document.getElementById("audio");audio.pause()};</script>
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
            var title = '邀请函';//分享标题
            var desc = '怀梦前行 感谢有你，平安银行北京分行中干家属答谢会。';//分享描述
            var link = 'http://' + window.location.host + '/pingan/indexfour?_wv=1&random=' + Math.random();//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/pingan3/img/share.png';//分享图标
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
        <script>
            $(function () {
                document.addEventListener('WeixinJSBridgeReady', function () {
                    document.getElementById('audio').play();
                }, false);
            });
        </script>
</html>