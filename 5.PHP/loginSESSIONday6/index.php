<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>  这是首页!  </h1>
	<!-- $_COOKIE
	 <?php  print_r($_COOKIE)?>  -->
	 <!-- isset($_COOKIE["username"]) 存在时  ,输出次代码 -->
	<?php session_start(); if(isset($_SESSION["username"])):?>
	 欢迎<?php echo $_SESSION["username"]?><a href="logint.php">退出</a>
	 <?php else:?>
	 
	 <!-- isset($_COOKIE["username"]) 不存在时  ,输出次代码 -->
	 <a href="login.php">登录</a>
<?php endif; ?>
</body>
</html>