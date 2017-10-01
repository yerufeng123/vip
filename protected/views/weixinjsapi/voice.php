<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>音频接口</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .main{
                width: 400px;
                height: 300px;
                background: #cccccc;
                position: absolute;
                left: 50%;
                top:50%;
                margin-left: -200px;
                margin-top: -150px;
                text-align: center;
                line-height: 50px;
            }
        </style>
    </head>
    <body>
        
        <div class="main">
            <input type="button" value="开始录音" onclick="start();">
            <input type="button" value="停止录音" onclick="stop();">
            <input type="button" value="播放录音" onclick="play();">
            <input type="button" value="暂停播放" onclick="pause();">
            <input type="button" value="停止播放" onclick="stop2();">
            <input type="button" value="上传录音" onclick="upload();">
            <input type="button" value="下载录音" onclick="download();">
            <input type="button" value="翻译录音" onclick="translate1();">
            <input type="hidden" value="" id="localId">
            <input type="hidden" value="" id="serverId">
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.3.min.js<?php echo (Yii::app()->params['common']['isradom']) ? '?radom=' . time() : ''; ?>"></script>
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
                    debug: true,
                    appId: '<?php echo $signPackage["appId"]; ?>',
                    timestamp: <?php echo $signPackage["timestamp"]; ?>,
                    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
                    signature: '<?php echo $signPackage["signature"]; ?>',
                    jsApiList: [
                        // 所有要调用的 API 都要加到这个列表中
                        'startRecord',
                        'stopRecord',
                        'pauseVoice',
                        'playVoice',
                        'stopVoice',
                        'uploadVoice',
                        'downloadVoice',
                        'onVoiceRecordEnd',
                        'onVoicePlayEnd',
                        'translateVoice',
                    ]
                });
                wx.ready(function () {
                    //监听录音自动停止接口
                    wx.onVoiceRecordEnd({
                        // 录音时间超过一分钟没有停止的时候会执行 complete 回调
                        complete: function (res) {
                            var localId = res.localId;
                            alert(localId);
                        }
                    });

                    //监听语音播放完毕接口
                    wx.onVoicePlayEnd({
                        success: function (res) {
                            var localId = res.localId; // 返回音频的本地ID
                        }
                    });
                });

                //开始录音
                function start() {
                    wx.startRecord();
                }

                //停止录音
                function stop() {
                    wx.stopRecord({
                        success: function (res) {
                            var localId = res.localId;
                            $('#localId').val(localId);
                        }
                    });
                }



                //播放录音
                function play() {
                    wx.playVoice({
                        localId: $('#localId').val(), // 需要播放的音频的本地ID，由stopRecord接口获得
                    });
                }
                //暂停播放
                function pause() {
                    wx.pauseVoice({
                        localId: $('#localId').val(), // 需要暂停的音频的本地ID，由stopRecord接口获得
                    });
                }
                //停止播放
                function stop2() {
                    wx.stopVoice({
                        localId: $('#localId').val(), // 需要停止的音频的本地ID，由stopRecord接口获得
                    });
                }
                //智能识别音频内容,translate好像冲突不能用
                function translate1() {
                    wx.translateVoice({
                        localId: $('#localId').val(), // 需要识别的音频的本地Id，由录音相关接口获得
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            alert(res.translateResult); // 语音识别的结果
                        }
                    });
                }
                
                //上传语音
                function upload() {
                    wx.uploadVoice({
                        localId: $('#localId').val(), // 需要上传的音频的本地ID，由stopRecord接口获得
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var serverId = res.serverId; // 返回音频的服务器端ID
                            $('#serverId').val(serverId);
                        }
                    });
                }

                //下载语音
                function download() {
                    wx.downloadVoice({
                        serverId: $('#serverId').val(), // 需要下载的音频的服务器端ID，由uploadVoice接口获得
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var localId = res.localId; // 返回音频的本地ID
                            alert(localId);
                        }
                    });
                }

                

    </script>
</html>
