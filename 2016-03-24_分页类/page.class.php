<?php 
	//分页类的实现
	class Page{		
		public $rownum; //总行数
		public $length; //每页显示多少个
		public $pagenum;//当前页
		public $pagetot; //总页数
		public $offset; //从哪开始截取多少个
		// public $page; //页数
		public $prevpage; //上一页
		public $nextpage;//下一页
		public $limit; 
		
		function __construct($rownum,$length){
			$this->rownum=$rownum; //总行数
			$this->length=$length;  //每页显示多少个
			$this->pagenum=$_GET['page']?$_GET['page']:1;//当前页
			$this->pagetot= $this->pagetot(); //总页数
			$this->offset= $this->offset(); //从哪开始截取多少个
			$this->prevpage = $this->prevpage(); //上一页
			$this->nextpage = $this->nextpage();//下一页
			$this->limit="limit {$this->offset},{$this->length}";
		}

		function offset(){
			return ($this->pagenum-1)*$this->length;
		}

		//总页数
		function pagetot(){
			return ceil($this->rownum/$this->length);
		}

		//上一页
		function prevpage(){
			if ($this->pagenum<=1) {
				return 1;
			}
			return $this->pagenum-1;
		}

		// 下一页
		function nextpage(){
			if ($this->pagenum>=$this->pagetot) {
				return $this->pagetot;
			}
			return $this->pagenum+1;
		}

		function outpage(){
			echo  "<h2><a href='testpage.php?page={$this->prevpage}'>上一页</a><a href='testpage.php?page={$this->nextpage}'>下一页</a></h2>";
		}
	
	}

 ?>