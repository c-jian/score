<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\filesys\public/../application/project\view\index\skip.html";i:1540793671;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pname; ?></title>
	<script>
		var url='<?php echo $gotourl; ?>';
		if(url){
			location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wwd86db5a846c4ecd4&redirect_uri='+url+'&response_type=code&scope=snsapi_base#wechat_redirect';
		}
	</script>
</head>
<body>
	<p style="text-indent:-10000px;">来自<?php echo $pname; ?>项目文件夹的分享</p>

	<p>您可以点击右上角“转发”按钮分享给您的成员！</p>
</body>
</html>