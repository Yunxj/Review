<?php
$conn = mysqli_connect("localhost","root","root","student");
$sql = "select * from user";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
  $arr[] = $row;
}
// var_dump($arr);

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
    <a class="navbar-brand" href="#">XXX管理系统</a>
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
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="add.php">添加</a></h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>头像</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th class="text-center" width="140">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($arr as $k => $value) :?>
        <tr>
          <th scope="row"><?= $k+1?></th>
          <td><img src="<?= $value["photo"]?>" class="rounded"></td>
          <td><?= $value["name"]?></td>
          <td><?= $value["gender"]?></td>
          <td>
          <?php $currentTime = time();
                $brithday = strtotime($value["birthday"]);
                $age = ceil(($currentTime - $brithday) / (365*24*3600));
                echo $age;
          ?></td>
          <td class="text-center">
            <!-- 跳转页面时,把id的值也传递过去 -->
            <a href="edit.php?id=<?= $value["id"]?>" class="btn btn-info btn-sm">编辑</a>
            <a href="delete.php?id=<?= $value["id"]?>" class="btn btn-danger btn-sm">删除</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <!-- <tr>
          <th scope="row">2</th>
          <td><img src="./assets/img/icon-01.png" class="rounded"></td>
          <td>小红</td>
          <td>女</td>
          <td>16</td>
          <td class="text-center">
            <a href="#" class="btn btn-info btn-sm">编辑</a>
            <a href="#" class="btn btn-danger btn-sm">删除</a>
          </td>
        </tr>   -->
      </tbody>
    </table>
  </main>
</body>
</html>
