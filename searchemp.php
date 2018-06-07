<!-- view层 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript">
		function confirmdele(val){
			return window.confirm("是否要删除id="+val+"的用户");
		}
	</script>
</head>
<body>
	
	<h1>查询用户</h1>
	<form action="empprocess.php" method="post">
		请输入用户id：<input type="text" name="userid"> 
		<input type="submit" name="" value="搜索">
		<input type="hidden" name="flag" value="searchemp">
		<br>
		
	</form>
	<?php

	require_once 'common.php';//验证用户是不是没有登陆直接到这个页面的

	//用session验证用户是否登陆封装成函数到common.php
	checkuservalidate();

	// session_start();
	// echo $_SESSION['id'];
	// echo $_SESSION['name'];
	// echo $_SESSION['grade'];
	// echo $_SESSION['email'];
	// echo $_SESSION['salary'];
	if(!empty($_SESSION['id'])&&!empty($_SESSION['name'])&&!empty($_SESSION['grade'])&&!empty($_SESSION['email'])&&!empty($_SESSION['salary'])){
		$id=$_SESSION['id'];
		$name=$_SESSION['name'];
		$grade=$_SESSION['grade'];
		$email=$_SESSION['email'];
		$salary=$_SESSION['salary'];
	}
	else{
		$id='';
		$name='';
		$grade='';
		$email='';
		$salary='';
	}

	//这个是用get方式提交过来的时候的判断
	// if(!empty($_GET['id'])&&!empty($_GET['name'])&&!empty($_GET['grade'])&&!empty($_GET['email'])&&!empty($_GET['salary'])){
	// 	$id=$_GET['id'];
	// 	$name=$_GET['name'];
	// 	$grade=$_GET['grade'];
	// 	$email=$_GET['email'];
	// 	$salary=$_GET['salary'];
	// }
	echo "<br>";
	echo "<table border='1' bordercolor='green' cellspacing='0' width='700px'>";
	echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
	echo "<tr><td>{$id}</td><td>{$name}</td><td>{$grade}</td><td>{$email}</td><td>{$salary}</td>"."<td><a onclick='return confirmdele({$id})' href='empprocess.php?flag=del&id={$id}'>删除用户</a></td><td><a href='updateemp.php?id={$id}'>修改用户</a></td></tr> ";

	?>

</body>
</html>