<?php
$id = $_GET["id"];
$conn = mysqli_connect("localhost","root","root","student");
$sql = "select * from user where id = $id";
$bool = mysqli_query($conn,$sql);
$info = mysqli_fetch_assoc($bool);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXXX管理系统</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">用户管理</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">商品管理</a>
      </li>
    </ul>
  </nav>
  <main class="container">
    <h1 class="heading">添加用户</h1>
     <!-- 有错误信息时显示 -->
    <?php if(isset($error)):?>
      <div class="alert alert-danger" role="alert"><?= $error?></div>
    <?php endif; ?>
    
    <form action="update.php" method="post" enctype="multipart/form-data">
    <!-- update.php 也可以获取到当前页面的中$info["id"] 提交给update.php,可以同步数据 -->
      <input type="hidden" name="id" value="<?= $info["id"]?>">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $info['name']?>">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender" name="gender">
          <option value="未知">请选择性别</option>
          <!-- 三元运算符 选择男女 -->
          <option value="男" <?php $info["gender"] == "男" ? "seleced" : "" ;?>>男</option>
          <option value="女" <?php $info["gender"] == "女" ? "seleced" : "" ;?>>女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $info['birthday']?>">
      </div>
      <div class="form-group">
        <label for="img">头像</label>
        <input type="file" class="form-control" id="img" name="img">
      </div>
      <!-- <button class="btn btn-primary">保存</button> -->
      <input type="submit" value="保存" class="btn btn-primary">
    </form>
  </main>
</body>
</html>
