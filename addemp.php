<!-- view层 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		.adddiv{
			position: absolute;
			left: 8%;
			top: 10%;
		}
	</style>
</head>
<body>
	<div class="adddiv">
		<h1>添加雇员</h1>
		<form action="empprocess.php" method="post">
			<table>
				<tr><td>名字</td><td><input type="text" name="name"></td></tr>
				<tr><td>级别</td><td><input type="text" name="grade"></td></tr>
				<tr><td>邮件</td><td><input type="text" name="email"></td></tr>
				<tr><td>薪水</td><td><input type="text" name="salary"></td></tr>
				<input type="hidden" name="flag" value="addemp">
				<tr>
					<td><input type="submit" value="添加用户"></td>
					<td><input type="reset" value="重新填写"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<?php
	require_once 'common.php';//验证用户是不是没有登陆直接到这个页面的

	//用session验证用户是否登陆封装成函数到common.php
	checkuservalidate();
	?>
</body>
</html>
<?php
