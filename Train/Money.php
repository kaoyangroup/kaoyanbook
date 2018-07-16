<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
body {
	background-color: #CCC;
}
</style>
<link href="money.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="seeMoney">
<h3>账户余额</h3>

<div id="look">
<p>人民币 &nbsp;&nbsp;
<?php 
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
$uid = $_COOKIE["cur_uid"];
$sql = "select * from user where uid='$uid'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo $row['account'];
?>
&nbsp;&nbsp;元</p>
</div>

<div id="button">
<a href="charge.html" target="jump">
	<input name="" type="button" value="充 值" /></a>
</div>

<div id="iframe">
<iframe name="jump"></iframe>
</div>

</div>
</body>
</html>
