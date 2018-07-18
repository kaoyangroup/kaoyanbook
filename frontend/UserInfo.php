<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息</title>
<style type="text/css">
@import url("user.css");
</style>
</head>

<body id="info">
<h3>个人信息</h3>
<div>

<p>基本信息</p>
<ul>
<?php
require_once '../backend/includes/dbh.inc.php';
$uid = $_COOKIE["cur_uid"];
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo  "<li>用户名：".$row["uid"]."</li>";
echo  "<li>姓名：".$row["name"]."</li>";
echo  "<li>证件类型：二代身份证</li>";
echo  "<li>证件号码：".$row["cardNo"]."</li>";
if($row["userType"] == 1)
{
echo  "<li>旅客类型：学生</li>";
}
else
{
echo  "<li>旅客类型：普通</li>";
}
echo  "<li>核验状态：通过</li>";

echo "</ul>";
echo "<p>联系方式</p>";
echo "<ul>";
echo  "<li>手机号码：".$row["mobile"]."</li>";
echo  "<li>电子邮件：".$row["email"]."</li>";
  ?>
</ul>
</div>

</body>
</html>
