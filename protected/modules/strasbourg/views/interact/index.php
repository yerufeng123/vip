<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_place.png" />您当前位置：<span>集铭牌查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/strasbourg/interact/tag?model=3" method="POST">
            <!--查询开始-->
            点亮铭牌:<select name="tagindex">
                <option value="" <?php if($search['tagindex'] == ''){echo 'selected="selected"';}?>>全部</option>
                <option value="1" <?php if($search['tagindex'] == '1'){echo 'selected="selected"';}?>>购物达人</option>
                <option value="2" <?php if($search['tagindex'] == '2'){echo 'selected="selected"';}?>>收藏达人</option>
                <option value="3" <?php if($search['tagindex'] == '3'){echo 'selected="selected"';}?>>旅行达人</option>
                <option value="4" <?php if($search['tagindex'] == '4'){echo 'selected="selected"';}?>>美食达人</option>
                <option value="5" <?php if($search['tagindex'] == '5'){echo 'selected="selected"';}?>>派对达人</option>
                <option value="6" <?php if($search['tagindex'] == '6'){echo 'selected="selected"';}?>>艺术达人</option>
            </select>

            点亮人标识:<input type="text"  style="width:200px" name="openid" value="<?php echo $search['openid']; ?>">
            分享者标识:<input type="text"  style="width:200px" name="fopenid" value="<?php echo $search['fopenid']; ?>">
            分享者姓名:<input type="text"   name="name" value="<?php echo $search['name']; ?>">
            分享者电话:<input type="text"   name="phone" value="<?php echo $search['phone']; ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table width="818" cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>点亮者标识</th>
            <th>分享者标识</th>
            <th>分享者头像</th>
            <th>分享者姓名</th>
            <th>分享者电话</th>
            <th>点亮的铭牌</th>
            <th>创建时间</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['openid'] ?></td>
                        <td><?php echo $value['fopenid'] ?></td>
                        <td><img src="<?php echo $value['headimgurl'] ?>" width="100px" height="100px"></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php if($value['tagindex'] == '1'){ echo '购物达人'; }elseif($value['tagindex'] == '2'){ echo '收藏达人'; }elseif($value['tagindex'] == '3'){ echo '旅行达人'; }elseif($value['tagindex'] == '4'){ echo '美食达人'; }elseif($value['tagindex'] == '5'){ echo '派对达人'; }elseif($value['tagindex'] == '6'){ echo '艺术达人'; }else{echo '';} ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']) ?></td>
                        <td>
                            <div>
                                <span class="del"><a href="/strasbourg/interact/tag_delete?id=<?php echo $value['id'] ?>&model=3"><img src="<?php echo _STATIC_ . 'vip/strasbourg/admin1/'; ?>img/icon_error.png" /></a></span>
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
