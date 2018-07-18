
<?php
	include_once "includes/dbh.inc.php";
?>


<?php
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
*/

/*
select LA.lineId,LA.station,LA.arrTime,LB.station,LB.arrTime,P.seatType,P.price,M.date from
(select lineId,station,arrTime from Line where station="北京")LA,
(select lineId,station,arrTime from Line where station="石家庄")LB,
(select trainId,trainType from Train)TRAIN,
(select * from Mileprice)P,
(select * from Manage)M
where LA.lineId=LB.lineId and
      LA.lineId=TRAIN.trainId and
      TRAIN.trainType=P.lineType and
      LA.station=P.start and
      LB.station=P.end and
      LA.lineId=M.lineId and
      M.date="2018-08-01";
*/

$start = "北京";
$end = "石家庄";
$date = "2018-08-01";

//----------------------------------------------------------------------------
$sql = "select LA.lineId,LA.station,LA.arrTime,LB.station,LB.arrTime,P.seatType,P.price,M.date from
(select lineId,station,arrTime from Line where station='$start')LA,
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
      M.date='$date'";

$result = mysqli_query($con,$sql);

?>
