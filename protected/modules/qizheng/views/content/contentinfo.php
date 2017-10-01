<?php
require_once (dirname(__FILE__) . '/common.php');
?>
<!--正文导航-->
<?php $this->renderPartial("/public/qianhead") ?>
</head>
<body>

    <div id="wrap" class="page1">
        <header class="header">
            <h3><?php if(mb_strlen($contentinfo['title'], 'utf-8') >8){echo msubstr($contentinfo['title'], 0, 8);}else{echo $contentinfo['title'];} ?></h3>
        </header>
        <article class="about_product">
            <?php echo stripslashes($contentinfo['content']); ?>
        </article>
        <footer class="footer" style="position:relative">
            <img src="<?php echo _STATIC_ ?>img/logo.png" />西藏奇正藏药股份有限公司
        </footer>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>js/jquery-1.8.1.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</body>
<script>
    var shareLink = "<?php echo Yii::app()->request->hostInfo?>/content/contentinfo?Icid=<?php echo $contentinfo['id']?>";
    var imgUrl = "<?php echo _STATIC_ ?>img/qizhenglogo.png";
    var sharetitle = '<?php echo $contentinfo['title']; ?>';
    // $(function() {
    wx.config({
        appId: '<?php echo $signPackage["appId"]; ?>',
        timestamp: <?php echo $signPackage["timestamp"]; ?>,
        nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
        signature: '<?php echo $signPackage["signature"]; ?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
        ]
    });
    wx.ready(function() {
        // 在这里调用 API
        wx.onMenuShareTimeline({
            title: sharetitle, // 分享标题
            link: shareLink, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function() {
                // 用户确认分享后执行的回调函数
            },
            cancel: function() {
                // 用户取消分享后执行的回调函数
            }
        });

        wx.onMenuShareAppMessage({
            title: sharetitle, // 分享标题
            desc: '', // 分享描述
            link: shareLink, // 分享链接
            imgUrl: imgUrl, // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function() {
                // 用户确认分享后执行的回调函数
            },
            cancel: function() {
                // 用户取消分享后执行的回调函数
            }
        });
    });
    // });
</script>
</html>                      