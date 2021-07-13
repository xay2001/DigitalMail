<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>商品信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
		<script type="text/javascript" src="../script/check.js"></script>
	</head>
	<body>
			<h3 class="page_title">发布商品信息</h3>
			<form action="goodsAction.php?action=add" enctype="multipart/form-data" method="post" onsubmit="return validate_form(this)">
			<table border="0" width="1200" class="frm_table">
				<tr>
					<td align="right">名称：</td>
					<td><input type="text" name="name" autocomplete="off" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">类型：</td>
					<td>
						<select name="typeid">
						<?php 
							include("../dbconfig.php");
							foreach($typelist as $k=>$v){
								echo "<option value='{$k}'>{$v}</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">单价：</td>
					<td><input type="text" name="price" autocomplete="off" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">库存：</td>
					<td><input type="text" name="total" autocomplete="off" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">图片：</td>
					<td><input type="file" name="pic" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right" valign="top">描述：</td>
					<td><textarea rows="10" cols="70" name="note"></textarea></td>
				</tr>
				<tr>
					
					<td colspan="2" align="center">
						<input class="add_btn" type="submit" value="添加"/>&nbsp;&nbsp;&nbsp;
						<input class="add_btn" type="reset" value="重置"/>
					</td>
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