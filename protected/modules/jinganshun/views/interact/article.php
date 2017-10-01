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
            <h1 style="font-size: 18px;font-weight: bold">活动描述</h1><br>
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
        <input type='hidden' id='controlPath' value='/jinganshun/interact/article'/>
        <input type='hidden' id='displayPath' value='/jinganshun/interact/article?model=4'/>
    </form>
</div>

<div class="cont_right">
    <div class="cont_right_page2">
        <form action="/jinganshun/interact/article?model=4" method="POST">
            姓名：<input type="text" name="name" value="<?php echo $search['name'] ?>">
            电话：<input type="text" name="phone" value="<?php echo $search['phone'] ?>">
            分数：<input type='text' name="score" placeholder="请输入查找的最小值" value='<?php echo $search['score'] ?>'>
           
            <input type='submit' value="检索">
        </form>
    </div>
    <div class="cont_right_page3">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <th>序号</th>
            <th>姓名</th>
            <th>电话</th>
            <th>标题</th>
            <th>分数</th>
            <th>操作</th>
            </thead>

            <?php if (isset($list) && is_array($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo $value['title']; ?></td>
                        <td><?php echo $value['score']; ?></td>
                        <td>
                            <div>
                                <span class="compile"><a href="/jinganshun/interact/article_editor?id=<?php echo $value['id']; ?>&model=4"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_compile.png" /></a></span>
                                <span class="del"><a href="/jinganshun/interact/article_delete?id=<?php echo $value['id']; ?>&model=4"><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_error.png" /></a></span>
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
//        var str=$('#urlvalue').val();
//        var RegUrl = new RegExp();
//        RegUrl.compile("((http|ftp|https)://)(([a-zA-Z0-9\._-]+\.[a-zA-Z]{2,6})|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,4})*(/[a-zA-Z0-9\&%_\./-~-]*)?");//jihua.cnblogs.com
//        if (!RegUrl.test(str)) {
//            alert('链接格式不正确！');
//            return false;
//        }
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

