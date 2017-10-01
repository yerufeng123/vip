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
    <link rel="stylesheet" href="<?php echo _STATIC_?>vip/licai/css/common.css">
	</head>
  	<script>
		var page_list = [];	//页面动画动画元素
		var page = {
			_width :0,			//页面宽度
			_height:0,			//页面高度
			_zoom : 1,			//页面适配缩放比
			_index:0, 			//当前显示第几个页面
			_num:0,   			//页面个数
			sign:true,			//页面跳转标识
			clear:true,			//页面清除动画标识
			skip:"line",		//页面换页方式{卡片:card;跳转:jump;旋转:rotat;风车:wind;连线:line|翻页:book;}
			_dir:-1,			//页面切换的方向（-1为向下，1为向上）
			_top:0,				//滚动元素到页面顶上的距离
			_pre:false,			
		};
	</script>
  <body>
  	<div id="wrap" class="page_home">
  		<ul id="page_list">
		<!-- 首页 -->
			<li class="page2 page" id="page2" scene="2">
                <div class="titlebox">
                    <div class="fly"><img src="<?php echo _STATIC_?>vip/licai/img/hjy/logo.png" /></div>
                    <div class="qiandai"><img src="<?php echo _STATIC_?>vip/licai/img/hjy/qiandai.png" /></div>
                    <div class="caidai"><img src="<?php echo _STATIC_?>vip/licai/img/hjy/caidai.png" /></div>
                    <div class="blingup"><img src="<?php echo _STATIC_?>vip/licai/img/hjy/bling_up.png" /></div>
                </div>
                
                <!--
                 <div class="logo"><img src="img/logo.png"/></div>
                 <div class="index_text1"><img src="img/index_text1.png" /></div>
                 <div class="index_text2"><img src="img/index_text2.png"/></div>
                 <div class="index_child"><img src="img/index_child.png" /></div>
                 <div class="index_child"><img src="img/index_child.png" /></div>
                 -->
                <div class="wall"></div>
                
            
               <div class="haidao"></div>
               <div class="blingdown"></div>
               <div class="grass"></div>
		  		
		  		<div class="btn_box">
			  		<a href="javascript:void(0)" class="btn" id="inf_btn" href="javascript:void(0)">  </a>
		  		</div>
                
		  		<!-- <div class="index_page"><img src="img/index_bag.png" /></div> -->
                
                
               
                <section class="fuceng1" id="fc1" style="display:none">
                   
                        <div class="fucengborad"><img src="<?php echo _STATIC_?>vip/licai/img/hjy/fuceng1.png" />
                            <div class="ggbb">
                                <a href="javascript:void(0)" class="gamebtn" id="game_btn" href="javascript:void(0)">   </a>
                            </div>
                        </div>
                   
                </section>
                
                
				<!-- 游戏规则 -->
				<section class="rule_mask" id="mask" style="display:none">
					<div class="rule">
						<h4 class="rule_tit">游戏说明</h4>
						<p>&emsp;&emsp;亲，请用手指拖动屏幕底端的火锅，然后用你灵巧的双手尽量去接取天上掉下的各类美味，不过要小心隐藏其中的炸弹哦，接到炸弹，游戏结束，接满1000分者，还会有神秘礼品相赠，还等什么呢，赶快开始吧！</p>
					</div>
					<a href="javascript:void(0)" class="close btn">开始</a>
				</section>
                
			</li>
		</ul>
  		<!-- <img id="drop_down" src="img/drop_down.png" /> -->
    </div>
  </body>
  <script src="<?php echo _STATIC_?>vip/licai/js/jquery-1.8.1.min.js" type="text/javascript"></script>
  <script src="<?php echo _STATIC_?>vip/licai/js/slide.js" type="text/javascript"></script>
  <script src="<?php echo _STATIC_?>vip/licai/js/init.js" type="text/javascript"></script>
  <script>
  
    document.addEventListener("touchmove",function(e){e.preventDefault();})
	$("#inf_btn").bind("click",function(){
		$(".fuceng1").show();
	})
    $("#game_btn").bind("click",function(){
        window.location.href="/licai/game";
    })
//	$(".close").bind("click",function(){
//        window.location.href="/licai/game";
//    })
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
