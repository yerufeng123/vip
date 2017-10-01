<html>
    <body>
        <center>
        <h1>恭喜你赢的一张卡包<h1><br>
                <div id="batchAddCard" style="height: 30px;width: 100px;font-size: 24px;background-color: #ccc">立即领取</div>
        </center>

    </body>
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
                                alert('添加卡券失败');
                            } else if (res.err_msg == 'batch_add_card:cancel') {
                                alert('添加卡券取消');
                            } else if (res.err_msg == 'batch_add_card:ok') {
                                alert('添加卡券成功');
                            } else if (res.err_msg == 'access_deny') {
                                alert('链接里不带 wechat_card_js=1  参数');
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
    </script>
</html>