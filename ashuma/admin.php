<?php 
session_start();// 开启session
require("functions.php");// 引入函数
checkLogined();// 判断管理员是否登录
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>后台管理</title>
		<link rel="stylesheet" href="css/mystyle.css" type="text/css"/>
	</head>
	<body>
		<div class="admin_head">
			<h3>后台管理系统</h3>
		</div>
		<div class="admin_content">
			<!--左侧列表-->
        	<div class="menu">
        		<div class="cont">
        			<div class="title">管理员</div>
        			<ul class="mList">
        				<li>
	                        <h3><span>+</span>用户管理</h3>
	                        <dl>
	                        	<dd><a  class='pageA' href="admin_user/addUser.php" target="mainFrame">添加用户</a></dd>
	                            <dd><a  class='pageA' href="admin_user/userList.php" target="mainFrame">用户列表</a></dd>
	                        </dl>
                    	</li>
        				<li>
	                        <h3><span>+</span>商品管理</h3>
	                        <dl>
	                        	<dd><a  class='pageA' href="admin_goods/addGoods.php" target="mainFrame">添加商品</a></dd>
	                            <dd><a  class='pageA' href="admin_goods/goodsList.php" target="mainFrame">商品列表</a></dd>
	                        </dl>
                    	</li>
                    	<li>
	                        <h3><span>+</span>订单管理</h3>
	                        <dl>
	                            <dd><a  class='pageA' href="admin_order/orderList.php" target="mainFrame">订单列表</a></dd>
	                        </dl>
                    	</li>
                    	<li>
	                        <h3><span>+</span>系统管理</h3>
	                        <dl>
	                            <dd><a  class='pageA' href="index.php">返回首页</a></dd>
	                        </dl>
	                        <dl>
	                            <dd><a  class='pageA' href="loginAction.php?act=logout">退出登录</a></dd>
	                        </dl>
                    	</li>
        			</ul>
        		</div>
        	</div>
		
			<div class="main">
	            <!--右侧内容-->
	            <div class="cont">
	                <!-- <div class="title">后台管理</div> -->
	      	 		<!-- 嵌套网页开始 -->         
	                <iframe src="adminMain.php"  frameborder="0" name="mainFrame" width="100%" height="800"></iframe>
	                <!-- 嵌套网页结束 -->   
	            </div>
        	</div>
        	
		</div>
			
		
	</body>
</html>