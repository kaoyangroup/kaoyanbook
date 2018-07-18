<html>
<body>
<?php 
require_once '../backend/includes/dbh.inc.php';
$uid = $_POST["Userame"];
$pwd = $_POST["Password"];

$sql = "select * from user where pwd='$pwd' and (uid='$uid' or email='$uid' or mobile='$uid')";
$result = mysqli_query($con,$sql);
$num=mysqli_num_rows($result);
if($num > 0)
{
	setcookie("cur_uid",$uid,time()+3600);
	header("Location:index.html");
}
else
{
$loginErr = "账户不存在或密码不正确，请重新输入";
header("Location:login2.php?loginErr='$loginErr'");
}
?>

</body>
</html>