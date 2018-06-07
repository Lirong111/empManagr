<!-- control层 -->

<?php
require_once 'adminservice.class.php';
//接收用户的数据

$id=$_POST['id'];
$password=$_POST['password'];
$yzm=trim($_POST['yzm']);

//获取用户是否选择了保存id
if(empty($_POST['keep'])){
	// echo "用户不保存";
	if(!empty($_COOKIE['id'])){			//检查以前保存过cookie没
		setcookie("id",$id,time()-200);
	}
}else{
	// echo "保存";
	setcookie("id",$id,time()+7*2*24*3600);//保存两天
}
// echo $keep;
// exit();


//*********************************************使用分层之后写的（有class.php这种文件时）**********************************************
//实例化一个adminservice方法
$adminservice=new adminservice();
if($name=$adminservice->checkadmin($id,$password)){
	//合法
	//将登陆的信息存到session中，到empManage.php页面中验证一下有没有登陆，如果没登录则返回到login.php页面中重新登陆，这样是为了防止用户没有登陆直接到empManage页面进行对雇员的操作
	session_start();
	$_SESSION['loginuser']=$name;
	if(strtolower($_SESSION['checkcode'])==strtolower($yzm)){
		header("Location:empManage.php?name=$name");//这个是验证用户登陆是否合法，合法跳转到下一页面
		exit();
	}
	else{
		header("Location:login.php?errno=2");
		exit();
	}

	// //判断用户是否填写了验证码
	// 	session_start();
	// 	$yzm=trim($_POST['yzm']);
	// 	if(strtolower($_SESSION['checkcode'])!=strtolower($yzm)){
	// 		// echo "<script language=\"JavaScript\">alert(\"请输入验证码\");</script>";
	// 		header("Location:login.php");

	// 	}


	
}else{
	//不合法
	header("Location:login.php?errno=1");
	exit();
}

//***************************************************************************************************************************
//简单验证，先不到数据库
/*if($id=="100"&&$password=="123"){
	//合法，跳转到管理页面empManage.php
	header("Location:empManage.php");
	exit();
}else{
	header("Location:login.php?errno=1");
	exit();
}
*/

//**************************************************没有使用分层时写的****************************************************************************
//到数据库验证
// $con=mysql_connect("localhost","root","1234");
// if(!$con){
// 	die("连接失败".mysql_error());
// }
// mysql_query("set names utf8",$con) or die("设置编码失败".mysql_error());
// mysql_select_db("empmange",$con) or die(mysql_error());
// //发送sql语句，验证
// $sql="select password,name from admin where id=$id";
// // 通过输入id来获取数据库的密码，然后再和输入的密码对比
// $res=mysql_query($sql,$con);

// if($row=mysql_fetch_assoc($res)){
// 	if($row['password']==md5($password)){
// 		//合法,取出用户名
// 		$name=$row['name'];
// 		header("Location:empManage.php?name=$name");
// 		exit();
// 	}

// }
// 	header("Location:login.php?errno=1");
// 	exit();
// 	mysql_free_result($res);
// 	mysql_close($con);
