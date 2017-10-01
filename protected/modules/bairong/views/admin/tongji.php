<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_place.png" />您当前位置：<span>平台统计</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/bairong/admin/tongji?model=1" method="POST">

            手机号<input type="text" name="phone" value="<?php echo $search['phone']; ?>">
            领奖状态:<select name="state" style="width:150px;text-align: center;" id="state" >
                <option value="" <?php if ($search['state'] == '') echo selected; ?>>全部</option>
                <option value="0" <?php if ($search['state'] == '0') echo selected; ?>>未领奖</option>
                <option value="1" <?php if ($search['state'] == '1') echo selected; ?>>已领奖</option>
            </select>
            渠道:<select name="sid" style="width:150px;text-align: center;" id="sid">
                <option value="" >请选择渠道</option>    
            </select>
            <input type="hidden" id="sid2" value="<?php echo $search['sid'] ?>">
            <!--查询结束-->
            <input type="submit" value="查询"/>

        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>手机号</th>
            <th>领奖状态</th>
            <th>渠道</th>
            <th>创建时间</th>
            <th>操作</th>
            </thead>
            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['phone']; ?></td>
                        <td style="cursor:pointer;" class="state" val="<?php echo $value['id']; ?>" val1="<?php echo $key; ?>"><?php
                            if ($value['state'] == '1') {
                                echo '<span style="color:green" class="sel">已领奖</span>';
                            } else {
                                echo '<sapn style="color:red">未领奖</span>';
                            }
                            ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $value['ctime']); ?></td>
                        <td>
                            <div>
                                <span class="del"><a href="/admin/tongji_delete?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_error.png" /></a></span>
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
<script>
    $(function() {
        //初始化渠道列表
        $.post('/bairong/admin/ajaxgetstyle', {}, function(data) {
            var list = eval(data);
            for (var i in list) {
                $('#sid').append("<option value=" + (list[i].id) + ">" + list[i].name + "</option>");
            }
            var e = document.getElementById('sid');
            for (var j = 0; j < e.length; j++) {
                if ($('#sid2').val() == e.options[j].value) {
                    e.options[j].selected = true;
                }
            }
        });

        //单击状态
        $('.state').live('click', function() {
            var gid = $(this).attr('val');
            var index = $(this).attr('val1');
            if($(this).find('span').hasClass('sel')){
                return ;
            }
            if (confirm("确认要领奖么？")) {
                $.post('/bairong/admin/setstate', {'gid': gid}, function(data) {
                    if (data == '1') {
                        $('.state').eq(index).html('<span style="color:green" class="sel">已领奖</span>');
                    } else {
                        alert('修改状态失败！');
                    }
                });
            }
        });
    });

</script>
