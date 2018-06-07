<!-- view层 -->

<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		.updatediv{
			position: absolute;
			left: 8%;
			top: 10%;
		}
	</style>
</head>
<body>
	<?php
		require_once 'empservice.class.php';
		require_once 'common.php';

		//用session验证用户是否登陆封装成函数到common.php
		checkuservalidate();
		//该页面是修改雇员信息
		$id=$_GET['id'];
		//通过id来得到该用户的其他信息
		$empservice=new empservice();
		$arr=$empservice->getempid($id);
		//显示信息


	?>
	<div class="updatediv">
		<h1>修改雇员</h1>
		<form action="empprocess.php" method="post">
			<table>
				<tr><td>id</td><td><input type="text" name="id" readonly="readonly" value="<?php echo $arr[0]['id'] ?>"></td></tr>
				<tr><td>名字</td><td><input type="text" name="name" value="<?php echo $arr[0]['name'] ?>"></td></tr>
				<tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $arr[0]['grade'] ?>"></td></tr>
				<tr><td>邮件</td><td><input type="text" name="email" value="<?php echo $arr[0]['email'] ?>"></td></tr>
				<tr><td>薪水</td><td><input type="text" name="salary" value="<?php echo $arr[0]['salary'] ?>"></td></tr>
				<input type="hidden" name="flag" value="update">
				<tr>
					<td><input type="submit" value="修改用户"></td>
					<td><input type="reset" value="重新填写"></td>
				</tr>
			</table>
		</form>
	</div>
	

</body>
</html>


