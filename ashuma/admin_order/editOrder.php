<?php 
	//1.导入配置文件
	require("../dbconfig.php");
	//2. 连接数据库，并选择数据库

	
	//3. 获取要修改的订单信息
	$sql = "SELECT a.*,b.username,c.`name` as `goods_name`,c.pic FROM tb_order a, `user` b, goods c WHERE a.user_id=b.id AND a.goods_id=c.id and a.id={$_GET['id']}";
	$result = mysql_query($sql);
	
	//4. 判断是否获取到要编辑的订单信息
	if($result && mysql_num_rows($result)>0){
		$item = mysql_fetch_assoc($result);//解析出要修改的订单信息
	}else{
		die("没有找到要修改的信息");
	}
?>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>订单信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
		<script type="text/javascript" src="../script/check.js"></script>
	</head>
	<body>
			<h3 class="page_title">编辑订单信息</h3>
			<form action="orderAction.php?action=update" enctype="multipart/form-data" method="post" onsubmit="return validate_form(this)">
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			<table border="0" width="1200" class="frm_table">
				<tr>
					<td align="right">订单编号：</td>
					<td><input type="text" name="username" class="frm_txt" value="<?php echo $item['order_sn'];?>" readonly="readonly"/></td>
				</tr>
				<tr>
					<td align="right">订单金额：</td>
					<td><input type="text" name="order_money" class="frm_txt" value="<?php echo $item['order_money'];?>" /></td>
				</tr>
				
				<tr>
					<td align="right">收货人：</td>
					<td><input type="text" name="consignee" class="frm_txt" value="<?php echo $item['consignee'];?>" /></td>
				</tr>
				
				<tr>
					<td align="right">手机号：</td>
					<td><input type="text" name="phone" class="frm_txt" value="<?php echo $item['phone'];?>" /></td>
				</tr>
				
				<tr>
					<td align="right">收货地址：</td>
					<td><input type="text" name="address" class="frm_txt" value="<?php echo $item['address'];?>" /></td>
				</tr>
				
				<tr>
					
					<td colspan="2" align="center">
						<input type="submit" value="修改"/>&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
			</form>
		<script type="text/javascript">
		function validate_form(thisform){
			with (thisform){
				if (validate_required(order_money,"请填写订单金额")==false){
					order_money.focus();
			      	return false;
			  }
				if (validate_required(consignee,"请填写收货人")==false){
					consignee.focus();
			      	return false;
			  }
				if (validate_required(phone,"请填写手机号")==false){
					phone.focus();
			      	return false;
			  }

				if (validate_required(address,"请填写收货地址")==false){
					address.focus();
			      	return false;
			  }
			}
		}
    </script>
	</body>
</html>