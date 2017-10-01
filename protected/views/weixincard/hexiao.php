<html>

    <body>
        <center>
        <h1>你有优惠券</h1>
        <div id="chooseCard" style="height: 30px;width: 100px;font-size: 24px;background-color: #ccc">未使用</div>
        </center>
    </body>
    <script src="<?php echo _STATIC_ .'js/jquery-1.8.3.min.js'?>"></script>

    <script>
        $(function() {
            var readyFunc = function onBridgeReady() {
                //绑定关注事件
                document.querySelector('#chooseCard').addEventListener('click', function(e) {
                    WeixinJSBridge.invoke('chooseCard', {
                        "app_id": "<?php echo $sign['app_id']?>",
                        "location_id": "<?php echo $sign['location_id']?>",
                        "sign_type": "SHA1",
                        "card_sign": "<?php echo $sign['cardsign']?>",
                        "card_id": "<?php echo $sign['card_id']?>",
                        "card_type": "<?php echo $sign['card_type']?>",
                        "time_stamp": <?php echo $sign['timestamp']?>,
                        "nonce_str": "<?php echo $sign['nonce_str']?>"
                    },
                    function(res) {
                        if (res.err_msg == 'choose_card:fail') {
                            alert('选取卡券失败');
                        } else if (res.err_msg == 'choose_card:cancel') {
                            alert('选取卡券取消');
                        } else if (res.err_msg == 'choose_card:ok') {
                            var arrinfo = eval(res.choose_card_info);
                            $.post('<?php echo Yii::app()->params['prefixurl']?>/card/cardlist', {'card_id':arrinfo[0].card_id,'encrypt_code': arrinfo[0].encrypt_code}, function(data) {
                                alert(data);
                            });
                        } else {

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
        });
    </script>
</html>