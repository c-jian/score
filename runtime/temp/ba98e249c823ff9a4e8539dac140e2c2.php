<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\file\public/../application/index\view\index\upload.html";i:1543886423;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
	<style>
	ul,li{
		list-style:none;
		margin:0;
		padding:0;
	}
	#box{
		width:1080px;
		margin:0 auto;
		font-family: '微软雅黑';
	}
	.title{
		margin-top:200px;
		color:#3385ff;
		
		font-size: 25px;
		background: url('/static/img/icon/yes.png') no-repeat 0 center;
		background-size: 22px 22px;
		text-indent: 30px;
	}
	.info{
		margin-top:15px;
		text-indent: 30px;
		font-size: 16px;
		letter-spacing:3px;
	}
	
	.del{
		margin-top:80px;
		font-size:25px;
		color:#3385ff;
		margin-bottom:20px;
	}
	.mt15{
		margin-top:15px;
	}
	.del-item{
		height:30px;
		line-height:30px;
		margin:10px 0;
		background:url('/static/img/icon/error.png') no-repeat 0px center;
		background-size:35px;
		text-indent:35px;
	}
	</style>
</head>
<body>
	<div id="box">
		<?php if($condition>=1): ?>
			<div class="del">以下文件已经存在，如果想继续上传请先删除</div>
			<ul class="del-ul">
				<?php if(is_array($existsfile) || $existsfile instanceof \think\Collection || $existsfile instanceof \think\Paginator): $k = 0; $__LIST__ = $existsfile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
				<li class="del-item"><?php echo $v; ?></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="mt15"><a href="/">点我回到首页</a></div>
			<?php else: ?>
			
			<div class="title"><?php echo $message; ?></div>
			<div class="info">该页面<span id="second">3</span>秒后跳转<a href="/">首页</a></div>
			<script>
				var s=3,
					sEle=document.getElementById('second');
				setInterval(function(){
					s--;
					sEle.innerHTML=s;
					if(s==0){
						location.href='/';
					}
				},1000)
			</script>
		<?php endif; ?>
		
	</div>

	
</body>
</html>