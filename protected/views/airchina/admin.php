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
        <title>国航后台</title>
    </head>
    <body>
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc">
            <div>
                <form action="/airchina/admin" method="post" >

                    类型：<select name="type">
                        <option value="" <?php if ($search['type'] == '') echo 'selected="selected"'; ?>>全部</option>
                        <option value="1" <?php if ($search['type'] == '1') echo 'selected="selected"'; ?>>10元</option>
                        <option value="2" <?php if ($search['type'] == '2') echo 'selected="selected"'; ?>>20元</option>
                        <option value="3" <?php if ($search['type'] == '3') echo 'selected="selected"'; ?>>30元</option>
                        <option value="4" <?php if ($search['type'] == '4') echo 'selected="selected"'; ?>>50元</option>
                    </select>
                     状态：<select name="state">
                        <option value="" <?php if ($search['state'] == '') echo 'selected="selected"'; ?>>全部</option>
                        <option value="0" <?php if ($search['state'] == '0') echo 'selected="selected"'; ?>>未使用</option>
                        <option value="1" <?php if ($search['type'] == '1') echo 'selected="selected"'; ?>>已使用</option>
                    </select>
代金券编号：<input type="text" name="couponnum" value="<?php echo $search['couponnum'];?>">
                    <input type="submit" value="检索">
                </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th><th>代金券编号</th><th>类型</th><th>状态</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr><td><?php echo $key + 1; ?></td><td><?php echo $value['couponnum'] ?></td><td><?php if($value['type'] == '1'){echo '10元';}elseif($value['type']== '2'){echo '20元';}elseif($value['type']== '3'){echo '30元';}elseif($value['type']== '4'){echo '50元';}else{ echo '未知';}?></td><td><?php
                                    if ($value['state'] == '0') {
                                        echo '<font color="blue">未使用</font>';
                                    } elseif ($value['state'] == '1') {
                                        echo '<font color="green">已使用</font>';
                                    }else {
                                        echo '<font color="black">未知</font>';
                                    }
                                    ?></td></tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                </table>
            </div>
            <div >
                <?php echo $page; ?>
            </div>
            <div style="text-align:left;float:left">
                浏览量：<?php echo $data['viewnum'];?>&nbsp;分享量：<?php echo $data['sharenum'];?>&nbsp;微博：<?php echo $data['stylenum1'];?>&nbsp;国航官网：<?php echo $data['stylenum2'];?>&nbsp;网盟：<?php echo $data['stylenum3'];?>&nbsp;备用1：<?php echo $data['stylenum4'];?>&nbsp;备用2：<?php echo $data['stylenum5'];?>&nbsp;备用3：<?php echo $data['stylenum6'];?>&nbsp;分享渠道：<?php echo $data['stylenum7'];?>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo _STATIC_ ?>/js/jquery-1.8.3.min.js"></script>
    <script>
                document.addEventListener("touchmove", function (e) {
                    e.preventDefault()
                })
    </script>

</html>