<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"D:\filesys\public/../application/api\view\index\upload.html";i:1540179480;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
	<style>
	#box{
		width:1080px;
		margin:0 auto;
		font-family: '微软雅黑';
	}
	.title{
		margin-top:200px;
		color:#3385ff;
		
		font-size: 25px;
		background: url('/public/static/img/icon/yes.png') no-repeat 0 center;
		background-size: 22px 22px;
		text-indent: 30px;
	}
	.info{
		margin-top:15px;
		text-indent: 30px;
		font-size: 16px;
		letter-spacing:3px;
	}
	</style>
</head>
<body>
	<div id="box">
		<div class="title">上传成功!</div>
		<div class="info">该页面<span id="second">3</span>秒后跳转<a href="/public">首页</a></div>
	</div>

	<script>
		var s=3,
			sEle=document.getElementById('second');
		setInterval(function(){
			s--;
			sEle.innerHTML=s;
			if(s==0){
				location.href='/public';
			}
		},1000)
	</script>
</body>
</html>