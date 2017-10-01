<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- 修改开始 -->
        <!-- 预加载页面 -->
        <!-- 修改开始 -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta id="viewport" name="viewport" content="width=415,user-scalable=no">
        <title>VIP后台</title>
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
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc">
            <div>
                <form action="/aotocom/admin" method="post" >

                    姓名：<input type="text" name="name" value="<?php echo $search['name']; ?>"> 
                    手机：<input type="text" name="phone" value="<?php echo $search['phone']; ?>"> 
                    邮箱：<input type="text" name="email" value="<?php echo $search['email']; ?>"> 
                    公司：<input type="text" name="company" value="<?php echo $search['company']; ?>">
                    链接：<input type="text" name="link" value="<?php echo $search['link']; ?>">

                    <input type="submit" value="检索"><input type="button" value="导出数据" id="dao_btn">
                </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th><th>姓名</th><th>手机</th><th>邮箱</th><th>公司</th><th>链接</th><th>创建日期</th><th>访问次数</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr><td><?php echo $key + 1; ?></td><td><?php echo $value['name'] ?></td><td><?php echo $value['phone'] ?></td><td><?php echo $value['email'] ?></td><td><?php echo $value['company'] ?></td><td><?php echo $value['link'] ?></td><td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td><td><?php echo $value['viewnum'] ?></td></tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <div >
                <?php echo $page; ?>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>

    <script>
        document.addEventListener("touchmove", function (e) {
            e.preventDefault()
        })
    </script>
    <script>
        $(function () {
           

            //单击导出数据
            $('#dao_btn').bind('click', function () {
                window.location.href = "/autocom/ajaxpushdata"
            });

        });
    </script>
</html>