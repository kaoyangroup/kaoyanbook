<?php
   include_once "includes/dbh.inc.php";
/*
$firstZuoMargins="";
$secondZuoMargins="";
$firstZuoPrice="";
$secondZuoPrice="";
$woMargins="";
$zuoPrice="";    
$woPrice="";
$zuoPrice="";    
*/

/*
从前端获取的数据: $from,$to,$date
1. 先根据 from 和 to 检索出lineId={date=manage.date}.lineId
2. 
*/
/*
车次        | 出发站          | 出发时间        | 目的站          | 到达时间        | 途经时间 | 一等座余票 | 一等座价格 | 二等座余票 | 二等座价格 | 卧铺余票 | 卧铺价格 | 硬座余票 | 硬座价格
Line.lineId | Line.station(1) | Line.arrTime(1) | Line.station(2) | Line.arrTime(2) |          |  Milprice.from=station(1),Milprice.to=station(2),Milprice.lineType=Line.linId[0],Milprice.seatType={卧票,座票}
*/
/*
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];

select  LA.lineId as lineId,LA.station as start,LA.arrTime as start_time,LB.station as end,LB.arrTime as end_time,P.seatType as seatType,P.price as price,M.date as departure_time from
(select lineId,station,arrTime from Line where station='北京')LA,
(select lineId,station,arrTime from Line where station='石家庄')LB,
(select trainId,trainType from Train)TRAIN,
(select * from Mileprice)P,
(select * from Manage)M
where LA.lineId=LB.lineId and
      LA.lineId=TRAIN.trainId and
      TRAIN.trainType=P.lineType and
      LA.station=P.start and
      LB.station=P.end and
      LA.lineId=M.lineId and
      P.seatType="卧票" and
      M.date='2018-07-19';
*/
//----------------------------------------------------------------------------



$seatType = "卧票";

//echo "<td>$start</td><td>$end</td><td>$departure_date</td>";

$sql = "select  LA.lineId as lineId,LA.station as start,LA.arrTime as start_time,LB.station as end,LB.arrTime as end_time,P.seatType as seatType,P.price as price,M.date as departure_time from
(select lineId,station,arrTime from Line where station='$start' )LA,
(select lineId,station,arrTime from Line where station='$end')LB,
(select trainId,trainType from Train)TRAIN,
(select * from Mileprice)P,
(select * from Manage)M
where LA.lineId=LB.lineId and
      LA.lineId=TRAIN.trainId and
      TRAIN.trainType=P.lineType and
      LA.station=P.start and
      LB.station=P.end and
      LA.lineId=M.lineId and
      P.seatType='$seatType' and
      M.date='$departure_date' ";

$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if($num==0){
    echo "<tr>无可乘坐车次,请重新选择日期!</tr>";
}


while($row = mysqli_fetch_assoc($result)){   //--------------------------------------------------------------获得一行数据表示车次信息
    $lineId = $row["lineId"];
    $lineType = $lineId[0];
    $start = $row["start"];
    $end = $row["end"];
    $start_time = $row["start_time"];
    $end_time = $row["end_time"];
    $departure_time = $row["departure_time"];
    $firstZuoMargins=""; //高铁
    $secondZuoMargins="";
    $firstZuoPrice="";
    $secondZuoPrice="";
    $woMargins=""; // 普快 | 特快
    $zuoMagins="";    
    $woPrice="";
    $zuoPrice=""; 


    
    if($lineType=='G'){    // 更新: 一等座余票 | 一等座价格 | 二等座余票 | 二等座价格    <lineId,departure_date,start,end,seatType>       
        $seatType = "卧票";
        //一等座余量 
        $marginSql = "select marginTicket from Margins where 
                      lineId = '$lineId' and
                      start = '$start' and
                      end = '$end' and
                      seatType = '$seatType' and
                      date = '$departure_time'";
        $marginRes = mysqli_query($con,$marginSql); 
        while($marginRow = mysqli_fetch_assoc($marginRes)){
            $firstZuoMargins = $marginRow["marginTicket"];
        }
        //一等座价格
        $priceSql = "select price from Mileprice where
                     start = '$start' and
                     end = '$end' and 
                     seatType = '$seatType' and
                     lineType = 'lineType' ";
        $priceRes = mysqli_query($con,$priceSql);
        while($priceRow = mysqli_fetch_assoc($priceRes)){
            $firstZuoPrice = $priceRow["price"];
        }

        $seatType = "坐票";
        //二等座余量
        $marginSql = "select marginTicket from Margins where
              lineId = '$lineId' and
              start = '$start' and
              end = '$end' and
              seatType = '$seatType' and
              date = '$departure_time'";
        $marginRes = mysqli_query($con,$marginSql); 
        while($marginRow = mysqli_fetch_assoc($marginRes)){
            $secondZuoMargins = $marginRow["marginTicket"];
        }
        //二等座价格
        $priceSql = "select price from Mileprice where
             start = '$start' and
             end = '$end' and 
             seatType = '$seatType' and
             lineType = '$lineType' ";
        $priceRes = mysqli_query($con,$priceSql);
        while($priceRow = mysqli_fetch_assoc($priceRes)){
            $secondZuoPrice = $priceRow["price"];
        }      
    }else{ //更新: 卧铺余票 | 卧铺价格 | 硬座余票 | 硬座价格 
        
        $seatType = "卧票";
        //卧票余量
         $marginSql = "select marginTicket from Margins where 
                      lineId = '$lineId' and
                      start = '$start' and
                      end = '$end' and
                      seatType = '$seatType' and
                      date = '$departure_time'";
        $marginRes = mysqli_query($con,$marginSql); 
        while($marginRow = mysqli_fetch_assoc($marginRes)){
            $woMargins = $marginRow["marginTicket"];
        }
        //卧票价格
        $priceSql = "select price from Mileprice where
                     start = '$start' and
                     end = '$end' and 
                     seatType = '$seatType' and
                     lineType = 'lineType' ";
        $priceRes = mysqli_query($con,$priceSql);
        while($priceRow = mysqli_fetch_assoc($priceRes)){
            $woPrice = $priceRow["price"];
        }
        
        $seatType = "坐票";
        //坐票余量
        $marginSql = "select marginTicket from Margins where 
             lineId = '$lineId' and
             start = '$start' and
             end = '$end' and
             seatType = '$seatType' and
             date = '$departure_time'";
        $marginRes = mysqli_query($con,$marginSql); 
        while($marginRow = mysqli_fetch_assoc($marginRes)){
            $zuoMargins = $marginRow["marginTicket"];
        }
       //坐票价格
       $priceSql = "select price from Mileprice where
                     start = '$start' and
                     end = '$end' and 
                     seatType = '$seatType' and
                     lineType = 'lineType' ";
        $priceRes = mysqli_query($con,$priceSql);
        while($priceRow = mysqli_fetch_assoc($priceRes)){
            $woPrice = $priceRow["price"];
        }
    }
}


?>





