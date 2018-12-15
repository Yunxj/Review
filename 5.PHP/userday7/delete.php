<?php
$id = $_GET["id"];
$conn = mysqli_connect("localhost","root","root","student");
$sql = "delete from user where id = $id";
$bool = mysqli_query($conn,$sql);
if($bool) {
    header("location:index.php");
}else {
    echo "删除失败";
    echo mysqli_error($conn);
}

?>