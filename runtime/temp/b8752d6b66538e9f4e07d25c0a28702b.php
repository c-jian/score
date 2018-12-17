<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\filesys\public/../application/index\view\index\fileList.html";i:1541671066;}*/ ?>
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
		height:60px;
		line-height: 60px;
	}
	.header .title{
		font-size:23px;
		max-width: 1028px;
		margin:0 auto;
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
	.rar,.zip{
		background: url('/public/static/img/icon/zip.png') no-repeat center center;
		background-size:21px;
	}
	
	/*提示框*/
	.bg{
		position:absolute;
		left:0;
		top:0;
		right:0;
		bottom:0;
		width:100%;
		height:100%;
		background:rgba(0,0,0,.5);
	}
	.tip{
		position:absolute;
		left:50%;
		top:50%;
		width:500px;
		height:300px;
		background:#fff;
		box-shadow:2px 2px 2px #333;
		border-radius:5px;
		margin-left:-250px;
		margin-top:-150px;
		padding:10px;
		box-sizing:border-box;
	}
	.close{
		position:absolute;
		width:30px;
		height:30px;
		background:url('/public/static/img/icon/close.png') no-repeat center center;
		background-size:30px;
		right:-5px;
		top:-5px;
	}
	.tip-title{
		width:100%;
		text-align:center;
		padding:10px 0;
		font-size:26px;
	}
	.tip-item{
		font-size:16px;
		margin-top:10px;
		line-height:30px;
	}
	.red-highline{
		color:red;
	}
	.o-highline{
		font-size:17px;
	}
	.notice{
		position:absolute;
		bottom:10px;
		right:10px;
	}
	.close-btn,.noTip{
		width:90px;
		height:30px;
		border:none;
		background:#3385ff;
		float:right;
		color:#fff;
		border-radius:5px;
		font-size:15px;
		font-family:'微软雅黑';
		margin-right:10px;
		outline:none;
	}
	.noTip{
		background:red;
	}
	</style>
</head>
<body>
	
	<div class="bg">
		<div class="tip">
			<span class="close"></span>
			<h1 class="tip-title">关于下载文件打不开问题</h1>
			<div class="tip-item">原因：<strong class="red-highline">文件还没下载完</strong></div>
			<div class="tip-item"><strong>解决：</strong>在点击下载后会<strong class="o-highline">弹出</strong>一个新<strong class="o-highline">窗口</strong>，<strong class="o-highline">不用</strong>手动<strong class="o-highline">关闭</strong>，文件下载<strong class="o-highline">完成后</strong>会<strong class="o-highline">自动关闭</strong>。</div>
			<div class="notice"><button class="noTip">不再提醒</button><button class="close-btn">确定</button></div>
		</div>
	</div>
		
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
						&nbsp;<span class="size">大小：<?php  if($v['size']>1){echo $v['size'].'mb';}else{echo round($v['smallsize']/1024,2).'kb';}  ?></span>
						<a href="javascript:void(0);" class="del-file" data-id="<?php echo $v['id']; ?>" onclick="delFile(this)">删除</a>
						<i class="downloadnum">下载<?php echo $v['downloadnum']; ?>次</i>
						<a href="/public/index/index/download?fid=<?php echo $v['id']; ?>&pid=<?php echo $id; ?>" class="dlink"><span class="download" data-id="<?php echo $v['id']; ?>"></span></a>
					</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>

		</div>

	</div>
	
	
	
	<script src="/public/static/js/jquery.js"></script>
	<script>

	function delFile(el){
		var id=$(el).data('id');
		if(confirm('您确定删除此文件吗？')){
			$.ajax({
				url:'/public/index/index/delFile',
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
	
	var close=function(){
		$('.bg').remove();
	}
	$('.close').click(close);
	$('.close-btn').click(close);
	
	/*
	 var xhr = new XMLHttpRequest();
	var str = 'fid=64&pid=d314e80b2910754281754f2210f8a29a37f5685c';
		xhr.open('POST', "/public/index/index/download", true);    //也可以使用POST方式，根据接口
		xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xhr.responseType = "blob";   //返回类型blob
		xhr.onload = function () {
			//定义请求完成的处理函数
			if (this.status === 200) {
					var blob = this.response;
					if(blob.size>0){
						var reader = new FileReader();
						reader.readAsDataURL(blob);   // 转换为base64，可以直接放入a标签href
						reader.onload = function (e) {
							// 转换完成，创建一个a标签用于下载
							var a = document.createElement('a');
							a.download = 'world-map.jpg';
							a.href = e.target.result;
							a.innerHTML='点我啊';
							$("body").append(a);    // 修复firefox中无法触发click
							//a.click();
							//$(a).remove();
							//window.location.reload();
						}
					}else{
						//window.location.reload();
					}
			}
		};
		xhr.send(str);
	*/
	/*
	var oReq = new XMLHttpRequest();
	oReq.open("GET", "/public/index/index/download?fid=53&pid=d314e80b2910754281754f2210f8a29a37f5685c", true);
	oReq.responseType = "blob";

	oReq.onload = function(oEvent) {
	  //var blob = oReq.response;
	  var blob = new Blob([oReq.response], {type: 'image/png'});
	  console.log(blob);
	};

	oReq.send();
	*/
	</script>
</body>
</html>