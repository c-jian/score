<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\filesys\public/../application/index\view\index\index.html";i:1541140439;}*/ ?>
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
	p{
		margin:0;
	}
	ul,li{
		margin:0;
		padding:0;
		list-style:none;
	}
	input,button{
		outline: none;
		font-family: '微软雅黑';
	}
	a{
		text-decoration: none;
		color:blue;
	}
	/*创建头部模块*/
	.create-header{
		height:45px;
		line-height:45px;
		border-bottom:1px solid #ccc;
		padding:0 20px;
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
		height:45px;
		display:inline-block;
		text-align:center;
		line-height:45px;
		cursor:default;
		background:#3385ff url('/public/static/img/icon/plus.png') no-repeat 2px center;
		background-size:20px 20px;
		text-indent:15px;
		font-size:16px;
	}
	/*应用列表*/
	.project-list{
		max-width:1360px;
		margin:0 auto;
		margin-top:10px;
		padding:0 20px;
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
		display:none;
	}
	.other-create-btn{
		color:#3385ff;
		cursor:pointer;
	}
	
	/*点击创建*/
	.upload-bg{
		position:fixed;
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
		height:310px;
		padding:0 10px;
		overflow:auto;
		border-bottom:1px dashed #eee;
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
		width:95%;
		float:left;
	}
	.ipt-name{
		width:100%;
		height:35px;
		line-height: 35px;
		font-size:14px;
		text-indent: 5px;
		border:1px solid #3385ff;
	}
	.group{
		font-weight:bold;
		display: block;
		height:40px;
		line-height:40px;
	}
	.dep-name{
		height:30px;
		line-height:30px;
		text-indent:8px;
	}
	.dep-name .fold,.dep-name .fold-icon{
		width:20px;
		height:30px;
		float:left;
	}
	.dep-name .fold{
		background:url('/public/static/img/icon/folder.png') no-repeat 0 center;
		background-size:20px;
	}
	.dep-name .fold-icon{
		background:url('/public/static/img/icon/arrow-right.png') no-repeat 0 center;
		background-size:20px;
	}
	.dep-name .fold-active{
		background:url('/public/static/img/icon/arrow-down.png') no-repeat 0 center;
		background-size:20px;
	}
	.hide{
		display:none;
	}
	.dep-group .group-item{
		margin-left:30px;
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
		line-height: 28px;
	}
	.confirm{
		background:#3385ff;
		margin-top:9px;
	}
	.cancel{
		background:red;
	}
	
	/*上传*/
	.file-line{
		height:50px;
		position: relative;
		line-height: 50px;
		border-bottom:1px dashed #ccc;
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
	.c-box,.u-box,.e-box{
		display:none;
	}
	/*上传按钮*/
	.upload-label{
		display:block;
		width:300px;
		overflow:hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		height:50px;
		background:#fff url('/public/static/img/icon/upload.png') no-repeat 10px center;
		background-size:30px;
		position: absolute;
		z-index: 2;
		line-height: 50px;
		text-indent:55px;
		font-size: 16px;
		color:#ccc;
		cursor: pointer;
	}
	.file{
		position: absolute;
		z-index: 1;
	}
	
	.user{
		float:right;
		background:url('/public/static/img/icon/user.png') no-repeat 0 center;
		text-indent:20px;
		background-size:18px;
	}
	.logout{
		float:right;
		margin-left:10px;
	}
	/*项目描述*/
	.list-line{
		height:20px;
		line-height:20px;
		font-size:18px;
		margin-top:40px;
		
	}
	.list-block{
		width:5px;
		height:20px;
		background:#29569A;
		float:left;
		margin-right:5px;
	}
	.list-ul{
		margin-left:15px;
	}
	.list-item{
		border-bottom:1px dashed #ccc;
	}
	.des-title,.des-con{
		display:inline-block;
		font-size:16px;
	}
	.des-title{
		width:80px;
		color:#999;
	}
	.des-line{
		margin:20px 0;
	}
	
	.obtn{
		display:inline-block;
		width:100px;
		height:30px;
		line-height:30px;
		text-indent:30px;
		color:#fff;
		margin-left:10px;
		cursor:pointer;
		border-radius:5px;
		font-style:normal;
	}
	.edit-icon{
		background:#3385ff url('/public/static/img/icon/edit.png') no-repeat 5px center;
		background-size:20px;
	}
	.delete-icon{
		background:#3385ff url('/public/static/img/icon/delete.png') no-repeat 5px center;
		background-size:20px;
	}
	/*authorized-member*/
	.authorized-member{
		float:left;
		padding:1px 8px;
		background:#3385ff;
		margin:0 3px 5px 3px;
		color:#fff;
		border-radius:5px;
	}
	
	/*上传样式*/
	.title{
		float:left;
		width:300px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.filesize{
		color:#333;
		float:left;
		font-size:12px;
	}
	.filename{
		overflow:hidden;
		margin-bottom:5px;
	}
	.filelist{
		margin:10px 0;
	}
	.filebar{
		width:450px;
		border:1px solid #eee;
		height:20px;
		display:none;
	}
	.bar-progress{
		width:0%;
		height:20px;
		display:block;
		background:#3385ff;
		color:#fff;
		line-height:20px;
		text-align:center;
	}
	</style>
</head>
<body>
	<div class="create-header">
		<div class="inner-create-box">
			<span class="create-btn create-ev">添加项目</span>
			<a href="javascript:void(0);" class="logout">退出</a>
			<span class="user"></span>
			
		</div>
	</div>
	<div class="project-list">
		<div class="list-line"><span class="list-block"></span>项目列表</div>
		<ul class="list-ul"></ul>
		<div class="no-data">当前列表没有数据，赶紧<span class="other-create-btn create-ev">创建</span>吧！</div>
	</div>
	
	<!--创建project-->

	<div class="upload-bg">
		<!--创建-->
		<div class="upload-box c-box">
			<div class="upload-header">创建项目</div>
			<div class="upload-main">
				<div class="line project-name-line">
					<span class="project-name-ipt"><input type="text" class="ipt-name create-name" placeholder="项目名称" /></span>
				</div>
				<div class="line">
					<span class="group">选择授权成员<span style="color:red;font-weight:normal;">(被选择的成员将有权下载当前项目的文件)</span></span>
					<ul class="group-list" id="create-list">
							
					</ul>
				</div>
			</div>
			<button class="confirm create-confirm">确定</button>
			<button class="cancel">取消</button>
		</div>
		<!--上传-->
		<div class="upload-box u-box">
			<form enctype="multipart/form-data" method="post" name="fileinfo">
				<div class="upload-header">上传文件</div>
				<div class="upload-main">
					<div id="file-area">
						
						<div class="file-line">
							<label for="file" class="upload-label">点我选择文件上传</label><input type="file" name="filelist[]" onchange="changefile();" multiple="multiple" id="file"/>
						</div>
						
					</div>
					<ul id="content"></ul>
					<!--<div class="file-line" style="border-bottom:none;">
						<span class="add-file">添加文件</span>
					</div>-->
				</div>
				<input type="hidden" name="projectId" id="projectId"/>
				<input class="upload-confirm confirm" type="submit" value="上传"/>
			</form>
			<button class="cancel" style="position: absolute;left:85px;bottom:10px;">取消</button>
			
		</div>
		<!--编辑项目-->
		<div class="upload-box e-box">
			<div class="upload-header">编辑项目</div>
			<div class="upload-main">
				<div class="line project-name-line">
					<span class="project-name-ipt"><input type="text" class="ipt-name eidt-name" id="edit-ipt"/></span>
				</div>
				<div class="line">
					<span class="group">选择授权成员<span style="color:red;font-weight:normal;">(被选择的成员将有权下载当前项目的文件)</span></span>
					<div style="overflow:hidden;"><span style="float:left;">已授权:</span><span style="overflow:hidden;" class="authorized-box"></span></div>
					<ul class="group-list" id="edit-list">
						
					</ul>
				</div>
				<input type="hidden" name="pid" id="pid"/>
			</div>
			<button class="confirm edit-confirm">确定</button>
			<button class="cancel">取消</button>
		</div>
	</div>
<input type="hidden" name="userlist" id="userlist"/>
</body>
<script src="/public/static/js/jquery.js"></script>
<script src="/public/static/js/jquery.cookie.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
var xhr = new XMLHttpRequest();//xhr对象
var clock = null,files=null;
var form=document.forms.namedItem('fileinfo');
var file=document.getElementById('file');
var index=0;
var sendfile = (function (){
    var LENGTH = 1024 * 512;//每次上传的大小
    var start = 0;//每次上传的开始字节
    var end = start + LENGTH;//每次上传的结尾字节
    var sending = false;//表示是否正在上传
    var fd = null;//创建表单数据对象
    var blob = null;//二进制对象
    var percent = 0;
	
    return (function (){
		
        //如果有块正在上传，则不进行上传
        if(sending == true){
            return;
        }

        var file = files[index];//文件对象

        //如果sta>file.size，就结束了
        if(start > file.size){
			index+=1;
			
			if(index==files.length){
				clearInterval(clock);
				//一个文件上传完了
				fd.append('end',1);
				up(fd);
				alert('上传成功');
				window.location.href="/";
			}else{
				clearInterval(clock);
				//一个文件上传完了
				fd.append('end',1);
				up(fd);
				//清空
				fd = null;//创建表单数据对象
				blob = null;//二进制对象
				percent = 0;
				start = 0;
				end = start + LENGTH;
				begin();
			}
			
            return;
        }
        blob = file.slice(start,end);//根据长度截取每次需要上传的数据
        fd = new FormData(form);//每一次需要重新创建
        fd.append('video',blob);//添加数据到fd对象中
		fd.append('filename',file.name);
		fd.append('filesize',file.size);
		fd.append('projectId',$('#projectId').val());
		fd.append('ext',file.name.substr(file.name.lastIndexOf(".")+1));
        up(fd);

        //重新设置开始和结尾
        start = end;
        end = start + LENGTH;

        //sending = false;//上传完了

        //显示进度条
        percent = 100 * start/file.size;
        if(percent>100){
            percent = 100;
        }
		
	   document.getElementById('b'+index).style.display='block';
       document.getElementById('bar'+index).style.width = percent + '%';
       document.getElementById('bar'+index).innerHTML = parseInt(percent)+'%';
	   
    });

})();

form.addEventListener('submit',mysubmit)

function mysubmit(ev){
	ev.preventDefault();
	begin();
}
function begin(){
	clock = window.setInterval(sendfile,1000);
}
function changefile(){

	files=file.files,str='';
	for(var i=0,len=files.length;i<len;i++){
		str += '<li class="filelist"><div class="fileitem">'+
				'<p class="filename"><span class="title">名称:'+files[i].name+'</span><span class="filesize">大小:'+((files[i].size/1024).toFixed(2))+'KB</span></p>'+
				'<p class="filebar" id="b'+i+'"><span class="bar-progress" id="bar'+i+'"></span></p>'+
			'</div></li>';
	}
	document.getElementById('content').innerHTML = str;
	
}
function up(fd){
    xhr.open('POST','/public/index/index/upload',false);
    xhr.send(fd);
}
</script>
<script>

/*
$.ajax({
	url:'/public/api/wx/config',
	dataType:'json',
	success:function(data){
		wx.config(data.rows);
		
		
		wx.ready(function(){
			alert('ready');
			wx.onMenuShareAppMessage({
				title: 'woshi', // 分享标题
				desc: 'woshi', // 分享描述
				link: 'http://www.baidu.com', // 分享链接
				imgUrl: '', // 分享图标
				success: function () {
					alert(1);
					// 用户确认分享后执行的回调函数
				},
				cancel: function () {
					// 用户取消分享后执行的回调函数
				}
			});
			
			
		});
		wx.error(function(res){
			alert(JSON.stringify(res));
		});
	}
})
*/
/*
wx.config({
    beta: true,// 必须这么写，否则wx.invoke调用形式的jsapi会有问题
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: 'ww378cd488e2adb040', // 必填，企业微信的corpID
    timestamp: , // 必填，生成签名的时间戳
    nonceStr: '', // 必填，生成签名的随机串
    signature: '',// 必填，签名，见附录1
    jsApiList: [] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
*/


</script>
<script>
$('.user').html($.cookie('fsuname'));
/*添加文件事件处理*/
var i=0;
$('.add-file').click(function(){
	i++;
	$('#file-area').append('<div class="file-line"><label for="file'+i+'" class="upload-label">点我选择文件上传</label><input type="file" name="files[]" id="file'+i+'" class="file"/></div>');

	$('#file-area').find('.file').on('change',function(e){
		$($(this).prev()).html(e.currentTarget.files[0].name);
	})
})
$('#file-area').find('.file').on('change',function(e){
	$($(this).prev()).html(e.currentTarget.files[0].name);
})
/*取消处理*/
$('.cancel').click(function(){
	$('.upload-bg').hide();
	$('.c-box').hide();
	$('.u-box').hide();
	$('.e-box').hide();
	$('.fold-icon').removeClass('fold-active');
	$('.dep-group-ul').addClass('hide');
})
/*添加project*/
$('.create-ev').click(function(){
	$('.upload-bg').show();
	$('.c-box').show();
})
/*创建确认*/
$('.create-confirm').click(function(){
	var projectName=$('.create-name').val();
	var uid='',uname='';
	$('#create-list .select-icon').each(function(k,v){
		if($(v).hasClass('yes')){
			uid+=$(this).data('uid')+'|';
			uname+=$(v).prev().html()+'|';
		}
	})
	uid=uid.substr(0,uid.length-1);
	uname=uname.substr(0,uname.length-1);
	$.ajax({
		url:'/public/api/index/create',
		dataType:'json',
		data:{projectName:projectName,uid:uid,uname:uname},
		success:function(data){
			if(data.state==0){
				alert(data.msg);
				location.reload();
			}
		}
	})
})
/*退出登录*/
$('.logout').click(function(){
	$.cookie('fsuname','',{ expires: -1 });
	$.cookie('fstoken','',{ expires: -1 });
	$.cookie('fsid','',{ expires: -1 });
	location.reload();
})

/*获取列表*/
var protocol=window.location.protocol;
var host=window.location.host;
var url=protocol+'//'+host+'/public/project?id=';
$.ajax({
	url:'/public/api/index/getList',
	dataType:'json',
	success:function(data){
		var html='';
		var rows=data.rows;
		if(data.state==0){
			for(var i=0;i<rows.length;i++){
				var addtime=rows[i].addtime==null?'':rows[i].addtime;
				html+='<li class="list-item">';
					html+='<div class="des-line"><span class="des-title">项目名称:</span><span class="des-con">'+rows[i].projectName+'<i class="edit-icon obtn" data-id="'+rows[i].projectId+'" data-name="'+rows[i].weChatName+'">编辑项目</i><i class="delete-icon obtn" data-id="'+rows[i].projectId+'">删除项目</i></span></div>';
					html+='<div class="des-line"><span class="des-title">ID:</span><span class="des-con">'+rows[i].projectId+'</span></div>';
					html+='<div class="des-line"><span class="des-title">URL:</span><span class="des-con"><a href="/public/project/index/skip?admin=1&pname='+rows[i].projectName+'&url='+encodeURIComponent(url+rows[i].projectId)+'" target="_blank">分享项目</a></span></div>';
					html+='<div class="des-line"><span class="des-title">操作:</span><span class="des-con"><a href="javascript:void(0);" class="upload-file" data-id="'+rows[i].projectId+'">上传文件</a>&nbsp;<a href="/public/index/index/fileList?id='+rows[i].projectId+'">文件列表</a>&nbsp;<a href=""></a></span></div>';
					html+='<div class="des-line"><span class="des-title">文件数量:</span><span class="des-con">'+rows[i].fileCount+'</span></div>';
					html+='<div class="des-line"><span class="des-title">创建时间:</span><span class="des-con">'+rows[i].addtime+'</span></div>';
			}
			
			$('.list-ul').html(html);
			/*上传文件按钮事件*/
			$('.upload-file').click(function(){
				$('.upload-bg').show();
				$('.u-box').show();
				$('#projectId').val($(this).data('id'))
			})
			/*编辑项目*/
			$('.edit-icon').click(function(){
				$('.upload-bg').show();
				$('.e-box').show();
				$('#pid').val($(this).data('id'));
				
				//渲染部门已授权成员
				if($(this).data('name')){
					var departmentArr=$(this).data('name').split('|');
					var html=''
					for(var i=0,len=departmentArr.length;i<len;i++){
						html+='<span class="authorized-member">'+departmentArr[i]+'</span>';
					}
					$('.authorized-box').html(html);
				}else{
					$('.authorized-box').html('');
				}
				
				render();
			})
			/*删除项目*/
			$('.delete-icon').click(function(){
				if(confirm('您确定删除此项目吗')){
					del($(this).data('id'));
				}
			})
			/*渲染部门已授权成员*/
			
		}
		if(rows && !rows.length){
			$('.no-data').show();
		}
	}
})
/*编辑项目*/
function render(id){
	var id=$('#pid').val();
	$.ajax({
		url:'/public/api/index/getData',
		data:{id:id},
		dataType:'json',
		success:function(data){
			$('#edit-ipt').val(data.rows.projectName);
			$('#userlist').val(data.rows.warrantId);
			renderDepartment();
		}
	});
}
/*编辑确认*/
$('.edit-confirm').click(function(){
	var projectName=$('.eidt-name').val();
	var uid='',uname='';
	$('#edit-list .select-icon').each(function(k,v){
		if($(v).hasClass('yes')){
			uid+=$(this).data('uid')+'|';
			uname+=$(v).prev().html()+'|';
		}
	})
	uid=uid.substr(0,uid.length-1);
	uname=uname.substr(0,uname.length-1);
	$.ajax({
		url:'/public/api/index/update',
		dataType:'json',
		data:{projectName:projectName,uid:uid,id:$('#pid').val(),uname:uname},
		success:function(data){
			
			if(data.state==0){
				alert(data.msg);
				location.reload();
				return;
			}
			alert(data.msg);
		}
	})
})
/*删除项目*/
function del(id){
	$.ajax({
		url:'/public/api/index/delProject',
		data:{id:id},
		dataType:'json',
		success:function(data){
			alert(data.msg);
			location.reload();
		}
	});
}
/*渲染部门成员*/
$(function(){
	$.ajax({
		url:'/public/api/index/getDepartmentUser',
		dataType:'json',
		success:function(data){
			if(data.rows.errcode==0){
				renderGroup(data.rows.department);
				
				renderDepartment()
				
			}else{
				alert(data.rows.errmsg);
			}
		}
	})
})
function renderDepartment(){
	/*编辑项目授权成员更改*/
	var userArr=$('#userlist').val().split('|');
	$('#edit-list .group-item').each(function(k,v){
		$(v).find('.select-icon').removeClass('yes');
		$(v).find('.select-icon').addClass('no');
		for(var i=0,len=userArr.length;i<len;i++){
			if($(v).data('id')==userArr[i]){
				$(v).find('.select-icon').removeClass('no');
				$(v).find('.select-icon').addClass('yes');
			}
		}
	})
}
function renderGroup(department){	
	
	var html='';
	for(var i=0,len=department.length;i<len;i++){
		html+='<li class="dep-group">';
		html+='<div class="dep-name"><i class="fold-icon"></i><i class="fold"></i>'+department[i].name+'</div>';
		html+='<ul class="dep-group-ul hide">';
		var userlist=department[i].userlist;
		for(var j=0,jlen=userlist.length;j<jlen;j++){
			html+='<li class="group-item" data-id="'+userlist[j].userid+'"><span>'+userlist[j].name+'</span> <i class="select-icon no" data-uid="'+userlist[j].userid+'"></i></li>';
		}
		html+='</ul></li>';
	}
	$('#create-list').html(html);
	$('#edit-list').html(html);
	
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
	
	/*折叠展开*/
	$('.dep-name').click(function(){
		$(this).find('.fold-icon').toggleClass('fold-active');
		$(this).siblings().toggleClass('hide');
	})
	
	
}
</script>
</html>