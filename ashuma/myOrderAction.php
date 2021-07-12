<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
//执行商品信息的增、删、改的操作

//一、导入配置文件和函数库文件	//二、连接MySQL，选择数据库
	require("dbconfig.php");
	require("functions.php");


//三、获取action参数的值，并做对应的操作
	switch($_GET["action"]){
		case "add": //添加
			//1. 获取添加信息
			$userId 		= $_SESSION['userId'];
			$goodsId 		= trim($_POST["goods_id"]);// 商品id
			$orderSn		= date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);//订单号
			$consignee		= trim($_POST['consignee']);// 收货人
			$phone			= trim($_POST['phone']);// 联系电话
			$address		= trim($_POST['address']);// 收货地址
			$orderMoney 	= 0;// 订单金额
			// 查询订单金额
			$sql = "select * from goods where id={$goodsId}";
			$result = mysql_query($sql);
			if($result && mysql_num_rows($result)>0){
				$goods = mysql_fetch_assoc($result);//解析出要修改的商品信息
				$orderMoney = $goods['price'];
			}else{
				alertMes('商品不存在', 'index.php');
			}
			if($orderMoney <= 0){
				alertMes('订单金额需要大于0', 'index.php');
			}
			
			$createtime 	= date('y-m-d H:i:s');// 下单时间
			
			//2. 验证
			if(empty($phone)){
				alertMes('请填写手机号', 'addOrder.php?id='.$goodsId);
			}
			if(empty($consignee)){
				alertMes('请填写收货人', 'addOrder.php?id='.$goodsId);
			}
			if(empty($address)){
				alertMes('请填写地址', 'addOrder.php?id='.$goodsId);
			}
			
			
			
			//3. 拼装sql语句，并执行添加
			$sql = "insert into tb_order(user_id,goods_id,order_sn,order_money,consignee,phone,address,createtime) values('{$userId}','{$goodsId}','{$orderSn}','{$orderMoney}','{$consignee}','{$phone}','{$address}','{$createtime}')";
			//echo $sql;
			mysql_query($sql);
			
			//4. 判断并输出结果
			if(mysql_insert_id()>0){
				alertMes('下单成功！', 'myOrderList.php');
			}else{
				echo "下单失败！".mysql_error();
			}
			
			
			break;
		
		case "del": //删除
			$userId 		= $_SESSION['userId'];
			//获取要删除的id号并拼装删除sql，执行
			$sql = "delete from tb_order where id={$_GET['id']} and user_id={$userId}";;
			mysql_query($sql);
			
			//跳转到浏览界面
			header("Location:myOrderList.php");
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
				alertMes("订单金额必须有值", "editOrder.php?id={$id}");
			}
			
			if(empty($consignee)){
				alertMes("收货人必须有值", "editOrder.php?id={$id}");
			}
			
			if(empty($address)){
				alertMes("地址必须有值", "editOrder.php?id={$id}");
			}
			
			if(empty($phone)){
				alertMes("手机号必须有值", "editOrder.php?id={$id}");
			}
			
			
			//3. 执行修改
			$sql = "update tb_order set order_money='{$orderMoney}', consignee='{$consignee}', address='{$address}', phone='{$phone}', updatetime='{$updatetime}' where id={$id}";
			//echo $sql;
			mysql_query($sql);
			
			//6. 判断是否修改成功
			if(mysql_affected_rows()>0){
				alertMes("修改成功", "myOrderList.php");
			}else{
				//echo "修改失败".mysql_error();
				alertMes("修改失败", "myOrderList.php");
			}
			
			break;

	}

//四、关闭数据库
mysql_close();


