
<?php
	include_once "includes/dbh.inc.php";
    session_start();
	$lineId = $_SESSION["lineId"];
	$start = $_SESSION["start"];
	$end = $_SESSION["end"];
	$start_datetime = $_SESSION["start_datetime"];
    $departure_date = $_SESSION["departure_date"];
    $userName = $_SESSION["userName"];
    $userId = "风之子";//$_SESSION["cur_uid"];
    //后台进行选票操作
    $seatType = $_POST["seatType"];
    $_SESSION["seatType"] = $seatType;
    //进行输入校验,如果不合法则返回
    if($lineId[0] == 'G' and ($seatType=="硬座" or $seatType=="卧铺")){
    $Err = "没有查找到该类型车票,请重新核对座位类型!";
    echo "<script>alert('$selectErr')</script>";
    header('Refresh:1,Url=ticketBooking.php');
    }
    if( ($lineId[0] == 'K' or $lineId[0] == 'T') and ($seatType=="一等座" or $seatType=="二等座")){
    $Err = "没有查找到该类型车票,请重新核对座位类型!";
    echo "<script>alert('$Err')</script>";
    header('Refresh:1,Url=ticketBooking.php');
    }
    if(($seatType == '卧铺') or ($seatType=='一等座'))  $MyseatType = '卧票';
    if(($seatType == '硬座') or ($seatType=='二等座')) $MyseatType = '坐票';
    include_once "ticketOrderSql.php";
?>

<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" href="../frontend/css/marco/bootstrap.min.css">
    <link rel="stylesheet" href="../frontend/css/marco/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../frontend/css/marco/fontAwesome.css">
    <link rel="stylesheet" href="../frontend/css/marco/hero-slider.css">
    <link rel="stylesheet" href="../frontend/css/marco/owl-carousel.css">
    <link rel="stylesheet" href="../frontend/css/marco/datepicker.css">
    <link rel="stylesheet" href="../frontend/css/marco/tooplate-style.css">
    <script src="../frontend/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<body>
<!-- bar -->
<nav class="navbar navbar-default "></nav>  
<!-- mian -->
<div class="container">
    <!--面包屑导航 -->
    <div style="clear:both">
        <ol class="breadcrumb">
        当前位置：
            <li><a href="../frontend/index.html">首页</a></li>
            <li><a href="../frontend/ticketQuery.php">在线订票</a></li>
            <li><a href="ticketTable.php">车次查询</a></li>
            <li><a href="ticketBooking.php">选票</a></li>
            <li class="active">订单确认</li>
        </ol>
    </div>

    <!-- 选票 -->
    <div id="shop_cart">
        <table class="table table-hover">
            <thead style="background:#64a7af;">
                <th>用户姓名</th>
                <th>出发时间</th>
                <th>出发地</th>
                <th>目的地</th>
                <th>路线号</th>
                <th>车厢号</th>
                <th>座位号</th>
                <th>价格</th>
            </thead>
            <?php
                //查询车票价格
                

                $sql_train = "select * from Train where trainId='$lineId'";
                $res_train = mysqli_query($con,$sql_train);
                $row_train = mysqli_fetch_array($res_train);
                $trainType = $row_train["trainType"];
                $sql_price = "select * from Mileprice where start='$start' and end='$end' and lineType='$trainType' and seatType='$MyseatType'";
                $res_price = mysqli_query($con,$sql_price);
                $row_price = mysqli_fetch_array($res_price);
                $price = $row_price["price"];
                //echo $seatId;
                //通过$seatId 查到车厢号和座位号
                $sql = "select Carriage.carriageNo as cno, Seat.seatNo as sno from Seat natural join Carriage  where Seat.seatId='$seatId'";
                $re = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($re)){
                    $carriageNo = $row["cno"];
                    $seatNo = $row["sno"];
                } 
                $_SESSION["carriageNo"] = $carriageNo;
                $_SESSION["seatNo"] = $seatNo;
                $_SESSION["price"] = $price;
                echo "<tr>
                        <td>$userName</td>
                        <td>$start_datetime</td>
                        <td>$start</td>
                        <td>$end</td>
                        <td>$lineId</td>
                        <td>$carriageNo</td>
                        <td>$seatNo</td>
                        <td>$price</td>
                        <td></td>
                </tr>";
            ?>
        </table>
    </div>
    <!-- 座位类型 -->
    <form name="formSeatType" method="post"  enctype="multipart/form-data" action="ticketOrderUpdate.php">
        <div style="background:#eee;height:4em;">
            <div style="float:right;padding:1em 2em ">
           ticketBookingSql     <input type="submit" name="Submit" value="确认并支付" class="btn btn-success"> 
            </div>
        </div>           
    </form> 
</div>
</body>
</html>





