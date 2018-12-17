<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\filesys\public/../application/login\view\index\register.html";i:1540276530;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<style>
		html{
			width:100%;
			height: 100%;
		}
		body{
			margin:0;
			width:100%;
			height:100%;
			background-image:url('/public/static/img/login-bg.jpg');
			background-repeat:no-repeat;
			background-size:cover;
		}
		p{
			margin:0;
		}
		.bg{
			width:100%;
			height:100%;
			background:rgba(20,62,111,.5);
		}
		.login-box{
			width:400px;
			height:300px;
			background: #fff;
			box-shadow: 1px 0px 1px 2px #eee;
			position: absolute;
			left:50%;
			top:50%;
			margin-left:-200px;
			margin-top:-150px;
			border-radius: 5px;
			padding:10px;
			box-sizing: border-box;
			padding-top:30px;
		}
		.ipt{
			width:100%;
			height:35px;
			border:1px solid #3385ff;
			outline: none;
			text-indent:5px;
			margin:10px 0;
			border-radius: 5px;
		}
		.reg{
			width:100%;
			background: #3385ff;
			color:#fff;
			display:block;
			left:0;
			height:40px;
			text-align: center;
			line-height:40px;
			font-size: 16px;
			cursor:pointer;
			border-radius: 5px;
			margin-top:50px;
			font-family:'微软雅黑';
		}
		.text{
			font-size:13px;
			color:#ccc;
			margin-top:8px;
		}
	</style>
</head>
<body>
	<div class="bg">
		
		<div class="login-box">
			<p><input type="text" name="uname" id="uname" class="ipt" placeholder="用户名"></p>
			<p><input type="password" name="pwd" id="pwd" class="ipt" placeholder="密码"></p>
			<p class="text"><a href="/public/login/">登录</a></p>
			<p><span class="reg">注册</span></p>
		</div>

	</div>
	<script src="/public/static/js/jquery.js"></script>
	<script>
		$('.reg').click(function(){
			var uname=$('#uname').val();
			var pwd=$('#pwd').val();
			$.ajax({
				url:'/public/login/index/reg',
				dataType:'json',
				data:{uname:uname,pwd:pwd},
				success:function(data){
					console.log(data);
					if(data['state']==0){
						alert('注册成功');
					}
				}
			})
		})
	</script>
</body>
</html>