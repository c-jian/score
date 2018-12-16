<?php
namespace app\login\controller;
use think\Db;
use think\Controller;
class Index extends Controller
{
	/*登录页面*/
	public function index(){
		return view();
	}
	/*注册页面*/
	public function register(){
		return view();
	}
	
	/**
	*用户注册
	*/
    public function reg(){
		$uname=input('uname');
		$password=input('pwd');
		if(empty($uname) || empty($password)){
			$this->message('用户名或密码为空',null,1);
		}
		if(Db::table('user')->where(array('uname'=>$uname))->find()){
			$this->message('用户已存在',null,1);
		}
		
		$res=Db::table('user')->insertGetId(array('uname'=>$uname,'password'=>md5($password)));

	
		if($res){
			$this->message('注册成功',$res);
		}else{
			$this->message('注册失败',$res,4);
		}
	}
	/*登录*/
	public function login(){
		
		$uname=input('uname');
		$password=input('pwd');
		
		if(empty($uname) || empty($password)){
			$this->message('用户名或密码为空',null,1);
		}
		
		$res=Db::table('user')->where(array('uname'=>$uname))->find();
		
		if(empty($res)){
			$this->message('账号错误',null,2);
		}
		
		if($res['password']!=md5($password)){
			$this->message('密码错误',null,2);
		}
		
		$token=$this->getToken();
		
		$data=array(
			'username'=>$res['uname'],
			'token'=>$token,
			'id'=>$res['id']
		);
		
		Db::table('user')->where(array('id'=>$res['id']))->update(array('token'=>$token,'maxtime'=>time()+3600));//保存token并设置过期时间
		
		$this->message('登录成功',$data);
		
	}
	/**
	*生成token/id
	*/
	private function getToken(){
		$str = md5(uniqid(md5(microtime(true)),true));  //生成一个不会重复的字符串
        $str = sha1($str);  //加密
        return $str;
	}
	/**
	*返回数据
	*/
	public function message($msg='',$data,$state=0){
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