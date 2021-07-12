<?php
header("Content-Type: text/html;charset=utf-8");
//执行商品信息的增、删、改的操作

//一、导入配置文件和函数库文件
	require("../dbconfig.php");
	require("../functions.php");

//二、连接MySQL，选择数据库


//三、获取action参数的值，并做对应的操作
	switch($_GET["action"]){
		case "add": //添加
			//1. 获取添加信息
			$username 		= trim($_POST["username"]);
			$password 		= trim($_POST["password"]);
			$repassword 	= trim($_POST["repassword"]);
			$createtime 	= date('y-m-d H:i:s');
			$md5Pwd 		= md5($password);// 密码加密
			//2. 验证
			if(empty($username)){
				die(errorTip("用户名称必须有值", "addUser.php"));
			}
			if(empty($password)){
				die(errorTip("密码必须有值", "addUser.php"));
			}
			if($password != $repassword){
				die(errorTip("两次密码不一致", "addUser.php"));
			}
			
			// 判断用户名是否重复
			$sql_count = "select count(*) as total from user where username = '{$username}'";
			$result = mysql_query($sql_count);
			if($result){
				$res = mysql_fetch_array($result);
				$num=$res['total'];
				if($num > 0){
					die(errorTip("用户名已经被占用", "addUser.php"));
				}
			}
			
			
			//3. 拼装sql语句，并执行添加
			$sql = "insert into user values(null,'{$username}','{$md5Pwd}','{$createtime}',null)";
			//echo $sql;
			mysql_query($sql);
			
			//4. 判断并输出结果
			if(mysql_insert_id()>0){
				echo "添加成功！";
			}else{
				echo "添加失败！".mysql_error();
			}
			echo "<br/> <a href='userList.php'>返回列表<a>";
			
			
			break;
		
		case "del": //删除
			//获取要删除的id号并拼装删除sql，执行
			$sql = "delete from user where id={$_GET['id']}";
			mysql_query($sql);
			
			//跳转到浏览界面
			header("Location:userList.php");
			break;
			
			
		case "update": //修改
			//1. 获取要修改的信息
			$username 		= trim($_POST["username"]);
			$id 			= trim($_POST['id']);
			$updatetime 	= date('y-m-d H:i:s');
			//2. 数据验证
			if(empty($username)){
				die(errorTip("用户必须有值", "editUser.php?id={$id}"));
			}
			
			
			// 判断用户名是否重复
			$sql_count = "select count(*) as total from user where username = '{$username}' and id !={$id}";
			$result = mysql_query($sql_count);
			if($result){
				$res = mysql_fetch_array($result);
				$num=$res['total'];
				if($num > 0){
					die(errorTip("用户名已经被占用", "editUser.php?id={$id}"));
				}
			}
			
			//5. 执行修改
			$sql = "update user set username='{$username}',updatetime='{$updatetime}' where id={$id}";
			//echo $sql;
			mysql_query($sql);
			
			//6. 判断是否修改成功
			if(mysql_affected_rows()>0){
				echo "修改成功";
			}else{
				echo "修改失败".mysql_error();
			}
			echo "<br/> <a href='userList.php'>返回列表<a>";
			
			break;
		case "resetPwd":
			$id 			= trim($_POST['id']);
			$updatetime 	= date('y-m-d H:i:s');
			$password 		= trim($_POST["password"]);
			$repassword 	= trim($_POST["repassword"]);
			$createtime 	= date('y-m-d H:i:s');
			$md5Pwd 		= md5($password);// 密码加密
			//1. 验证
			if(empty($password)){
				die(errorTip("密码必须有值", "resetUserPwd.php?id={$id}"));
			}
			if($password != $repassword){
				die(errorTip("两次密码不一致", "resetUserPwd.php?id={$id}"));
			}
			//2. 执行修改
			$sql = "update user set password='{$md5Pwd}',updatetime='{$updatetime}' where id={$id}";
			//echo $sql;
			mysql_query($sql);
				
			//3. 判断是否修改成功
			if(mysql_affected_rows()>0){
				echo "密码重置成功";
			}else{
				echo "密码重置失败".mysql_error();
			}
			echo "<br/> <a href='userList.php'>返回列表<a>";
			break;

	}

//四、关闭数据库
mysql_close();


