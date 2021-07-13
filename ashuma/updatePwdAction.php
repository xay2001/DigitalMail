<?php
header("Content-Type: text/html;charset=utf-8");
//执行商品信息的增、删、改的操作
session_start();
//一、导入配置文件和函数库文件 连接MySQL，选择数据库
	require("dbconfig.php");
	require("functions.php");

//二、获取action参数的值，并做对应的操作
	
	switch($_GET["action"]){
		case "updatePwd": //修改密码
			//1. 获取信息
			$userId			= $_SESSION['userId'];
			$password 		= $_POST['password'];
			$repassword 	= $_POST['repassword'];
			$newpassword 	= $_POST['newpassword'];
			$updatetime 	= date('y-m-d H:i:s');
			
			//2. 验证
			if(empty($password)){
				alertMes('旧密码必须有值', 'updatePwd.php');
			}
			if(empty($repassword)){
				alertMes('确认密码必须有值', 'updatePwd.php');
			}
			if(empty($newpassword)){
				alertMes('新密码必须有值', 'updatePwd.php');
			}
			if($repassword != $newpassword){
				alertMes('两次密码不一致', 'updatePwd.php');
			}
			// 判断用户是否存在
			$sql_count = "select * from user where id = {$userId}";
			$result = mysql_query($sql_count);
			
			
			if($result && mysql_num_rows($result)>0){
				$item = mysql_fetch_assoc($result);
				if($item['password']== md5(trim($password))){
					if(trim($repassword) == trim($newpassword)){
						$md5Pwd = md5(trim($newpassword));
						$sql = "update user set password='{$md5Pwd}',updatetime='{$updatetime}' where id={$userId}";
						//echo $sql;
						mysql_query($sql);
						//判断是否修改成功
						if(mysql_affected_rows()>0){
							alertMes("密码重置成功", "index.php");
						}else{
							echo "密码重置失败".mysql_error();
						}
					}else{
						alertMes("两次密码不一致", "updatePwd.php");
					}
				}else{
					alertMes("旧密码有误", "updatePwd.php");
				}
			}else{
				alertMes('用户不存在', 'index.php');
			}

			
			break;
		
			
			

	}

//三、关闭数据库
mysql_close();


