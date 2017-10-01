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
        <title>斯特拉斯堡圣诞小镇商户后台</title>
    </head>
    <body>
        <div style="margin: auto;text-align: center;width:80%;border: 2px solid #ccc">
            <div>
               <form action="/strasbourg/navigation/admin" method="POST">
             <!--查询开始-->
<!--            是否支付：<select name="state">
                <option value="" <?php if($search['state'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="0" <?php if($search['state'] == '0'){echo 'selected="selected"';}?>>未支付</option>
                <option value="1" <?php if($search['state'] == '1'){echo 'selected="selected"';}?>>已支付</option>
            </select>-->
            订单号:<input type="text" style="width:180px" name="order_sn" value="<?php echo $search['order_sn']; ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/><input type="button" value="导出数据" onclick="javascript:location.href='/strasbourg/navigation/ajaxpushdata'"/>

        </form>
            </div>
            <div style="margin: auto;text-align: center">
                <table border="1">
                    <tr><th>序号</th>
            <th>订单号</th>
            <th>活动名称</th>
            <th>木屋编号</th>
            <th>是否支付</th>
            <th>价格</th>
            <th>创建时间</th></tr>
                    <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['order_sn'];?></td>
                        <td><?php echo $value['activename']; ?></td>
                        <td><?php echo $value['roomnumer']; ?></td>
                        <td><?php if($value['state'] == '0'){ echo '<font color="green">未支付</font>'; }else{echo '<font color="red">已支付</font>';} ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['time']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
                </table>
            </div>
            <div style="text-align: left">
            <?php if($totalprice != 0) echo '总价格：'.$totalprice;?>
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





</html>