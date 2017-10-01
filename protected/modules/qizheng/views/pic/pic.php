<html>
    <head>
        <script src="<?php echo _STATIC_?>js//jquery.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_?>uploadify/jquery.uploadify.min.js"></script>
        <!--<script type="text/javascript" src="__PUBLIC__/Js/uploadfile.js"></script>-->
        <link rel="stylesheet" type="text/css" href="<?php echo _STATIC_?>uploadify/uploadify.css" />
        <meta charset="utf-8" />
        <script>
            $(function() {
                $('#file_upload1').uploadify({
                    'swf': '<?php echo _STATIC_?>uploadify/uploadify.swf', //指定上传控件的主体文件
                    'uploader': '/pic/uploadify1?width=500&height=500', //指定服务器端上传处理文件
                    'buttonText': '上传图片',
                    //其他配置项
                    'onUploadStart': function(file) {
                        //$('#tu').remove();
                    },
                    'onUploadSuccess': function(file, data, response) {
                        alert(data);
                    }
                });
            });
        </script>
    </head>
    <body>

        店标小图:<font color="red">*必填(200*150)</font><input id="file_upload1"  type="file" multiple="true">
        <div id="tu_photo1"></div><br /><br /><br /><br /><br /><br />
        <input type="hidden" name="little_logo" id="little_logo" value=""/>

    </body>
</html>