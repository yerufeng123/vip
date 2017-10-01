<?php

/*
 * 红包扩展类
 * weiyeying
 * 2015-1-14
 * 
 *  */

class packet {

    var $para; //参数设置

    const url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
    const appid = "wxa3a69a78c2bb02b6";
    const mch_id = "1227118002";
    const key = "e920583447ac9432757534eb07cced2c";//商户API
				 

    //初始化参数
    public function __construct() {
        $this->para['nonce_str'] = $this->create_noncestr(); //随机数
        $this->para['mch_id'] = self::mch_id; //商户号
        $this->para['wxappid'] = self::appid;
        $this->para['nick_name'] = '会点会务通'; //提供方名称
        $this->para['send_name'] = '会点会务通'; //商户名称
        $this->para['total_num'] = 1; //数量
        $this->para['wishing'] = "会点会务通红包测试";
        $this->para['client_ip'] = '202.85.221.61';
        $this->para['act_name'] = '会点会务通红包';
        $this->para['remark'] = '会点会务通红包发送';
      
    }

    /**
     * 设置参数
     * 需要设置订单号
     * 金额
     * 最小金额
     * 最大金额
     * 用户openid
     * */
//设置参数并返回xml
   public function set_parm($order_id, $openid, $price) {
        $this->para['mch_billno'] = $order_id; //订单编号
        $this->para['re_openid'] = $openid; //用户openid
        $this->para['total_amount'] = $price; //金额
        $this->para['min_value'] = $price; //金额
        $this->para['max_value'] = $price; //金额
        $sign = $this->sign($this->para);
        $this->para['sign'] = $sign;
      
       $data = $this->arrayToXml($this->para);
       return $data;
    }
    //发送（这方法后加的没测试如果不好使请放到上面的方法里）
    public function send_packet($data){
        $url = self::url;
        $res = $this->curl_post_ssl($url, $data);
        $d = (array) simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
         return $d;
    }
    

    public function getpara() {
        return $this->para;
    }
    
//生成sign签名     
public function sign($params){
    ksort($params);
    $beSign = array_filter($params, 'strlen');
    $pairs = array();
    foreach ($beSign as $k => $v) {
        $pairs[] = "$k=$v";
    }
 
    $sign_data = implode('&', $pairs);
    $sign_data.='&key='.self::key;
    return strtoupper(md5($sign_data));
}
    

//转换xml
    function arrayToXml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml.="<" . $key . ">" . $val . "</" . $key . ">";
            }
            else
                $xml.="<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml.="</xml>";
        return $xml;
    }

//随机字符串
    function create_noncestr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //发送数据
    public function post2($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            echo '错误!' . curl_error($ch);
        }
        curl_close($ch);
        return $tmpInfo;
    }

//    //发送数据
    public function curl_post_ssl($url, $vars, $second = 30, $aHeader = array()) {
        $ch = curl_init();
        //超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //以下两种方式需选择一种
        //第一种方法，cert 与 key 分别属于两个.pem文件
      curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT,getcwd().'/protected/components/pay/apiclient_cert.pem');
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, getcwd().'/protected/components/pay/apiclient_key.pem');
        curl_setopt($ch, CURLOPT_CAINFO, getcwd().'/protected/components/pay/rootca.pem');

        //第二种方式，两个文件合成一个.pem文件
        //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');

        if (count($aHeader) >= 1) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        $data = curl_exec($ch);
        $info=curl_getinfo($ch);
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            //echo "call faild, errorCode:$error\n"; 
            curl_close($ch);
            return false;
        }
    }

}

?>
