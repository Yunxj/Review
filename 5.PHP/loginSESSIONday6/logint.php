<?php 
// setcookie("username", "");
// // header("location:index.php");
// header("location:index.php");
//情况$_COOKIE中的数据
// setcookie("username","");
//并且跳转到首页面

//用session方法存储数据
session_start();
session_destroy(); //删除当前用户对应的session文件
header("location:index.php");
?>