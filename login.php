<!-- view层 -->

<?php
require_once 'common.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"/> -->
	<style type="text/css">
		.loginh1{
			display: block;
			position: absolute;
			left: 20%;
			top: 10%;
			color: #ffffff;
		}
		.loginform{
			display: block;
			position: absolute;
			left: 20%;
			top: 22%;
		}
		.add{
			color: red;
			position: absolute;
			left: 20%;
			top: 52%;
		}
	
	</style>
</head>
<body>
	
	<!--<div class="login">-->
		<h1 class="loginh1">管理员登陆系统</h1>
		<form action="loginprocess.php" method="post" class="loginform">
			<table>
				<tr>
					<td>用户id:</td>
					<td><input type="text" name="id" value="<?php echo getcookieval("id"); ?>"></td>
				</tr>
				<tr>
					<td>密&nbsp;码：</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>输入验证码：</td>
					<td><input type="text" name="yzm"></td>
					<td><img src="./gd2.php" onclick="this.src='gd2.php?aa='+Math.random()"></td>
					<td><a href="">看不清，点击图片换一张</a></td>
	
				</tr>
				<tr>
					<td colspan="2">是否保存用户名id<input type="checkbox" name="keep" value="yes"></td>
				</tr>
				
				<tr style="display: block;position: absolute;top: 110%;">
					<td><input type="submit" value="用户登录">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					
					<td><input type="reset" value="重新填写"></td>
				</tr>
	
			</table>
		</form>
	<!--</div>-->
	
	<?php
		
		if(!empty($_GET['errno'])){
			$errno=$_GET['errno'];
			if($errno==1){
				echo "<br>"."<div fontsize='3' class='add'>你的用户名或者密码错误</div>";
			}
			else if($errno==2){
				echo "<br>"."<div color='red' fontsize='3' class='add'>你的验证码错误</div>";
			}
		}

		
	?>

	
</body>
</html>