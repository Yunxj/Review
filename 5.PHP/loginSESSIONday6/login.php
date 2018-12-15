<?php
//判断用户发送的请求是POST,不是不显示内容,
// var_dump($_SERVER["REQUEST_METHOD"]); 
//没有操作时打印出来的是"GET",点击登录时打印的是"POST"
if($_SERVER["REQUEST_METHOD"] == "POST") { 
  //  print_r($_POST);
// Array
// (
//     [username] => 1    
//     [password] => 1
// )
// username的中括号是打印时系统自加的,不影响用法,和数组的用法一样
  //接收数据,用户名发出了POST的请求,那么就储存用户输入的用户名和密码
  $name = $_POST["username"];
  $pwd = $_POST["password"];
    //判断是否输入用户名或密码
    if(trim($name) == "" || trim($pwd) == ""){
      //不正确输出$error
      $error = "请输入用户名和密码";
    }else {
      //正确时,先获取数据库的中的用户名和密码,遍历$str
      $str = file_get_contents("users.json");
      $arr = json_decode($str,true);
      foreach($arr as $value) {
        //遍历$str 判断用户名和密码是否与数据库的用户名和密码正确
        if($value["username"] ==  $name && $value["password"] == $pwd) {
          //正确时把输入的用户名,用setcookie方法把用户名以键值对的方式,储存到数组中
          //执行以上代码时，PHP脚本通过HTTP协议，
          //通知浏览器在其COOKIE数据区存储数据。数据的类型为字符串，无法存储其他类型的数据。
          //PHP脚本将数据存储在预定义变量$_COOKIE中。
          //可以通过$_COOKIE进行读取，实现其他业务逻辑（如推荐信息等）。
          // setcookie("username",$name);
          ///print_r($_COOKIE["username"]);   打印输出属性值jack

          // print_r($_COOKIE);  打印出一个数组
          // Array
          // (
          //     [username] => jack
          // ) 
          //并且同时跳转到登录成功的页面
          //用session方法存储数据
          session_start();
          $_SESSION["username"] = $name;
          header("location:index.php");
        }else {
          //不正确就输出
          $error = "用户名或密码错误";
        }
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登录</title>
  <link rel="stylesheet" href="bootstrap.css">
  <style>
    body {
      background-color: #f8f9fb;
    }

    .login-form {
      width: 360px;
      margin: 100px auto;
      padding: 30px 20px;
      background-color: #fff;
      border: 1px solid #eee;
    }

    .login-form h1 {
      font-size: 30px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1>登录</h1>  
    <!-- 如果 isset($error) 是true, 说明是为$error存在,即内容输入错误,那么就输出<?= $error?>错误信息 -->
    <?php if(isset($error)):?>
    <!-- 下面的错误提示信息结构 需要在有错误信息的时候进行显示 -->
    <div class="alert alert-danger" role="alert"><?= $error?></div>
   <?php endif;?>
    <div class="form-group">
      <label for="username">用户名</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">密码</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    
    <!-- <button type="submit" class="btn btn-primary btn-block">登录</button> 有BUG不能用-->
    <input type="submit" class="btn btn-primary btn-block" value="登录">
  </form>
</body>
</html>