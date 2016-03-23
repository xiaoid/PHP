<?php 
	class Model{
		public $field; //字段
		public $tableName; //表名
		public $where; //where条件
		public $order; //排序
		public $limit; //取多少个

		function __construct($tableName){
			mysql_connect(HOST,USER,PWD); //连接数据库 
			mysql_select_db(DBNAME);  //选择数据库
			mysql_query("set names utf8"); //设置字符串集
 
			$this->tableName=$tableName; //表名
						
		}

		//字段
		function field($field){
			$this->field=$field;
			return $this;
		}

		//where 条件
		function where($where){
			$this->where="where ".$where;

			return $this;
		}

		//排序
		function order($order){
			$this->order="order by ".$order;
			return $this;
		}

		//限制取多少条记录
		function limit($limit){		
			$this->limit="limit ".$limit;
			return $this;
		}

		/*
		 *查询
		*/
		function select(){
			$sql="select {$this->field} from {$this->tableName} {$this->where} {$this->order} {$this->limit}";
		 	$result=mysql_query($sql);
		 	while ($row=mysql_fetch_assoc($result)) {
		 		$rows[] = $row;
		 	}
			return $rows; //返回数组
		}
		
		/*
		 *添加
		*/		
		function insert($data){
			
			foreach ($data as $key => $val) {
				# code...
				$keys[]=$key;
				$vals[]="'".$val."'";
			}
			//加入分隔符
			$keystr=join(",",$keys);
			$valstr=join(",",$vals);

			$sql="insert into {$this->tableName}({$keystr})  values({$valstr})";
			//执行sql语句
			mysql_query($sql);

			//获取影响的行数
			$result = mysql_affected_rows();

			// echo $result;

			//添加成功 返回值>0, 失败返回值为-1
			return ($result>0)?true:false; //三元运算

			// if ($result > 0) {
			// 	# code...
			// 	return true;
			// }else{
			// 	return false;
			// }
		}
		/*
		 *修改
		*/	
		function update($data){
			// $data = array("name" => "admin","pwd"=>"123456" );

			foreach ($data as $key => $val) {
				# code...
				$keys[]=$key;
				$vals[]=$val;
			}
			$keystr=join(",",$keys);
			$valstr=join(",",$vals);

			//遍历取得的数据，拼接成 $key=$value
			for ($i=0; $i < count($data); $i++) { 
				//拼接
				$fieldstr .= $keys[$i]."=".$vals[$i].",";
			}

			
			$sql="update  {$this->tableName} set {$fieldstr} {$this->where} ";

			mysql_query($sql);

			//获取影响的行数
			$result = mysql_affected_rows();

			return ($result>0)?true:false; //三元运算

			// if ($result>0) {
			// 	# code...
			// 	return true;
			// }else{
			// 	return false;
			// }

			// echo $sql;

		}

		/*
		 *删除
		*/
		function delete(){
			// $sql = "delete user where id='null'";

			$sql = "delete from {$this->tableName} {$this->where}";
			// echo $sql ."<br>";
			mysql_query($sql);

			//获取影响的行数
			$result = mysql_affected_rows();

			// echo  $result ."<br>";

			return ($result>0)?true:false; //三元运算

			// if ($result > 0 ) {
			// 	# code...
			// 	echo "删除成功";
			// 	return true;
			// }else{
			// 	echo "删除失败";
			// 	return false;
			// }
			
		}


	}
	//study end 33:01
 ?>