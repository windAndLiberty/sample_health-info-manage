<?php 
// 创建连接
$conn = new mysqli("127.0.0.1:3306", "librarian", "","myDB");
// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 //预处理及绑定
$stmt = $conn->prepare("update `item` set `name`=?, `idType`=?, `idNum`=?,`address`=? ,`travelHistory`=?,`symptom`=?,`contact`=? where phoneNum=" . $_POST['phoneNum']);
  $stmt->bind_param("sssssii",
  $_POST['name'], $_POST['idType'], $_POST['idNum'],$_POST['address'],$_POST['travelHistory'],$symptom,$contact);

// 设置参数

$symptom =$_POST['symptom']=='true'?1:0;
$contact=$_POST['contact']=='true'?1:0;


$stmt->execute();
echo "更新成功";
$stmt->close();

$conn->close();
?>