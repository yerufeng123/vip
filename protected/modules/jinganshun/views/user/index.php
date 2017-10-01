<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/jinganshun/user/index?model=1" method="POST">
            <!--查询开始-->
            身份：<select name="enable">
                <option value="" <?php if($search['enable'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="1" <?php if($search['enable'] == '1'){echo 'selected="selected"';}?>>游客</option>
                <option value="0" <?php if($search['enable'] == '0'){echo 'selected="selected"';}?>>员工</option>
            </select>
           <!--  员工编号:<input type="text" style="width:80px" name="user_username" value="<?php echo $search['user_username']; ?>"> -->
            微信识别码:<input type="text" style="width:200px" name="openid" value="<?php echo $search['openid']; ?>">
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
<!--             <th>员工编号</th> -->
            <th>微信身份码</th>
            <th>姓名</th>
            <th>手机</th>
            <th>二维码</th>
            <th>二维码对应链接(可用于生成新的二维码)</th>
            <th>上班时间</th>
            <th>创建时间</th>
            <th>身份</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <!-- <td><?php echo $value['username']; ?></td> -->
                        <td><?php echo $value['openid']; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><img src="/<?php echo $value['erweima'];?>" width="100px" height="100px"></td>
                        <td><?php echo $value['erweimaurl'] ?></td>
                        <td><?php echo $value['starttime'].'-'.$value['endtime'];?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td><?php
                            if ($value['enable'] == 0) {
                                echo '<font color="red">员工</font>';
                            } else {
                                echo '<font color="green">游客</font>';
                            }
                            ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/jinganshun/user/user_editor?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/jinganshun/user/user_delete?id=<?php echo $value['id'] ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_error.png" /></a></span>
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
