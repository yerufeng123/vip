<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_?>vip/strasbourg/css/page_detail.css" rel="stylesheet">
<title>斯特拉斯堡圣诞小镇</title>
</head>
<body>
<!--请将屏幕竖向浏览-->
          <div class="orientation_set">
              <div>
                  <img src="<?php echo _STATIC_?>vip/strasbourg/img/orientation.png" width="50" alt="" class="translate"><br>请将屏幕竖向浏览
              </div>
          </div>
<!--弹出框二维码-->
<div id="wrap" class="share_send">
	<?php if(!empty($headpic)):?>
		<img src="<?php echo $headpic ?>" class="cur_tu">
	<?php else:?>
		<img src="<?php echo _STATIC_?>vip/strasbourg/img/nor_tu.jpg" class="nor_tu">
	<?php endif;?>
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/share_send_tit.png" class="share_send_tit">
  <div class="share_main share_main_send">
    <ul>
        <li <?php if(in_array('1', $tags)) echo 'class="active"'?>><i class="share_tu1 tag" val='1'></i></li>
        <li <?php if(in_array('2', $tags)) echo 'class="active"'?>><i class="share_tu2 tag" val='2'></i></li>
        <li <?php if(in_array('3', $tags)) echo 'class="active"'?>><i class="share_tu3 tag" val='3'></i></li>
        <li <?php if(in_array('4', $tags)) echo 'class="active"'?>><i class="share_tu4 tag" val='4'></i></li>
        <li <?php if(in_array('5', $tags)) echo 'class="active"'?>><i class="share_tu5 tag" val='5'></i></li>
        <li <?php if(in_array('6', $tags)) echo 'class="active"'?>><i class="share_tu6 tag" val='6'></i></li>
    </ul>
  </div>
<div class="share_rule share_rule_two">
    <ul>
        <li>1.帮助好友点亮铭牌，助其获得100元优惠券。</li>
        <li>2.点击“我也要收集铭牌”就可参与"斯特拉斯堡圣诞集市"活动，同样有机会领取100元优惠券。</li>
        <li>（活动的解释权在法律规定的范围内归本司所有）</li>
    </ul>
  </div>
  <!--------分享出-------->
 <a href="/strasbourg/register/index" class="diag_btn share_send_btn">我也要收集铭牌</a> 
</div>

<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
<script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <?php
        $jssdk = new JSSDK(Yii::app()->params['strasbourg']['wxappid'], Yii::app()->params['strasbourg']['wxappsecret']);
        $signPackage = $jssdk->GetSignPackage();
        ?>
        <script>
                                            /*
                                             * 注意：
                                             *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
                                             */
                                            var title = '邀请函';//分享标题
                                            var desc = '斯特拉斯堡圣诞集市诚邀您参加活动，好吃好玩好礼尽在这里！';//分享描述
                                            var link = 'http://' + window.location.host + '/strasbourg/register/index';//分享链接
                                            var imgUrl = '<?php echo _STATIC_; ?>vip/strasbourg/img/share.png';//分享图标
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
  var flag='<?php echo $flag?>';
  var flag2='<?php echo $flag2?>';
  var fopenid='<?php echo $_GET['fopenid']?>';
  var obj=null;
   $('.tag').bind('click',function(){
	   if(flag2 == '1'){
		    alert('不能给自己点亮铭牌');
		    return false;
	   }
	   if(flag != '0'){
		    alert('您已经点亮过，每人只能点亮一次');
		    return false;
	   }
	   obj=$(this);
	    if(!obj.parent().hasClass('active')){
	    	flag='1';
	        $.post('/strasbourg/register/ajaxaddtag',{'tagindex':obj.attr('val'),'fopenid':fopenid},function(data){
	            var list=eval('('+data+')');
	            if(list.code != '10000'){
	            	alert(list.result);
	            	if(list.code == '20004'){
	            		location.reload();
	            	}
		        }else{
		        	obj.parent().addClass('active');
		            alert('点亮成功');
			    }
		    });
		}


   });

  </script>
<script type="text/javascript">
	$(function(){
  		//页面大小初始化
      (function(){
          var _width = document.body.clientWidth;
          var _dom = document.querySelector('#viewport');
          var scale = _width/320;
          _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
      })()
      //阻止页面背景划动
      $("[data-move]").bind("touchmove", function(e) {
         e.preventDefault();
      })
      //分享好友
      $("[data-share]").bind("click", function() {
          $(".share_bg").show();
      })
      //分享好友关闭
      $(".share_bg").bind("click", function() {
          $(".share_bg").hide();
      })
      //单击点亮
     // $(".share_main_send li").bind("click",function(){
      //    $(this).addClass("active");
      //})
		})
</script>
</body>
</html>
