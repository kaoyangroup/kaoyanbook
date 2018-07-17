<html>
<body>
<?php 
function find($conn,$sql2)
{
	$re = mysqli_query($conn,$sql2);
	return mysqli_num_rows($re);
}

$uid = $_POST["uid"];
$name = $_POST["name"];
$pwd = $_POST["pwd"];
$cardType = $_POST["cardType"];
$cardNo = $_POST["cardNo"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$userType = $_POST["userType"];
$account = 0.0;
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
if(find($con,"select * from user where uid='$uid'") > 0)
{
	$regErr = "用户名已被注册";
	header("Location:login2.php?regErr=$regErr");
}
else if(find($con,"select * from user where cardNo='$cardNo'") > 0)
{
	$regErr = "身份证号已被注册";
	header("Location:login2.php?regErr=$regErr");
}
else if(find($con,"select * from user where email='$email'") > 0)
{
	$regErr = "邮箱已被注册";
	header("Location:login2.php?regErr=$regErr");
}
else if(find($con,"select * from user where mobile='$mobile'") > 0)
{
	$regErr = "手机号已被注册";
	header("Location:login2.php?regErr=$regErr");
}
else
{
$sql = "insert into user values('$uid','$pwd','$name','$cardType','$cardNo','$email','$mobile','$userType','$account')";
$result = mysqli_query($con,$sql);
mysqli_close($con);
setcookie("cur_uid",$uid,time()+3600);
header("Location:index.html");
}

?>

</body>
</html>