<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/strasbourg/user/index?model=1" method="POST">
            <!--查询开始-->
            注册来源：<select name="channel">
                <option value="" <?php if($search['channel'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="<?php echo Constant::CHANNEL_H5;?>" <?php if($search['channel'] == Constant::CHANNEL_H5){echo 'selected="selected"';}?>>H5</option>
                <option value="<?php echo Constant::CHANNEL_AUCTION;?>" <?php if($search['channel'] == Constant::CHANNEL_AUCTION){echo 'selected="selected"';}?>>竞拍</option>
                
                <option value="<?php echo Constant::CHANNEL_LOTTERY3;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY3){echo 'selected="selected"';}?>>摇一摇抽奖</option>
                <option value="<?php echo Constant::CHANNEL_LOTTERY;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY){echo 'selected="selected"';}?>>小礼品抽奖</option>
                <option value="<?php echo Constant::CHANNEL_LOTTERY2;?>" <?php if($search['channel'] == Constant::CHANNEL_LOTTERY2){echo 'selected="selected"';}?>>大礼品抽奖</option>
                
                <option value="<?php echo Constant::CHANNEL_GROUP;?>" <?php if($search['channel'] == Constant::CHANNEL_GROUP){echo 'selected="selected"';}?>>团购</option>
                <option value="<?php echo Constant::CHANNEL_SECKILL;?>" <?php if($search['channel'] == Constant::CHANNEL_SECKILL){echo 'selected="selected"';}?>>秒拍</option>
                <option value="<?php echo Constant::CHANNEL_GAME;?>" <?php if($search['channel'] == Constant::CHANNEL_GAME){echo 'selected="selected"';}?>>游戏</option>
            </select>

            姓名:<input type="text" style="width:80px" name="user_name" value="<?php echo $search['user_name']; ?>">
            手机号<input type="text" name="user_phone" value="<?php echo $search['user_phone']; ?>">
            微信识别码<input type="text"  style="width:200px" name="openid" value="<?php echo $search['openid']; ?>">
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
            <th>微信昵称</th>
            <th>微信性别</th>
            <th>微信省(市)</th>
            <th>微信市(区)</th>
            <th>微信国家</th>
            <th>微信头像</th>
            <th>创建时间</th>
            <th>注册渠道</th>
            <th>微信识别码</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo $value['nickname']; ?></td>
                        <td><?php if($value['sex'] == '1'){ echo '男'; }elseif($value['sex'] == '2'){ echo '女'; }else{echo '未知';} ?></td>
                        <td><?php echo $value['province']; ?></td>
                        <td><?php echo $value['city']; ?></td>
                        <td><?php echo $value['country']; ?></td>
                        <td><img src="<?php echo $value['headimgurl']; ?>" width="100px" height="100px"></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td><?php echo $value['channel'];?></td>
                        <td><?php echo $value['openid']; ?></td>
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
