<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安全邮箱</title>
<link href="change.css" rel="stylesheet" type="text/css" />
</head>

<body id='changePas'>
<h3>账号安全 - 安全邮箱</h3>
<div id="center">
<?php
$uid = $_COOKIE["cur_uid"];
require_once '../backend/includes/dbh.inc.php';
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo "<p>原电子邮箱：&nbsp;&nbsp;&nbsp;&nbsp;".$row["email"]."</p>";
echo "<form action='changeLetSQL.php' method='post'>";
echo "<p>新电子邮箱：<input type='text' name='textfieldB' /></p>";
echo "<p>登录密码：&nbsp;&nbsp;&nbsp;&nbsp;<input type='password' name='textfieldC' /></p>";
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正确输入密码才能修改个人资料</p>";
    
echo "<div>";
echo "<input type='submit' value='确 认' />";
echo "</div>";
echo "</form>";
if(isset($_GET["pwdErr"]))
{
	echo $_GET["pwdErr"];
}
?>

</div>
</body>
</html>