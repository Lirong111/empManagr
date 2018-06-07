<!-- model层 -->

<?php
//该类是一个业务逻辑处理类，主要完成对admin表的业务逻辑操作
require_once 'sqlhelp.class.php';
class adminservice{
	//提供一个验证用户是否合法的方法
	public function checkadmin($id,$password){
		$sql="select password,name from admin where id=$id";
		//创建一个SQL help对象
		$Sqlhelp=new sqlhelp();
		$res=$Sqlhelp->execute_dql1($sql);
		if($row=mysql_fetch_assoc($res)){
			//比对密码
			if(md5($password)==$row['password']){
				return $row['name'];
			}
		}
		mysql_free_result($res);
		$Sqlhelp->close_con();
		return "";
	}
}