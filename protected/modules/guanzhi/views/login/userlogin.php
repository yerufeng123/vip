<!--正文导航-->
<?php $this->renderPartial("/public/qianhead") ?>
<style>
	#wrap{position:relative;min-height:100%}
</style>
</head>
<body>
    <div id="wrap" class="page1">
        <img class="login_img" src="<?php echo _STATIC_ . 'vip/guanzhi/'; ?>img/img9.png" />
        <article class="login_cont">
            <label>员工编号：</label><input class="num" id="usercode" name="usercode" type="text" />
            <span class="login" onclick="tijiao();"></span>
        </article>
        <footer class="footer">
            <img src="<?php echo _STATIC_ . 'vip/guanzhi/'; ?>img/logo.png" />西藏奇正藏药股份有限公司
        </footer>

    </div>
    <!-- 登录失败弹出层 -->
    <div class="mask">
        <div class="mask_pro">
            <img class="close" src="<?php echo _STATIC_ . 'vip/guanzhi/'; ?>img/error.png" />
            <span id="maskcontent">编号错误，请重新输入！</span>
            <span class="confirm"></span>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/guanzhi/'; ?>js/jquery-1.8.1.min.js"></script>
    <script>
                $(function() {
                    $("body").height($(window).height());
                    $(".close,.confirm").bind("click", function() {
                        $(".mask").hide();
                    })
                });

    </script>

</body>
<script>
    function tijiao() {
        var usercode = $('#usercode').val();
        if (usercode == '') {
            $('.mask').show();
            $('#maskcontent').html('请输入员工编号!');
            return false;
        }
        $.post('/guanzhi/login/userloginon', {'usercode': usercode}, function(data) {
            if (data != '') {
                $('.mask').show();
                $('#maskcontent').html(data);
            } else {
                window.location.href = "/guanzhi/index/index";
            }

        });
        return false;
    }
</script>
</html>                      