<!-- model层 -->

<?php
//设计一个通用的分页类

class fenyepage{
	public $pagesize;
	public $res_array;//这是显示的分页数据
	public $rowcount;//从数据库中获取的
	public $pagenow;//用户指定的当前页数
	public $pagecount;//计算得到的
	public $navi;//下面的导航信息（上一页，下一页，第几页...）
	public $gotourl;//表示把分页请求提交给哪个页面
}