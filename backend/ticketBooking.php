
<?php
echo "ssss";


	include_once "includes/dbh.inc.php";
    session_start();
if(!isset($_SESSION["lineId"])) echo "2222";
	$lineId = $_SESSION["lineId"]
    echo $lineId." ";
	$start = $_SESSION["start"];    
    echo $start." ";
	$end = $_SESSION["end"];
echo $end."";
	$departure_date = $_SESSION["departure_date"];
echo $departure_date;
	$userId = "marco";

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
            <li class="active">选票</li>
        </ol>
    </div>

    <!-- 选票 -->
    <div id="shop_cart">
        <table class="table table-hover">
            <thead style="background:#64a7af;">
                <th>用户姓名</th>
                <th>用户类型</th>
                <th>身份证号</th>
                <th>出发日期</th>
                <th>出发地</th>
                <th>目的地</th>
                <th>路线号</th>
            </thead>
            <?php
                $sql = "select * from user where uid='$userId'";
                $res = mysqli_query($con, $sql);
               	while($row = mysqli_fetch_assoc($res)){
               		$userName = $row['name'];
               		$userType = $row['userType'];
               		$cardNo = $row['cardNo'];
               	}
               	if($userType==0){
               		$userType = "成人";
               	}else{
                    $userType = "学生";
                }
               	echo "<tr>
					  <td>$userName</td>	
					  <td>$userType</td>	
					  <td>$cardNo</td>	
					  <td>$departure_date</td>	
					  <td>$start</td>	
					  <td>$end</td>	
                      <td>$lineId</td>
               		  </tr>";
                $_SESSION["userName"] = $userName;
            ?>
        </table>
    </div>
    
    <!-- 座位类型 -->
    <form id="formSeatType" method="post"  action="ticketOrder.php">
        <div style="background:#eee;height:4em;">
            <div style="float:right;padding:1em 2em ">
                    <select required id='selectSeatType' name='seatType' onchange='this.form.()' >
                        <option value="">请选择座位类型</option>
                        <option value="一等座">一等座</option>
                        <option value="二等座">二等座</option>
                        <option value="卧铺">卧铺</option>
                        <option value="硬座">硬座</option>
                    </select>  
                <input type="submit" name="submit" value="确认订票" class="btn btn-success"> 
            </div>
        </div>           
    </form> 
</div>
</body>
</html>



