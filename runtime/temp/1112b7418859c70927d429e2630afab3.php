<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\filesys\public/../application/project\view\index\index.html";i:1540957376;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件列表</title>
	<style>
	body,ul,li,h1{
		margin:0;
		padding:0;
		font-family: '微软雅黑';
	}
	ul,li{
		list-style: none;
	}
	.listbox{

	}
	.header{
		border-bottom:1px solid #ccc;
		height:60px;
		line-height: 60px;
	}
	.header .title{
		font-size:26px;
		max-width: 1028px;
		margin:0 auto;
		text-align: center;
	}
	.main{
		max-width: 1028px;
		margin:0 auto;
	}
	.main .file-ul{
		margin-top:10px;
	}
	.main .file-item{
		padding:15px 10px;
		height:21px;
		border-bottom:1px dashed #ccc;
	}
	.main .file-item:hover{
		background:#D1ECF3;
	}
	.download{
		float:right;
		width:21px;
		height:21px;
		background: url('/public/static/img/icon/download.png') no-repeat center center;
		background-size:21px;
		margin-right: 10px;
		cursor: pointer;
	}
	.download:hover{
		background: url('/public/static/img/icon/download-active.png') no-repeat center center;
		background-size:21px;
	}
	.downloadnum{
		float:right;
		font-size: 13px;
		margin-top: 5px;
		font-style:normal;
		color:#ccc;
	}
	.size{
		font-size:13px;
		color:#aaa;
	}
	/*文件图标*/
	.fileIcon{
		width:21px;
		height:21px;
		margin-right:10px;
		display: inline-block;
	}
	.doc,.docx{
		background: url('/public/static/img/icon/doc.png') no-repeat center center;
		background-size:21px;
	}
	.pdf{
		background: url('/public/static/img/icon/pdf.png') no-repeat center center;
		background-size:21px;
	}
	.xls,.xlsx{
		background: url('/public/static/img/icon/xls.png') no-repeat center center;
		background-size:21px;
	}
	.ppt{
		background: url('/public/static/img/icon/ppt.png') no-repeat center center;
		background-size:21px;
	}
	.jpeg,.jpg,.png,.gif{
		background: url('/public/static/img/icon/pic.png') no-repeat center center;
		background-size:21px;
	}
	.zip,.rar{
		background: url('/public/static/img/icon/zip.png') no-repeat center center;
		background-size:21px;
	}
	</style>
</head>

<body>
	
	<div class="listbox">
		<div class="header">
			<h1 class="title">项目名称：<?php echo $pname; ?></h1>
		</div>

		<div class="main">
			<ul class="file-ul">
				<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li class="file-item">
						<span class="fileIcon <?php echo $v['ext']; ?>"></span>
						<?php echo $v['name']; ?>
						&nbsp;<span class="size">大小：<?php echo $v['size']; ?>mb</span>
						<i class="downloadnum"></i>
						<a href="/public/index/index/download?fid=<?php echo $v['id']; ?>&pid=<?php echo $id; ?>&code=<?php echo $code; ?>" target="_blank"><span class="download" data-id="<?php echo $v['id']; ?>"></span></a>
					</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>

		</div>

	</div>
</body>
</html>