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
        <title>途家后台</title>
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
                <form action="/tujia/admin" method="post" >

                    姓名：<input type="text" name="name" value="<?php echo $search['name']; ?>"> 
                    手机：<input type="text" name="phone" value="<?php echo $search['phone']; ?>"> 
                    房源：<input type="text" name="room" value="<?php echo $search['room']; ?>"> 
                    邀请人：<input type="text" name="fname" value="<?php echo $search['fname']; ?>">
                    预约码：<input type="text" name="yym" value="<?php echo $search['code']; ?>">

                    <input type="submit" value="检索"><input type="button" value="导出数据" id="dao_btn">
                </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th><th>姓名</th><th>手机</th><th>房源</th><th>邀请人</th><th>预约码</th><th>入住日期</th><th>填写日期</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr><td><?php echo $key + 1; ?></td><td><?php echo $value['name'] ?></td><td><?php echo $value['phone'] ?></td><td><?php echo $value['room'] ?></td><td><?php echo $value['fname'] ?></td><td><?php echo $value['code'] ?></td><td><?php echo $value['year'] . '-' . $value['mouth'] . '-' . $value['day'] ?></td><td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td></tr>
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
                window.location.href = "/tujia/ajaxpushdata"
            });

        });
    </script>
</html>