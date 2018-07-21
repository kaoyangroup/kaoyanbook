<?php
require_once 'includes/dbh.inc.php';
session_start();
//确认下订单之后执行的sql
//更新Booking表被选中票的余票标识码和余票数量
$ticketId = $_SESSION["ticketId"];
$sql_margins = "select * from Booking where ticketId='$ticketId'";
$res_margins = mysqli_query($con,$sql_margins);
$row_margins = mysqli_fetch_array($res_margins);

$marginCode = $row_margins["marginCode"];
$marginTicket = $row_margins["marginTicket"];
$startSeq = $_SESSION["startSeq"];
$endSeq = $_SESSION["endSeq"];
// update marginCode and marginTicket for Booking
for($i = $startSeq; $i <= $endSeq; $i++ ){   
    $marginCode[$i-1]='1';
}
$marginTicket = $marginTicket - ($endSeq - $startSeq +1);  

// seq[3,4]
// station[3,4]
//update Booking表
$sql = "update Booking set marginCode='$marginCode',marginTicket='$marginTicket' 
        where ticketId='$ticketId'";
$result = mysqli_query($con,$sql);
//update margin
//echo $_SESSION["seatType"];
//<start,end,lineId,ticketId> -> 更新余票表
$lineId = $_SESSION["lineId"];
$seatType = $_SESSION["seatType"];
$date = $_SESSION["departure_date"];
$length = strlen($marginCode);

if(($seatType == '卧铺') or ($seatType=='一等座'))  $mySeatType = '卧票';
if(($seatType == '硬座') or ($seatType=='二等座'))  $mySeatType = '坐票';

for($i = 1; $i <= $endSeq+1; $i++){   // i:出发站seq j:终点站seq seatType:座位类型
    for($j = $startSeq+1; $j<=$length+1;$j++){
        if($i >= $j)continue;
        $sql = "select station from Line where arrOrder='$i' and lineId='$lineId'";
        $re = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($re);
        $startStation=$row["station"];
        $sql = "select station from Line where arrOrder='$j' and lineId='$lineId'";
        $re = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($re);
        $endStation=$row["station"];

        //echo $startStation,$endStation."<br>"; 
        //echo $." ".$date." ".$startStation." ".$endStation."<br>";
        $sql = "update Margins set marginTicket=marginTicket-1  where
            lineId ='$lineId' and 
            date ='$date' and
            start = '$startStation' and
            end = '$endStation' and
            seatType = '$mySeatType'";
        $re = mysqli_query($con,$sql);
    }
}


    //seatId -> carriageId -> carriageType 得到座位类型 seatType
    //------------------------------------------------------------------------------------------update ----------------------------
/*
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
*/  


//更新Myorder,order订单表
$uid = "风之子";//$_COOKIE["cur_uid"];
$orderTime = date("Y-m-d H:i:s");
//$orderId = md5($uid + $ticketId + $orderTime);
$orderId = $uid." ".$ticketId." ".$orderTime;
$start = $_SESSION["start"];
$end = $_SESSION["end"];
$sql_order = "insert into Order1 values ('$orderId','$uid','$ticketId','$orderTime',0,'$start','$end')";
mysqli_query($con,$sql_order);
$sql_myorder = "insert into Myorder values('$uid','$orderId')";
mysqli_query($con,$sql_myorder);

//跳转到订单界面
header("Location:../frontend/pay.php");

?>
