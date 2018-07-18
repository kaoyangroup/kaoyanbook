<?php 

require_once '../backend/order_back.php';
$uid = $_COOKIE["cur_uid"];
if(isset($_GET["orderId"]))
	$orderId = $_GET["orderId"];
update($orderId,$uid,0);
echo "取消订单成功！";
echo "<a href='../frontend/order_false.php'>点击返回</a>";
?>