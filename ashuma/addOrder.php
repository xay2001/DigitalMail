<?php 
require("functions.php");
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>商城</title>
    <link rel="stylesheet" href="css/mystyle.css" type="text/css"/>
    <script type="text/javascript" src="script/check.js"></script>
</head>

<body class="shop_body">
    <?php 
    	// 引入头部
		include 'front-top.php';
		// 判断是否登录
		checkUserLogined();
	?>
    <div class="goods_detail_contain">
    	<?php  
				//1.导入配置文件  连接数据库，并选择数据库
					require("dbconfig.php");
				
				//3. 获取商品信息
					$sql = "select * from goods where id={$_GET['id']}";
					$result = mysql_query($sql);
				
				//4. 判断是否获取到商品信息
					if($result && mysql_num_rows($result)>0){
						$shop = mysql_fetch_assoc($result);//解析出商品信息 
					}else{
						alertMes('商品不存在', 'index.php');
					}
			
			
			
			?>
			<h3 class="page_title">订单信息</h3>
			<form  enctype="multipart/form-data" method="post" action="myOrderAction.php?action=add" onsubmit="return validate_form(this)">
				<input type="hidden" name="goods_id" value="<?php echo $shop['id']; ?>"/>
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['userId'];?>">
				<table border="0" style="width:100%;" class="frm_table">
					<tr>
						<td align="right" width="60">名称：</td>
						<td><span  class="frm_txt"><?php echo $shop['name'];?></span></td>
					</tr>
					
					<tr>
						<td align="right" valign="top">&nbsp;</td>
						<td><img src="./uploads/<?php echo $shop['pic']; ?>" style="max-width: 200px;"/></td>
					</tr>
					
					<tr>
						<td align="right">收货人：</td>
						<td><input type="text" name="consignee" autocomplete="off"  value="" class="frm_txt"/></td>
					</tr>
					<tr>
						<td align="right">手机：</td>
						<td><input type="text" name="phone" autocomplete="off"  value="" class="frm_txt"/></td>
					</tr>
					<tr>
						<td align="right">地址：</td>
						<td><input type="text" name="address" autocomplete="off"  value="" class="frm_txt"/></td>
					</tr>
					<tr>
						<td colspan="2" class="txt_center"><button class="submit_order_btn">提交订单</button></td>
						
					</tr>
				</table>
			</form>
    </div>
	<div class="bottom">
		<p style="text-align: center;height: 100px; line-height: 100px;">
			<a  href="index.php" style="color: #fff;">首页</a> <span>|</span> <a style="color: #fff;" href="myOrderList.php">我的 </a>
		</p>
	</div>
    <script type="text/javascript">
		function validate_form(thisform){
			with (thisform){
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