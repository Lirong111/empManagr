<!-- control 层 -->

<?php
require_once 'empservice.class.php';
header("Content-Type:text/html;charset=utf-8");

$empService=new empservice();
	//先看看用户是要分页还是要删除某个雇员（get方式）还是要添加用户（post方式）
	if(!empty($_REQUEST['flag'])){
		//这时要删除用户
		$flag=$_REQUEST['flag'];
		if($flag=='del'){
			//说明是要删除
			//接收用户要删除的用户id
			$id=$_REQUEST['id'];
			if($empService->delempbyid($id)==1){
				//成功
				header("Location:ok.php");
				exit();
			}else{
				//失败
				header("Location:error.php");
				exit();
			}
		}else if($flag=='addemp'){
			//说明是要添加用户
			//接收用户
			$name=$_POST['name'];
			$grade=$_POST['grade'];
			$email=$_POST['email'];
			$salary=$_POST['salary'];
			//添加到数据库
			$res=$empService->addemp($name,$grade,$email,$salary);
			if($res==1){
				header("Location:ok.php");
				exit();
			}else{
				//失败
				header("Location:error.php");
				exit();
			}
		}else if($flag=='update'){
			//说明是修改用户信息
			$id=$_POST['id'];
			$name=$_POST['name'];
			$grade=$_POST['grade'];
			$email=$_POST['email'];
			$salary=$_POST['salary'];
			$res=$empService->updateemp($id,$name,$grade,$email,$salary);
			if($res==1){
				header("Location:ok.php");
				exit();
			}else{
				//失败
				header("Location:error.php");
				exit();
			}
		}else if($flag=='searchemp'){
			$id=$_POST['userid'];
			$arr=array();
			$arr=$empService->searchemp($id);

			//2.将数组转换为字符串传过去，可以在url看见信息
			// $com=implode(",", $arr[0]);
			// header("Location:searchemp.php?com=".$com);

			//3.将获取到的信息存到session里，在前端页面用session获取，前端页面看不到信息
			session_start();
			$_SESSION['id']=$arr[0][0];
			$_SESSION['name']=$arr[0][1];
			$_SESSION['grade']=$arr[0][2];
			$_SESSION['email']=$arr[0][3];
			$_SESSION['salary']=$arr[0][4];
			header("Location:searchemp.php");



			//1.直接将数组的信息通过get方式传过去，可以在url看见信息
			// header("Location:searchemp.php?id=".$arr[0][0]."&name=".$arr[0][1]."&grade=".$arr[0][2]."&email=".$arr[0][3]."&salary=".$arr[0][4]);

			//二维数组转化为字符串，中间用,隔开
			// function arr_to_str($arr) {
			//     foreach ($arr as $v) {
			//         $v = join(",",$v); // 可以用implode将一维数组转换为用逗号连接的字符串，join是别名
			//         $temp[] = $v;
			//     }
			//     foreach ($temp as $v) {
			//         $t.=$v.",";
			//     }
			//     $t = substr($t, 0, -1); // 利用字符串截取函数消除最后一个逗号
			//     return $t;
			// }

			// echo arr_to_str($arr);


			// print_r($arr);
			// echo "<br>";
			// print_r($arr[0][0]);
			exit();
		}
		
	}
