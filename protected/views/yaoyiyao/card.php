<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <!--<meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">-->
        <meta name="viewport" content="width=415,minimum-scale=0.7,maximum-scale=2.0,user-scalable=no">
        <link type="text/css" href="<?php echo _STATIC_; ?>vip/yaoyiyao/css/common.css" rel="stylesheet">
        <title>盛景摇一摇</title>
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
        <div id="wrap" class="wrap">
            <section class="page1 page_body">
                <div class="icon_card">
                    <img src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/icon_card.png" />
                </div>
                <div class="icon_click">
                    <img class="text_click" src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/text_click.png" />
                    <img class="icon_line" src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/icon_line.png" />
                </div>
                <div class="present_box" id="batchAddCard">
                    <img src="<?php echo _STATIC_; ?>vip/yaoyiyao/img/present_box.png" />
                </div>
            </section>
        </div>
        <script src="<?php echo _STATIC_; ?>vip/yaoyiyao/js/jquery-2.1.1.min.js"></script>
        <script>
            document.addEventListener("touchmove", function(e) {
                e.preventDefault();
            })
        </script>	
        <script>
            $(document).ready(function() {


            });
        </script>
        <script>
            //记得添加版本判断  如果小于6.0提示用户卡包js无效
            var readyFunc = function onBridgeReady() {
                document.querySelector('#batchAddCard').addEventListener('click',
                        function(e) {
                            WeixinJSBridge.invoke('batchAddCard', {
                                "card_list": [
                                    {
                                        "card_id": "<?php echo $cardid ?>",
                                        "card_ext": "<?php echo $card_ext; ?>"
                                    },
                                ]
                            },
                            function(res) {
                                if (res.err_msg == 'batch_add_card:fail') {
                                    window.location.href='/yaoyiyao/index';
                                    alert('卡券领取失败');
                                    //alert('添加卡券失败');
                                } else if (res.err_msg == 'batch_add_card:cancel') {
                                    //alert('添加卡券取消');
                                } else if (res.err_msg == 'batch_add_card:ok') {
                                    alert('卡券领取成功');
                                     window.location.href='/yaoyiyao/index';
                                    //alert('添加卡券成功');
                                } else if (res.err_msg == 'access_deny') {
                                    alert('链接里不带 wechat_card_js=1  参数');
                                } else {
                                    alert(res.err_msg);
                                }
                            });
                        });
            }
            if (typeof WeixinJSBridge === "undefined") {
                document.addEventListener('WeixinJSBridgeReady', readyFunc, false);
            }
            else {
                readyFunc();
            }
        </script>
    </body>
</html>
