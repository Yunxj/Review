<?php
//第一步:收集数据
header("Content-Type:text/html;charset=utf8");
$name = $_POST["name"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
// $name = $_POST["name"];
$filename = "";
if($_FILES["img"]["error"] == 0){
    $filename = "./assets/img/".time().mt_rand(100,999).strrchr($_FILES["img"]["name"],".");
    move_uploaded_file($_FILES["img"]["tmp_name"],$filename);
}
$conn = mysqli_connect("localhost","root","root","student");
$sql = "insert into user values(null,'$name','$filename','$gender','$birthday')";
//用变量接收,利于传入参数
$bool = mysqli_query($conn,$sql);
//die($sql); 找不到错误时,可以检查错误
if($bool) {
    header("location:index.php");
}else {
    echo "输入错误";
    echo mysqli_error($conn);
}


?>