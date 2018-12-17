<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"D:\filesys/application/index\view\index\index.html";i:1540182550;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件管理系统</title>
	<style>
	body{
		margin:0;
		font-family:'微软雅黑';
		font-size:14px;
	}
	ul,li{
		margin:0;
		padding:0;
		list-style:none;
	}
	/*创建头部模块*/
	.create-header{
		height:50px;
		line-height:50px;
		border-bottom:1px solid #ccc;
	}
	/*创建内侧模块*/
	.inner-create-box{
		max-width:1360px;
		margin:0 auto;
	}
	/*创建按钮*/
	.create-btn{
		color:#fff;
		width:90px;
		height:35px;
		display:inline-block;
		text-align:center;
		line-height:33px;
		cursor:default;
		border-radius:5px;
		background:#3385ff url('/public/static/img/icon/plus.png') no-repeat 5px center;
		background-size:20px 20px;
		text-indent:15px;
		font-size:16px;
	}
	/*应用列表*/
	.project-list{
		max-width:1360px;
		margin:0 auto;
		margin-top:10px;
	}
	.project-list .project-table{
		width:100%;
		text-align:center;
	}
	.project-table th{
		background:#eee;
		padding:10px 0;
	}
	.project-table td{
		padding:10px 0;
		border-bottom:1px solid #eee;
	}
	/*没有数据时*/
	.no-data{
		width:100%;
		height:450px;
		background:url('/public/static/img/icon/empty.png') no-repeat center center;
		background-size:100px 100px;
		text-align:center;
		line-height:250px;
		color:#ccc;
		font-size:18px;
	}
	.other-create-btn{
		color:#3385ff;
		cursor:pointer;
	}
	
	/*点击创建*/
	.upload-bg{
		position:absolute;
		z-index:1000;
		background:rgba(0,0,0,.3);
		width:100%;
		height:100%;
		left:0;
		top:0;
		display:none;
	}
	.upload-box{
		width:500px;
		height:400px;
		position:absolute;
		top:50%;
		left:50%;
		margin-left:-250px;
		margin-top:-250px;
		background:#fff;
		border-radius:5px;
		box-shadow:1px 1px 6px 2px #888;
	}
	.upload-header{
		height:40px;
		line-height:40px;
		padding:0 10px;
		font-weight:600;
		font-size:16px;
		background:#3385ff;
		color:#fff;
	}
	.upload-main{
		height:320px;
		padding:0 10px;
		overflow:auto;
	}
	.project-name-line{
		line-height:50px;
	}
	.project-name{
		width:100px;
		float:left;
		font-weight:bold;
	}
	.project-name-ipt{
		width:380px;
		float:left;
	}
	.ipt-name{
		width:95%;
		height:25px;
	}
	.group{
		font-weight:bold;
	}
	.group-list{
		height:200px;
		padding:0 10px;
		overflow:auto;
	}
	.group-item{
		height:35px;
		line-height:35px;
		border-bottom:1px solid #eee;
	}
	.group-item .yes{
		float:right;
		width:20px;
		height:20px;
		background:url('/public/static/img/icon/yes.png') no-repeat center center;
		background-size:20px 20px;
		margin-top:7px;
	}
	.group-item .no{
		float:right;
		width:20px;
		height:20px;
		background:url('/public/static/img/icon/no.png') no-repeat center center;
		background-size:20px 20px;
		margin-top:7px;
	}
	.upload-main .line{
		border-bottom:1px solid #eee;
		overflow:hidden;
		padding:10px 0;
	}
	.confirm,.cancel{
		width:80px;
		height:30px;
		border:none;
		color:#fff;
		font-size:16px;
		border-radius:5px;
		margin-left:10px;
		outline:none;
	}
	.confirm{
		background:#3385ff;
	}
	.cancel{
		background:red;
	}
	
	/*上传*/
	.file-line{
		padding:10px 0;
	}
	.add-file{
		display:inline-block;
		width:100px;
		height:30px;
		background:#3385ff;
		color:#fff;
		text-align:center;
		line-height:30px;
		border-radius:5px;
		cursor:default;
	}
	/*创建和上传模块*/
	.c-box,.u-box{
		display:none;
	}
	</style>
</head>
<body>
	<div class="create-header">
		<div class="inner-create-box">
			<span class="create-btn create-ev">project</span>
		</div>
	</div>
	<div class="project-list">
		
		<div class="no-data">当前列表没有数据，赶紧<span class="other-create-btn create-ev">创建</span>吧！</div>
	</div>
	
	<!--创建project-->

	<div class="upload-bg">
		<!--创建-->
		<div class="upload-box c-box">
			<div class="upload-header">创建Project</div>
			<div class="upload-main">
				<div class="line project-name-line">
					<span class="project-name">Project名称</span>
					<span class="project-name-ipt"><input type="text" class="ipt-name"/></span>
				</div>
				<div class="line">
					<span class="group">选择授权成员<span style="color:red;font-weight:normal;">(被选择的成员将有权下载当前Project的文件)</span></span>
					<ul class="group-list">
						<li class="group-item"><span>zhangsan</span> <i class="select-icon yes" data-uid="u1"></i></li>
						<li class="group-item"><span>lisi</span> <i class="select-icon no" data-uid="u2"></i></li>
					</ul>
				</div>
			</div>
			<button class="confirm create-confirm">确定</button>
			<button class="cancel">取消</button>
		</div>
		<!--上传-->
		<div class="upload-box u-box">
			<form name="form" id="form" method="post" action="/public/index/index/upload" enctype="multipart/form-data">
				<div class="upload-header">上传文件</div>
				<div class="upload-main">
					<div id="file-area">
						
						<div class="file-line">
							<input type="file" name="files[]" class="file"/>
						</div>
						
					</div>
					<div class="file-line">
						<span class="add-file">添加文件</span>
					</div>
				</div>
				<input type="hidden" name="projectId" id="projectId"/>
				<input class="upload-confirm confirm" type="submit" value="上传"/>
			</form>
			<button class="cancel" style="position: absolute;left:85px;bottom:10px;">取消</button>
			
		</div>
	</div>
</body>
<script src="/public/static/js/jquery.js"></script>
<script>
/*添加文件事件处理*/
$('.add-file').click(function(){
	$('#file-area').append('<div class="file-line"><input type="file" name="files[]"/></div>');
})
/*取消处理*/
$('.cancel').click(function(){
	$('.upload-bg').hide();
	$('.c-box').hide();
	$('.u-box').hide();
})
/*添加project*/
$('.create-ev').click(function(){
	$('.upload-bg').show();
	$('.c-box').show();
})
/*选择授权成员*/
$('.group-item').click(function(){
	var hasNo=$(this).find('.select-icon').hasClass('no');
	var hasYes=$(this).find('.select-icon').hasClass('yes');
	if(hasNo){
		$(this).find('.select-icon').removeClass('no')
		$(this).find('.select-icon').addClass('yes');
	}
	if(hasYes){
		$(this).find('.select-icon').removeClass('yes')
		$(this).find('.select-icon').addClass('no');
	}
})
/*创建确认*/
$('.create-confirm').click(function(){
	var projectName=$('.ipt-name').val();
	var uid='';
	$('.group-item .select-icon').each(function(k,v){
		if($(v).hasClass('yes')){
			uid+=$(this).data('uid')+'|';
		}
	})
	uid=uid.substr(0,uid.length-1);
	$.ajax({
		url:'/public/api/index/create',
		dataType:'json',
		data:{projectName:projectName,uid:uid},
		success:function(data){
			if(data.state==0){
				alert(data.msg);
				$('.upload-bg').hide();
				$('.c-box').hide();
			}
		}
	})
})
/*获取列表*/
$.ajax({
	url:'/public/api/index/getList',
	dataType:'json',
	success:function(data){
		var html='<table class="project-table"><tr><th>Project</th><th>ID</th><th>URL</th><th>操作</th></tr>';
		var rows=data.rows;
		if(data.state==0){
			for(var i=0;i<rows.length;i++){
				html+='<tr>';
					html+='<td>'+rows[i].projectName+'</td>';
					html+='<td>'+rows[i].projectId+'</td>';
					html+='<td>http://localhost/public/project?id='+rows[i].projectId+'</td>';
					html+='<td><a href="###" class="upload-file" data-id="'+rows[i].projectId+'">上传文件</a></td>';
				html+='</tr>'
			}
			html+='</table>';
			$('.project-list').html(html);
			/*上传文件按钮事件*/
			$('.upload-file').click(function(){
				$('.upload-bg').show();
				$('.u-box').show();
				$('#projectId').val($(this).data('id'))
			})
		}
	}
})
</script>
</html>