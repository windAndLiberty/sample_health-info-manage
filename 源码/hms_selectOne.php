
<html>
<body>
 
<?php 
// 创建连接
$conn = mysqli_connect("127.0.0.1", "librarian", "", "myDB");
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select name,idType,idNum,phoneNum,address,travelHistory,symptom,contact from item 
where phoneNum=" . $_POST['phoneNum'];
 
$result = mysqli_query( $conn, $sql );
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row==null){
       die('<h1>查询结果为空</h1>');
}


//看是否需要标红
if($row['symptom'] == 1 || $row['contact'] == 1){
    echo '<table border="1" style="border-collapse: collapse;background-color:red;opacity:0.7;filter:Alpha(opacity=70);  top: 10%;
  margin: auto;
  width: 50%;
  border: 3px solid #73AD21;
  padding: 10px;
  background-color: #cae8ca;
  text-align:center;">';
}
else{
    echo '<table border="1" style="border-collapse: collapse;opacity:0.7;filter:Alpha(opacity=70);  top: 10%;
  margin: auto;
  width: 50%;
  border: 3px solid #73AD21;
  padding: 10px;
  background-color: #cae8ca;
  text-align:center;">';
}

//转换数据项含义
$row['symptom'] = ($row['symptom'] == 1)? '有' : '无'; 
$row['contact'] = ($row['contact'] == 1)? '有' : '无'; 
$data=array('name'=>'姓名','idType'=>'证件类型','idNum'=>'证件号码','phoneNum'=>'手机号码','address'=>'户籍地址','travelHistory'=>'旅行史','symptom'=>'存在症状？','contact'=>'与病例有接触？');
foreach($data as $x =>$x_value) 
{
    echo "<tr><th> {$data[$x]}</th> ".
         "<td>{$row[$x]} </td> ".
         "</tr>";
}
echo '</table>';
// 释放内存
mysqli_free_result($result);
mysqli_close($conn);
?>

</body>
</html>