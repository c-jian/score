<?php

namespace app\mark\controller;
use think\Controller;
use think\Db;
import('wechat', EXTEND_PATH,'.class.php');
class Index extends Controller{

	private $token=''; //access_token
	private $gotourl='/score/public/index.php/mark/Index/mark';
	private $corpid='';//企业的CorpID

	public function __construct(){

		//获取access_token
		$wechat=new \Wechat();
		$this->token=$wechat->getAccessTokenData();
		//获取企业的CorpID
		$this->corpid=$wechat->getCorpid();

	}

	//页面跳转
	public function index(){

		$this->redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->corpid.'&redirect_uri='.$this->gotourl.'&response_type=code&scope=snsapi_base#wechat_redirect
',302);//302重定向

	}


	//打分页面
	public function mark(){
		echo 'mark';
	}

	/**
     * 返回数据
     */
    private function respond($data){
    	header('Content-Type:application/json; charset=utf-8');
    	echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit();
    }
}




?>