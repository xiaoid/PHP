<?php 
	include("db.config.php");
	include("model.class.php");
	include("page.class.php"); //引用文件

	$user = new Model("user");

	//查询
    // $rows=$user->field("*")->select();

	
	$data = array("name" => "admins","pwd"=>"12345678" );

	//添加
    // $user->insert($data);

	//修改
   	// $user->where("id=2")->update();

   	//删除
    $result=$user->where("id > 25")->delete();

    // var_dump($result);

   	exit;

	echo "<pre>";
	print_r($rows);
	echo "</pre>";
	// exit;

	// header("content-type:text/html;charset=utf-8");
	// $conn = @mysql_connect("localhost","root","12345678");
	// //选择数据库
	// mysql_select_db("user");

	// mysql_query("set names utf8");

	// 总行数
	$totsql = "select count(*) from message";
	$totrst=mysql_query($totsql);
	$totarr=mysql_fetch_row($totrst); //总行数

	//生成分页对象
	$page = new Page($totarr[0],5);

	//获取每页数据
	$sql = "select * from message order by id {$page->limit}";
	$rst = mysql_query($sql);

	//把数据显示出来
	echo "<center>";
	echo "<h2>留言表</h2>";
	echo "<table width='700px' border='1px'>";

	while($row=mysql_fetch_assoc($rst)) {
		echo "<tr>";
		echo "<td>{$row['id']}</td>";
		echo "<td>{$row['content']}</td>";
		echo "<td>{$row['sender']}</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$page->outpage();

	echo "</center>";
 ?>