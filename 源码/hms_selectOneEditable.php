<html>
<head>
<style>
[name]{
   text-align: left;
   margin-top: 15px;
}

form {
  top: 10%;
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
  background-color: #cae8ca;
  text-align:center;
}
</style>
</head>
<body>
<?php 
// 创建连接
$conn = mysqli_connect("127.0.0.1", "librarian", "", "myDB");
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * from item 
where phoneNum=" . $_POST['phoneNum'];
 
$result = mysqli_query( $conn, $sql );
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row==null){
       die('<h1>要修改的数据不存在</h1>');
}


//看是否需要标红
if($row['symptom'] == 1 || $row['contact'] == 1){
    echo '<form name="myForm" action="hms_updateFormData.php" onsubmit="return validateForm()" method="post" style="background-color:red;">';
}
else{
    echo '<form name="myForm" action="hms_updateFormData.php" onsubmit="return validateForm()" method="post">';
}

//在表单子元素中填入查询得到的信息
?>
<form name="myForm" action="hms_updateFormData.php" onsubmit="return validateForm()" method="post">
<label for="name">姓名：</label>
<input type="text" name="name" id="name" maxlength="30" required value="<?php 
    echo $row['name'];
?>"><br>

<label for="idType">证件类型：</label>
<select name="idType" id = "idType" value="<?php 
    echo $row['idType'];
?>" >
    <option>身份证</option>
    <option>护照</option>
    <option>外籍居留证</option>
    <option>港澳通行证</option>
</select><br>

<label for="idNum">证件号码：</label>
<input type="text" name="idNum" id="idNum" maxlength="30" onchange=" validateIdNum()" value="<?php 
    echo $row['idNum'];
?>" required><br>

<label for="phoneNum">手机号码：</label>
<input type="text" name="phoneNum" id="phoneNum" value="<?php 
    echo $row['phoneNum'];
?>" disabled></input><br>

<label for="address">户籍地址：</label>
<input type="text" name="address" id="address" maxlength="50" required value="<?php 
    echo $row['address'];
?>"><br>

<textarea rows="3" cols="30" placeholder="近14天旅行史" name = "travelHistory" requird ><?php if (isset ($row['travelHistory']))
    echo $row['travelHistory'];
?></textarea><br>

<label for="symptom">近14天内是否有发热、干恶等不适症状：</label>
<input type="radio" name="symptom" id="symptom" value="true" requird <?php if (isset($row['symptom']) && $row['symptom']==1) echo "checked";?> value="true">是
<input type="radio" name="symptom" id="symptom" value="false" requird <?php if (isset($row['symptom']) && $row['symptom']==0) echo "checked";?> value="false">否<br>

<label for="contact">近14天内是否与正在实施医学观察的确诊病例,疑似病例接触：</label>
<input type="radio" name="contact" id="contact" value="true" requird <?php if (isset($row['contact']) && $row['contact']==1) echo "checked";?> value="true">是
<input type="radio" name="contact" id="contact" value="false" requird <?php if (isset($row['contact']) && $row['contact']==0) echo "checked";?> value="false">否<br>


  <input type="reset" value="重置">
  <input type="submit" value="提交">
</form>
<script>

function validateIdNum(){
   var patt;
   switch(document.forms["myForm"]["idType"].value){
         case "身份证":patt = /^\d{17}(\d|X)$/;   
           break; 
         case "护照":patt = /^[A-Z]{1}\d{8}$/;   
           break; 
         case "外籍居留证":patt = /^([A-Z]|[a-z]){3}\d{12}$/;   
           break; 
         case "港澳通行证":patt = /^[A-Z]{1}(\d){8}$/;   
           break; 
   }
   if(patt.test(document.forms["myForm"]["idNum"].value)){
         return true;
   }else{
	     alert('需要输入正确的证件号码');
         return false;
   }
}
function validateSymptom(){
    if(document.forms["myForm"]["symptom"].value==null){
          return false;
    }
    return true;
}
function validateContact(){
    if(document.forms["myForm"]["contact"].value==null){
          return false;
    }
    return true;
}
function validateForm(){
if(validateIdNum()&&validateSymptom()&&validateContact()){
     document.getElementById("phoneNum").disabled=false;
     return true;      
      }
else{return false;}
}
</script>
<?php 
// 释放内存
mysqli_free_result($result);
mysqli_close($conn);
?>
</body>
</html>