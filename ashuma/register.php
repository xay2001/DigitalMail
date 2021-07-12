<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link rel="stylesheet" href="css/mystyle.css" type="text/css"/>
    <script type="text/javascript" src="script/check.js"></script>
</head>

<body class="shop_body">
	<?php 
		include 'front-top.php';
	?>
    <div class="formContain">
    	<form action="registerAction.php?action=add" method="post" onsubmit="return validate_form(this)">
    		<h2 class="frm_title">注册</h2>
    		<p><span>输入账号</span><input type="text" name="username" autocomplete="off" class="txt-inp"></p>
    		<p><span>输入密码</span><input type="password" name="password" class="txt-inp"></p>
    		<p><span>确认密码</span><input type="password" name="repassword" class="txt-inp"></p>
    		<p class="txt_center"><input type="submit" value="注册" class="frm-btn" style="border-radius: 5px;"></p>
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
	      if (validate_required(username,"请输入账号")==false){
		      	username.focus();
		      	return false;
		  }
	      if (validate_required(password,"请输入密码")==false){
	    		 password.focus();
	    		 return false;
	     }
	      if (validate_required(repassword,"请输入确认密码")==false){
	    	  repassword.focus();
	    		 return false;
	     }
		     if(validate_equal(password, repassword, "两次密码不一致") == false){
		    	 repassword.focus();
	    		 return false;
			 }
	  }
    }
    </script>
</body>

</html>