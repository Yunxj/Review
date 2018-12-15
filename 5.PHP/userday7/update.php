<?php
//编辑后的保存到数据库
header("Content-Type:text/html;charset=utf8");
$name = $_POST["name"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
$id = $_POST["id"];

$filename = "";
if($_FILES["img"]["error"] == 0){
    $filename = "./assets/img/".time().mt_rand(100,999).strrchr($_FILES["img"]["name"],".");
    move_uploaded_file($_FILES["img"]["tmp_name"],$filename);
}

$conn = mysqli_connect("localhost","root","root","student");
//当用户重新编辑没有上传文件时, $filename = ""是为空的,判断当前的$filename = "" 是否为空,;
if($filename == "") {
    $sql = "update user set name = '$name', gender='$gender',birthday='$birthday' where id = $id ";

}else{
    $sql = "update user set name = '$name', gender='$gender',birthday='$birthday', photo='$filename' where id = $id  ";

}
$bool = mysqli_query($conn,$sql);
if($bool) {
    header("location:index.php");
}else {
    echo "输入错误";
    echo mysqli_error($conn);
}











?>