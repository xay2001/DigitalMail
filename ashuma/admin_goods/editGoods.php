<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>商品信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
		<script type="text/javascript" src="../script/check.js"></script>
	</head>
	<body>
			<?php  
				//1.导入配置文件 
					require("../dbconfig.php");
				//2. 连接数据库，并选择数据库
				
				//3. 获取要修改的商品信息
					$sql = "select * from goods where id={$_GET['id']}";
					$result = mysql_query($sql);
				
				//4. 判断是否获取到要编辑的商品信息
					if($result && mysql_num_rows($result)>0){
						$shop = mysql_fetch_assoc($result);//解析出要修改的商品信息 
					}else{
						die("没有找到要修改的商品信息");
					}
			
			
			
			?>
			<h3 class="page_title">编辑商品信息</h3>
			<form action="goodsAction.php?action=update" enctype="multipart/form-data" method="post" onsubmit="return validate_form(this)">
				<input type="hidden" name="id" value="<?php echo $shop['id']; ?>"/>
				<input type="hidden" name="oldpic" value="<?php echo $shop['pic']; ?>"/>
			<table border="0" width="1200" class="frm_table">
				<tr>
					<td align="right">名称：</td>
					<td><input type="text" name="name" value="<?php echo $shop['name']; ?>" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">类型：</td>
					<td>
						<select name="typeid">
						<?php 
							require("../dbconfig.php");
							foreach($typelist as $k=>$v){
								$sd = ($shop['typeid']==$k)?"selected":"";//是否是当前的类型
								echo "<option value='{$k}' {$sd}>{$v}</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">单价：</td>
					<td><input type="text" name="price"  value="<?php echo $shop['price']; ?>" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">库存：</td>
					<td><input type="text" name="total"  value="<?php echo $shop['total']; ?>" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">图片：</td>
					<td><input type="file" name="pic"/></td>
				</tr>
				<tr>
					<td align="right" valign="top">描述：</td>
					<td><textarea rows="10" cols="70" name="note"><?php echo $shop['note']; ?></textarea></td>
				</tr>
				<tr>
					
					<td colspan="2" align="center">
						<input type="submit" value="修改"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="重置"/>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">&nbsp;</td>
					<td><img src="../uploads/<?php echo $shop['pic']; ?>" style="max-width: 200px;"/></td>
				</tr>
			</table>
			</form>
		<script type="text/javascript">
		function validate_form(thisform){
			with (thisform){
				if (validate_required(name,"请填写商品名称")==false){
					name.focus();
			      	return false;
			  }
				if (validate_required(price,"请填写商品单价")==false){
					price.focus();
			      	return false;
			  }

				if (validate_required(total,"请填写商品库存")==false){
					total.focus();
			      	return false;
			  }
				if (validate_required(note,"请填写商品描述")==false){
					note.focus();
			      	return false;
			  }
			}
		}
    </script>
	</body>
</html>