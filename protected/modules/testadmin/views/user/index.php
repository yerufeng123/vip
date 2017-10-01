<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/testadmin/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/testadmin/user/index?model=1" method="POST">
            <!--查询开始-->
            姓名:<input type="text" style="width:80px" name="user_name" value="<?php echo $search['user_name']; ?>">
            手机号<input type="text" name="user_phone" value="<?php echo $search['user_phone']; ?>">
            注册开始时间<input type="text" name="starttime" placeholder="<?php echo date('Y-m-d',strtotime("-1 day"));?>" value="<?php echo $search['starttime']; ?>">
            注册结束时间<input type="text" name="endtime" placeholder="<?php echo date('Y-m-d',time());?>" value="<?php echo $search['endtime']; ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table width="818" cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>姓名</th>
            <th>手机</th>
            <th>所在区域</th>
            <th>微信昵称</th>
            <th>微信头像</th>
            <th>创建时间</th>
            <th>是否联系</th>
            <th>详细地址</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo $value['city']; ?></td>
                        <td><?php echo $value['wxnickname']; ?></td>
                        <td><img src="<?php echo $value['wxheadimgurl']; ?>" width="100px" height="100px"></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td><?php if($value['status'] == '1'){echo '<font color="red">否</font>';}else{echo '<font color="green">是</font>';}?></td>
                        <td><?php echo $value['address'];?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>



        </table>
        <div class="cont_right_page4" style="float: right;">
            <?php echo $page; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>


<?php $this->renderPartial("/public/buttom") ?> 
