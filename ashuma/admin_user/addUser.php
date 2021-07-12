<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>用户信息管理</title>
		<link rel="stylesheet" href="../css/mystyle.css" type="text/css"/>
		<script type="text/javascript" src="../script/check.js"></script>
	</head>
	<body>
			<h3 class="page_title">添加用户信息</h3>
			<form action="userAction.php?action=add" enctype="multipart/form-data" method="post" onsubmit="return validate_form(this)">
			<table border="0" width="900" class="frm_table">
				<tr>
					<td align="right">用户名：</td>
					<td><input type="text" name="username" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">密码：</td>
					<td><input type="password" name="password" class="frm_txt"/></td>
				</tr>
				<tr>
					<td align="right">确认密码：</td>
					<td><input type="password" name="repassword" class="frm_txt"/></td>
				</tr>
				
				<tr>
					
					<td colspan="2" align="center">
						<input type="submit" value="添加" class="add_btn"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="重置" class="add_btn"/>
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