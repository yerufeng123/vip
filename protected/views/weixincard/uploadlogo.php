<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>上传公司logo</title>

    </head>
    <body>
        <form action="<?php echo Yii::app()->params['prefixurl'];?>/card/uploadlogo" method="post" enctype="multipart/form-data">
            <input type="file" name="mylogo" />
            <input type="submit" value="确定">
        </form>
    </body>
</html>
