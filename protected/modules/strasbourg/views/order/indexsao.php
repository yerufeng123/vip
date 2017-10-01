<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_place.png" />您当前位置：<span>扫码支付</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/strasbourg/order/indexsao?model=5" method="POST">
            <!--查询开始-->
            是否支付：<select name="state">
                <option value="" <?php if($search['state'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="0" <?php if($search['state'] == '0'){echo 'selected="selected"';}?>>未支付</option>
                <option value="1" <?php if($search['state'] == '1'){echo 'selected="selected"';}?>>已支付</option>
            </select>
            订单号:<input type="text" style="width:180px" name="order_sn" value="<?php echo $search['order_sn']; ?>">
            所属商户:<input type="text" style="width:180px" name="company" value="<?php echo $search['company']; ?>">
           房间号码:<input type="text" style="width:180px" name="roomnumer" value="<?php echo $search['roomnumer']; ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/>
            <input type="button" value="导出数据" id="outputdata" onclick="javascript:location.href='/strasbourg/order/ajaxpushdata'"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table width="818" cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>订单号</th>
            <th>活动名称</th>
            <th>所属商户</th>
            <th>木屋编号</th>
            <th>是否支付</th>
            <th>价格</th>
            <th>创建时间</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['order_sn'];?></td>
                        <td><?php echo $value['activename']; ?></td>
                        <td><?php echo $value['company']; ?></td>
                        <td><?php echo $value['roomnumer']; ?></td>
                        <td><?php if($value['state'] == '0'){ echo '<font color="green">未支付</font>'; }else{echo '<font color="red">已支付</font>';} ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['time']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>



        </table>
        <div class="cont_right_page4" style="float: left;font-size:20px;color:red">
                                <?php if($totalprice != 0) echo '总价格：'.$totalprice;?>
        </div>
        <div class="cont_right_page4" style="float: right;">
            <?php echo $page; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>


<?php $this->renderPartial("/public/buttom") ?> 
