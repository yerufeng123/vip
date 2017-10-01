<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>

<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;">
            <div class="clearbar10"></div>
            <h1 style="font-size: 18px;font-weight: bold">每次对应金额</h1><br>
            <textarea name="content" class="textarea250" maxlength="100"><?php echo $data['content'] ?></textarea><br />
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">

        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/interact/share'/>
        <input type='hidden' id='displayPath' value='/jinganshun/interact/share?model=4'/>
    </form>
</div>
<div class="cont_right">
    <div class="cont_right_page1">
        <span><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_place.png" />您当前位置：<span>分享有礼</span></span>
    </div>
    <div class="cont_right_page2">
        <form action="/jinganshun/interact/share?model=4" method="POST">
            姓名：<input type="text" name="name" value="<?php echo $search['name'] ?>">
            电话：<input type="text" name="phone" value="<?php echo $search['phone'] ?>">
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
            <th>手机</th>
            <th>OPENID</th>
            <th>关注OPENID</th>
            <th>关注时间</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name']?></td>
                        <td><?php echo $value['phone']?></td>
                        <td><?php echo $value['openid']?></td>
                        <td><?php echo $value['fopenid']?></td>
                        <td><?php echo date('Y-m-d H:i:s',$value['ctime']);?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>


        </table>
        <div class="cont_right_page4" style="float:left;font-size:25px">
                                分享次数：<?php echo $countnum;?>&nbsp;&nbsp;&nbsp;&nbsp;对应金额：<?php echo $countnum*$data['content'];?>
        </div>
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