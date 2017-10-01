<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_place.png" />您当前位置：<span>产品查看</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/qizheng/product/index?model=2" method="POST">

            产品名称:<input type="text" style="width:80px" name="name" value="<?php echo $search['name']; ?>">
            发布人<input type="text" name="adminname" value="<?php echo $search['adminname']; ?>">

            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>产品名称</th>
            <th>产品图片</th>
            <th>位置</th>
            <th>创建时间</th>
            <th>发布人</th>
            <th>操作</th>
            </thead>
            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php
                            if (mb_strlen($value['name'], 'utf-8') > 8) {
                                echo msubstr($value['name'], 0, 8);
                            } else {
                                echo $value['name'];
                            }
                            ?></td>
                        <td><img width="80" height="80" src="<?php echo $value['product_pic'] ?>" /></td>
                        <td><?php echo $value['PX']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td>
                        <td><?php echo $value['adminname'] ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/qizheng/product/product_editor?id=<?php echo $value['id']; ?>&model=2"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/qizheng/product/product_delete?id=<?php echo $value['id']; ?>&model=2"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_error.png" /></a></span>
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
