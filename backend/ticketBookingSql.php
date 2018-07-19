<?php>
    include_once "includes/dbh.inc.php";
?>

<?php
/*
订票:
$userId = $_COOKIE["cur_uid"];  
$lineId = ......
$ticket_date = .....
$start = ......
$end = ......


1.从ticketTable中得到 lineId  start end
2.检索Booking订票表
    select * from Booking where lineId=$lineId and date=$curr_date
                          order by marginTicket;
3.查找座位类型
select C.carriageType from
        (select * from Seat)S
        (select * from Carriage)C
    
---------------------------------------- 遍历Booking订票表,获取一张可以购买的表  ----------------

*/
$curr_date = date("Y-m-d");
$curr_time = time("H-m-s");
//-------------------------------得到出发地边号 startSeq
$sql = "select arrOrder from Line where lineId='$lineId' and station='$start' ";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result)){
    $startSeq = $row["arrOrder"];
}
//-------------------------------得到目的地边号 endSeq
$sql = "select arrOrder from Line where lineId='$lineId' and station='$end' ";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result)){
    $endSeq = $row["arrOrder"]-1;
}

//--------------------------------当前区间占用几张票 ticketNeed
$ticketNeed = $sendSeq - $startSeq + 1;


//从Booking表中查找可用座位,更新
$sql = "select * from Booking where lineId='$lineId' and date='$ticket_date'
                          order by marginTicket";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result)){
    $marginCode = $row["marginCode"];
    $marginTicket = $row["marginTicket"];
    $ticketId = $row["ticketId"];
    $seatId = $row["seatId"];
    if($marginTicket < $ticketNeed){   //余票数量 < ticketNeed
        continue;    
    }
    $tag=true;
    $len = strlen($marginCode);
    for(int $i = $startSeq; $i <= $endSeq; $i++){
        if($marginCode[$i] == '1'){
            $tag = false;
            break;        
        }    
    }
    if(!$tag){               //当前区间存在不可选段
        continue;    
    }
    //当前记录表示的座位可选,退出循环
    break;
}
//------------------------------------更新Booking表被选中票的余票标识码和余票数量
for(int $i = $startSeq; $i <= $endSeq; $i++ ){
    $marginCode[$i]='1';
}
$marginTicket = $marginTicket - ($endSeq - $startSeq +1);    
//------------------------------------------ update booking表
$sql = "update table Booking set marginCode='$marginCode',marginTicket='$marginTicket' 
        where ticketId='$ticketId'";
$result = mysqli_query($con,$sql);

//-------------------------------------- <start,end,lineId,ticketId> -> 更新余票表
for(int $i = 1; $i <= endSeq+1; $i++)   // i:出发站 j:终点站 seatType:座位类型
    for(int $j =startSeq+1; $j<=$len+1;$j++){
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

//-----------------------------------------------更新Myorder,order订单表
//--------------------------------------------------跳转到订单界面

include_once "orderInsert.php";



?>






