<?php
function update($orderId,$uid,$f)
{
	session_start();
	$dbServer = "localhost";
$userName = "root";
$dbPwd = "123456";
$dbName = "kaoyan";

$con = mysqli_connect($dbServer,$userName,$dbPwd,$dbName);
mysqli_set_charset($con,'utf8');

if(!$con){
    die('Could not connect: '.mysqli_connect_error());
}
	//Order
	$sql_order = "select * from Order1 where orderId='$orderId'";
	$res_order = mysqli_query($con,$sql_order);
	$row_order = mysqli_fetch_array($res_order);
	$ticketId = $row_order["ticketId"];
	$from = $row_order["start"];
	$to = $row_order["end"];

	//Myorder
	$uid = "风之子";//$_SESSION["cur_uid"];//$_COOKIE["cur_uid"];

	//Booking
	$sql_booking = "select * from Booking where ticketId='$ticketId'";
	$res_booking = mysqli_query($con,$sql_booking);
	$row_booking = mysqli_fetch_array($res_booking);
	$lineId = $row_booking["lineId"];
	$seatId = $row_booking["seatId"];
	$marginCode = $row_booking["marginCode"];
	$marginTicket = $row_booking["marginTicket"];
	$goDate = $row_booking["date"];

	//seat
	$sql_seat = "select * from Seat where seatId='$seatId'";
	$res_seat = mysqli_query($con,$sql_seat);
	$row_seat = mysqli_fetch_array($res_seat);
	$carriageId = $row_seat["carriageId"];
	$seatNo = $row_seat["seatNo"];

	//carriage
	$sql_carriage = "select * from Carriage where carriageId='$carriageId'";
	$res_carriage = mysqli_query($con,$sql_carriage);
	$row_carriage = mysqli_fetch_array($res_carriage);
	$trainId = $row_carriage["trainId"];
	$carriageType = $row_carriage["carriageType"];
	$carriageNo = $row_carriage["carriageNo"];

	//train
	$sql_train = "select * from Train where trainId='$trainId'";
	$res_train = mysqli_query($con,$sql_train);
	$row_train = mysqli_fetch_array($res_train);
	$trainType = $row_train["trainType"];

	//Line
	$sql_line = "select * from Line where lineId='$lineId' and station='$from'";
	$res_line = mysqli_query($con,$sql_line);
	$row_line = mysqli_fetch_array($res_line);
	$order_from = $row_line["arrOrder"];
	$sql_line1 = "select * from Line where lineId='$lineId' and station='$to'";
	$res_line1 = mysqli_query($con,$sql_line1);
	$row_line1 = mysqli_fetch_array($res_line1);
	$order_to = $row_line1["arrOrder"];

	//Mileprice
	$sql_price = "select * from Mileprice where start='$from' and end='$to' and lineType='$trainType' and seatType='$carriageType'";
	$res_price = mysqli_query($con,$sql_price);
	$row_price = mysqli_fetch_array($res_price);
	$price = $row_price["price"];

	$codeLength = strlen($marginCode);
	for($i = $order_from-1;$i <= $order_to;$i++)
	{
		if($marginCode[$i] == '1')
			$marginCode[$i] = '0';
	}
	//
	$marginNum = 0;
	for($j = 0;$j < $codeLength;$j++)
	{
		if($marginCode[$j] == '0')
			$marginNum++;
	}
	//update booking
	$sql_update_booking = "update Booking set marginCode='$marginCode',marginTicket='$marginNum' where ticketId='$ticketId'";
	mysqli_query($con,$sql_update_booking);

	//Margins
	$sql_update_margins = "update Margins set marginTicket=marginTicket+1 where lineId='$lineId' and date='$goDate' and start='$from' and end='$to' and seatType='$carriageType'";
	mysqli_query($con,$sql_update_margins);

	//update myorder
	$sql_update_myorder = "delete from Myorder where orderId='$orderId'";
	mysqli_query($con,$sql_update_myorder);

	//update order
	$sql_update_order = "delete from Order1 where orderId='$orderId'";
	mysqli_query($con,$sql_update_order);

	if($f == 1){
		//update user
		$sql_user = "update user set account=account+'$price' where uid='$uid'";
		mysqli_query($con,$sql_user);
	}
	

	// return array($from,$to,$trainId,$seatNo,$uid,$goDate,1);
}
?>