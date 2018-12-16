<?php
namespace app\api\controller;
use think\Db;

class WX{
	
	public function index(){
	}
	
	/*请求access_token*/
	private function getAccessToken(){
		
	  $corpid = 'wwd86db5a846c4ecd4'; //企业id
	  $secret = 'el9IFG_Acvf-CjSl8t2FwAX14rQAnXx1WKht7ZsRk54'; //密钥
	  
	  $dbres=Db::table('access_token')->find();
	  if (!$dbres || $dbres['expires_time']<time()){//数据库里没有数据并且时间已经过期
		
		$time = time()+7200; //当前时间+2小时等于过期时间
		$res = file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$corpid.'&corpsecret='.$secret);
		
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
	
	/*获取jsapi_ticket*/
	private function getJsApiTicket(){
		
		$dbres=Db::table('jsapi_ticket')->find();
		
		  if (!$dbres || $dbres['expires_time']<time()){//数据库里没有数据并且时间已经过期
			
			$time = time()+7200; //当前时间+2小时等于过期时间
			
			$res = file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/ticket/get?access_token='.$this->getAccessToken().'&type=agent_config');

			$res = json_decode($res, true);
			
			$ticket = $res['ticket'];
			
			if($ticket){
				
			  $data = array(
				  'ticket'=>$ticket,
				  'expires_time'=>$time
			  );
			  
			  if($dbres){
				//更新数据库
				Db::table('jsapi_ticket')->where(array('id'=>$dbres['id']))->update($data);
			  }else{
				//保存数据库
				Db::table('jsapi_ticket')->insert($data);
			  }
			  
			}
		  }else{//有数据，没过期
			  return $dbres['ticket'];
		  }
		  
		  return $ticket;//获取了新的数据
	  
		
	}
	/*获取16个字符的随机字符串*/
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
		  $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	/*权限配置*/
	public function config(){
		
		$ticket=$this->getJsApiTicket();
		$timestamp=time();
		$nonceStr=$this->createNonceStr();
		$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$signature=sha1("jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url");
		$data=array(
			'beta'=>true,
			'debug'=>true,
			'appId'=>'ww378cd488e2adb040',
			'timestamp'=>$timestamp,
			'nonceStr'=>$nonceStr,
			'signature'=>$signature,
			'url'=>$url,
			'jsApiList'=>array('onMenuShareAppMessage')
		);
		$this->message('获取配置信息成功',$data);
	}
	
	/**
	*返回数据
	*/
	private function message($msg='',$data,$state=0){
		$getbackData=array(
			'rows'=>$data,
			'msg'=>$msg,
			'state'=>$state
		);
		echo json_encode($getbackData,JSON_UNESCAPED_UNICODE);
		die;
	}
	
}









?>