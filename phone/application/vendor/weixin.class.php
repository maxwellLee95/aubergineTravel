<?php
/**
 * PHP 微信
 *
 */
class weixinPHP
{
	var $appid;
	var $appkey;
	var $callback_url;
	var $access_token;
	var $state;//可回调验证参数
	var $scope='snsapi_login'; //授权方法
	function __construct($appid, $appkey,$callback_url,$state,$access_token=NULL){
		$this->appid=$appid;
		$this->appkey=$appkey;
		$this->callback_url=$callback_url;
		$this->state=$state;
		$this->access_token=$access_token;	
	}


    function createOauthUrlForCode()
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["redirect_uri"] = $this->callback_url;
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = $this->scope;
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->formatBizQueryParaMap($urlObj, false);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }

    /**
     * 	作用：格式化参数，签名过程需要使用
     */
    function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v)
        {
            if($urlencode)
            {
                $v = urlencode($v);
            }
            //$buff .= strtolower($k) . "=" . $v . "&";
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar=null;
        if (strlen($buff) > 0)
        {
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }
   

    //返回登陆地址.
	function login_url(){
		$params=array(
			'appid'=>$this->appid,
			'redirect_uri'=>$this->callback_url,
			'response_type'=>'code',
			'scope'=>$this->scope,
			'state'=>$this->state,
		);
		return 'https://open.weixin.qq.com/connect/qrconnect?'.http_build_query($params).'#wechat_redirect';
	}

	function access_token($code){
		$params=array(
			'grant_type'=>'authorization_code',
			'appid'=>$this->appid,
			'secret'=>$this->appkey,
			'code'=>$code,
			'state'=>''
		);
		$url='https://api.weixin.qq.com/sns/oauth2/access_token?'.http_build_query($params);
		$result_str=$this->http($url);
		
		$json_r=array();
		if($result_str!=''){
			$json_r = json_decode($result_str,true);  
		}
		
		return $json_r;
	}


	function get_user_info($openid,$token){
		$params=array(
			'access_token'=>$token,
			'openid'=>$openid
		);
		$url='https://api.weixin.qq.com/sns/userinfo';
		return $this->api($url, $params);
	}

    function get_user_base_info($openid,$token){
        $params=array(
            'access_token'=>$token,
            'openid'=>$openid,
            'lang'=>'zh_CN'
        );
        $url='https://api.weixin.qq.com/cgi-bin/user/info';
        return $this->api($url, $params);
    }

	function api($url, $params, $method='GET'){
		
		if($method=='GET'){
			$result_str=$this->http($url.'?'.http_build_query($params));
		}else{
			$result_str=$this->http($url, http_build_query($params), 'POST');
		}
		$result=array();
		if($result_str!='')$result=json_decode($result_str, true);
		return $result; 
	}

	function http($url, $postfields='', $method='GET', $headers=array()){
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
}