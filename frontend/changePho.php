<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>手机核验</title>
<link href="change.css" rel="stylesheet" type="text/css" />
</head>

<body id='changePas'>
<h3>账号安全 - 手机核验</h3>
<div id="center">
<?php
$uid = $_COOKIE["cur_uid"];
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$mobile = $row["mobile"];
echo "<p>原手机号：&nbsp;&nbsp;&nbsp;&nbsp;".$mobile."</p>";
echo "<form action='changePhoSQL.php' method='post'>";
echo "<p>新手机号：<input type='text' name='textfieldB' /></p>";
echo "<p>登录密码：<input type='text' name='textfieldC' /></p>";
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正确输入密码才能修改密保</p>";
    
echo "<div>";
echo "<input type='submit' value='确 认'' />";
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
