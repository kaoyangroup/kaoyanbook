<?php
$oldPas = $_POST["textfieldA"];
$newPas = $_POST["textfieldB"];
$newPas2 = $_POST["textfieldC"];
$uid = $_COOKIE["cur_uid"];
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
if($row["pwd"] != $oldPas)
{
$pwdErr = "密码输入错误，修改失败";
header("Location:changePas.php?pwdErr=$pwdErr");
}
else if($newPas != $newPas2)
{
$pwdErr = "输入新密码不一致，请重新输入";
header("Location:changePas.php?pwdErr=$pwdErr");
}
else
{
$sql2 = "update user set pwd='$newPas'";
$res = mysqli_query($con,$sql2);
}
mysqli_close($con);
echo "修改成功！";
echo "<a href='Safe.html'>点击返回</a>";
?>