/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 本文件，主要收集了一些研发工程中，经常会用到的js函数
 */

/**
 * 正则验证相关
 */
//验证手机
function check_phone(phone) {
    var reg = /^1[3|4|5|7|8][0-9]\d{8}$/;
    if (!reg.test(phone)) {
        return false;
    } else {
        return true;
    }
}
//验证邮箱
function checkEmail(str) {
    var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/
    if (re.test(str)) {
        return true;
    } else {
        return false;
    }
}


/**
 * 工具函数相关
 */
function getRootPath(){
    //获取当前网址，如： http://localhost:8088/test/test.jsp
    var curPath=window.document.location.href;
    //获取主机地址之后的目录，如： test/test.jsp
    var pathName=window.document.location.pathname;
    var pos=curPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8088
    var localhostPaht=curPath.substring(0,pos);
    //获取带"/"的项目名，如：/test
    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);
    return(localhostPaht+projectName);
}


/**
     * 中文字符截取函数
     * str='我dd是d中f文字符串';
     * str.substr(0,3)按字（包括汉字或者字母）截取   =>我dd
     * sb_substr(str,0,3)按字符截取  =>我d
     */
    //得到字符总数
    function getChars(str) {
        var i = 0;
        var c = 0.0;
        var unicode = 0;
        var len = 0;
        if (str == null || str == "") {
            return 0;
        }
        len = str.length;
        for (i = 0; i < len; i++) {
            unicode = str.charCodeAt(i);
            if (unicode < 127) { //判断是单字符还是双字符
                c += 1;
            } else {  //chinese
                c += 2;
            }
        }
        return c;
    }
    function sb_strlen(str) {
        return getChars(str);
    }
//截取字符
    function sb_substr(str, startp, endp) {
        var i = 0;
        var c = 0;
        unicode = 0;
        var rstr = '';
        var len = str.length;
        var sblen = sb_strlen(str);
        if (startp < 0) {
            startp = sblen + startp;
        }
        if (endp < 1) {
            endp = sblen + endp;// - ((str.charCodeAt(len-1) < 127) ? 1 : 2);
        }
        // 寻找起点
        for (i = 0; i < len; i++) {
            if (c >= startp) {
                break;
            }
            var unicode = str.charCodeAt(i);
            if (unicode < 127) {
                c += 1;
            } else {
                c += 2;
            }
        }
        // 开始取
        for (i = i; i < len; i++) {
            var unicode = str.charCodeAt(i);
            if (unicode < 127) {
                c += 1;
            } else {
                c += 2;
            }
            rstr += str.charAt(i);
            if (c >= endp) {
                break;
            }
        }
        return rstr;
    }

	//打印js 对象内容
	function DY(data) {
                function fenge(data) {
                    if (typeof (data) == 'object') {
                        for (var i in data) {
                            str += '   ' + i + '=>';
                            fenge(data[i]);
                        }
                    } else {
                        str += data + '\n';
                    }
                }
                var str = "";
                if (typeof (data) == 'object') {
                    for (var i in data) {
                        str += i + '=>';
                        fenge(data[i]);
                    }
                } else {
                    str += data + '\n';
                }
                alert(str);
            }


/**
 * JS获取n至m随机整数
 * 琼台博客
 */
function rd(n,m){
    var c = m-n+1;  
    return Math.floor(Math.random() * c + n);
}

