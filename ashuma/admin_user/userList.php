<!doctype html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>用户信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
	</head>
	<body>
		
			<h3>用户信息列表</h3>
			<div class="admin_search_bar">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>">
					<ul>
						<li><label>用户名</label><input type="text" class="txt" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>"></li>
						<li><button class="add_btn">搜索</button></li>
					</ul>
				</form>
			</div>
			<table border="1" width="1000" class="frm_table">
				<tr>
					<th>用户编号</th>
					<th>用户名称</th>
					<th>添加时间</th>
					<th>操作</th>
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
					
					$sql_count = "select count(*) as total from user where 1";
					if($keyword){
						$sql_count.= " and username like '%{$keyword}%'";
					}
					$result = mysql_query($sql_count);
					$res = mysql_fetch_array($result);
					$num=$res['total'];
					$p_count=ceil($num/$list_num);					//总页数为总条数除以每页显示数
				
				//3. 执行商品信息查询
					$sql = "select * from user where 1 ";
					if($keyword){
						$sql .=  " and username like '%{$keyword}%'";
					}
					$sql .= " limit {$temp},{$list_num}";
					$result = mysql_query($sql);
					
					
					
					
				//4. 解析商品信息（解析结果集）
					while($row = mysql_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['username']}</td>";
						echo "<td>{$row['createtime']}</td>";
						if($row['username'] != "admin"){
							echo "<td class='txt_center'>
							<a href='userAction.php?action=del&id={$row['id']}' class='op_btn' style='color:'white''>删除</a>
							<a href='editUser.php?id={$row['id']}' class='op_btn'>修改</a>
							<a href='resetUserPwd.php?id={$row['id']}' class='op_btn'>重置密码</a>
							</td>";
						}else{
							echo "<td class='txt_center'>
							<a class='op_btn' onclick='cantDel();'>删除</a>
							<a href='editUser.php?id={$row['id']}' class='op_btn'>修改</a>
							<a href='resetUserPwd.php?id={$row['id']}' class='op_btn'>重置密码</a>
							</td>";
						}
						
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
			<script>
				function cantDel(){
					alert("管理员不能删除");
				}
			</script>
	</body>
</html>