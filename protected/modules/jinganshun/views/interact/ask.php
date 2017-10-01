<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 1220px;">
        <div style="margin:auto;width: 600px;float:left">
            <div class="clearbar10"></div>
            <h1 style="font-size: 18px;font-weight: bold">活动规则</h1><br>
            <textarea name="content" class="textarea250" maxlength="100"><?php echo $data['content'] ?></textarea><br />
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">

        </div>
        <div style="margin:auto;width: 600px;float:right">
            <div class="clearbar10"></div>
            <h1 style="font-size: 18px;font-weight: bold">每次对应金额</h1><br>
            <textarea name="content2" class="textarea250" maxlength="100"><?php echo $data2['content'] ?></textarea><br />
            <input type="hidden" name="id2" value="<?php echo $data2['id'] ?>">

        </div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/interact/ask'/>
        <input type='hidden' id='displayPath' value='/jinganshun/interact/ask?model=4'/>
    </form>
</div>
<div class="cont_right">
    
    
    <div class="cont_right_page2">
        <form action="/jinganshun/interact/ask?model=4" method="POST">
            姓名：<input type="text" name="name" value="<?php echo $search['name'] ?>">
            手机：<input type="text" name="phone" value="<?php echo $search['phone'] ?>">
            开始时间：<input type='text' name="stime" placeholder="格式：<?php echo date('Y-m-d', time()); ?>" value='<?php echo $search['stime'] ?>'>
            结束时间：<input type='text' name="etime" placeholder="格式：<?php echo date('Y-m-d', time()); ?>" value='<?php echo $search['etime'] ?>'>
            <input type='submit' value="检索">
        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>姓名</th>
            <th>员工编号</th>
            <th>状态</th>
			<th>通过次数</th>
			<th>对应金额</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name']?></td>
                        <td><?php echo $value['username']?></td>
                        <td><?php if($value['state'] == '1'){echo '通过';}elseif($value['state'] == '0'){echo '未通过';}else{echo $value['state'];}?></td>
						<td><?php echo $arrnum[$value['name']]; ?></td>
						<td><?php echo $arrnum[$value['name']]*$data2['content']; ?></td>
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