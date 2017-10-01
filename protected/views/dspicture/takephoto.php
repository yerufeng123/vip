<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta id="viewport" name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link type="text/css" href="<?php echo _STATIC_ ;?>vip/dspicture/css/share.css" rel="stylesheet">
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
<title>DS汽车</title>
</head>
<body>
<div id="wrap" class="shop_login">
  	<div class="shop_share"> 
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/logo.png" class="logo">
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/p6_show.png" class="p6_show">
        <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/share_tit.png" class="share_tit">
        <div class="share_block">
          <div class="share_main">
          <div style="width: 231px; height: 156px;position: relative;" id="pic_box" class="share_tu">
		      <div class="cutbox"></div>
	       </div>
            <!--  <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/share_tu.jpg" class="share_tu"> -->
            <div class="share_name">
                <h3><?php echo $user->name;?></h3>
                <span>所在城市：<?php echo $user->city;?></span>
            </div>
          </div>
          <p class="share_detail">
           <textarea id="text"></textarea>
        </p>
         <img src="<?php echo _STATIC_ ;?>vip/dspicture/img/share_btn.png" class="share_btn now_share">
          <div class="share_bg" style="display: none;">
                <p><img src="<?php echo _STATIC_ ;?>vip/dspicture/img/wechat_icon_arr.png" /><span><b>请分享给你的朋友们吧，<br/>让大家一睹你的前卫风采</b></span></p>
          </div>

        </div>
	</div>
</div>
<script src="<?php echo _STATIC_ ;?>vip/dspicture/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
  $(function(){
    //页面大小初始化
        (function(){
            var _width = document.body.clientWidth;
            var _dom = document.querySelector('#viewport');
            var scale = _width/320;
            _dom.setAttribute('content','width=320,user-scalable=no,initial-scale='+scale);
        })()

    $("body").height($("body").height());
//       $('.now_share').bind('click', function() {
//                 $('.share_bg').show();
//             });
      $(".share_bg").bind("touchmove",function(e){
        e.preventDefault();
        })
      $('.share_bg').bind('click', function() {
                $('.share_bg').hide();
            });

    })
</script>
<script src="<?php echo _STATIC_ ;?>vip/dspicture/js/resources.js"></script>
<script src="<?php echo _STATIC_ ;?>vip/dspicture/js/jquery.crop.js"></script>
<script src="<?php echo _STATIC_ ;?>js/globals.js"></script>
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

</script>

 <script>
      //用户对象
      var person={
            pic:'',//身份证图片
            text:'',//输入文本
      }
 
      
      
      //用户报告错误
      person.findError=function(errMsg,type){
         switch(type){
         case 1:
             //完善信息框
             $('.diag_block').hide();
        	 $(".mask").show();
        	 $('.info_block').show();
             break;
         default :
             //普通错误
        	 alert(errMsg);
             break;
         }
  	   
  	    return false;
      }

      //用户检查输入
      person.checkInput=function(){
    	  if(this.pic == '' || this.pic == undefined){
  	  	    this.findError('请先保存图片');
  	  	  	return false;
  	  	 }
    	  if(this.text == ''){
  	  	    this.findError('请输入文本内容');
  	  	  	return false;
  	  	 }
    	 return true;
      }

      //用户更新资料
      person.update=function(){
  	     $.post('/dspicture/ajaxuserupdate',{'pic':person.pic,'text':person.text},function(data){
   	    	var list=eval('('+data+')');
            if(list.code != '10000'){
                alert(list.result);
            }else{
            	//去掉分享屏蔽按钮
              	wx.showMenuItems({
              	    menuList: [
                          'menuItem:share:appMessage',
                          'menuItem:share:timeline',
                          'menuItem:share:qq',
                          'menuItem:share:weiboApp',
                          'menuItem:favorite',
                          'menuItem:share:facebook',
                          'menuItem:share:QZone',
                      ]
              	});
                  //TODO:弹分享框
              	$('.share_bg').show();
            }
  	  	 });
      }  
</script>
 
 
 
 <script>
                                    /*
                                     * 注意：
                                     *需要到公众号设置——〉功能设置——〉JS接口安全域名 中添加当前域名
                                     */
                                    var title = 'DS';//分享标题
                                    var desc = 'DS 前卫车模SHOW，等你来参加哟！';//分享描述
                                    var link = 'http://' + window.location.host + '/dspicture/share?fopenid=<?php echo $openid?>';//分享链接
                                    var imgUrl = '<?php echo _STATIC_?>vip/dspicture/img/sharepic.png';//分享图标
                                        var type = '';// 分享类型,music、video或link，不填默认为link
                                        var dataUrl = '';//如果type是music或video，则要提供数据链接，默认为空
                                        wx.ready(function() {
                                        	wx.hideMenuItems({
                                        	    menuList: [
                                        	       'menuItem:share:appMessage',
                                        	       'menuItem:share:timeline',
                                        	       'menuItem:share:qq',
                                        	       'menuItem:share:weiboApp',
                                        	       'menuItem:favorite',
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

                                            //捕捉到用户上传图片事件
                                         //pic.id='pic_box';
                                        	//person.paizhao(pic);
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

                                            //分享到QQ空间
                                            wx.onMenuShareQZone({
                                                title: title, // 分享标题
                                                desc: desc, // 分享描述
                                                link: link, // 分享链接
                                                imgUrl: imgUrl, // 分享图标
                                                success: function() {
                                                    // 用户确认分享后执行的回调函数
                                                    //shareok('qzone');
                                                },
                                                cancel: function() {
                                                    // 用户取消分享后执行的回调函数
                                                    // sharecancel('qzone');
                                                }
                                            });

                                        });
    </script>
 
 
 



<script>
		$(function(){
			//var w = $(window).width();
			//var h = $(window).height();
			var w = $('#pic_box').width();
			var h = $('#pic_box').height()+60;
			$('.cutbox').crop({
				w:w,
				h:h-60,
				r:w*0.75*0.5,
				res:'<?php echo $_GET['path'];?>',
				//res:'/static/vip/dspicture/img/test.jpg',
				callback:function(ret){
					$('#pic_box').html("<img src="+ret+">");
					person.pic=ret;
				}
			});


			
			//捕捉到用户单击分享事件
	        $('.now_share').bind('click',function(){
		        person.text=$('#text').val();
	            if(person.checkInput()){
		            person.update();
	            }
	        });
			
		});
</script>
</body>
</html>
