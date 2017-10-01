<!--正文导航-->
<?php $this->renderPartial("/public/qianhead") ?>
<style>
  .login_cont{width:300px;text-align:left;margin:45px auto;padding-bottom:50px;margin-bottom:50px;}
</style>
</head>
<body>
    <div id="wrap" class="page1">
        <header class="header">
            <h3><?php if(mb_strlen($Ititle, 'utf-8') >8){echo msubstr($Ititle, 0, 8);}else{echo $Ititle;} ?></h3>
        </header>
        <article class="login_cont">
            <span class="analyze"><?php if(mb_strlen($Ititle, 'utf-8') >8){echo msubstr($Ititle, 0, 8);}else{echo $Ititle;} ?></span>

            <?php
            if (isset($contentlist) && is_array($contentlist)) {
                foreach ($contentlist as $key => $value) {
                    echo '<dl>';
                    echo '<a href="/qizheng/content/contentinfo?Icid=' . $value['id'] . '">';
                    echo '<dt><img src="' . _STATIC_ . 'vip/qizheng/img/icon.png" /></dt>';
                    echo '<dd>';
                    if(mb_strlen($value['title'], 'utf-8') >20){
                        echo msubstr($value['title'], 0, 20);
                    }else{
                        echo $value['title'];
                    }
                    echo '</dd>';
                    echo '</a>';
                    echo '</dl>';
                }
            }
            ?>
        </article>
        <footer class="footer">
            <img src="<?php echo _STATIC_ . 'vip/qizheng/'; ?>img/logo.png" />西藏奇正藏药股份有限公司
        </footer>
    </div>
    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/qizheng/'; ?>js/jquery-1.8.1.min.js"></script>
    <script>
        $(".close").bind("click", function() {
            $(".mask").hide();
        })
    </script>

</body>
</html>                      