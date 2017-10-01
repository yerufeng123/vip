<!--正文导航-->
<?php $this->renderPartial("/public/qianhead") ?>
</head>
<body>

    <div id="wrap" class="page1">
        <header class="header">
            <h3><?php if(mb_strlen($product['name'], 'utf-8') >8){echo msubstr($product['name'], 0, 8);}else{echo $product['name'];} ?></h3>
            <section>
                <nav id="top_nav" class="click">
                    <span data-click="#top_nav"></span>
                    <ul class="uls open">
                        <?php
                        if (isset($productlist) && is_array($productlist)) {
                            foreach ($productlist as $key => $value) {
                                echo '<li><a href="/qizheng/index/index?pid=' . $value['id'] . '">' . $value['name'] . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </section>
        </header>
        <article class="main">
            <section class="slide_img">
                <div id="center">
                    <ul id="uls">
                        <?php
                        if (isset($product['pic']) && is_array($product['pic'])) {
                            foreach ($product['pic'] as $key => $value) {
                                if (!empty($value)) {
                                    echo '<li><img src="' . Yii::app()->request->hostInfo . '/' . $value . '" /></li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div id="line">
                    <ul id="thelist">

                    </ul>
                </div>
            </section>
            <span class="product_frame">产品说明</span>
            <section class="content">
                <dl>
                    <dt>产品展示</dt>
                    <?php if(!empty($product['product_pic'])):?>
                    <dd><img src="<?php echo Yii::app()->request->hostInfo . '/' . $product['product_pic']; ?>" /></dd>
                    <?php endif;?>
                </dl>

                <dl>
                    <dt>适应症</dt>
                    <dd><?php echo $product['introduction'] ?></dd>
                </dl>

                <dl>
                    <dt>用法用量</dt>
                    <dd><?php echo $product['use_method'] ?></dd>
                </dl>

                <dl>
                    <dt>不良反应</dt>
                    <dd><?php echo $product['bad_reaction'] ?></dd>
                </dl>

                <dl>
                    <dt>禁忌</dt>
                    <dd><?php echo $product['taboo'] ?></dd>
                </dl>
                <?php
                if (isset($product['other']) && is_array($product['other'])) {
                    foreach ($product['other'] as $key => $value) {
                        echo '<dl>';
                        echo '<dt>' . $value[0] . '</dt>';
                        echo '<dd>' . $value[1] . '</dd>';
                        echo '</dl>';
                    }
                }
                ?>
            </section>
            <span class="product_frame">产品资料</span>
            <section class="img_show">
                <ul>
                    <?php
                    if (isset($information) && is_array($information)) {
                        foreach ($information as $key => $value) {
                            echo '<li>';
                            echo '<a href = "/qizheng/index/contentlist?Iid=' . $value['id'] . '&Ititle=' . $value['title'] . '">';
                            echo '<img src = "' . Yii::app()->request->hostInfo . '/' . $value['little_pic'] . '" />';
                            echo '<div><p>' . $value['title'] . '</p></div>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </section>
            <span class="product_frame">推广工具</span>
            <section class="img_show">
                <ul>
                    <?php
                    if (isset($link) && is_array($link)) {
                        foreach ($link as $key => $value) {
                            echo '<li>';
                            echo '<a href="' . $value['url'] . '">';
                            echo '<img src="' . Yii::app()->request->hostInfo . '/' . $value['little_pic'] . '" />';
                            echo '<div>';
                            echo '<p>' . $value['title'] . '</p>';
                            echo '</div>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </section>
        </article>
        <footer class="footer" style="position:relative">
            <img src="<?php echo _STATIC_ ?>img/logo.png" />西藏奇正藏药股份有限公司
        </footer>
        <section id="other">
            <div data-scroll="200" data-scrollto id="scroll_top" class="scroll_top"></div>
        </section>
    </div>


    <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/qizheng/'; ?>js/jquery-1.8.1.min.js"></script>
    <script src="<?php echo _STATIC_ . 'vip/qizheng/'; ?>js/script.js"></script>
    <script>
        $(document).ready(function(e) {
            //页面初始化
            $("#top_nav").click(function() {
                $(this).toggleClass("open");
                $(".uls").toggle();
            })
            $("#scroll_top").click(function() {
                $("body,html").animate({scrollTop: 0}, 1000);
            });

            function showScroll() {
                $(window).scroll(function() {
                    var scrollValue = $(window).scrollTop();
                    //alert(scrollValue);
                    console.log($(window).scrollTop());
                    scrollValue > 50 ? $('#scroll_top').fadeIn(1500) : $("#scroll_top").fadeOut(1500);
                });

            }
            showScroll();
        });

    </script>
</body>
</html>   

