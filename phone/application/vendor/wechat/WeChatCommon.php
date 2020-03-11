<?php
/**
 * Created by PhpStorm.
 * User: Lance
 * Date: 2018/12/23
 * Time: 15:41
 */

class WeChatCommon
{
    public static function getAccessToken(){
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(self::getWeChatFile("access_token"));
        if ($data->expire_time < time()) {
            $appid = $GLOBALS['cfg_wxpay_appid'];
            $appkey = $GLOBALS['cfg_wxpay_appsecret'];
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appkey";
            $res = json_decode(self::httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                self::setWeChatFile("access_token", json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    public static function httpGet($url) {
        $ci=curl_init();
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_URL, $url);
        $response=curl_exec($ci);
        curl_close($ci);
        return $response;
    }

    static function getWeChatFile($filename) {
        $file = BASEPATH . '/data/'.$filename.'.php';
        return trim(substr(file_get_contents($file), 15));
    }

    static function setWeChatFile($filename, $content) {
        $path = BASEPATH . '/data/'.$filename.'.php';
        $fp = fopen($path, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }

    static function http($url, $postfields='', $method='GET', $headers=array()){
        $ci=curl_init();
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        if($method=='POST'){
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response=curl_exec($ci);
        curl_close($ci);
        return $response;
    }

    static function api($url, $params, $method='GET'){

        if($method=='GET'){
            $result_str=self::http($url.'?'.http_build_query($params));
        }else{
            if (is_array($params)){
                $postfields=http_build_query($params);
            }else{
                $postfields=$params;
            }
            $result_str=self::http($url, $postfields, 'POST');
        }
        $result=array();
        if($result_str!='')$result=json_decode($result_str, true);
        return $result;
    }

    function ihttp_request($url, $post = '', $extra = array(), $timeout = 60) {
        $urlset = parse_url($url);
        if (empty($urlset['path'])) {
            $urlset['path'] = '/';
        }
        if (!empty($urlset['query'])) {
            $urlset['query'] = "?{$urlset['query']}";
        }
        if (empty($urlset['port'])) {
        }
        if (strexists($url, 'https://') && !extension_loaded('openssl')) {
            if (!extension_loaded("openssl")) {
                message('请开启您PHP环境的openssl');
            }
        }
        if (function_exists('curl_init') && function_exists('curl_exec')) {
            $ch = curl_init();
            if (!empty($extra['ip'])) {
                $extra['Host'] = $urlset['host'];
                $urlset['host'] = $extra['ip'];
                unset($extra['ip']);
            }
            curl_setopt($ch, CURLOPT_URL, $urlset['scheme'] . '://' . $urlset['host'] . ($urlset['port'] == '80' || empty($urlset['port']) ? '' : ':' . $urlset['port']) . $urlset['path'] . $urlset['query']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            @curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            if ($post) {
                if (is_array($post)) {
                    $filepost = false;
                    foreach ($post as $name => &$value) {
                        if (version_compare(phpversion(), '5.6') >= 0 && substr($value, 0, 1) == '@') {
                            $value = new CURLFile(ltrim($value, '@'));
                        }
                        if ((is_string($value) && substr($value, 0, 1) == '@') || (class_exists('CURLFile') && $value instanceof CURLFile)) {
                            $filepost = true;
                        }
                    }
                    if (!$filepost) {
                        $post = http_build_query($post);
                    }
                }
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
            if (!empty($GLOBALS['_W']['config']['setting']['proxy'])) {
                $urls = parse_url($GLOBALS['_W']['config']['setting']['proxy']['host']);
                if (!empty($urls['host'])) {
                    curl_setopt($ch, CURLOPT_PROXY, "{$urls['host']}:{$urls['port']}");
                    $proxytype = 'CURLPROXY_' . strtoupper($urls['scheme']);
                    if (!empty($urls['scheme']) && defined($proxytype)) {
                        curl_setopt($ch, CURLOPT_PROXYTYPE, constant($proxytype));
                    } else {
                        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
                        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
                    }
                    if (!empty($GLOBALS['_W']['config']['setting']['proxy']['auth'])) {
                        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $GLOBALS['_W']['config']['setting']['proxy']['auth']);
                    }
                }
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
            if (defined('CURL_SSLVERSION_TLSv1')) {
                curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            }
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
            if (!empty($extra) && is_array($extra)) {
                $headers = array();
                foreach ($extra as $opt => $value) {
                    if (strexists($opt, 'CURLOPT_')) {
                        curl_setopt($ch, constant($opt), $value);
                    } elseif (is_numeric($opt)) {
                        curl_setopt($ch, $opt, $value);
                    } else {
                        $headers[] = "{$opt}: {$value}";
                    }
                }
                if (!empty($headers)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }
            }
            $data = curl_exec($ch);
            $status = curl_getinfo($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            curl_close($ch);
            if ($errno || empty($data)) {
                return error(1, $error);
            } else {
                return ihttp_response_parse($data);
            }
        }
        $method = empty($post) ? 'GET' : 'POST';
        $fdata = "{$method} {$urlset['path']}{$urlset['query']} HTTP/1.1\r\n";
        $fdata .= "Host: {$urlset['host']}\r\n";
        if (function_exists('gzdecode')) {
            $fdata .= "Accept-Encoding: gzip, deflate\r\n";
        }
        $fdata .= "Connection: close\r\n";
        if (!empty($extra) && is_array($extra)) {
            foreach ($extra as $opt => $value) {
                if (!strexists($opt, 'CURLOPT_')) {
                    $fdata .= "{$opt}: {$value}\r\n";
                }
            }
        }
        $body = '';
        if ($post) {
            if (is_array($post)) {
                $body = http_build_query($post);
            } else {
                $body = urlencode($post);
            }
            $fdata .= 'Content-Length: ' . strlen($body) . "\r\n\r\n{$body}";
        } else {
            $fdata .= "\r\n";
        }
        if ($urlset['scheme'] == 'https') {
            $fp = fsockopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
        } else {
            $fp = fsockopen($urlset['host'], $urlset['port'], $errno, $error);
        }
        stream_set_blocking($fp, true);
        stream_set_timeout($fp, $timeout);
        if (!$fp) {
            return error(1, $error);
        } else {
            fwrite($fp, $fdata);
            $content = '';
            while (!feof($fp))
                $content .= fgets($fp, 512);
            fclose($fp);
            return ihttp_response_parse($content, true);
        }
    }

    public static function log($msg){
        if (is_array($msg)){
            $msg=json_encode($msg);
        }
        $path = BASEPATH . '/data/wechat_logs.txt';
        file_put_contents($path,date("Y-m-d H:i:s")."----". $msg."\r",FILE_APPEND);
    }


}