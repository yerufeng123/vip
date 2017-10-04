
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
/***********************************项目函数***********************************/

