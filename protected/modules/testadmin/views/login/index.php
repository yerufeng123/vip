<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/testadmin/admin1/'; ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo _STATIC_ . 'vip/testadmin/admin1/'; ?>js/jquery.form.js"></script>
        <title>圣诞集市——后台登录</title>
        <style type="text/css">
            <!--
            body {
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                background-color: #016aa9;
                overflow:hidden;
            }
            .STYLE1 {
                color: #000000;
                font-size: 12px;
            }
            -->
        </style>

        <!--登陆验证相关-->
        <script>
            function checkFormSerialize() {
                var aQuery = $("#myForm").formSerialize();
                $.post('/testadmin/login/login', aQuery, function(data) {
                    if (data != '') {
                        alert(data);
                    } else {
                        window.location.href = "/testadmin/admin/index?model=1";
                    }
                });
                return false;
            }
        </script>
    </head>

    <body>
        <form name="myForm" id="myForm">
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="235" background="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/login_03.gif">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="394" height="53" background="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/login_05.gif">&nbsp;</td>
                                            <td width="206" background="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="16%" height="25"><div align="right"><span class="STYLE1">用户</span></div></td>
                                                        <td width="57%" height="25"><div align="center">
                                                                <input type="text" name="admin_username" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                                                            </div></td>
                                                        <td width="27%" height="25">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="25"><div align="right"><span class="STYLE1">密码</span></div></td>
                                                        <td height="25"><div align="center">
                                                                <input type="password" name="admin_password" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                                                            </div></td>
                                                        <td height="25"><div align="left"><input type="image" src="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/dl.gif" onclick="return checkFormSerialize();"></div></td>
                                                    </tr>
                                                </table></td>
                                            <td width="362" background="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/login_07.gif">&nbsp;</td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td height="213" background="<?php echo _STATIC_ . 'vip/testadmin/'; ?>img/login_08.gif">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
            </table>
        </form>
    </body>
</html>
