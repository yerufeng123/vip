
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo _STATIC_; ?>extension/uploadify/jquery.uploadify.min.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo _STATIC_ ; ?>js/gxd.js"></script>
<script type="text/javascript" src="<?php echo _STATIC_ ; ?>js/globals.js"></script>
</body>
</html>
<script>
$(function() {
    var c = "<?php echo $_GET['model']?>";
    switch (c) {
        case '1':
            $('#model1').css('display', 'block');
            break;
        case '2':
            $('#model2').css('display', 'block');
            break;
        case '3':
            $('#model3').css('display', 'block');
            break;
        case '4':
            $('#model4').css('display', 'block');
            break;
        default:
            $('#model1').css('display', 'block');
            break;

    }
});
</script>