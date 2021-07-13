<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
//执行商品信息的增、删、改的操作

//一、导入配置文件和函数库文件
	require("../dbconfig.php");
	require("../functions.php");

//二、连接MySQL，选择数据库


//三、获取action参数的值，并做对应的操作
	switch($_GET["action"]){
		
		case "del": //删除
			//获取要删除的id号并拼装删除sql，执行
			$sql = "delete from tb_order where id={$_GET['id']}";
			mysql_query($sql);
			
			//跳转到浏览界面
			header("Location:orderList.php");
			break;
			
			
		case "update": //修改
			//1. 获取要修改的信息
			$id 			= trim($_POST['id']);
			$orderMoney 	= trim($_POST["order_money"]);
			$consignee 		= trim($_POST["consignee"]);
			$address 		= trim($_POST["address"]);
			$phone 			= trim($_POST["phone"]);
			$updatetime 	= date('y-m-d H:i:s');
			//2. 数据验证
			if(empty($orderMoney)){
				die(errorTip("订单金额必须有值", "editOrder.php?id={$id}"));
			}
			
			if(empty($consignee)){
				die(errorTip("收货人必须有值", "editOrder.php?id={$id}"));
			}
			
			if(empty($address)){
				die(errorTip("地址必须有值", "editOrder.php?id={$id}"));
			}
			
			if(empty($phone)){
				die(errorTip("手机号必须有值", "editOrder.php?id={$id}"));
			}
			
			
			//3. 执行修改
			$sql = "update tb_order set order_money='{$orderMoney}', consignee='{$consignee}', address='{$address}', phone='{$phone}', updatetime='{$updatetime}' where id={$id}";
			//echo $sql;
			mysql_query($sql);
			
			//6. 判断是否修改成功
			if(mysql_affected_rows()>0){
				echo "修改成功";
			}else{
				echo "修改失败".mysql_error();
			}
			echo "<br/> <a href='orderList.php'>返回列表<a>";
			
			break;

	}

//四、关闭数据库
mysql_close();


