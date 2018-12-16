<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
import('wechat', EXTEND_PATH,'.class.php');
class Index extends Controller
{

	private $token=''; //access_token

	public function __construct(){

		//获取access_token
		$wechat=new \Wechat();
		$this->token=$wechat->getAccessTokenData();

	}

	public function index(){

		

	}
 
 	/**
 	 * 获取部门列表
 	 */
 	public function getDepartmentList(){

 		$id=input('id');

 		$list=file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$this->token.'&id='.$id);

 		return $list;

 	}
	
 	/**
 	 * 获取部门所属成员列表
 	 */
 	public function getUserList(){

 		$reload=input('reload');
 		$res=Db::table('company_info')->select();
 		
 		//如果数据库为空，或者前端要求要重新请求数据
 		if(!$res || $reload=='reload'){

	 		$department=$this->getDepartmentList();

	 		$arr=json_decode($department,true)['department'];

	 		$arrLen=count($arr);

	 		$list=[];


	 		for($i=0;$i<$arrLen;$i++){

	 			$userlist=file_get_contents('https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token='.$this->token.'&department_id='.$arr[$i]['id']);
	 			$list[]=[
	 				'departmentId'=>$arr[$i]['id'],
	 				'departmentName'=>$arr[$i]['name'],
	 				'parentid'=>$arr[$i]['parentid'],
	 				'order'=>$arr[$i]['order'],
	 				'userlist'=>$userlist
	 			];

	 		}
	 		if($reload=='reload'){
	 			//更新数据库
	 			Db::table('company_info')->where('id>0')->delete();//先全部删除
	 			Db::table('company_info')->saveAll($list);//saveAll是Model的方法
	 		}else{
	 			//保存到数据库
	 			Db::table('company_info')->insertAll($list);
	 		}
	 		
	 		//返回数据
	 		$this->respond(['msg'=>'获取数据成功','data'=>$list,'code'=>0]);

 		}else{

 			//返回数据
 			$this->respond(['msg'=>'获取数据成功','data'=>$res,'code'=>0]);

 		}

 	}

 	/**
 	 * 添加评委
 	 */
 	public function addRater(){

 		$idstr=input('idstr');
 		$imgstr=input('imgstr');
 		$unamestr=input('unamestr');

 		if(!empty($idstr)){
 			$id=explode('|', $idstr);
 		}

 		if(!empty($imgstr)){
 			$img=explode('|', $imgstr);
 		}

 		if(!empty($unamestr)){
 			$uname=explode('|', $unamestr);
 		}

 		$arr=[];
 		$len=count($id);

 		for($i=0;$i<$len;$i++){
 			$arr[]=[
 				'raterid'=>$id[$i],
 				'name'=>$uname[$i],
 				'avatar'=>$img[$i]
 			];
 		}

 		if(Db::table('rater')->select()){
 			Db::table('rater')->where('id>0')->delete();
 			$res=Db::table('rater')->insertAll($arr);
 		}else{
 			$res=Db::table('rater')->insertAll($arr);
 		}

 		if($res){
 			$this->respond(['msg'=>'保存成功','code'=>0,'data'=>$res]);
 		}
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
