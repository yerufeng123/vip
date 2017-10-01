
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Cache-Control" content="no-cache">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta id="viewport" name="viewport"
	content="width=415,maximum-scale=2.0,minimum-scale=0.5,user-scalable=no">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>斯特拉斯堡圣诞小镇</title>

</head>
<body>
<script>
		var h5 = { 
			skip 		:"jump",	
			//页面换页方式{正常状态:normal;抽取卡片:draw;旋转卡片：card;跳转:jump;旋转:rotat;风车:wind;连线:line;翻页:book;水平:banner;}
			clear 		:true,		//页面清除动画
			address 	:"",		//默认地址
			lazy 		:1,			//懒加载页面个数
			preload 	:false,
		}


	</script>
	 <style>
      #preload{width:100%;height:100%; position:fixed; left:0; top:0; right:0; bottom:0; z-index:9999; text-align:center; font-size:16px; background-color:rgba(0,0,0,0.3); background-size:100% auto;}
    .pre_main h3{font-size:14px;color:#fff; position:absolute;top:50%;left:0;bottom:0px;right:0;}
    #load_num{ position:absolute; left:0; top:55%; width:100%;font-size:14px;color:#000;}
    </style>
      <div id="preload">
      <div class="pre_main"><h3>精彩正在加载...</h3><br/><span id="load_num" style="color:#fff"></span></div>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/loading_game.js"></script>
	<div id="wrap" class="page_home">
		<header class="top_bg">
			<div class="logo2"></div>
			<div class="mytime" id="mtimer">30</div>
			<div class="jifen" id="sore_pic"></div>
			<div class="jifenzhi" id="sore">0</div>
		</header>
		<ul id="page_list">
			<!-- 游戏页 -->
			<li class="page_game page" id="page3" scene="3">
				<ul id="stage" speed="4">
					<div id="receive"></div>

				</ul> <!--<div class="jifen" id="sore_pic"></div>
                    <div class="jifenzhi" id="sore">0</div>-->

			</li>
			<!-- 遮罩层 -->
			<section id="mask" style="display: none">

				<!-- 留资页 -->
				<section class="dialog first_place" id="false" style="display: none">
					<a href="javascript:void(0)" class="close_btn" data-dialog-close=""></a>
					<img
						pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
						class="g_form_cake_one"><img
						pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
						class="g_form_cake_two"><img
						pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
						class="g_form_cake_three">
					<div class="diag_main_form">
						<div class="diag_form_tit">
							<p>归属人信息：</p>
							<p>请留下您宝贵的资料信息，以便中奖时或礼品兑换后及时与您取得联系。</p>
						</div>
						<ul class="diag_form">
							<li class="name_input"><label class="name">姓名</label> <input
								id="name" class="user-input" placeholder="请输入姓名"></li>

							<li class="name_input"><label class="name">手机</label> <input
								id="mobile" class="user-input" placeholder="请输入您的手机号"></li>

							<!-- <li class="name_input"><label class="name">家乡</label> <input
								id="home" class="user-input" placeholder="请输入您的家乡"></li> -->

						</ul>
					</div>
					<a href="javascript:void(0)" class="result_btn">查看凭证</a>
				</section>
				<!-- 游戏弹出窗 -->
				<section class="dialog first_place" id="success"
					style="display: none">
					<a href="javascript:void(0)" class="close_btn" data-dialog-close=""></a>
					<img
						pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
						class="g_cake_one"><img
						pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png"
						class="g_cake_two"><img pre-src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/g_cake.png" class="g_cake_three">
					<h3 class="diag_tit">您真棒！</h3>
					<div class="diag_notice">
					    <p class="diag_this_score" style="display: inline-block; margin-left: 97px;"><span id="levelscore">3000=</span></p>
						<p class="diag_score" style="display: inline-block;">0</p>
						<p class="diag_this_score">
							本次游戏得分：<span>0</span>
						</p>
					</div>
					<div class="diag_offer">
						<a href="javascript:void(0);" id="sub" class="contin_btn btn_com">继续游戏</a>
						<a href="javascript:void(0);" class="quit_btn btn_com">退出游戏</a>
					</div>
					<a href="javascript:void(0)" class="exch_btn exch_btn_gray"
						id='gift'>兑换礼品</a>

				</section>

				<!--分享-->
				<section class="share" id="share" style="display: none">
					<span>点击以上位置分享朋友圈哦</span>
				</section>
			</section>
            <section class="numbers" id="numbers" style="display:none">

                    <div class="number" id="number"><img id="number_img" src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>img/3.png" />
                    </div>

           </section>
			<audio id="audio" loop="loop" preload='auto'
				src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>video/game_bg.mp3"></audio>
		</ul>
	</div>
</body>
<script  src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/jquery-1.8.1.min.js"  type="text/javascript"></script>
<script>
    $(function(){
            document.getElementById('audio').play();
    })
        var mkn=0;
        var resultrul='<?php echo $this->createUrl('active/certificate_web');?>';
        var cid;
        var gnum;
        var game = {
        		_width  :0,			//场景宽度
        		j_height:0,			//判定高度
        		l_height:0, 		//离开高度
        		gold_width : 55,	//炸弹的宽度
        		gold_height: 130,	//炸弹的高度
        		receive_left: 0,	//左距离
        		receive_width : 109,//饭盒的宽度
        		receive_height: 133,//饭盒的高度
        		num 	:0,			//页面中物品的个数
        		level 	:5, 		//难度等级  
        		_interval : 1400,	 	//出现金币间隔
        		over 	  : false,	//游戏是否结束
        		_sorc 	:0,			//分数
        		_max 	:0,			//最高分数
        		_id 	:"",		//用户ID
        		timeout :300,    	//结束时间
        		bg_audio:"",       //背景音乐
        		up_level :4000,     //加大难度时间
        	};
        function checkplay(){
      	     gnum='<?php echo $this->actionMy_certificate(Constant::CHANNEL_GAME);?>';
          }
        //游戏结束
        function gameOver(flag){
        	$("#mask").show();
        	$(".dialog").hide();
        	 var score=parseInt($('#sore').html());
        	 var sigle;
        	 if(gnum == 0){
            	sigle=4500;
             }else if(gnum == 1){
            	 sigle=6000; 
             }else if(gnum >= 2){
            	 sigle=9000;   
             }
        	 mkn=0;
             if(score >=sigle){
            	 mkn=1;
               }
        	// mkn=Math.floor(score/sigle);
			if(mkn > 0){
    			 $('#gift').removeClass('exch_btn_gray');
    			 $("#success").show();
		     }else{
		    	    $('#gift').addClass('exch_btn_gray');
		    		$("#success").show();
			 }
	          $('.diag_this_score > span').html(score);
			  $('.diag_notice > .diag_score').html(mkn);
			  $('#levelscore').html(sigle+'=');
        	  $(".gold").remove();
        }

       function setscore(n){
           var score=parseInt($('#sore').html());
      		$.post('<?php echo $this->createUrl('active/christmas_end');?>',{score:score},function(data){
    			var arr=eval(data);
                  if(arr.code == 2000){
                      alert('游戏数据出错,请重新开始!');
                      location.reload();
                      return false;
                   }
                  cid=data.game.cid;
                  if(n == 1){
                      var url=resultrul+'?type='+'<?php echo Constant::CHANNEL_GAME;?>'+'&cid='+cid;
                      $('#gift').attr('lock',0);
                   }else if(n == 2){
                   	  var url='<?php echo $this->createUrl('active/certificate_web');?>'+'?cid='+cid+'&type='+'<?php echo Constant::CHANNEL_GAME;?>'; 
                   }
                  window.location.href=url;
    	     },'json');
       }

       $('#gift').click(function(){
           var lock=$('#gift').attr('lock');
           if(lock == 1){
               alert('数据提交中,请稍等!');
               return false;
             }
            $('#gift').attr('lock',1);
          	$.post('<?php echo $this->createUrl('active/getuser');?>',{},function(data){
                 if(mkn > 0){
                    if(data.phone && data.phone != 'null'){
                    	setscore(1);
                    }else{ 
                    	$("#success").hide();
                        $("#false").show();
                   }
                }else{
                   alert('游戏积分不足，请重新开始游戏!');
                }
           },'json');
        });

       $('.quit_btn').click(function(){
            location.href='<?php echo $this->createUrl('active/christmasindex');?>';
         });
       
       $('#sub').click(function(){
    	    location.reload();
       });
       

      $('.result_btn').click(function(){
          var name=$('#name').val();
          var phone=$('#mobile').val();
       //   var home=$('#home').val();
          if(!name){
              alert('姓名不能为空!');
              return false;
           }
          if (!phone || !phone.match(/^1[0-9]{10}$/) || phone.length != '11') {
              if(!phone){
             	  alert('手机号不能为空!');
                  return false;  
              }
        	  alert('手机号格式错误!');
              return false;
          }
         var lock=$('.result_btn').attr('lock');
         if(lock == 1){
      	    alert('数据提交中,请稍等!');
            return false; 
          }
         $('.result_btn').attr('lock',1);
         $.post('<?php echo $this->createUrl('active/gamereg');?>',{name:name,phone:phone},function(data){
             console.log(data);
            if(data.code == 1000){
              	setscore(2);
            }else{
                alert(data.msg);
            }
            $('.result_btn').attr('lock',0);
         },'json'); 	
      });	
    	//关闭
    	$(".close_btn").bind("click",function(){
 		     location.href='<?php echo $this->createUrl('active/christmasindex');?>';
    		$("#mask").hide();
    	})
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/game.js?<?php echo time(); ?>"  type="text/javascript"></script>
<script src="<?php echo _STATIC_ . 'vip/strasbourg/'; ?>js/slide2.js?<?php echo time(); ?>"  type="text/javascript"></script>
<?php
$jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
$signPackage = $jssdk->GetSignPackage();
?>
<script>
    /*
     * 注意：
     *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
     */
var title = '快来拯救马卡龙吧！';//分享标题
var desc = ' 斯特拉斯堡圣诞集市诚邀您参与游戏互动，动动手指，就能品尝地道的法国马卡龙，心动不如行动呦~';//分享描述
var link = 'http://' + window.location.host + '/strasbourg/active/christmasindex?_wv=1';//分享链接
var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share_pic.png';//分享图标
    var type = '';// 分享类型,music、video或link，不填默认为link
    var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"]; ?>',
        timestamp: <?php echo $signPackage["timestamp"]; ?>,
        nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
        signature: '<?php echo $signPackage["signature"]; ?>',
        jsApiList: [
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'closeWindow',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'hideMenuItems',
            'showMenuItems'
        ]
    });
    wx.ready(function () {
    	wx.hideMenuItems({
    	    menuList: [
    	       //'menuItem:share:appMessage',
    	       //'menuItem:share:timeline',
    	       'menuItem:share:qq',
    	       'menuItem:share:weiboApp',
    	       //'menuItem:favorite',
    	       'menuItem:share:facebook',
    	       'menuItem:share:QZone',
    	       'menuItem:editTag',
    	       'menuItem:delete',
    	       'menuItem:copyUrl',
    	       'menuItem:originPage',
    	       'menuItem:readMode',
    	       'menuItem:openWithQQBrowser',
    	       'menuItem:openWithSafari',
    	       'menuItem:share:email',
    	       'menuItem:share:brand'
    	       
    	   ] 
    	});
    	wx.showMenuItems({
      	    menuList: [
                  'menuItem:share:appMessage',
                  'menuItem:share:timeline',
                  //'menuItem:share:qq',
                  //'menuItem:share:weiboApp',
                  //'menuItem:favorite',
                  //'menuItem:share:facebook',
                  //'menuItem:share:QZone',
              ]
      	});
        //分享到朋友圈
        wx.onMenuShareTimeline({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                //shareok('friends');
            	shareok();
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
            	shareok();
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
</html>
