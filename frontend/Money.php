<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>账户余额</title>
<style type="text/css">
body {
	background-color: #CCC;
}
</style>
<link href="css/money.css" rel="stylesheet" type="text/css" />
</head>

<body id="seeMoney">

<div id="topM">
<div id="t"><h3>账户余额</h3></div>
<div id="r">
<ul>
	<li>
    	<a href="index.html" target="_blank"><div>首页</div></a>
    </li>
	<li>
    	<a href="Buy.html" target="_blank"><div>购票</div></a>
    </li>
    <li>
    	<a href="order.html" target="_blank"><div>查看历史订单</div></a>
    </li>
    <li>
    	<a href="login2.php" target="_blank"><div>退出登录</div></a>
    </li>
</ul>
</div>
</div>

<div id="c">
<div id="look">
<p>人民币 &nbsp;&nbsp;
<?php 
require_once '../backend/includes/dbh.inc.php';
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
