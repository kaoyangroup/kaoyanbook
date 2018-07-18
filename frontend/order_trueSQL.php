<?php 

require_once '../backend/order_back.php';
$uid = $_COOKIE["cur_uid"];
if(isset($_GET["orderId"]))
	$orderId = $_GET["orderId"];
update($orderId,$uid,1);
echo "退票成功！";
echo "<a href='../frontend/order_true.php'>点击返回</a>";
?>