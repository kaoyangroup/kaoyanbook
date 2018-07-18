<?php
$uid = $_COOKIE["cur_uid"];
require_once '../backend/includes/dbh.inc.php';
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$email = $row["email"];
$pwd = $_POST["textfieldC"];
$newEmail = $_POST["textfieldB"];
if($pwd != $row["pwd"])
{
	$pwdErr = "密码错误。请重试";
	header("Location:changeLet.php?pwdErr=$pwdErr");
}
else
{
	$sql2 = "update user set email='$newEmail'";
	mysqli_query($con,$sql2);

}
mysqli_close($con);
echo "修改成功！";
echo "<a href='Safe.html'>点击返回</a>";
?>