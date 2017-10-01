<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>一汽丰田</title>
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            .login_box{
                width: 300px;
                height: 200px;
                background:#eeeeee;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -150px;
                margin-top: -100px;
                text-align: center;
            }
        </style>
    </head>
    <body>

        <div class="login_box">
            <div style='margin:auto;width: 200px;margin-top: 50px;line-height: 30px'>
                <div class="user" style="float:left">
                    <label>用&nbsp;户&nbsp;名:</label><span >一汽丰田</span>
                </div>
                <div class="password" style="float:left">
                    <label>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:</label>
                    <input type="text" style="width:120px" id='psw'>
                </div>
                <div style='float:left;margin-left: 70px;margin-top: 10px;'>
                    <input type='button' value='提交' style="width: 55px;height: 30px;" id='sub_btn'>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>vip/yiqi/js/jquery-2.1.1.min.js"></script>
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
                                    var title = '锐志2015狂欢周末，打造最嗨夏日狂欢，惊艳开启。';//分享标题
                                    var desc = '“志成一派”狂欢周末，等你来HIGH！';//分享描述
                                    var link = 'http://' + window.location.host + '/yiqi/index';//分享链接
                                    var imgUrl = '<?php echo _STATIC_; ?>vip/yiqi/img/img12.jpg?radom=<?php echo time(); ?>';//分享图标
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
                                                title: title, // 分享标题
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
        $(function(){
            //单击提交
            $('#sub_btn').bind('click',function(){
                var psw=$('#psw').val();
            if(psw == ''){
                alert('请输入密码');
                return false;
            }
                $.post('/yiqi/ajaxlogin',{'psw':psw},function(data){
                    var list=eval('('+data+')');
                    if(list.code != '10000'){
                        alert(list.result);
                    }else{
                        location.href='/yiqi/index';
                    }
                    
                });
            });
        });
    </script>
</html>
