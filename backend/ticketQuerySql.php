<?php
	include_once "includes/dbh.inc.php";
?>


<?php
/*
从前端获取的数据: $from,$to,$date

1. 先根据 from 和 to 检索出lineId={date=manage.date}.lianId
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
$from = "北京";
$to = "石家庄";
$date = "2018-07-20";
/*
$sql = "select lineId from Line where station='$from' and lineId in(
            select lineId from Line where station='$to')";
*/
$fuck = "select * from Line where station='$from'";
$result = mysqli_query($con,$fuck);
$num = mysqli_num_rows($result);
echo $num;

?>
