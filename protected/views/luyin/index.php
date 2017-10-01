<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="email=no">
        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <!-- UC强制全屏 --><meta name="full-screen" content="yes">
        <!-- UC应用模式 --><meta name="browsermode" content="application">
        <!-- QQ强制全屏 --><meta name="x5-fullscreen" content="true">
        <!-- QQ应用模式 --><meta name="x5-page-mode" content="app">
        <title>猴年庆新春</title>
        <style>
        </style>
        <link rel="stylesheet" href="<?php echo _STATIC_ ?>vip/luyin/css/common.css">
    </head>
    <body>
        <div id="wrap" class="">
            <div class="page">
                <ul class="pageList">
                    <li class="pageLi userPage"  style="background-image:url(<?php echo $data['myinfo']['bgpic'] ?>)" id="bgpic">
                        <div class="userMask"></div>
                        <div class="myPhoto" style="background-image:url(<?php echo $data['myinfo']['headpic'] ?>)" id="headpic"></div>
                        <span class="myName"><?php echo $data['myinfo']['name'] ?></span>
                        <!-- 上传完成后会添加data-audio属性 -->
                        <!-- <div class="myAudio" data-audio="12345"></div> -->
                        <div class="myAudio" id="myaudio" <?php if ($data['myinfo']['video']) echo 'data-audio="' . $data['myinfo']['video'] . '"'; ?>></div>
                        <audio id="audio"   preload='auto' src="<?php echo $data['myinfo']['video']; ?>"></audio>
                    </li>
                    <li class="pageLi recordPage">
                        <ul class="recordList" id="recordList">
                            <?php foreach ($data['videos'] as $key => $video): ?>
                                <li class="recordLi">
                                    <div class="recordMark"></div>
                                    <div class="recordMain" data-audio="<?php echo $video->localid ?>">
                                        <?php echo date('Y.m.d', $video->ctime); ?>
                                        <span class="recordDelete">删除</span>
                                        <span class="recordUpload <?php if ($video->state == '1') echo 'finish'; ?>"></span><!-- finish load-->
                                    </div>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                        <div class="recordHead">
                            <div class="recordBtn" id="recordBtn">录音</div>
                        </div>
                        <div class="recordTip">最多录制十条语音，请及时删除</div>
                    </li>
                    <li class="pageLi audioPage show">
                        <div class="search">
                            <div class="searchByname">搜索</div>
                        </div>
                        <dl class="audioList">
                            <dt class="audioTit" id="D">D</dt>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="逗B班长">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dt class="audioTit" id="F">F</dt>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="飞奔的五花肉">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)" ></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="飞奔的五花肉">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)" ></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="飞奔的五花肉">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)" ></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="飞奔的五花肉">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)" ></div>
                            </dd>
                            <dt class="audioTit" id="L">L</dt>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="LT">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dt class="audioTit" id="M">M</dt>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="漫陀螺">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="漫陀螺">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="漫陀螺">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="漫陀螺">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                            <dd class="audioLi" data-down="" data-pic="<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg" data-photo="<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg" data-name="漫陀螺">
                                <div class="audioPic" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                            </dd>
                        </dl>
                        <div class="searchList">
                            <a href="#D" class="searchLi">D</a>
                            <a href="#F" class="searchLi">F</a>
                            <a href="#L" class="searchLi">L</a>
                            <a href="#M" class="searchLi">M</a>
                        </div>
                    </li>
                    <li class="pageLi sharePage"></li>
                </ul>
                <ul class="tabList">
                    <li class="tabLi">
                        <div class="icons user"></div>
                        我的信息
                    </li>
                    <li class="tabLi">
                        <div class="icons record"></div>
                        语音录制
                    </li>
                    <li class="tabLi click">
                        <div class="icons audio"></div>
                        通信录
                    </li>
                    <li class="tabshare">
                        <div class="icons share"></div>
                        分享
                    </li>
                </ul>
            </div>
            <div class="audioShow" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo3.jpg)">
                <div class="audioMask"></div>
                <div class="audioP" style="background-image:url(<?php echo _STATIC_ ?>vip/luyin/img/photo.jpg)"></div>
                <div class="audioN">飞奔的五花肉</div>
                <div class="audioTip">正在连接中....</div>
                <ul class="audioB">
                    <li class="icons audioOff"></li>
                </ul>
            </div>
            <div class="tips">你好哈</div>
        </div>
        <input type="hidden" id="localIds"  value="" />
        <input type="hidden" id="serverId" value=""/>
        <!-- 加载动画 -->
        <div class="maskLoad" style="display:none"></div>
        <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js">//JQ</script>

        <script type="text/javascript">
            var luflag = 0;
            var boflag = 0;
            var lulocalId = null;
            $(document).ready(function () {
                //tab切换
                $('.tabLi').on('click', function (e) {
                    $(this).addClass('click').siblings('.tabLi').removeClass('click');
                    var _index = $(this).index();
                    $('.pageLi').removeClass('show').eq(_index).addClass('show');
                    e.stopPropagation();
                    e.preventDefault();
                })
                $('.tabshare').on('click', function (e) {
                    alert('分享接口')
                })
                $('.myPhoto').on('click', function (e) {
                    paizhao('headpic');
                })
                $('.userMask').on('click', function (e) {
                    paizhao('bgpic');
                })

                //单击我的信息----》录音按钮
                $('#myaudio').bind('click', function () {
                    if ($('#myaudio').attr('data-audio') == undefined) {
                        $('.tabLi').eq(1).click();
                        return false;
                    }

                    var audio = document.getElementById('audio');
                    audio.addEventListener('ended', function () {
                        boflag = 0;
                    }, false);

                    if (boflag == 1) {
                        boflag = 0;
                        audio.pause();
                        return false;
                    }

                    if (boflag == 0) {
                        boflag = 1;
                        audio.play();
                        return false;
                    }

                });

                //单击语音录制----》录音按钮
                $('#recordBtn').bind('click', function () {
                    if (luflag == 0) {
                        luflag = 1;
                        start();
                        return false;
                    }
                    if (luflag == 1) {
                        luflag = 0;
                        stop();
                        return false;
                    }

                });

                //单击语音录制----》备选按钮
                $(document).on('click','.recordUpload', function () {
                    var localId = $(this).parent().attr('data-audio');
                    var obj = $(this);
                    //更改该条语音状态
                    $.post('/luyin/ajaxupdateaudio', {'localId': localId}, function (data) {
                        var list = eval(data);
                        if (list.code != '10000') {
                            alert(list.result);
                        } else {
                            $('.recordUpload').removeClass('finish');
                            obj.addClass('finish');
                            $('#myaudio').attr('data-audio', localId);
                            $('#audio').attr('src', localId);
                        }
                    }, 'json');
                });
                
                //单击语音录制----》删除按钮
                $(document).on('click','.recordDelete', function () {
                    var localId = $(this).parent().attr('data-audio');
                    var obj = $(this);
                    //更改该条语音状态
                    $.post('/luyin/ajaxdeleteaudio', {'localId': localId}, function (data) {
                        var list = eval(data);
                        if (list.code != '10000') {
                            alert(list.result);
                        } else {
                            obj.parent().parent().remove();
                            if(localId == $('#myaudio').attr('data-audio')){
                                $('#myaudio').attr('data-audio',null);
                                $('#audio').attr('src','');
                            }
                        }
                    }, 'json');
                });

            })

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
             var title = '语音祝福';//分享标题
            var desc = '快来邀请你的好友一起玩果冻工作室的语音祝福游戏吧';//分享描述
            var link = 'http://' + window.location.host + '/luyin/share?_wv=1&fopenid=<?php echo $data['openid'];?>';//分享链接
            var imgUrl = '<?php echo _STATIC_; ?>vip/pingan/img/share.png';//分享图标
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
                    'chooseImage',
                    'previewImage',
                    'uploadImage',
                    'downloadImage',
                    'closeWindow',
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
                     'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                ]
            });

            wx.ready(function () {

                //监听语音播放完毕接口
                wx.onVoicePlayEnd({
                    success: function (res) {
                        var localId = res.localId; // 返回音频的本地ID
                    }
                });
                
                 //分享到朋友圈
                wx.onMenuShareTimeline({
                    title: desc, // 分享标题
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

            });

            //拍照或从手机中选择
            function paizhao(type) {
                wx.chooseImage({
                    success: function (res) {
                        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                        if (localIds.length == 0) {
                            alert('请先选择照片');
                            return false;
                        }
                        if (localIds.length > 1) {
                            alert('目前上传只支持单张');
                            return false;
                        }
                        $('#localIds').val(localIds);
                        wx.uploadImage({
                            localId: $('#localIds').val(), // 需要上传的图片的本地ID，由chooseImage接口获得
                            isShowProgressTips: 1, // 默认为1，显示进度提示
                            success: function (res) {
                                var serverId = res.serverId; // 返回图片的服务器端ID
                                $('#serverId').val(serverId);
                                shangchuan(type);
                                //alert('已选择1张图片');
                            }
                        });
                    }
                });
            }


            //上传图片接口---->('大图片就会失败’)
            function shangchuan(type) {
                var serverId = $('#serverId').val();
                $.post('/luyin/ajaxgetmetarial', {'serverId': serverId, 'type': type}, function (data) {
                    var list = eval('(' + data + ')');
                    if (list.code != '10000') {
                        if (list.result == 'media_id missing') {
                            alert('请先单击左侧按钮，选择照片或拍照');
                            return false;
                        }
                        alert(list.result);
                    } else {
                        if (type == 'headpic') {
                            $('#headpic').css('background-image', 'url(' + list.result + ')');
                        }
                        if (type == 'bgpic') {
                            $('#bgpic').css('background-image', 'url(' + list.result + ')');
                        }
                    }
                });
            }


          

            //上传语音
            function upload(localId) {
                wx.uploadVoice({
                    localId: localId, // 需要上传的音频的本地ID，由stopRecord接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回音频的服务器端ID
                        $.post('/luyin/ajaxgetmetarial2', {'serverId': serverId}, function (data) {
                            var list = eval('(' + data + ')');
                            if (list.code != '10000') {
                                alert(list.result);
                            } else {
                                var html = '';
                                html += '<li class="recordLi">';
                                html += '<div class="recordMark"></div>';
                                html += '<div class="recordMain" data-audio="' + list.result + '">';
                                html += '<?php echo date('Y.m.d', time()); ?>';
                                html += '<span class="recordDelete">删除</span>';
                                html += '<span class="recordUpload"></span>';
                                html += '</div>';
                                html += '</li>';
                                $('#recordList').append(html);
                            }
                        });
                    }
                });
            }


            //开始录音
            function start() {
                wx.startRecord();
            }

            //停止录音
            function stop() {
                wx.stopRecord({
                    success: function (res) {
                        var localId = res.localId;
                        upload(localId);
                    }
                });
            }


        </script>

    </body>
</html>