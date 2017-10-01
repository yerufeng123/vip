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


