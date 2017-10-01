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

<!---------------------- 分享好友 ---------------------->
<div class="share_bg" data-move>
    <span><img src="<?php echo _STATIC_?>vip/strasbourg/img/wechat_icon_arr.png" /><b>点击右上角分享好友</b></span>
</div>

<div id="wrap" class="share">
  <img src="<?php echo _STATIC_?>vip/strasbourg/img/share_tit.png" class="share_tit">
  <div class="share_main">
    <ul>
        <li <?php if(in_array('1', $tags)) echo 'class="active"'?>><i class="share_tu1" ></i></li>
        <li <?php if(in_array('2', $tags)) echo 'class="active"'?>><i class="share_tu2" ></i></li>
        <li <?php if(in_array('3', $tags)) echo 'class="active"'?>><i class="share_tu3" ></i></li>
        <li <?php if(in_array('4', $tags)) echo 'class="active"'?>><i class="share_tu4" ></i></li>
        <li <?php if(in_array('5', $tags)) echo 'class="active"'?>><i class="share_tu5" ></i></li>
        <li <?php if(in_array('6', $tags)) echo 'class="active"'?>><i class="share_tu6" ></i></li>
    </ul>
  </div>
  <div class="share_rule">
    <ul>
        <li>1.分享至朋友圈，邀请好友为您点亮全部圣诞集市铭牌即可获得100元优惠券。</li>
        <li>2.全部收藏后将获得凭证二维码，持此码于2015年12月5号至2016年1月4日到现场领取优惠券。</li>
        <li>（活动的解释权在法律规定的范围内归本司所有）</li>
    </ul>
  </div>
  <!--------分享好友-------->
 <a href="javascript:void(0)" class="diag_btn share_btn" data-share>分享朋友圈</a>
</div>

<script src="<?php echo _STATIC_?>vip/strasbourg/js/zepto.min.js"></script>
<script type="text/javascript">
	$(function(){
		//$("body").height($("body").height());
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
		})
</script>
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
                                            var title = '<?php echo $name;?>邀您点亮铭牌';//分享标题
                                            var desc = '赶快帮我点亮铭牌吧！参与就有机会获得活动优惠券。';//分享描述
                                            var link = 'http://' + window.location.host + '/strasbourg/register/share?fopenid=<?php echo $openid;?>';//分享链接
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
                                                            location.reload();
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
                                                        	location.reload();
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
