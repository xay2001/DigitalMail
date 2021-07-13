<?php
header("Content-Type: text/html;charset=utf-8");
//执行商品信息的增、删、改的操作
session_start();
//一、导入配置文件和函数库文件
	require("dbconfig.php");
	require("functions.php");


//二、获取action参数的值，并做对应的操作
	
	switch($_GET["act"]){
		case "login": //登录
			//1. 获取信息
			$username 		= trim($_POST["username"]);
			$password 		= trim($_POST["password"]);
			$md5Pwd 		= md5($password);// 密码加密
			$code=trim($_POST["code"]);
			//2. 验证
			if(empty($username)){
				alertMes('用户名称必须有值', 'login.php');
			}
			if(empty($password)){
				alertMes('密码必须有值', 'login.php');
			}
			if(empty($code)||$code!=$_SESSION["check_checks"]){
				alertMes('验证码错误','login.php');
			}
			
			// 判断用户是否存在
			$sql_count = "select * from user where username = '{$username}' and password='{$md5Pwd}'";
			$result = mysql_query($sql_count);
			
			
			if($result && mysql_num_rows($result)>0){
				$item = mysql_fetch_assoc($result);
				if($username == 'admin'||$username == 'weilai'||$username == 'xieweijie'||$username == 'xuanyuan'||$username == 'daironghao'){
					$_SESSION['adminName'] = $item['username'];
					$_SESSION['adminId'] = $item['id'];
					$_SESSION['userName'] = $item['username'];
					$_SESSION['userId'] = $item['id'];
					alertMes('登录成功', 'index.php');
				}else{
					$_SESSION['userName'] = $item['username'];
					$_SESSION['userId'] = $item['id'];
					alertMes('登录成功', 'index.php');
				}
			}else{
				alertMes('登录失败，重新登录', 'login.php');
			}

			
			break;
		
		case "logout": //退出
			//获取要删除的id号并拼装删除sql，执行
			$_SESSION['adminName'] = '';
			$_SESSION['adminId'] = '';
			$_SESSION['userName'] = '';
			$_SESSION['userId'] = '';
			
			//跳转到浏览界面
			header("Location:index.php");
			break;
			
			

	}

//四、关闭数据库
mysql_close();


