<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/qizheng/user/index?model=1" method="POST">
            <!--查询开始-->
            员工编号:<input type="text" style="width:80px" name="user_username" value="<?php echo $search['user_username']; ?>">

            姓名:<input type="text" style="width:80px" name="user_name" value="<?php echo $search['user_name']; ?>">
            手机号<input type="text" name="user_phone" value="<?php echo $search['user_phone']; ?>">

            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table width="818" cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>员工编号</th>
            <th>姓名</th>
            <th>手机</th>
            <th>创建时间</th>
            <th>启用状态</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td><?php
                            if ($value['enable'] == 0) {
                                echo '<font color="red">未启用</font>';
                            } else {
                                echo '<font color="green">启用</font>';
                            }
                            ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/qizheng/user/user_editor?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/qizheng/user/user_delete?id=<?php echo $value['id'] ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_error.png" /></a></span>
                            </div>
                        </td>
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
