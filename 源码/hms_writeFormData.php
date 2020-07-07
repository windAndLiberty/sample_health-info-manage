<?php 
// 创建连接
$conn = new mysqli("127.0.0.1:3306", "librarian", "","myDB");
// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//判断预处理函数返回的类型是否有效var_dump($stmt);

// 预处理及绑定
$stmt = $conn->prepare("INSERT INTO `item` (`name`, `idType`, `idNum`,`phoneNum` ,`address` ,`travelHistory`,`symptom`,`contact` ) VALUES (?, ?, ?, ?, ? , ?, ?, ?)");
  $stmt->bind_param("ssssssii",
  $_POST['name'], $_POST['idType'], $_POST['idNum'],$_POST['phoneNum'],$_POST['address'],$_POST['travelHistory'],$symptom,$contact);

// 设置参数

$symptom =$_POST['symptom']=='true'?1:0;
$contact=$_POST['contact']=='true'?1:0;


$stmt->execute();
echo "新记录产生成功";
$stmt->close();

$conn->close();
?>