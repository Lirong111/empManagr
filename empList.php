<!-- view层 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>雇员信息列表</title>
	<script type="text/javascript">
		function confirmdele(val){
			return window.confirm("是否要删除id="+val+"的用户");
		}
	</script>
	
</head>

	<?php
	require_once 'empservice.class.php';
	require_once 'fenyepage.class.php';

	require_once 'common.php';//验证用户是不是没有登陆直接到这个页面的

		//用session验证用户是否登陆封装成函数到common.php
		checkuservalidate();

	

//********************************************这些是加了fenyepage.class.php之后改的所有代码，将分页封装成一个类************************
//**************************************没有加这个类之前的代码可以见LR下的emplist.php文件*********************************************
	$fenyepage=new fenyepage();
	$fenyepage->pagenow=1;
	$fenyepage->pagesize=7;
	$fenyepage->gotourl='empList.php';

	if(!empty($_GET['pagenow'])){
			$fenyepage->pagenow=$_GET['pagenow'];
		}
	$empService=new empservice();
	$empService->getfenyepage($fenyepage);
	echo "<table border='1' bordercolor='green' cellspacing='0' width='700px'>";
	echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
	for($i=0;$i<count($fenyepage->res_array);$i++){
		$row=$fenyepage->res_array[$i];
		echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>"."<td><a onclick='return confirmdele({$row['id']})' href='empprocess.php?flag=del&id={$row['id']}'>删除用户</a></td><td><a href='updateemp.php?id={$row['id']}'>修改用户</a></td></tr> ";
	}
	echo "<h1>雇员信息列表</h1>";//<a href='empManage.php' style='position: absolute;left: 28%;top: 5%;font-size: 20px;'>返回上一页</a>
	echo "</table>";
	//显示上一页和下一页
	echo $fenyepage->navi;





	//************************************使用class.php之后不用的代码********************************************
		//显示所有用户的信息
		// $con=mysql_connect('localhost','root','1234') or die(mysql_error());
		// mysql_query("set names utf8");
		// mysql_select_db('empmange',$con);

//********************************************下面原来和class.php两者都要有*********************************************************
		// $pagesize=6;//每页的数量
		// $rowcount=0;//这个变量值要从数据库取
		// $pagenow=1;//显示第几页，用户指定,目前刚进去是1
		// //根据用户点击修改pagenow
		// if(!empty($_GET['pagenow'])){
		// 	$pagenow=$_GET['pagenow'];
		// }


//**************************************创建empservice.class.php文件之前的代码*******************************************		
		// $pagecount=0;//这个表示共有多少页，是计算出来的

		// $sql="select count(id) from emp";
		// $res1=mysql_query($sql);
		// //取出行数
		// if($row=mysql_fetch_row($res1)){
		// 	$rowcount=$row[0];
		// }
		// //计算共有多少页
		// $pagecount=ceil($rowcount/$pagesize);

	//*********************************************创建empservice.class.php文件后改的代码***********************************
		// $empService=new empservice();
		// $pagecount=$empService->getpagecount($pagesize);



		// $sql="select * from emp limit ".($pagenow-1)*$pagesize.",$pagesize";//使用class.php之后不用的代码
		// $res=mysql_query($sql,$con);//使用class.php之后不用的代码


//*******************************************使用class.php之后添加的修改代码***********************************************
		// $res=$empService->getemplist($pagenow,$pagesize);//使用class.php之后添加的修改代码

	//*******************************************下面这两句都要有***************************************************************
		// echo "<table border='1' bordercolor='green' cellspacing='0' width='700px'>";
		// echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";


		//*************************************没有加class.php之前的代码************************************************************
		// while($row=mysql_fetch_assoc($res)){
		// 	echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>"."<td><a href='#''>删除用户</a></td><td><a href='#''>修改用户</a></td></tr> ";
		// }
//**************************************加了class.php之后的，和加了分页类不同**********************************************

		// for($i=0;$i<count($res);$i++){
		// 	$row=$res[$i];
		// 	echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>"."<td><a href='#''>删除用户</a></td><td><a href='#''>修改用户</a></td></tr> ";
		// }
		// echo "<h1>雇员信息列表</h1>";
		// echo "</table>";
//*************************************************下面三行是最原始的一页一页显示****************************************************
		// //打印出页码的超链接
		// for($i=1;$i<=$pagecount;$i++){
		// 	echo "<a href='empList.php?pagenow=$i'>$i</a>&nbsp;";
		// }

		//当数据很多时，一页一页显示就很慢，电脑会卡死，所以要显示上一页和下一页，
		//显示上一页和下一页，当添加了fenyepage类后可以封装到类中
	/*	if($pagenow>1){
			$prepage=$pagenow-1;
			echo "<a href='empList.php?pagenow=$prepage'>上一页</a>&nbsp;";
		}
		if($pagenow<$pagecount){
			$nextpage=$pagenow+1;
			echo "<a href='empList.php?pagenow=$nextpage'>下一页</a>&nbsp;";
		}


		
		$page_whole=10;
		$start=floor(($pagenow-1)/$page_whole)*$page_whole+1;
		$index=$start;

		//整体每10页向前翻
		if($pagenow>$page_whole){
			echo "&nbsp;&nbsp;<a href='empList.php?pagenow=".($start-1)."'><<</a>&nbsp;&nbsp;";
		}
		
		//每次显示$page_whole页。<<表示直接翻十页
		for(;$start<$index+$page_whole;$start++){
			echo "<a href='empList.php?pagenow=$start'>[$start]</a>";
		}
		echo "&nbsp;&nbsp;<a href='empList.php?pagenow=$start'>>></a>&nbsp;&nbsp;";//整体每10页向后翻


		//显示当前页和共有多少页
		echo "当前页{$pagenow}/共{$pagecount}页";

		//指定跳转到某页
		echo "<br><br>";*/
		?>
		<form action="empList.php">
			跳转到：<input type="text" name="pagenow">
			<input type="submit" name="" value="Go">
		</form>
		<?php
		


		// mysql_free_result($res);
		// mysql_close($con);
	?>

	<!-- select * from emp limit 3,4;3表示从第三条开始取（从0开始，相当于从表中第四条取），取四条数据 -->

</html>

