<!doctype html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>订单信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
	</head>
	<body>
		
			<h3>订单信息列表</h3>
			<div class="admin_search_bar">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>">
					<ul>
						<li><label>商品名称</label><input type="text" class="txt" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>"></li>
						<li><button class="op_btn">搜索</button></li>
					</ul>
				</form>
			</div>
			
			<table border="1" width="1300px" class="frm_table">
				<tr>
					<th>订单编号</th>
					<th>用户</th>
					<th>商品名称</th>
					<th>商品图片</th>
					<th>订单金额</th>
					<th>收货人</th>
					<th>收货地址</th>
					<th>下单时间</th>
					<th style="width: 150px;">操作</th>
				</tr>
				<?php
				
				
				//从数据库中读取信息并输出到浏览器表格中
				//1.导入配置文件 
					require("../dbconfig.php");
					
					// 当前页
					if(!isset($_GET["page"])){
						$page=1;
					}else{
						$page=$_GET["page"];
					}
					
					// 数据从第几行开始
					$temp=($page-1)*$list_num;
					
					// 搜索关键字
					if(!isset($_GET['keyword'])){
						$keyword = "";
					}else{
						$keyword = trim($_GET['keyword']);
					}
					
					
				//2. 连接数据库，并选择数据库
					
					$sql_count = "SELECT count(*) as total FROM tb_order a, `user` b, goods c WHERE a.user_id=b.id AND a.goods_id=c.id ";
					if($keyword){
						$sql_count.= " and c.`name` like '%{$keyword}%'";
					}
					$result = mysql_query($sql_count);
					$res = mysql_fetch_array($result);
					$num=$res['total'];
					$p_count=ceil($num/$list_num);					//总页数为总条数除以每页显示数
				
				//3. 执行订单信息查询
					$sql = "SELECT a.*,b.username,c.`name` as `goods_name`,c.pic FROM tb_order a, `user` b, goods c WHERE a.user_id=b.id AND a.goods_id=c.id ";
					if($keyword){
						$sql .=  " and c.`name` like '%{$keyword}%'";
					}
					$sql .= " limit {$temp},{$list_num}";
					$result = mysql_query($sql);
					
					
					
					
				//4. 解析订单信息（解析结果集）
					while($row = mysql_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>{$row['order_sn']}</td>";
						echo "<td>{$row['username']}</td>";
						echo "<td>{$row['goods_name']}</td>";
						echo "<td><img src='../uploads/s_{$row['pic']}'/></td>";
						echo "<td>{$row['order_money']}</td>";
						echo "<td>{$row['consignee']}({$row['phone']})</td>";
						echo "<td>{$row['address']}</td>";
						echo "<td>".$row['createtime']."</td>";
						echo "<td> 
								<a href='orderAction.php?action=del&id={$row['id']}' class='op_btn2'>发货</a> 
								<a href='editOrder.php?id={$row['id']}' class='op_btn2'>修改</a></td>";
						echo "</tr>";
					}
					
				
				
				//5. 释放结果集，关闭数据库
		
				
				?>
			</table>
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
					echo "<a href='".$_SERVER['PHP_SELF']."?page=1&keyword={$keyword}'>第一页</a> | ";
				}
				if ($prev_page<1)							//如果上一页小于1只显示文字
				{
					echo "上一页 | ";
				}
				else										//如果大于1显示指向上一页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=$prev_page&keyword={$keyword}'>上一页</a> | ";
				}
				if ($next_page>$p_count)						//如果下一页大于总页数只显示文字
				{
					echo "下一页 | ";
				}
				else										//如果小于总页数则显示指向下一页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=$next_page&keyword={$keyword}' class='underline'>下一页</a> | ";
				}
				if ($page>=$p_count)						//如果当前页大于或者等于总页数只显示文字
				{
					echo "最后一页</p>\n";
				}
				else										//如果当前页小于总页数显示最后页的连接
				{
					echo "<a href='".$_SERVER['PHP_SELF']."?page=$p_count&keyword={$keyword}'>最后一页</a></p>\n";
				}
			}else{
				echo "<P align='center'>暂时还没有记录！</p>";
			}
			?>
	</body>
</html>