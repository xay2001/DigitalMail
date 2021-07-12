<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
    <link rel="stylesheet" href="css/mystyle.css" type="text/css"/>
    <script type="text/javascript" src="script/check.js"></script>
</head>

<body class="shop_body">
	<?php 
		include 'front-top.php';
		include 'functions.php';
		checkUserLogined();// 判断用户是否登录
	?>
    <div class="formContain">
    	<form action="updatePwdAction.php?action=updatePwd" method="post" onsubmit="return validate_form(this)">
    		<h2 class="frm_title">修改密码</h2>
    		<p><span>旧的密码</span><input type="password" name="password" class="txt-inp"></p>
    		<p><span>新的密码</span><input type="password" name="newpassword" class="txt-inp"></p>
    		<p><span>确认密码</span><input type="password" name="repassword" class="txt-inp"></p>
    		<p class="txt_center"><input type="submit" value="修改" class="frm-btn"></p>
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
	      if (validate_required(password,"请输入旧密码")==false){
	    	  	password.focus();
		      	return false;
		  }
	      if (validate_required(newpassword,"请输入密码")==false){
	    	  	 newpassword.focus();
	    		 return false;
	     }
	      if (validate_required(repassword,"请输入确认密码")==false){
	    	     repassword.focus();
	    		 return false;
	     }
		     if(validate_equal(newpassword, repassword, "两次密码不一致") == false){
		    	 repassword.focus();
	    		 return false;
			 }
	  }
    }
    </script>
</body>

</html>

