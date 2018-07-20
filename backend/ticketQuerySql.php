<?php
    include_once "includes/dbh.inc.php";
?>


<?php
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
(select lineId,station,arrTime from Line where station='上海')LB,
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
?>
<?php
//从前端获取的数据: $from,$to,$departure_date
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
      P.seatType='卧票' and
      M.date='$departure_date' ";

$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if($num==0){
    echo "<tr>无可乘坐车次,请重新选择日期!</tr>";
}


while($row = mysqli_fetch_assoc($result)){   
    //获得一行数据表示车次信息
    $lineId = $row["lineId"];
    $lineType = $lineId[0];
    $start = $row["start"];
    $end = $row["end"];
    $start_time = $row["start_time"];
    $end_time = $row["end_time"];
    $departure_time = $row["departure_time"];
    $firstZuoMargins="--"; //高铁
    $secondZuoMargins="--";
    $firstZuoPrice="--";
    $secondZuoPrice="--";
    $woMargins="--"; // 普快 | 特快
    $zuoMagins="--";    
    $woPrice="--";
    $zuoPrice="--"; 
    //echo "<tr><td>$lineId</td></tr>";
    
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
                     lineType = '$lineType' ";
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
                     lineType = '$lineType' ";
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
                     lineType = '$lineType' ";
        $priceRes = mysqli_query($con,$priceSql);
        while($priceRow = mysqli_fetch_assoc($priceRes)){
            $zuoPrice = $priceRow["price"];
        }
    }
    //已知departure_date 获得 end_date
    $end_date = $departure_date;
    $dateSql = "select arrDate from Line where lineId = '$lineId' and station = '$end'";
    $dateRes = mysqli_query($con,$dateSql);
    while($dateRow = mysqli_fetch_assoc($dateRes)){
        $arrive_date = $dateRow["arrDate"];
        if($arrive_date == "次日") $end_date =date('Y-m-d',strtotime("$end_date +1 day")); 
    }
    $start_datetime = "$departure_date "."$start_time";
    $end_datetime = "$end_date "."$end_time";
    $duratino_datetime = "";
    //向table中填写获得的数据 
    echo "
        <tr>
            <td>$lineId</td> <!-- 路线号-->
            <td>$start</td> <!-- 出发站-->
            <td>$start_datetime</td> 
            <td>$end</td>
            <td>$end_datetime</td>
            <td>$duration_time </td>
            <td>$firstZuoMargins</td>
            <td>$firstZuoPrice</td>
            <td>$secondZuoMargins</td>
            <td>$secondZuoPrice</td>
            <td>$woMargins</td>
            <td>$woPrice</td>
            <td>$zuoMargins</td>
            <td>$zuoPrice</td>
            <td><input type='button' id='buttonBooking' value='预订' class='btn btn-success'  onclick='onSubmit()' >
            </td>         
        </tr>
    ";
}
/*
function onSubmit(){
						window.location.href='ticketBooking.html?lineId=' + $lineId + '&departure_date=' + $departure_date + '&start=' + $start + '&end=' + $end;
					}
*/

?>
<?php
	$_SESSION["lineId"] = $lineId;
	$_SESSION["departure_date"] = $departure_date;
	$_SESSION["start"] = $start;
	$_SESSION["end"] = $end;
    $_SESSION["start_datetime"] = $start_datetime;
?>





