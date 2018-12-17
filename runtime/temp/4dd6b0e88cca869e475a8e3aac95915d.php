<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\file\public/../application/index\view\index\fileList.html";i:1543886361;}*/ ?>
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
		padding:20px 0 0px 0;
	}
	.header .title{
		font-size:23px;
		max-width: 1028px;
		margin:0 auto;
	}
	.header p{
		max-width: 1028px;
		margin:0 auto;
		padding:10px 0;
		
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
		/*height:21px;*/
		border-bottom:1px dashed #ccc;
	}
	.main .file-item:hover{
		background:#D1ECF3;
	}
	.download{
		float:right;
		width:21px;
		height:21px;
		background: url('/static/img/icon/download.png') no-repeat center center;
		background-size:21px;
		margin-right: 10px;
		cursor: pointer;
	}
	.download:hover{
		background: url('/static/img/icon/download-active.png') no-repeat center center;
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
	.del-file{
		margin-left:5px;
	}
	
	/*文件图标*/
	.fileIcon{
		width:21px;
		height:21px;
		margin-right:10px;
		display: inline-block;
	}
	.doc,.docx{
		background: url('/static/img/icon/doc.png') no-repeat center center;
		background-size:21px;
	}
	.pdf{
		background: url('/static/img/icon/pdf.png') no-repeat center center;
		background-size:21px;
	}
	.xls,.xlsx{
		background: url('/static/img/icon/xls.png') no-repeat center center;
		background-size:21px;
	}
	.ppt{
		background: url('/static/img/icon/ppt.png') no-repeat center center;
		background-size:21px;
	}
	.jpeg,.jpg,.png,.gif{
		background: url('/static/img/icon/pic.png') no-repeat center center;
		background-size:21px;
	}
	.rar,.zip{
		background: url('/static/img/icon/zip.png') no-repeat center center;
		background-size:21px;
	}
	</style>
</head>
<body>
	
	<div class="listbox">
		<div class="header">
			<h1 class="title">项目名称：<?php echo $pname; ?></h1>
			<p>
			授权下载的成员：<?php echo $warrantName; ?>
			</p>
		</div>

		<div class="main">
			<ul class="file-ul">
				<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li class="file-item">
						<span class="fileIcon <?php echo $v['ext']; ?>"></span>
						<?php echo $v['name']; ?>
						&nbsp;<span class="size">大小：<?php  if($v['size']>1){echo $v['size'].'mb';}else{echo round($v['smallsize']/1024,2).'kb';}  ?></span>
						<a href="javascript:void(0);" class="del-file" data-id="<?php echo $v['id']; ?>" onclick="delFile(this)">删除</a>
						<i class="downloadnum">下载<?php echo $v['downloadnum']; ?>次</i>
						<a href="/index/index/download?fid=<?php echo $v['id']; ?>&pid=<?php echo $id; ?>" target="_blank"><span class="download" data-id="<?php echo $v['id']; ?>"></span></a>
						<input type="hidden" id="hdn" value="<?php echo $v['downloadName']; ?>"/>
						<div id="dn" style="padding-top:15px;">
							已下载成员：<?php echo $v['downloadName']; ?>
						</div>
					</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>

		</div>

	</div>
	<script src="/static/js/jquery.js"></script>
	<script>
	function delFile(el){
		var id=$(el).data('id');
		if(confirm('您确定删除此文件吗？')){
			$.ajax({
				url:'/index/index/delFile',
				data:{id:id},
				dataType:'json',
				success:function(data){
					if(data.state==0){
						alert(data.msg);
						window.location.reload();
					}else{
						alert(data.msg);
					}
				}
			})
		}
	}

	</script>
</body>
</html>