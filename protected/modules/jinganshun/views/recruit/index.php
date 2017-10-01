<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_place.png" />您当前位置：<span>应聘人查看</span></span>
    </div>
    <div class="cont_right_page2">
<!--        <input type="button" value='添加' onclick="javascript:location.href = '/jinganshun/recruit/areaadd?model=3'">-->
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>申请职位</th>
            <th>姓名</th>
            <th>手机</th>
<!--            <th>籍贯</th>
            <th>地址</th>-->
            <th>申请时间</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['job']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['phone']; ?></td>
<!--                        <td><?php echo $value['province']; ?></td>
                        <td><?php
                            if (mb_strlen($value['address'], 'utf-8') > 50) {
                                echo msubstr($value['address'], 0, 50);
                            } else {
                                echo $value['address'];
                            }
                            ?>
                        </td>-->

                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td>
                     <td>
                    <div>
<!--                        <span class="compile"><a href="/jinganshun/recruit/areaquery?id=<?php echo $value['id']; ?>&model=3"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_compile.png" /></a></span>-->
                        <span class="del"><a href="/jinganshun/recruit/recruiterdelete?id=<?php echo $value['id']; ?>&model=3"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_error.png" /></a></span>
                    </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>


        </table>
        <div class="cont_right_page4" style="float:right;">
            <?php echo $page; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php $this->renderPartial("/public/buttom") ?> 
