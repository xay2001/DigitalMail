<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>商城</title>
    <link rel="stylesheet" href="css/mystyle.css" type="text/css">
</head>

<body class="shop_body">
    <?php 
    	// 引入头部
		include 'front-top.php';
	?>
    <div class="shop_contain">
		<div style="height: 750px; display: flex;">
    	<ul class="overflow_hidden">
    	<?php 
	    	//从数据库中读取信息并输出到浏览器表格中
	    	//1.导入配置文件
	    	require_once "dbconfig.php" ;
	    		
	    	// 当前页
	    	if(!isset($_GET["page"])){
	    		$page=1;
	    	}else{
	    		$page=$_GET["page"];
	    	}
	    		
	    	// 数据从第几行开始
	    	$temp=($page-1)*$front_list_num;
	    		
	    	// 搜索关键字
	    	if(!isset($_GET['searchword'])){
	    		$searchword = "";
	    	}else{
	    		$searchword = trim($_GET['searchword']);
	    	}
	    		
	    		
	    	//2. 操作数据库
	    		
	    	$sql_count = "select count(*) as total from goods where 1";
	    	if($searchword){
	    		$sql_count.= " and name like '%{$searchword}%'";
	    	}
	    	$result = mysql_query($sql_count);
	    	if($result){
	    		$res = mysql_fetch_array($result);
	    		$num=$res['total'];
	    	}else{
	    		$num = 0;
	    	}
	    	
	    	$p_count=ceil($num/$front_list_num);					//总页数为总条数除以每页显示数
	    	
	    	//3. 执行商品信息查询
	    	$sql = "select * from goods where 1 ";
	    	if($searchword){
	    		$sql .=  " and name like '%{$searchword}%'";
	    	}
	    	$sql .= " limit {$temp},{$front_list_num}";
	    	$result = mysql_query($sql);
	    	//4. 解析商品信息（解析结果集）
	    	while($result && $row = mysql_fetch_assoc($result)){
    	?>
    		<li>
    			<div class="goods_item">
					<div class="goods-div">
    				<a href="goodsDetail.php?id=<?php echo $row['id'];?>"><img  src="uploads/<?php echo $row['pic'];?>" class="goods_img"></a>
    				</div>
					<div class="goods_price">￥<?php echo $row['price'];?></div>
    				<div class="goods_name"><?php echo $row['name'];?></div>
    			</div>
    		</li>
    	<?php 
	    	}
    	?>
    	
    	</ul>
		</div>
    	<div class="page_contain">
    		<?php 
			// 分页
			if($num > 0){
				$prev_page=$page-1;						//定义上一页为该页减1
				$next_page=$page+1;						//定义下一页为该页加1
				//echo "next_page=".$next_page.",p_count=".$p_count;
				echo "<p align=\"center\"> ";
				if ($page<=1)								//如果当前页小于等于1只有显示
				{
					echo "第一页 | ";
				}
				else										//如果当前页大于1显示指向第一页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=1&searchword={$searchword}'>第一页</a> | ";
				}
				if ($prev_page<1)							//如果上一页小于1只显示文字
				{
					echo "上一页 | ";
				}
				else										//如果大于1显示指向上一页的连接
				{
					echo "<a  href='".$_SERVER['PHP_SELF']."?page=$prev_page&searchword={$searchword}'>上一页</a> | ";
				}
				if ($next_page>$p_count)						//如果下一页大于总页数只显示文字
				{
					echo "下一页 | ";
				}
				else										//如果小于总页数则显示指向下一页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=$next_page&searchword={$searchword}' >下一页</a> | ";
				}
				if ($page>=$p_count)						//如果当前页大于或者等于总页数只显示文字
				{
					echo "最后一页</p>\n";
				}
				else										//如果当前页小于总页数显示最后页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=$p_count&searchword={$searchword}'>最后一页</a></p>\n";
				}
			}else{
				echo "<P align='center'>暂时还没有记录！</p>";
			}
			?>
    	</div>
    </div>
<!--    <div class="shop_footer">
    	<?php echo COPYRIGHT;?>
    </div> -->
	<div class="bottom">
		<p style="text-align: center;height: 100px; line-height: 100px;">
			<a  href="index.php" style="color: #fff;">首页</a> <span>|</span> <a style="color: #fff;" href="myOrderList.php">我的 </a>
		</p>
	</div>
</body>

</html>