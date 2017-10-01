<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/strasbourg/certificateadmin/index?model=4" method="POST">
            <!--查询开始-->
            注册来源：<select name="channel">
                <option value="" <?php if($search['channel'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="<?php echo Constant::CHANNEL_H5;?>" <?php if($search['channel'] == Constant::CHANNEL_H5){echo 'selected="selected"';}?>>H5</option>
                <option value="<?php echo Constant::CHANNEL_AUCTION;?>" <?php if($search['channel'] == Constant::CHANNEL_AUCTION){echo 'selected="selected"';}?>>竞拍</option>
                <option value="<?php echo Constant::CHANNEL_LOTTERY;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY){echo 'selected="selected"';}?>>小抽奖</option>
                <option value="<?php echo Constant::CHANNEL_LOTTERY2;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY2){echo 'selected="selected"';}?>>大抽奖</option>
                <option value="<?php echo Constant::CHANNEL_LOTTERY3;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY3){echo 'selected="selected"';}?>>摇一摇抽奖</option>
                <option value="<?php echo Constant::CHANNEL_GROUP;?>" <?php if($search['channel'] == Constant::CHANNEL_GROUP){echo 'selected="selected"';}?>>团购</option>
                <option value="<?php echo Constant::CHANNEL_SECKILL;?>" <?php if($search['channel'] == Constant::CHANNEL_SECKILL){echo 'selected="selected"';}?>>秒拍</option>
                <option value="<?php echo Constant::CHANNEL_GAME;?>" <?php if($search['channel'] == Constant::CHANNEL_GAME){echo 'selected="selected"';}?>>游戏</option>
            </select>
            姓名:<input type="text" style="width:80px" name="name" value="<?php echo $search['name']; ?>">
            手机号<input type="text" name="phone" value="<?php echo $search['phone']; ?>">
            二维码编号<input type="text" name="code" value="<?php echo $search['code']; ?>">
            活动标题<input type="text" name="type" value="<?php echo $search['type']; ?>">
            微信识别码<input type="text"  style="width:200px" name="openid" value="<?php echo $search['openid']; ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table width="818" cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>用户头像</th>
            <th>所属用户</th>
            <th>用户手机</th>
            <th>二维码</th>
            <th>二维码编号</th>
            <th>微信识别码</th>
            <th>是否核销</th>
            <th>活动类型</th>
            <th>活动标题</th>
            <th>创建时间</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><img src="<?php echo $value['headimgurl']; ?>" width="100px" height="100px"></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><img src="/<?php echo $value['erweimaurl']; ?>" width="100px" height="100px"></td>
                        <td><?php echo $value['code']; ?></td>
                        <td><?php echo $value['openid']; ?></td>
                        <td><?php if($value['overtime'] != '0' && $value['overtime']< time()){ echo '<font color="red">已核销</font>'; }else{echo '<font color="green">未核销</font>';} ?></td>
                        <td><?php echo $value['channel']; ?></td>
                        <td><?php echo $value['type']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td>
                            <div>
                                <span class="del"><a href="/strasbourg/certificateadmin/certificate_delete?id=<?php echo $value['id'];?>&model=4"><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_error.png" /></a></span>
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
