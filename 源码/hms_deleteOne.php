
<html>
<body>
 
<?php 
// 创建连接
$conn = mysqli_connect("127.0.0.1", "librarian", "", "myDB");
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "delete from item 
where phoneNum=" . $_POST['phoneNum'];
 
$result = mysqli_query( $conn, $sql );
if(! $result )
{
    die('无法删除该元组: ' . mysqli_error($conn));
}
echo "<h1>删除成功</h1>";
// 释放内存

mysqli_close($conn);
?>

</body>
</html>