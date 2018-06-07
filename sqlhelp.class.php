<!-- model层 -->

<?php
//一个工具类，作用是完成对数据库的操作
class sqlhelp{
	public $con;
	public $dbname="empmange";
	public $username="root";
	public $password="1234";
	public $local="localhost";

	public function __construct(){
		$this->con=mysql_connect($this->local,$this->username,$this->password);
		// $this->con=new mysqli($this->local,$this->username,$this->password);

		if(!$this->con){
			die("连接失败".mysql_error());
		}
		mysql_select_db($this->dbname,$this->con);
		// mysqli_query($this->dbname,$this->con);

	}

	//执行dql语句的
	public function execute_dql1($sql){
		$res=mysql_query($sql,$this->con) or die(mysql_error());
		return $res;

	}

	//执行一个dql语句，但是返回的是一个数组,这样可以将数据很好的拿出，关闭资源也方便
	public function execute_dql2($sql){
		$arr=array();
		$res=mysql_query($sql,$this->con) or die(mysql_error());
		//把res转换为数组arr
		$i=0;
		while($row=mysql_fetch_array($res)){
			$arr[$i++]=$row;
		}

		//这里就可以立马把$res关闭
		mysql_free_result($res);
		return $arr;

	}

	//考虑分页情况的查询
	// $sql1="select * from where 表名 limit 0,6";
	// $sql2="select count(id) from 表名";
	function exectue_dql_fenye($sql1,$sql2,$fenyepage){
		$res=mysql_query($sql1,$this->con) or die(mysql_error());
		$arr=array();
		//把res转换为数组arr
		while($row=mysql_fetch_assoc($res)){
			$arr[]=$row;
		}
		
		//把数组赋给fenyepage类对象
		$fenyepage->res_array=$arr;
		
		$res2=mysql_query($sql2,$this->con) or die(mysql_error());
		if($row=mysql_fetch_row($res2)){
			$fenyepage->pagecount=ceil($row[0]/$fenyepage->pagesize);
			$fenyepage->rowcount=$row[0];
		}

		//把导航信息（上一页下一页的显示）也封装到fenyepage中
		$navi="";
		if($fenyepage->pagenow>1){
			$prepage=$fenyepage->pagenow-1;
			$navi="<a href='{$fenyepage->gotourl}?pagenow=$prepage'>上一页</a>&nbsp;";
		}
		if($fenyepage->pagenow<$fenyepage->pagecount){
			$nextpage=$fenyepage->pagenow+1;
			$navi=$navi."<a href='{$fenyepage->gotourl}?pagenow=$nextpage'>下一页</a>&nbsp;";
		}
		

		$page_whole=10;
		$start=floor(($fenyepage->pagenow-1)/$page_whole)*$page_whole+1;
		$index=$start;

		//整体每10页向前翻
		if($fenyepage->pagenow>$page_whole){
			$navi=$navi."&nbsp;&nbsp;<a href='{$fenyepage->gotourl}?pagenow=".($start-1)."'><<</a>&nbsp;&nbsp;";
		}
		
		//每次显示$page_whole页。<<表示直接翻十页
		for(;$start<$index+$page_whole;$start++){
			$navi=$navi."<a href='{$fenyepage->gotourl}?pagenow=$start'>[$start]</a>";
		}
		$navi=$navi."&nbsp;&nbsp;<a href='{$fenyepage->gotourl}?pagenow=$start'>>></a>&nbsp;&nbsp;";//整体每10页向后翻


		//显示当前页和共有多少页
		$navi=$navi."当前页{$fenyepage->pagenow}/共{$fenyepage->pagecount}页";
		$fenyepage->navi=$navi;

		mysql_free_result($res);
		mysql_free_result($res2);
	}

	//执行dml语句的
	public function execute_dml($sql){
		$b=mysql_query($sql,$this->con) or die(mysql_error());
		if(!$b){
			return 0;//表示失败
		}else{
			if(mysql_affected_rows($this->con)>0){
				return 1;//表示执行成功
			}else{
				return 2;//表示行没有收到影响
			}
		}
	}

	//关闭连接
	public function close_con(){
		if(!empty($this->con)){
			mysql_close($this->con);
		}
	}

	
}