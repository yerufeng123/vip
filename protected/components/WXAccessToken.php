<?php

class WXAccessToken {

    /**
     * 功能：获取微信accesstoken
     * 备注：全部项目唯一指定获取token方法
     * 位置：  /static/weixincache/wechat_access_token+appId值
     * 调用示例：  $accesstoken=WXAccessToken::getToken(appId值);
     */
    public static function getToken($appid, $appSecret) {
        $access_token_file = $_SERVER['DOCUMENT_ROOT'] . "/static/weixincache/" . "wechat_access_token" . $appid;
        if (!file_exists($access_token_file)) {
            $data_create = '{"expire_time":0,"access_token":""}';
            file_put_contents($access_token_file, $data_create);
        }

        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents($access_token_file));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appSecret";
            $res = json_decode(self::httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen($access_token_file, "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    /**
     * 功能：获取微信JsApiTicket
     * 备注：全部项目唯一指定获取JsApiTicket方法
     * 位置：  /static/weixincache/wechat_jsapi_ticket+appId值
     * 调用示例：  $jsapiticket=WXAccessToken::getApiTicket(appId值);
     */
    public static function getApiTicket($appid, $appSecret) {
        $wechat_jsapi_ticket = $_SERVER['DOCUMENT_ROOT'] . "/static/weixincache/" . "wechat_jsapi_ticket" . $appid;
        if (!file_exists($wechat_jsapi_ticket)) {
            $data_create = '{"expire_time":0,"jsapi_ticket":""}';
            file_put_contents($wechat_jsapi_ticket, $data_create);
        }

        $data = json_decode(file_get_contents($wechat_jsapi_ticket));
        if ($data->expire_time < time()) {
            $accessToken = self::getToken($appid, $appSecret);
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode(self::httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen(_STATICPATH_ . "weixincache/" . "wechat_jsapi_ticket" . $appid, "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }

    private static function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        file_put_contents(_STATICPATH_.'wxaccesstokenall.txt', $res."#####\r\n",FILE_APPEND);
        curl_close($curl);

        return $res;
    }

}
