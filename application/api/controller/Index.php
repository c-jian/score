<?php
namespace app\api\controller;
use think\Db;
use think\Cookie;
use think\Controller;
class Index extends Controller
{
	/**
	*构造函数
	*/
	public function __construct(){
		 
		$uname=Cookie::get('fsuname');
		$token=Cookie::get('fstoken');
		
		if(empty($uname)){
			$this->message('请登录',null,401); //未登录
		}
		
		$res=Db::table('user')->where(array('uname'=>$uname))->find();
		
		if(!$res){
			$this->message('用户不存在',null,403); //无权操作
		}
		
		if($res['token']!=$token){
			$this->message('验证信息不存在',null,403); //无权操作
		}
		
		if(time()>$res['maxtime'] && $res['maxtime']!=0){
			$this->message('验证信息已过期，请重新登录',null,401); //未登录
		}
	
	}
	
	/*获取项目信息*/
	function getData(){
		
		$id=input('id');
		$res=Db::table('project')->where(array('projectId'=>$id))->find();
		$this->message('获取成功',$res);
		
	}
	/*创建项目*/
	public function create(){
		
		$loginId=Cookie::get('fsid');
		$projectName=input('projectName');
		$uid=input('uid');
		$uname=input('uname');
		if(empty($projectName)){
			$this->message('项目名称不能为空',null,1010);
		}
		$projectId=$this->getToken();
		
		$res=Db::table('project')->insert(array('weChatName'=>$uname,'projectName'=>$projectName,'projectId'=>$projectId,'warrantId'=>$uid,'loginId'=>$loginId,'addtime'=>date('Y-m-d H:i:s',time())));
		
		if($res){
			$this->message('创建成功',array('projectId'=>$projectId));
		}
	}
	
	/*修改项目*/
	public function update(){
		
		$projectName=input('projectName');
		$uid=input('uid');
		$id=input('id');
		$uname=input('uname');
		if(empty($projectName)){
			$this->message('项目名称不能为空',null,1010);
		}
		
		$res=Db::table('project')->where(array('projectId'=>$id))->update(array('projectName'=>$projectName,'warrantId'=>$uid,'weChatName'=>$uname));
		
		if($res){
			$this->message('修改成功',$res);
		}else{
			$this->message('修改失败',$res,42);
		}
		
	}
	/*删除项目*/
	public function delProject(){
		
		$id=input('id');
		
		if(empty($id)){
			$this->message('id有误',null,1010);
		}
		
		//删除文件
		$fres=Db::table('files')->where(array('projectId'=>$id))->select();//读取文件信息
		
		
		
		//删除所有文件
		foreach($fres as $k => $v){
			
			$filepath=ROOT_PATH.$v['path'].iconv('utf-8','gbk',$v['name']);//文件路径
			
			if(file_exists($filepath)){
				unlink($filepath);
			}
		}
		
		//删除文件夹
		if(count($fres)>=1 && is_dir(ROOT_PATH.$fres[0]['path'])){
			rmdir(ROOT_PATH.$fres[0]['path']);
		}
		
		//删除记录
		Db::table('files')->where(array('projectId'=>$id))->delete();//删除文件记录
		
		$res=Db::table('project')->where(array('projectId'=>$id))->delete();//删除项目记录
		
		if($res){
			$this->message('删除成功',$res);
		}else{
			$this->message('删除失败',$res,42);
		}
		
	}
	/*获取用户列表*/
	public function getList(){
		
		$loginId=Cookie::get('fsid');
		
		$res=Db::table('project')->where(array('loginId'=>$loginId))->field('projectId,projectName,addtime,weChatName')->order('id desc')->select();
		
		foreach($res as $k=>$v){
			$res[$k]['fileCount']=Db::table('files')->where(array('projectid'=>$v['projectId']))->count();
		}
		
		$this->message('获取列表成功',$res,0);
		
	}
	/*获取指定项目的文件列表*/
	public function getProjectList(){
		
		$res=Db::table('files')->where(array('projectid'=>input('id')))->select();
		
		$this->message('获取列表成功',$res,0);
	}
	
	/*请求access_token*/
	public function getAccessToken(){
		
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
	
	/*请求部门和部门成员*/
	public function getDepartmentUser(){
		
		$access_token=$this->getAccessToken();
		
		$res = file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token);
		
		$res = json_decode($res, true);
		
		//获取部门成员
		if($res['errcode']==0){
			
			$department=$res['department'];
			
			foreach($department as $k=>$v){
				
				$user = file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token.'&department_id='.$v['id']);
				
				$user = json_decode($user, true);
				
				$res['department'][$k]['userlist']=$user['userlist'];
				
			}
			
		}
		
		$this->message('获取成员数据成功',$res);
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
