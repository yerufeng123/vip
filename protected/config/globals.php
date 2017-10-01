<?php

/**
 * 项目全局自定义函数库：驼峰命名法
 * 本文件仅存放项目通用的一些工具函数，项目私有函数，请另建文件存放
 * 追加函数，请务必保持统一注释风格，注释中要包含 函数功能、参数、返回值类型
 * 分类导航：验证类、转换类、工具类、排序类、算法类、时间类、过滤类、拼割类
 * 注意 为避免跟其他参数冲突，请同意加前缀gxd 比如gxdCheckPhone
 */

/**
 * 2015-4-16
 *
 * @author gaoxiangdong
 * @version V1.0.0
 */
/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 验证类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 验证手机号是否规范
 * @test 要验证的字符串
 * @return boolean //$result匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkPhone($phone)
{
    /**
     * 匹配手机号码
     * 规则：
     * 手机号码基本格式：
     * 前面三位为：
     * 移动：134-139 147 150-152 157-159 182 183 187 188
     * 联通：130-132 155-156 185 186
     * 电信：133 153 180 189
     * 其他：177 170
     * 后面八位为：
     * 0-9位的数字
     */
    // $rule = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";
    $rule = "/^((13[0-9])|147|(15[0-9])|(17[0-9])|18[0-9])[0-9]{8}$/A";
    preg_match($rule, $phone, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证电话号码是否规范
 * @test 要验证的字符串
 * @return boolean //$result匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkTel($test)
{
    /**
     * 电话号码匹配
     * 电话号码规则：
     * 区号：3到5位，大部分都是四位，北京(010)和上海市(021)三位，西藏有部分五位，可以包裹在括号内也可以没有
     * 如果有区号由括号包裹，则在区号和号码之间可以有0到1个空格，如果区号没有由括号包裹，则区号和号码之间可以有两位长度的 或者-
     * 号码：7到8位的数字
     * 例如：(010) 12345678 或者 (010)12345678 或者 010 12345678 或者 010--12345678
     */
    $rule = '/^(\(((010)|(021)|(0\d{3,4}))\)( ?)([0-9]{7,8}))|((010|021|0\d{3,4}))([- ]{1,2})([0-9]{7,8})$/A';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证邮箱是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkEmail($test)
{
    /**
     * 匹配邮箱
     * 规则：
     * 邮箱基本格式是 *****@**.**
     * @以前是一个 大小写的字母或者数字开头，紧跟0到多个大小写字母或者数字或 .
     *
     *
     *
     *
     * _ - 的字符串
     * @之后到.之前是 1到多个大小写字母或者数字的字符串
     * .之后是 1到多个 大小写字母或者数字或者.的字符串
     */
    $zhengze = '/^[a-zA-Z0-9][a-zA-Z0-9._-]*\@[a-zA-Z0-9]+\.[a-zA-Z0-9\.]+$/A';
    preg_match($zhengze, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证身份证号是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkIdentity($test)
{
    /**
     * 匹配身份证号
     * 规则：
     * 15位纯数字或者18位纯数字或者17位数字加一位x
     */
    $rule = '/^(([0-9]{15})|([0-9]{18})|([0-9]{17}x))$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证邮编是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkZipcode($test)
{
    /**
     * 匹配邮编
     * 规则：六位数字，第一位不能为0
     */
    $rule = '/^[1-9]\d{5}$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证IP是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkIp($test)
{
    /**
     * 匹配ip
     * 规则：
     * *1.**2.**3.**4
     * *1可以是一位的 1-9，两位的01-99，三位的001-255
     * *2和**3可以是一位的0-9，两位的00-99,三位的000-255
     * *4可以是一位的 1-9，两位的01-99，三位的001-255
     * 四个参数必须存在
     */
    $rule = '/^((([1-9])|((0[1-9])|([1-9][0-9]))|((00[1-9])|(0[1-9][0-9])|((1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))))\.)((([0-9]{1,2})|(([0-1][0-9]{2})|(2[0-4][0-9])|(25[0-5])))\.){2}(([1-9])|((0[1-9])|([1-9][0-9]))|(00[1-9])|(0[1-9][0-9])|((1[0-9]{2})|(2[0-4][0-9])|(25[0-5])))$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证时间格式是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkTime($test)
{
    /**
     * 匹配时间
     * 规则：
     * 形式可以为：
     * 年-月-日 小时:分钟:秒
     * 年-月-日 小时:分钟
     * 年-月-日
     * 年：1或2开头的四位数
     * 月：1位1到9的数；0或1开头的两位数，0开头的时候个位数是1到9的数，1开头的时候个位数是1到2的数
     * 日：1位1到9的数；0或1或2或3开头的两位数，0开头的时候个位数是1到9的数，1或2开头的时候个位数是0到9的数，3开头的时候个位数是0或1
     * 小时：0到9的一位数；0或1开头的两位数，个位是0到9；2开头的两位数，个位是0-3
     * 分钟：0到9的一位数；0到5开头的两位数，个位是0到9；
     * 分钟：0到9的一位数；0到5开头的两位数，各位是0到9
     */
    $rule = '/^(([1-2][0-9]{3}-)((([1-9])|(0[1-9])|(1[0-2]))-)((([1-9])|(0[1-9])|([1-2][0-9])|(3[0-1]))))( ((([0-9])|(([0-1][0-9])|(2[0-3]))):(([0-9])|([0-5][0-9]))(:(([0-9])|([0-5][0-9])))?))?$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证是否是中文
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkChinese($test)
{
    // utf8下匹配中文
    $rule = '/([\x{4e00}-\x{9fa5}]){1}/u';
    preg_match_all($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证url是否规范
 * @test 要验证的字符串
 * @return boolean //$result 匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkUrl($test)
{
    /**
     * 匹配url
     * url规则：
     * 例
     * 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名
     * http://zhidao.baidu.com/question/535596723.html
     * 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名?参数
     * www.lhrb.com.cn/portal.php?mod=view&aid=7412
     * 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名/参数
     * http://www.xugou.com.cn/yiji/erji/index.php/canshu/11
     *
     * 协议：可有可无，由大小写字母组成；不写协议则不应存在://，否则必须存在://
     * 域名：必须存在，由大小写字母组成
     * 名称：必须存在，字母数字汉字
     * 后缀：必须存在，大小写字母和.组成
     * 文件路径：可有可无，由大小写字母和数字组成
     * 文件名：可有可无，由大小写字母和数字组成
     * 参数:可有可无，存在则必须由?开头，即存在?开头就必须有相应的参数信息
     */
    $rule = '/^(([a-zA-Z]+)(:\/\/))?([a-zA-Z]+)\.(\w+)\.([\w.]+)(\/([\w]+)\/?)*(\/[a-zA-Z0-9]+\.(\w+))*(\/([\w]+)\/?)*(\?(\w+=?[\w]*))*((&?\w+=?[\w]*))*$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证经度
 * @test 要验证的字符串
 * @return boolean //$result匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkLng($test)
{
    /**
     * 经度匹配
     * 经度规则：-180到180度
     */
    $rule = '/^(-?((180)|(((1[0-7]\\d)|(\\d{1,2}))(\\.\\d+)?)))$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证纬度
 * @test 要验证的字符串
 * @return boolean //$result匹配到的字符串数组 【0】是全匹配
 * @access public
 *
 * ***********************************************************
 */
function checkLat($test)
{
    /**
     * 纬度匹配
     * 纬度规则：-90到90度
     */
    $rule = '/^(-?((90)|((([0-8]\\d)|(\\d{1}))(\\.\\d+)?)))$/';
    preg_match($rule, $test, $result);
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证时间戳
 * @param mixed $time 要验证的时间变量
 * @param string $type 验证模式 默认1：严格验证 2：不严格验证（允许时间戳是字符串类型）
 * @return boolean
 * @access public
 *
 * ***********************************************************
 */
function checkTimeStamp($time, $type = '1')
{
    /**
     * 时间戳规则
     * 严格时间戳，必须为整形，不严格时间戳可以为字符串类型
     * 转化为整数类型必须大于等于1970-01-01 00:00:00 时间戳
     */
    if ($type == '2' || is_int($time)) {
        $time = $time * 1;
        if ($time >= strtotime('1970-01-01 00:00:00')) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

/*
 * ************************************************************
 *
 * 验证是否是微信浏览器
 * @return boolean
 * @access public
 *
 * ***********************************************************
 */
function checkWeixinBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'MicroMessenger') === false) {
        // 非微信
        return false;
    } else {
        return true;
    }
}

/*
 * ************************************************************
 *
 * 验证是否是电脑访问
 * @return boolean
 * @access public
 *
 * ***********************************************************
 */
function checkIsPc()
{
    if (stripos($_SERVER['HTTP_USER_AGENT'], "android") != false || stripos($_SERVER['HTTP_USER_AGENT'], "ios") != false || stripos($_SERVER['HTTP_USER_AGENT'], "wp") != false) {
        return false;
    } else {
        return true;
    }
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 转换类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 使用特定function对数组中所有元素做处理
 * @param string &$array 要处理的字符串
 * @param string $function 要执行的函数
 * @return boolean $apply_to_keys_also 是否也应用到key上
 * @access private(内部调用)
 *
 * ***********************************************************
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++ $recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter --;
}

/*
 * ************************************************************
 *
 * 将数组转换为JSON字符串（兼容中文）
 * @param array $array 要转换的数组
 * @return string 转换得到的json字符串
 * @access public
 *
 * ***********************************************************
 */
function TJSON($array)
{
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}

/*
 * ************************************************************
 *
 * 将JSON转换为数组
 * @param string $web 要转换的json字符串
 * @return array 转换得到的数组
 * @access public
 *
 * ***********************************************************
 */
function TARRAY($web)
{
    $arr = array();
    foreach ($web as $k => $w) {
        if (is_object($w))
            $arr[$k] = TARRAY($w); // 判断类型是不是object
        else
            $arr[$k] = $w;
    }
    return $arr;
}

/*
 * ************************************************************
 *
 * 文本换行转换成 \n(文本PHP_EOL to \n)
 * @param string $password 要转换的字符串
 * @return string 返回转换后的字符串
 * @access public
 *
 * ***********************************************************
 */
function eolToN($string)
{
    return str_replace("\n", '\n', $string);
}

/*
 * ************************************************************
 *
 * \n还原成成文本换行 (\n to 文本PHP_EOL)
 * @param string $password 要转换的字符串
 * @return string 返回转换后的字符串
 * @access public
 *
 * ***********************************************************
 */
function nToEol($string)
{
    return str_replace('\n', "\n", $string);
}

/*
 * ************************************************************
 *
 * 获取汉字拼音首字母（大写）
 * @param string $str 传入的汉字
 * @return char 返回新的大写字符
 * @access public
 *
 * ***********************************************************
 */
function getFirstChar($str)
{
    if (empty($str)) {
        return '';
    }
    $fchar = ord($str{0});
    if ($fchar >= ord('A') && $fchar <= ord('z'))
        return strtoupper($str{0});
    $s1 = iconv('UTF-8', 'gb2312', $str);
    $s2 = iconv('gb2312', 'UTF-8', $s1);
    $s = $s2 == $str ? $s1 : $str;
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if ($asc >= - 20319 && $asc <= - 20284)
        return 'A';
    if ($asc >= - 20283 && $asc <= - 19776)
        return 'B';
    if ($asc >= - 19775 && $asc <= - 19219)
        return 'C';
    if ($asc >= - 19218 && $asc <= - 18711)
        return 'D';
    if ($asc >= - 18710 && $asc <= - 18527)
        return 'E';
    if ($asc >= - 18526 && $asc <= - 18240)
        return 'F';
    if ($asc >= - 18239 && $asc <= - 17923)
        return 'G';
    if ($asc >= - 17922 && $asc <= - 17418)
        return 'H';
    if ($asc >= - 17417 && $asc <= - 16475)
        return 'J';
    if ($asc >= - 16474 && $asc <= - 16213)
        return 'K';
    if ($asc >= - 16212 && $asc <= - 15641)
        return 'L';
    if ($asc >= - 15640 && $asc <= - 15166)
        return 'M';
    if ($asc >= - 15165 && $asc <= - 14923)
        return 'N';
    if ($asc >= - 14922 && $asc <= - 14915)
        return 'O';
    if ($asc >= - 14914 && $asc <= - 14631)
        return 'P';
    if ($asc >= - 14630 && $asc <= - 14150)
        return 'Q';
    if ($asc >= - 14149 && $asc <= - 14091)
        return 'R';
    if ($asc >= - 14090 && $asc <= - 13319)
        return 'S';
    if ($asc >= - 13318 && $asc <= - 12839)
        return 'T';
    if ($asc >= - 12838 && $asc <= - 12557)
        return 'W';
    if ($asc >= - 12556 && $asc <= - 11848)
        return 'X';
    if ($asc >= - 11847 && $asc <= - 11056)
        return 'Y';
    if ($asc >= - 11055 && $asc <= - 10247)
        return 'Z';
    return null;
}


/*
 * ************************************************************
 *
 * 将字符串中指定长度字符替换为指定字符
 * @param string $str 需要处理的字符串
 * @param string $replace 准备替换的字符
 * @param string $start 开始替换位置,0表示起始位置
 * @param string $length 替换长度，为负时，为距离末尾长度
 * @return string 返回新的字符串
 * @access public
 *
 * ***********************************************************
 */
function gxdSubstreplace($str,$replace,$start=0,$length=null){
    /**
     * 例：$str='6222022201825647856'
     *    gxdSubstreplace($str,'*',0,-4);
     *    $newstr='***************7856';
     */
    $newstr='';
    $len=strlen($str);//字符串长度
    if(empty($length) && $length != 0){
        $length=len;
    }
    for($i=0;$i<$len;$i++){
        if(($length>0 && $i>=$start && $i<$start+$length) || ($length <0 && $i>=$start && $i<$len+$length)){
            $newstr.=$replace;
        }else{
            $newstr.=$str{$i};
        }
    }
    return $newstr;
}


/*
 * ************************************************************
 *
 * 在字符串间隔指定长度处，插入指定字符串
 * @param string $str 需要处理的字符串
 * @param string $replace 准备替换的字符
 * @param string $start 开始替换位置,0表示起始位置
 * @param string $length 替换长度，为负时，为距离末尾长度
 * @return string 返回新的字符串
 * @access public
 *
 * ***********************************************************
 */
function gxdInsertstr($str,$insertstr,$step=1){
    /**
     * 例：$str='6222022201825647856'
     *    gxdInsertstr($str,' ',4);
     *    $newstr='6222 0222 0182 5647 856';
     */
    $newstr='';
    $len=strlen($str);//字符串长度
    for($i=0;$i<$len;$i++){
        if($i%$step == '0' && $i != 0){
            $newstr.=$insertstr;
        }
        $newstr.=$str{$i};
    }
    return $newstr;
}


/*
 * ************************************************************
 *
 * 转换数字为 钱币 显示模式
 * @param float $number 需要处理的数字(数字默认是元为单位)
 * @param int $model 输出模式 1:正规钱币分割，保留2位小数    2：小数部分全部保留
 * @return string 返回新的钱币模式字符串
 * @access public
 *
 * ***********************************************************
 */
function gxdNumToMoney($number,$model=1){
    /**
     * 例：$number=1500000.3354654
     *    gxdNumToMoney($number,2);
     *    $newstr=1,500,000.335,465,4;
     */
    $newstr='';
    $number=$number*1;//强转数字类型
    $number=$number.'';//再次强转为字符串类型
    $num=explode('.', $number);
    $integer=empty($num[0]) ? 0 : $num[0];//整数部分
    $decimal=empty($num[1]) ? 0 : $num[1];//小数部分
    $newinteger=strrev(gxdInsertstr(strrev($integer), ',',3));
    switch ($model){
        case 1:
            $newdecimal=substr($decimal, 0,2);
            break;
        default:
            $newdecimal=gxdInsertstr($decimal, ',',3);
    }
    if($length=strlen($newdecimal) <2){
        for($i=0;$i<2-$length;$i++){
            $newdecimal.='0';
        }
    }
    $newstr=$newinteger.'.'.$newdecimal;
    return $newstr;
}
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 工具类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 以js谈框的形式，返回传入的信息
 * @param string $str 要提示的错误信息
 * @param string $url 要跳转的连接地址：可为绝对地址，或者相对地址
 * @return string 返回的js代码
 * @access public
 *
 * ***********************************************************
 */
function returnJs($str, $url = '')
{
    if ($url) {
        echo '<script>alert("' . $str . '");window.location.href="' . $url . '";</script>';
    } else {
        echo '<script>alert("' . $str . '");window.history.back();</script>';
    }
    exit();
}

/*
 * ************************************************************
 *
 * 以json形式，返回传入的信息
 * @param mixed $data 要提示的错误信息(字符串，可支持数组)
 * @param string $code 信息代码，正确时为10000，错误请传入错误码
 * @param integer $type 输出类型 1：输出并终止程序 2：输出但不终止程序3:返回结果
 * @return string 返回的json字符串
 * @access public
 *
 * ***********************************************************
 */
function returnJson($data, $code = '10000', $type = 1)
{
    /**
     * 1开头是系统错误码，业务错误码，从2开始
     * 10000 操作已完成
     * 10001 操作失败
     * 10002 校验错误
     * 10003 请求的必要参数缺失
     * 10004 请求参数长度超出限制
     */
    $arr = array(
        'code' => $code,
        'result' => $data
    );
    switch ($type) {
        case 1:
            echo TJSON($arr);
            exit();
            break;
        case 2:
            echo TJSON($arr);
            break;
        default:
            return TJSON($arr);
            exit();
    }
}

/*
 * ************************************************************
 *
 * 项目密码的加密
 * 备注：在此处可以修改加密规则，如果需要账号和密码进行关联，请传入账号，不需要可以不传
 * @param string $password 要加密的密码
 * @param string $username 用户账号
 * @param string $string 干扰字符串
 * @return string 返回md5加密后的字符串
 * @access public
 *
 * ***********************************************************
 */
function setPwd($password, $username = '', $string = 'ganrao')
{
    return empty($username) ? md5($string . $password) : md5($username . md5($string . $password));
}

/*
 * ************************************************************
 *
 * 个人密码加密小函数
 * 备注：在此处可以修改加密规则
 * @param string $str 要加密的密码
 * @param integer $type 默认1：数字和小写字母 2：数字和大小写字母 3：混合类型（数字、大小写字母、字符）
 * @return string 返回加密后的字符串
 * @access public
 *
 * ***********************************************************
 */
function setGaoPwd($str, $type = 1)
{
    $len = strlen($str);
    $newstr = '';
    for ($i = 0; $i < $len; $i ++) {
        switch ($str{$i}) {
            case 'a':
                if ($type == 3) {
                    $newstr .= '!';
                } else {
                    $newstr .= '1';
                }
                break;
            case 'b':
                if ($type == 3) {
                    $newstr .= '#';
                } elseif ($type = 2) {
                    $newstr .= 'B';
                } else {
                    $newstr .= '2';
                }
                break;
            case 'c':
                if ($type == 3) {
                    $newstr .= '$';
                } else {
                    $newstr .= '3';
                }
                break;
            case 'd':
                if ($type == 3) {
                    $newstr .= '%';
                } elseif ($type == 2) {
                    $newstr .= 'D';
                } else {
                    $newstr .= '4';
                }
                break;
            case 'e':
                if ($type == 3) {
                    $newstr .= '@';
                } else {
                    $newstr .= '5';
                }
                break;
            case 'f':
                if ($type == 3) {
                    $newstr .= '^';
                } elseif ($type == 2) {
                    $newstr .= 'F';
                } else {
                    $newstr .= '6';
                }
                break;
            case 'g':
                if ($type == 3) {
                    $newstr .= '&';
                } else {
                    $newstr .= '7';
                }
                break;
            case 'h':
                if ($type == 3) {
                    $newstr .= '*';
                } elseif ($type == 2) {
                    $newstr .= 'H';
                } else {
                    $newstr .= '8';
                }
                break;
            case 'i':
                if ($type == 3) {
                    $newstr .= '_';
                } else {
                    $newstr .= '9';
                }
                break;
            case '1':
                if ($type == 2) {
                    $newstr .= 'A';
                } else {
                    $newstr .= 'a';
                }

                break;
            case '2':
                $newstr .= 'b';
                break;
            case '3':
                if ($type == 2) {
                    $newstr .= 'C';
                } else {
                    $newstr .= 'c';
                }
                break;
            case '4':
                $newstr .= 'd';
                break;
            case '5':
                if ($type == 2) {
                    $newstr .= 'E';
                } else {
                    $newstr .= 'e';
                }
                break;
            case '6':
                $newstr .= 'f';
                break;
            case '7':
                if ($type == 2) {
                    $newstr .= 'G';
                } else {
                    $newstr .= 'g';
                }
                break;
            case '8':
                $newstr .= 'h';
                break;
            case '9':
                if ($type == 2) {
                    $newstr .= 'I';
                } else {
                    $newstr .= 'i';
                }
                break;
            default:
                $newstr .= $str{$i};
        }
    }
    return $newstr;
}

/*
 * ************************************************************
 *
 * 对上传的文件进行检测和移动（待检测）
 * @param string $basepath 上传路径
 * @param array $file 上传的文件包
 * @param array $arrtype 允许上传的格式
 * @param boolean $rename 是否需要重命名
 * @return string 返回上传后的路径
 * @access public
 *
 * ***********************************************************
 */
function getUploadPic($basepath, $file, $arrtype, $rename = true)
{
    /**
     * $basepath 文件最终存放的相对路径 例如：'uploads/bigLogo'
     */
    if (is_uploaded_file($file)) {
        returnJson('非HTTP POST上传', '10002');
    }
    $name = $file['name']; // 文件名
    $type = $file['type']; // 文件类型
    $size = $file['size']; // 文件大小
    $tmp_name = $file['tmp_name']; // 文件临时路径
    $error = $file['error']; // 系统返回的上传状态值
                             // 判断文件格式是否合格
    if (in_array($type, $arrtype)) {
        if ($error == 0) {
            $basepath = trim($basepath, '/');
            // 开始移动文件
            $path = $targetpath = $_SERVER['DOCUMENT_ROOT'] . $basepath . '/' . $name; // 拼写文件目标路径
            $temp = move_uploaded_file($tmp_name, $targetpath); // 移动文件
            if ($rename) {
                // 重命名文件名
                $name1 = pathinfo($targetpath);
                $name_dirname = $name1['dirname']; // 取得文件路径
                $name_extension = $name1['extension']; // 取得文件后缀格式
                $path = $newname = $name_dirname . '/' . time() . rand(1, 1000000) . '.' . $name_extension; // 以时间戳生成新文件名
                $temp1 = rename($targetpath, $newname); // 重命名文件
            }
            return substr($path, strlen($_SERVER['DOCUMENT_ROOT'])); // 返回文件相对路径
        } else {
            returnJson('上传文件出错', '10001');
        }
    } else {
        $message = '请上传';
        foreach ($arrtype as $k1 => $v1) {
            $message .= $v1 . '、';
        }
        $message .= '格式的文件';
        returnJson($message, '10002');
    }
}

/*
 * ************************************************************
 *
 * yii框架 session封装操作
 * @param string $param session键名
 * @param string $value session键值
 * @return null
 * @access public
 *
 * ***********************************************************
 */
function getYS($param)
{
    return Yii::app()->session[$param];
}

function setYS($param, $value)
{
    Yii::app()->session[$param] = $value;
}

function unsetYS($param)
{
    unset(Yii::app()->session[$param]);
}

/*
 * ************************************************************
 *
 * yii框架 cookie封装操作
 * @param string $param cookie键名
 * @param string $value cookie键值
 * @param inter $expire cookie有效期（默认为一周）
 * @return null
 * @access public
 *
 * ***********************************************************
 */
function getYC($param)
{
    $cookie = Yii::app()->request->getCookies();
    return $cookie[$param]->value;
}

function setYC($param, $value, $expire = 604800)
{
    $cookie = new CHttpCookie($param, json_encode($value));
    $cookie->expire = time() + $expire; // 有限期30天
    Yii::app()->request->cookies[$param] = $cookie;
}

function unsetYC($param)
{
    $cookie = Yii::app()->request->getCookies();
    unset($cookie[$param]);
}

/*
 * ************************************************************
 *
 * yii框架 获取参数
 * @param string $param 要获取的参数名
 * @param string $type 要获取的类型1：get参数 2：post参数 3：get和post参数
 * @return mix
 * @access public
 *
 * ***********************************************************
 */
function getYP($param, $type = 3)
{
    if ($type == 1) {
        $string = $_GET[$param];
    } elseif ($type == 2) {
        $string = $_POST[$param];
    } else {
        $string = Yii::app()->request->getParam($param);
    }
    return $string;
}

/*
 * ************************************************************
 *
 * CURL get请求
 * @param string $url 请求的链接
 * @return mixed json字符串 或 false
 * @access public
 *
 * ***********************************************************
 */
function http_get($url)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); // CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

/*
 * ************************************************************
 *
 * CURL post请求
 * @param string $url 请求的链接
 * @param mixed $param 要传的参数（字符串或者数组）
 * @param boolean $post_file 控制是否将数组参数保持原样，true:保留数组  false:将数组拼接
 * @return mixed json字符串 或 false
 * @access public
 *
 * ***********************************************************
 */
function http_post($url, $param, $post_file = false)
{
    set_time_limit(200);
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); // CURL_SSLVERSION_TLSv1
    }
    if (is_string($param) || $post_file) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach ($param as $key => $val) {
            $aPOST[] = $key . "=" . urlencode($val);
        }
        $strPOST = join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POST, true);
    // curl_setopt($oCurl, CURLOPT_HEADER, 0);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

function getImage($url, $filename = '', $type = 0)
{
    if ($url == '') {
        return false;
    }
    if ($filename == '') {
        $ext = strrchr($url, '.');
        if ($ext != '.gif' && $ext != '.jpg') {
            return false;
        }
        $filename = time() . $ext;
    }
    // 文件保存路径
    if ($type) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $img = curl_exec($ch);
        curl_close($ch);
    } else {
        ob_start();
        readfile($url);
        $img = ob_get_contents();
        ob_end_clean();
    }
    $size = strlen($img);
    // 文件大小
    $fp2 = @fopen($filename, 'a');
    fwrite($fp2, $img);
    fclose($fp2);
    return $filename;
}

/*
 * ************************************************************
 *
 * 获取访问者设备类型（待检测）
 * @return string 返回访问者的类型
 * @access public
 *
 * ***********************************************************
 */
function getBrowserStyle()
{
    if (stripos($_SERVER['HTTP_USER_AGENT'], "android") != false) {
        return 'android';
    } elseif (stripos($_SERVER['HTTP_USER_AGENT'], "ios") != false) {
        return 'ios';
    } elseif (stripos($_SERVER['HTTP_USER_AGENT'], "wp") != false) {
        return 'wp';
    } else {
        return 'pc';
    }
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 排序类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 多维数组按某个键值进行排序
 * @param type $arr：多维数组
 * @param type $keys：参考排序的键值
 * @param type $type：排序类型 asc升序 desc降序
 * @return type array数组类型
 * @access public
 *
 * ***********************************************************
 */
function setArrSort($arr, $keys, $type = 'asc')
{
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }

    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }

    reset($keysvalue);

    foreach ($keysvalue as $k => $v) {
        $new_array[] = $arr[$k];
    }

    return $new_array;
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 算法类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 根据经纬度，计算2点间的距离
 * @param type $lng1 经度1
 * @param type $lat1 纬度1
 * @param type $lng2 经度2
 * @param type $lat2 纬度2
 * @param type $len_type 1:m 2:km
 * @param type $decimal 精度，小数点后的位数
 * @return number 返回距离值
 * @access public
 *
 * ***********************************************************
 */
function getDistance($lng1, $lat1, $lng2, $lat2, $len_type = 1, $decimal = 2)
{
    define('EARTH_RADIUS', 6378.137); // 地球半径，假设地球是规则的球体
    define('PI', 3.1415926);
    $radLat1 = $lat1 * PI() / 180.0; // PI()圆周率
    $radLat2 = $lat2 * PI() / 180.0;
    $a = $radLat1 - $radLat2;
    $b = ($lng1 * PI() / 180.0) - ($lng2 * PI() / 180.0);
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
    $s = $s * EARTH_RADIUS;
    $s = round($s * 1000);
    if ($len_type > 1) {
        $s /= 1000;
    }
    return round($s, $decimal);
}

/*
 * ************************************************************
 *
 * 抽奖算法1
 * 适用场景：奖品和中奖概率都可以单独配置
 * @param array $proArr 抽奖配置数组
 * @return string 返回中奖项的键名
 * @access public
 *
 * ***********************************************************
 */
function getLottery1($proArr)
{

    /**
     * $proArr = array(
     * '0' => array('id'=>1,'prize'=>'平板电脑','v'=>1),
     * '1' => array('id'=>2,'prize'=>'数码相机','v'=>5),
     * '2' => array('id'=>3,'prize'=>'音箱设备','v'=>10),
     * '3' => array('id'=>4,'prize'=>'4G优盘','v'=>12),
     * '4' => array('id'=>5,'prize'=>'10Q币','v'=>22),
     * '5' => array('id'=>6,'prize'=>'下次没准就能中哦','v'=>50),
     * );
     */
    $newProArr = array();
    foreach ($proArr as $key => $proCur) {
        $newProArr[$key] = $proCur['v'];
    }
    $result = '';

    // 概率数组的总概率精度
    $proSum = array_sum($newProArr);

    // 概率数组循环
    foreach ($newProArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset($proArr);
    unset($newProArr);
    return $result;
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 时间类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 功能计算两个时间的时间差
 * @param string $time1 起始日期:时间字符串或者时间戳
 * @param string $time2 结束日期:时间字符串或者时间戳
 * @return array={[day]=>?,[hour]=>?,[minute]=>?,[second]=>?}
 * @access public
 *
 * ***********************************************************
 */
function getTimeDiff($time1, $time2)
{
    $startdate = checkTimeStamp($time1) ? $time1 : strtotime($time1);
    $enddate = checkTimeStamp($time2) ? $time2 : strtotime($time2);
    $temp = $enddate - $startdate;
    $result['day'] = floor($temp / 86400);
    $result['hour'] = floor($temp % 86400 / 3600);
    $result['minute'] = floor($temp % 86400 % 3600 / 60);
    $result['second'] = floor($temp % 86400 % 3600 % 60);

    if ($result['day'] >= 0) {
        if ($result['hour'] == 0 && $result['minute'] == 0 && $result['second'] == 0) {
            $result['lastday'] = $result['day'];
        } else {
            $result['lastday'] = $result['day'] + 1;
        }
    } else {
        $result['lastday'] = '0';
    }
    return $result;
}

/*
 * ************************************************************
 *
 * 功能:获取精确度更高的时间戳
 * @param level 级别（小数位数【0~6】）
 * @param style 样式（是否显示小数点：1不显示2显示）
 * @return string 为了防止科学计数法，返回数值用字符串表示
 * @access public
 *
 * ***********************************************************
 */
function getTimestamps($level = 3, $style = '2')
{
    if ($level * 1 > 6 || $level * 1 < 0) {
        $level = 6;
    }
    $newnum = '';
    list ($usec, $sec) = explode(" ", microtime());
    switch ($style) {
        case '1':
            $newnum = $sec . substr($usec, 2, $level * 1);
            break;
        case '2':
            $newnum = $sec . substr($usec, 1, 1 + $level * 1);
            break;
        default:
            $newnum = $sec . substr($usec, 2, $level * 1);
            break;
    }
    return $newnum;
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 过滤类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 防注入,过滤特殊字符
 * @param mixed $array 需要过滤的数据
 * @return array
 * @access public
 *
 * ***********************************************************
 */
function sec(&$array)
{
    // 如果是数组，遍历数组，递归调用
    if (is_array($array)) {
        foreach ($array as $k => $v) {
            $array[$k] = sec($v);
        }
    } else 
        if (is_string($array)) {
            // 使用addslashes函数来处理
            $array = addslashes($array);
        } else 
            if (is_numeric($array)) {
                $array = intval($array);
            }
    return $array;
}

/*
 * ************************************************************
 *
 * 功能：去除英文单双引符号
 * @param string $str 需要过滤的字符串
 * @return string
 * @access public
 *
 * ***********************************************************
 */
function check_clsspecialsign($str)
{
    $str = str_replace("\'", '', $str);
    $str = str_replace("\"", '', $str);
    return $str;
}

/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */
/* * *******************************************************我是华丽的分割线********************************************************** */

/* * *********************************************************************** */
/* * ************************** ********************************* */
/* * ************************* 拼割类 ******************************** */
/* * ************************** ********************************* */
/* * *********************************************************************** */

/*
 * ************************************************************
 *
 * 将本地图片字符串处理为完整的图片数组(待验证)
 * @param string $string 图片字符串
 * @param string $type 对单张图片处理模式 默认1：字符串模式返回 2：数组模式返回
 * @return mixed 返回补全的链接信息，可能是数组或者字符串
 * @access public
 *
 * ***********************************************************
 */
function setPicUrl($string, $type = '1')
{
    /**
     * 例如 $string='uploads/Pic/1.jpg,uploads/Pic/2.jpg,uploads/Pic/3.jpg,uploads/Pic/4.jpg'
     * 返回 $arr[0]='http://www.tongchenghui123.com/uploads/Pic/1.jpg';
     * $arr[1]='http://www.tongchenghui123.com/uploads/Pic/2.jpg';
     * $arr[2]='http://www.tongchenghui123.com/uploads/Pic/3.jpg';
     * $arr[3]='http://www.tongchenghui123.com/uploads/Pic/4.jpg';
     */
    $arr = explode(',', trim($string));
    if (! empty($string)) {
        if (count($arr) > 1) {
            foreach ($arr as $key => $value) {
                $arr[$key] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $arr[$key];
            }
        } else {
            if ($type == '2') {
                $arr[0] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $arr[0];
            } else {
                $arr = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $arr[0];
            }
        }
    } else {
        $arr = array();
    }
    return $arr;
}

/*
 * ************************************************************
 *
 * 截取指定长度的中英文混合字符串
 * @param string $str 等待截取的字符串
 * @param string $start 开始截取位置
 * @param string $length 截取的长度：不管是中文还是英文，都是一个长度
 * @param string $charset 字符编码
 * @param string $suffix 是否带省略号：true带省略，false不带省略符
 * @return $length 返回新的字符串
 * @access public
 *
 * ***********************************************************
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr")) {
        if ($suffix)
            return mb_substr($str, $start, $length, $charset) . "…";
        return mb_substr($str, $start, $length, $charset);
    } elseif (function_exists('iconv_substr')) {
        if ($suffix)
            return iconv_substr($str, $start, $length, $charset) . "…";
        return iconv_substr($str, $start, $length, $charset);
    }
    $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix)
        return $slice . "…";
    return $slice;
}

/*
 * ************************************************************
 *
 * 从用符号拼接的长字符串中删除某个短字符串
 * @param string $oldStr 老字符串
 * @param string $delStr 要删除的字符串
 * @param string $splitstring 分割符，不支持字符串
 * @return string 返回新的字符串
 * @access public
 *
 * ***********************************************************
 */
function delString($oldStr, $delStr, $splitstring)
{
    /**
     * 例如：$oldStr="uploads/Pic/1.jpg,uploads/Pic/2.jpg,uploads/Pic/3.jpg,uploads/Pic/4.jpg"
     * $delStr="uploads/Pic/1.jpg"
     * $newStr="uploads/Pic/2.jpg,uploads/Pic/3.jpg,uploads/Pic/4.jpg"
     */
    $arr = explode($splitstring, trim($oldStr, $splitstring));
    foreach ($arr as $k => $v) {
        if ($v == $delStr) {
            unset($arr[$k]);
        }
    }
    $newStr = implode($splitstring, $arr);

    return $newStr;
}

/*
 * ************************************************************
 *
 * 获取百分比数字（设置小数位数）
 * @param string $oldnum 待切割的数字
 * @param string $num 要保留的小数位数
 * @param int $type 返回的形式默认1：小数 2：百分比(82.35%算4位小数)
 * @return number 返回新的数字
 * @access public
 *
 * ***********************************************************
 */
function cutNumber($oldnum, $num, $type = 1)
{
    $multnum = pow(10, floor($num));
    $newnum = floor($oldnum * $multnum) / $multnum;
    if ($type == 2) {
        $newnum = $newnum * 100;
    }

    return $newnum;
}


/*
 * ************************************************************
 *
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
 * @param array $para 需要拼接的数组
 * @param int $type 是否对字符串做编码 0：不做处理  1：对字符串进行 urlencode编码
 * @return string 拼接完成以后的字符串
 * @access public
 *
 * ***********************************************************
 */
function gxdCreateLink($para,$type=0) {
    $arg  = "";
    
    if($type=1){
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".urlencode($val)."&";
        }
    }else{
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".$val."&";
        }
    }
    
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}


/*
 * ************************************************************
 *
 * 把多维数组拼接成字符串，并用特定符号  替代 符号 "
 * @param array $multiarr 需要拼接的多维数组
 * @param string $str 替换 " 的字符串或者符号
 * @return string 拼接完成以后的字符串
 * @access public
 *
 * ***********************************************************
 */
function gxdCreateMultiLink($multiarr,$str ="#") {
    $arg=str_replace('"',$str,json_encode($multiarr));
    return $arg;
}

/*
 * @后台Banner位置
 * @ rerurn array
 */
function Banner(){
    return array(
        1=>'PC-首页banner',
        2=>'PC-关于我们banner',
        3=>'PC-安全保障banner',
        4=>'PC-合作伙伴banner',
        5=>'PC-加入我们banner',
        6=>'微信-活期列表页',
        7=>'微信-定期理财首页',
        8=>'微信-定期理财列表页',
        9=>'微信-定期借款人详情',
        10=>'微信-定期担保机构',
        11=>'微信-定期风险提示',
        12=>'微信-常见问题',
        13=>'微信、安全保障',
        14=>'PC-产品说明banner',
        15=>'微信-兜财宝',
    );
}

/*
 * @后台 资讯文章 类别
 * @ return array;
 */
function ArticleCategory(){
    return array(
        1=>'合作伙伴',
        2=>'媒体报道',
        3=>'活期理财咨询',
        4=>'安全保障',
        5=>'合作银行',
        6=>'加入我们',
        7=>'友情链接',
        8=>'产品说明',
    );
}

/*
 * @后台 资讯文章 类别
 * @ return array;
 */
function ArticleTag(){
    return array(
        1=>'互联网',
        2=>'理财',
        3=>'金融',
        4=>'北京',
        5=>'网络',
        6=>'投资',

    );
}