<?php
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
$curr_time = time("H-i-s");
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
$ticketNeed = $endSeq - $startSeq + 1;

//从Booking表中查找可用座位,更新
//$departure_date = '2018-07-20';
//优化处理：先查询余票表，如果余票表显示余票为0，那么不需要对订票表进行检索，直接显示无可选座位
$sql = "select * from Booking where lineId='$lineId' and date='$departure_date'
                          order by marginTicket";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){

    $marginCode = $row["marginCode"];
    $marginTicket = $row["marginTicket"];
    $ticketId = $row["ticketId"];
    $seatId = $row["seatId"];
    //跳过类型不匹配的座位
    /*$sql = "
        select Crg.carriageType as ctype from 
        (select carriageId,carriageType from Carriage )Crg,
        (select seatId,carriageId from Seat)SEAT where
        SEAT.seatId = '$seatId' and 
        Crg.carriageId = SEAT.carriageId
     ";*/
     $sql = "select  carriageType as ctype from Carriage natural join Seat where Seat.seatId='$seatId'";
    $re = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($re)){
       $ctype = $row["ctype"];
    } 
    //if($ctype =="坐票") echo $ctype;
    $ack = false;
    //echo $ctype;
    if(($ctype == '卧票' and ($seatType=="卧铺" or $seatType=="一等座"))or($ctype == '坐票' and ($seatType=="硬座" or $seatType=="二等座"))){
        $ack = true;
    }
    if( !$ack ){
        continue;    
    }

    if($marginTicket < $ticketNeed){   //余票数量 < ticketNeed
        continue;    
    }
    $tag=true;
    $len = strlen($marginCode);
    for( $i = $startSeq; $i <= $endSeq; $i++){
        if($marginCode[$i-1] == "1"){
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
//--------------------------------------把seatId放到SESSION中去
$_SESSION["seatId"] = $seatId;
$_SESSION["ticketId"] = $ticketId;
$_SESSION["startSeq"] = $startSeq;
$_SESSION["endSeq"] = $endSeq;
?>






