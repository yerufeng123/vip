/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    //$("#firstpane .menu_body:eq(0)").show();
    $("#firstpane p.menu_head").click(function() {
        $(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
        $(this).siblings().removeClass("current");
    });
    $("#secondpane .menu_body:eq(0)").show();
    $("#secondpane p.menu_head").mouseover(function() {
        $(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
        $(this).siblings().removeClass("current");
    });

});







function delpic(Obj, name) {
    //删除uploadify插件中的图片时调用,需要从拼好的字符串中删掉该图的src
    var picsrc = $(Obj).prev().attr("src");
    var oldpic = $('#' + name).val();
    var picsrc1 = picsrc.substr(1);
    $.post('/common/deletesrc', {'picsrc': picsrc1, 'oldpic': oldpic}, function(src) {
        $('#' + name).val(src);
    });
    $(Obj).prev().remove();
    $(Obj).remove();
}



function explode(separators, inputstring, includeEmpties) {
    inputstring = new String(inputstring);
    separators = new String(separators);

    if (separators == "undefined") {
        separators = " :;";
    }

    fixedExplode = new Array(1);
    currentElement = "";
    count = 0;

    for (x = 0; x < inputstring.length; x++) {
        str = inputstring.charAt(x);
        if (separators.indexOf(str) != -1) {
            if (((includeEmpties <= 0) || (includeEmpties == false)) && (currentElement == "")) {
            }
            else {
                fixedExplode[count] = currentElement;
                count++;
                currentElement = "";
            }
        }
        else {
            currentElement += str;
        }
    }

    if ((!(includeEmpties <= 0) && (includeEmpties != false)) || (currentElement != "")) {
        fixedExplode[count] = currentElement;
    }
    return fixedExplode;
}

//工具函数，模拟php去右符号函数，多用于去除多余的逗号和空格
function rtrim(s, f) {
    var newstr = s;
    var newchar = s.substr(-1, 1);
    while (newchar == f) {
        var strlength = newstr.length;
        var newstr = newstr.substr(0, strlength - 1);
        newchar = newstr.substr(-1, 1);
    }
    return newstr;
}

