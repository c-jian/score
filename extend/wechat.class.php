<?php
use think\Db;

//企业微信操作类库
class Wechat{

	private $corpid='wwd86db5a846c4ecd4';//企业的CorpID
	private	$secret = 'el9IFG_Acvf-CjSl8t2FwAX14rQAnXx1WKht7ZsRk54'; //密钥
	/*请求access_token*/
	private function getAccessToken(){
  
	  $dbres=Db::table('access_token')->find();

	  if (!$dbres || $dbres['expires_time']<time()){//表里没有数据并且时间已经过期
		
		$time = time()+7200; //当前时间+2小时等于过期时间

		/*
		这里在php7.2.10出现问题：file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:
		error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed
		换成5.6.38又可以了，待查证
		*/
		$res = file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$this->corpid.'&corpsecret='.$this->secret);
		
		$res = json_decode($res, true);
		
		$token = $res['access_token'];
		
		if($token){
			
		  $data = array(
			  'access_token' => $token,
			  'expires_time' => $time
		  );
		  
		  if($dbres){
			//更新数据库
			Db::table('access_token')->where(array('id'=>$dbres['id']))->update($data);
		  }else{
			//保存数据库
			Db::table('access_token')->insert($data);
		  }
		  
		}
	  }else{//有数据，没过期
		  return $dbres['access_token'];
	  }
	  return $token;//获取了新的数据
	}

	//获取access_token
	public function getAccessTokenData(){
		return $this->getAccessToken();
	}

	public function getCorpid(){
		return $this->corpid;
	}

	public function getSecret(){
		return $this->secret;
	}

}






?>