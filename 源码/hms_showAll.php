<?php
session_start();

// 创建连接
$conn = mysqli_connect("127.0.0.1", "librarian", "", "myDB");
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select phoneNum from item ";
 
$result = mysqli_query( $conn, $sql );
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}
if(mysqli_num_rows($result) ==0){
       die('<h1>查询结果为空</h1>');
}
$_SESSION['phoneNums']=array();
while($row = mysqli_fetch_assoc($result)) {
  array_push($_SESSION['phoneNums'],$row["phoneNum"]);
} 
$_SESSION['pos']=-1;
?>

<html>
<head>
<style>
[name]{
   text-align: left;
   margin-top: 15px;
}
body{
  background: url(https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1591613138460&di=a10747b4273cd969925a3160c19baa9c&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fblog%2F201401%2F03%2F20140103000230_5EZiQ.jpeg);
}
iframe{
  top: 10%;
  float:center;
  padding: 10px;
 <!-- background-color: #cae8ca;-->  
  text-align:center;
}
button{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 20px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 12px;
}

</style>
</head>
<body>
<?php //print_r($_SESSION['phoneNums']);
?>
 <a target="frame1" href="hms_previousPage.php"><button 
 style="float:left;" id="pre" disabled>上一页</button></a>
 <a target="frame1" href="hms_nextPage.php"><button 
style="float:right;" id="next">下一页</button></a>



<iframe src="" frameborder="0" id="frame1" name="frame1" width="95%" height = "600px"></iframe>


<script>
document.getElementById("next").onclick=function available(){
  document.getElementById("pre").disabled=false;
}

</script>
</body>
</html>
<?php 
// 释放内存
mysqli_free_result($result);
mysqli_close($conn);
?>