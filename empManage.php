<!-- view层 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>

<style type="text/css">
	
	.managediv{
		/*width: 100%;*/
		/*height: 100%;*/
		position: absolute;
		left: 20%;
		top: 10%;
	}
	
	.mainleft img{
		width: 345px;
		display: inline-block;
		position: absolute;
		
	}
	.mainright{
		position: absolute;
		/*background-color: #449D44;*/
		display: inline-block;
		left: 72%;
		top: 50%;
		font-size: 20px;
	}
</style>
<body>
	
	<?php
		header("Content-Type:text/html;charset=utf-8");
		require_once 'common.php';

		//用session验证用户是否登陆封装成函数到common.php
		checkuservalidate();

		$name=$_GET['name'];
		
		// echo "欢迎".$_GET['name']."登陆成功";
		// echo "<br><a href='login.php'>返回重新登陆</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		//用cookie显示上次登录时间，
		// getlasttime();
		
	?>
	<div class="managediv">
		<p>欢迎<?php echo $name;?>登陆成功!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  getlasttime();?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php" class="empa">返回重新登陆</a></p>
		<p></p>
		<p></p>
		<div class="mainleft">
			<img src="image/timg.jpg"/>
		</div>
		<div class="mainright">
			<h1>主界面</h1>
			<a href="empList.php">管理用户</a><br>
			<a href="addemp.php">添加用户</a><br>
			<a href="searchemp.php">查询用户</a><br>
			<a href="">安全退出</a><br>
		</div>
		
	</div>
	
</body>
</html>
