<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_place.png" />您当前位置：<span>员工关怀</span></span>
    </div>
    <div class="cont_right_page2">
        <input type="button" value='添加' onclick="javascript:location.href='/jinganshun/business/careadd?model=2'">
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>照片</th>
            <th>描述</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><img src='/<?php echo $value['pic']?>' width="100px" height="100px"></td>
                        <td><?php
                            if (mb_strlen($value['content'], 'utf-8') > 50) {
                                echo msubstr($value['content'], 0, 50);
                            } else {
                                echo $value['content'];
                            }
                            ?></td>

                        <td>
                            <div>
                                <span class="compile"><a href="/jinganshun/business/careeditor?id=<?php echo $value['id']; ?>&model=2"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/jinganshun/business/caredelete?id=<?php echo $value['id']; ?>&model=2"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_error.png" /></a></span>
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
