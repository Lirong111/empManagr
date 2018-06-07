<!-- 公共方法 -->

<?php
function getlasttime(){
	// date_default_timezone_set("");//这个是时区出现错误时可以设置的，但是比较麻烦，可以在php.ini文件里修改
	if(!empty($_COOKIE['lastvisit'])){
			echo "你上次登陆的时间是：".$_COOKIE['lastvisit'];
			//更新时间
			setcookie("lastvisit",date("Y-m-d  H:i:s"),time()+24*3600*30);
		}else{
			//说明是第一次登陆
			echo "你是第一次登陆";
			//更新时间
			setcookie("lastvisit",date("Y-m-d  H:i:s"),time()+24*3600*30);
		}
}

function getcookieval($key){
	if(empty($_COOKIE[$key])){
		return "";
	}else{
		return $_COOKIE[$key];
	}
}

function checkuservalidate(){
	session_start();
	if(empty($_SESSION['loginuser'])){
		header("Location:login.php?errno=1");
		}
		
}