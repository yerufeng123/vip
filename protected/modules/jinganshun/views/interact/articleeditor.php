<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>


<div class="Tc_input">
    <form id="myForm" name="myForm"  enctype="multipart/form-data">
        <div style="margin:auto;width: 600px;border: 10px solid #ffffff;">
            <div class="clearbar10"></div>
            <div style="font-size: 24px;font-weight: bold"><?php echo $list['title'] ?></div>
            <div><?php echo $list['content'] ?></div>
            <div class="clearbar5"></div>
            分数：<input type="text" name="score" value="<?php echo $list['score']?>" />
            <input type='hidden' id='admin_id' name='id' value='<?php echo $list['id']; ?>' />

            <div class="clearbar10"></div>
        </div>
        <div class="clearbar10"></div>
        <center>
            <input class='button50' type="reset" name="admin_reset"  value="重置" />
            <input class='button50' type="button" name="admin_button" value="确定" onclick="checkFormSerialize();" style="margin-left: 30px"/>
        </center>
        <div class="clearbar10"></div>
        <input type='hidden' id='controlPath' value='/jinganshun/interact/article_editor'/>
    </form>
</div>

<?php $this->renderPartial("/public/buttom") ?> 

<script>
    function checkFormSerialize() {

        var aQuery = $("#myForm").formSerialize();
        var controlPath = $("#controlPath").val();
        $.post(controlPath, aQuery, function(data) {
            var list=eval('('+data+')');
            if (list.code != '100000') {
                alert(list.result);
            } else {
                location.href = document.referrer;
            }
        });
        return false;
    }

</script>