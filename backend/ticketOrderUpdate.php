<?php
require_once 'includes/dbh.inc.php';
session_start();
//确认下订单之后执行的sql
//更新Booking表被选中票的余票标识码和余票数量
$ticketId = $_SESSION["ticketId"];
$sql_margins = "select * from Booking where ticketId='$ticketId'";
$res_margins = mysqli_query($con,$sql_margins);
$row_margins = mysqli_fetch_array($res_margins);
$marginTicket = $row_margins["marginTicket"];
$startSeq = $_SESSION["startSeq"];
$endSeq = $_SESSION["endSeq"];
$marginCode = $row_margins["marginCode"];
for($i = $startSeq; $i <= $endSeq; $i++ ){
    $marginCode[$i]='1';
}
$tiekctId = $_SESSION["ticketId"];

$marginTicket = $marginTicket - ($endSeq - $startSeq +1);    

//update booking表
$sql = "update table Booking set marginCode='$marginCode',marginTicket='$marginTicket' 
        where ticketId='$ticketId'";
$result = mysqli_query($con,$sql);

//<start,end,lineId,ticketId> -> 更新余票表
for($i = 1; $i <= endSeq+1; $i++)   // i:出发站 j:终点站 seatType:座位类型
    for($j =startSeq+1; $j<=$len+1;$j++){
    if($i >= $j)continue;
    //seatId -> carriageId -> carriageType 得到座位类型 seatType
    $sql = "select C.carriageId from
              (select * from Seat)S,
              (select * from Carriage)C 
            where S.ticketId='$ticketId' and S.carriageId=C.carriageId";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $seatType = $row["arrOrder"];
    }
    // <lineId,curr_date,start,end,seatType>余票数量-1
    $sql ="update table Margins set marginTicket=marginTicket-1 where 
                lineId='$lineId' and 
                date='$ticket_date' and
                start='$start' and
                end = '$end' ";
    $result = mysqli_query($con,$sql);    
}

//更新Myorder,order订单表
$uid = "marco";//$_COOKIE["cur_uid"];
$ticketId = $_SESSION["ticketId"];
$orderTime = date("Y-m-d H:i:s");
echo $orderTime;
$orderId = md5($uid + $ticketId + $orderTime);
$start = $_SESSION["start"];
$end = $_SESSION["end"];
$sql_order = "insert into Order1 values ('$orderId','$uid','$ticketId','$orderTime',0,'$start','$end')";
mysqli_query($con,$sql_order);
$sql_myorder = "insert into Myorder values('$uid','$orderId')";
mysqli_query($con,$sql_myorder);

//跳转到订单界面
header("Location:../frontend/pay.php");

?>
