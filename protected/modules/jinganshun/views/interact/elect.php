<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>



<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            <h1 style="font-size: 18px;font-weight: bold">文本介绍</h1><br>
            <textarea name="content" class="textarea250" maxlength="100"><?php echo $data['content'] ?></textarea><br />
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">

        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/interact/elect'/>
        <input type='hidden' id='displayPath' value='/jinganshun/interact/elect?model=4'/>
    </form>
</div>

<div class="cont_right">
    <div class="cont_right_page2">
        <form action="/jinganshun/interact/elect?model=4" method="POST">
            类型：<select name="type">
                <option value="" <?php if ($search['type'] == '') echo 'selected="selected"'; ?>>全部</option>
                <option value="1" <?php if ($search['type'] == '1') echo 'selected="selected"'; ?>>优秀队长</option>
                <option value="2" <?php if ($search['type'] == '2') echo 'selected="selected"'; ?>>优秀队员</option>
                <option value="3" <?php if ($search['type'] == '3') echo 'selected="selected"'; ?>>优秀内勤</option>
            </select>
            姓名：<input type="text" name="name" value="<?php echo $search['name'] ?>">

            <input type='submit' value="检索"><input type='button' value="添加新项" id="add_btn">
        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>类型</th>
            <th>姓名</th>
            <th>图片</th>
            <th>文字介绍</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php
                            if ($value['type'] == '1') {
                                echo '优秀队长';
                            } elseif ($value['type'] == '2') {
                                echo '优秀队员';
                            } elseif($value['type'] =='3'){
                                echo '优秀内勤';
                            } else{
                                echo '未知';
                            }
                            ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><img src="<?php echo '/' . $value['pic'] ?>"></td>
                        <td><?php echo $value['content']; ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/jinganshun/interact/elect_editor?id=<?php echo $value['id']; ?>&model=4"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/jinganshun/interact/elect_delete?id=<?php echo $value['id']; ?>&model=4"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_error.png" /></a></span>
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


<?php $this->renderPartial("/public/buttom") ?> 
<script>
    function checkFormSerialize() {
        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        var displayPath = $("#displayPath").val();
        $.post(controlPath, aQuery, function(data) {
            var list = eval('(' + data + ')');
            if (list.code != '100000') {
                alert(list.result);
            } else {
                alert('更新成功');
            }
        });
        return false;
    }
</script>
<script>
    $(function() {
        //单击添加按钮
        $('#add_btn').bind('click', function() {
            location.href = '/jinganshun/interact/elect_add?model=4';
        });
    });
</script>

