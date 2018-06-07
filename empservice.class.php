<!-- model层 -->

<?php
require_once 'sqlhelp.class.php';
//提供一个函数可以获取共有多少页
class empservice{
	function getpagecount($pagesize){
	//需要查询出rowcount
		$sql="select count(id) from emp";
		$Sqlhelp=new sqlhelp();
		$res=$Sqlhelp->execute_dql1($sql);
		//计算$pagecount
		if($row=mysql_fetch_row($res)){
			$pagecount=ceil($row[0]/$pagesize);
		}
		mysql_free_result($res);
		$Sqlhelp->close_con();
		return $pagecount;
	}

	//函数可以获取应当显示的雇员信息
	function getemplist($pagenow,$pagesize){
		
		$sql="select * from emp limit ".($pagenow-1)*$pagesize.",$pagesize";
		$Sqlhelp=new sqlhelp();
		$res=$Sqlhelp->execute_dql2($sql);
		//这里如果关闭资源res的话就不能在empList显示结果，所以要想不在empList里面关闭资源，又想获取到结果，就在sqlhelp里面写了一个函数execute_dql2，将资源res转换为一个数组
		// mysql_free_result($res);
		$Sqlhelp->close_con();
		return $res;

	}

	//第二种使用封装的方式实现分页，第一种是fenyepage.class.php
	function getfenyepage($fenyepage){
		//创建一个sqlhelp对象实例
		$Sqlhelp=new sqlhelp();
		$sql1="select * from emp limit ".($fenyepage->pagenow-1)*$fenyepage->pagesize.",$fenyepage->pagesize";
		$sql2="select count(id) from emp";

		$Sqlhelp->exectue_dql_fenye($sql1,$sql2,$fenyepage);
		$Sqlhelp->close_con();
	}

	//根据输入的id删除某个用户
	function delempbyid($id){
		$sql="delete from emp where id=$id";
		$Sqlhelp=new sqlhelp();
		return $Sqlhelp->execute_dml($sql);
	}

	//添加用户方法
	function addemp($name,$grade,$email,$salary){
		$sql="insert into emp (name,grade,email,salary) values('$name',$grade,'$email',$salary)";
		$Sqlhelp=new sqlhelp();
		$res=$Sqlhelp->execute_dml($sql);
		$Sqlhelp->close_con();
		return $res;
	}

	//根据id号获取雇员信息
	function getempid($id){
		$sql="select * from emp where id=$id";
		$Sqlhelp=new sqlhelp();
		$arr=$Sqlhelp->execute_dql2($sql);
		$Sqlhelp->close_con();
		return $arr;
	}

	//更新用户信息
	function updateemp($id,$name,$grade,$email,$salary){
		$sql="update emp set name='$name',grade=$grade,email='$email',salary=$salary where id=$id";
		$Sqlhelp=new sqlhelp();
		$res=$Sqlhelp->execute_dml($sql);
		$Sqlhelp->close_con();
		return $res;
	}

	
	//查询用户
	function searchemp($id){
		$sql="select * from emp where id=$id";
		$Sqlhelp=new sqlhelp();
		$arr=array();
		$arr=$Sqlhelp->execute_dql2($sql);
		$Sqlhelp->close_con();
		return $arr;
	}
}
