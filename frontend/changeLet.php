<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安全邮箱</title>
<link href="css/change.css" rel="stylesheet" type="text/css" />
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
echo "<script type='text/javascript'>
		function validate_email()
		{
			var re=/^\w+@[a-zA-Z0-9]{2,10}(?:\.[a-z]{2,4}){1,3}$/;
			if(re.test(cha.textfieldB.value))
			{return true}
			else{alert('邮箱格式不正确！');return false}
		}	
	</script>";
echo "<p>原电子邮箱：&nbsp;&nbsp;&nbsp;&nbsp;".$row["email"]."</p>";
echo "<form name='cha' action='changeLetSQL.php' method='post' onsubmit='return validate_email()'>";
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