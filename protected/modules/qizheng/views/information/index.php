<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_place.png" />您当前位置：<span>文献管理</span></span>
    </div>
    <div class="cont_right_page2">

        <form action="/qizheng/information/index?model=3" method="POST">
            所属产品:<select name="pid" style="width:150px;text-align: center;" id="pid">
                <option value="" >请选择产品</option>    
            </select>
            <input type="hidden" id="pid2" value="<?php echo $search['pid'] ?>">
            分类标题:<input type="text" name="title" value="<?php echo $search['title']; ?>">
            发布人:<input type="text" name="adminname" value="<?php echo $search['adminname']; ?>">

            <!--查询结束-->
            <input type="submit" value="查询"/>
        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>所属产品</th>
            <th>分类标题</th>
            <th>分类图片</th>
            <th>是否显示</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>发布人</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php if (mb_strlen($value['productname'], 'utf-8') > 8) {
                echo msubstr($value['productname'], 0, 8);
            } else {
                echo $value['productname'];
            } ?></td>
                        <td><?php if (mb_strlen($value['title'], 'utf-8') > 8) {
                        echo msubstr($value['title'], 0, 8);
                    } else {
                        echo $value['title'];
                    } ?></td>
                        <td><img width="80" height="80" src="<?php echo $value['little_pic'] ?>" /></td>
                        <td><?php
                    if ($value['display'] == 0) {
                        echo '<font color="red">不显示</font>';
                    } else {
                        echo '<font color="green">显示</font>';
                    }
                    ?></td>
                        <td><?php echo $value['PX']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td>
                        <td><?php echo $value['adminname'] ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/qizheng/information/information_editor?id=<?php echo $value['id'];?>&model=3"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/qizheng/information/information_delete?id=<?php echo $value['id'];?>&model=3"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_error.png" /></a></span>
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
<script>
    $(function() {
        //初始化导航分类列表
        $.post('/qizheng/product/ajaxgetproduct', function(data) {
            var list = eval(data);
            for (var i in list) {
                $('#pid').append("<option value=" + list[i]['id'] + ">" + list[i].name + "</option>");
            }
            var e = document.getElementById('pid');
            for (var j = 0; j < e.length; j++) {
                if ($('#pid2').val() == e.options[j].value) {
                    e.options[j].selected = true;
                }
            }
        });
    });
</script>
