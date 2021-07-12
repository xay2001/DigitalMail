<?php 
	//1.导入配置文件
	require("../dbconfig.php");
	//2. 连接数据库，并选择数据库
	
	//3. 获取要修改的用户信息
	$sql = "select * from user where id={$_GET['id']}";
	$result = mysql_query($sql);
	
	//4. 判断是否获取到要编辑的用户信息
	if($result && mysql_num_rows($result)>0){
		$item = mysql_fetch_assoc($result);//解析出要修改的信息
	}else{
		die("没有找到要修改的信息");
	}
?>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>用户信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
		<script type="text/javascript" src="../script/check.js"></script>
	</head>
	<body>
			<h3 class="page_title">重置用户密码</h3>
			<form action="userAction.php?action=resetPwd" enctype="multipart/form-data" method="post" onsubmit="return validate_form(this)">
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			<table border="0" width="900" class="frm_table">
				<tr>
					<td align="right">用户名：</td>
					<td><input type="text" name="username" class="frm_txt" value="<?php echo $item['username'];?>" disabled="disabled"/></td>
				</tr>
				
				<tr>
					<td align="right">新密码：</td>
					<td><input type="text" name="password" class="frm_txt"/></td>
				</tr>
				
				<tr>
					<td align="right">确认密码：</td>
					<td><input type="text" name="repassword" class="frm_txt"/></td>
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
				if (validate_required(username,"请填写用户名")==false){
					username.focus();
			      	return false;
			  }
				if (validate_required(password,"请填写密码")==false){
					password.focus();
			      	return false;
			  }

				if (validate_required(repassword,"请填写确认密码")==false){
					repassword.focus();
			      	return false;
			  }
			}
		}
    </script>
	</body>
</html>