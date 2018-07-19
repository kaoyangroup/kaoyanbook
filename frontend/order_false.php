<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>未完成订单</title>
<link href="css/history.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #CCC;
}
</style>
</head>

<body>

<div id="top">
<div id="t"><h3>未完成订单</h3></div>

<div id="r">
<ul>
	<li>
    	<a href="index.html" target="_blank"><div>首页</div></a>
    </li>
	<li>
    	<a href="ticketQuery.php" target="_blank"><div>购票</div></a>
    </li>
    <li>
    	<a href="UserAll.html" target="_blank"><div>查看用户信息</div></a>
    </li>
    <li>
    	<a href="login2.php" target="_blank"><div>退出登录</div></a>
    </li>
</ul>
</div>
</div>

<div id="c">
<table width="1000" border="1" cellpadding="5" cellspacing="1" border="1">
        <thead>
        <tr> 
             <th width="40">序号</th>
             <th width="80">出发站</th>
             <th width="80">终点站</th>
             <th width="80">车次信息</th>
             <th width="180">席位信息</th>
             <th width="160">旅客姓名</th>
             <th width="130">出发时间</th>
             <th width="40">张数</th>
             <th width="60">待支付金额</th>
             <th width="100">选项</th>
        </tr></thead>
             
        <tbody>
                  <?php
				  ini_set('date.timezone','Asia/Shanghai');
				  require_once '../backend/includes/dbh.inc.php';
                  $uid = $_COOKIE["cur_uid"];
                  $i = 0;
                  
                  $sql = "select * from Myorder where userId='$uid'";
                  $result = mysqli_query($con,$sql);
				  if(!$result){
					  printf("Error: %s\n", mysqli_error($con));
					  exit();
				  }
                  $cur_time = date("y-m-d h:i:s");
                  
                //   $toShowList = array();
                  while($row=mysqli_fetch_array($result))
                  {
        					  /*if(!$row){
        					  printf("Error: %s\n", mysqli_error($con));
        					  exit();
                          }*/
                     $orderId = $row["orderId"];
                     //Order
                     $sql_order = "select * from Order1 where orderId='$orderId' and orderType=0";
                     $res_order = mysqli_query($con,$sql_order);
                     $num_order = mysqli_num_rows($res_order);
                     if($num_order == 0)
                     {
                      continue;
                     }
                     $row_order = mysqli_fetch_array($res_order);
                     $orderTime = $row_order["orderTime"];
                     $passengerId = $row_order["passengerId"];
                     $from = $row_order["start"];
                     $to = $row_order["end"];
                     $ttime = strtotime($cur_time)-strtotime($orderTime);

                     if($ttime >= 60*60)
                     {
                        require_once '../backend/order_back.php';
                        update($orderId,$uid,0);
                        continue;
                     }
                     $i += 1;
                     $ticketId = $row_order["ticketId"];
                     //Booking
                     $sql_booking = "select * from Booking where ticketId='$ticketId'";
                     $res_booking = mysqli_query($con,$sql_booking);
                     $row_booking = mysqli_fetch_array($res_booking);
                     $lineId = $row_booking["lineId"];
                     $seatId = $row_booking["seatId"];
                     $goDate = $row_booking["date"];

                     //seat
                     $sql_seat = "select * from Seat where seatId='$seatId'";
                     $res_seat = mysqli_query($con,$sql_seat);
                     $row_seat = mysqli_fetch_array($res_seat);
                     $seatNo = $row_seat["seatNo"];
                     $carriageId = $row_seat["carriageId"];

                     //Carriage
                     $sql_carriage = "select * from Carriage where carriageId='$carriageId'";
                     $res_carriage = mysqli_query($con,$sql_carriage);
                     $row_carriage = mysqli_fetch_array($res_carriage);
                     $trainId = $row_carriage["trainId"];
                     $seatType = $row_carriage["carriageType"];
                     $carriageNo = $row_carriage["carriageNo"];

                     //Train
                     $sql_train = "select * from Train where trainId='$trainId'";
                     $res_train = mysqli_query($con,$sql_train);
                     $row_train = mysqli_fetch_array($res_train);
                     $trainType = $row_train["trainType"];

                     //user
                     $sql_user = "select * from user where uid='$passengerId'";
                     $res_user = mysqli_query($con,$sql_user);
                     $row_user = mysqli_fetch_array($res_user);
                     $name = $row_user["name"];

                     //Mileprice
                     $sql_price = "select * from Mileprice where start='$from' and end='$to' and lineType='$trainType' and seatType='$seatType'";
                     $res_price = mysqli_query($con,$sql_price);
                     $row_price = mysqli_fetch_array($res_price);
                     $price = $row_price["price"];

                     //Line
                     $sql_line = "select * from Line where lineId='$trainId' and station='$from'";
                     $res_line = mysqli_query($con,$sql_line);
                     $row_line = mysqli_fetch_array($res_line);
                     $arrTime = $row_line["arrTime"];
                     $arrDate = $row_line["arrDate"];
                     if($arrDate == "次日")
                     {
                      $goDate = $goDate+1;
                     }
                  
                
                echo "<tr>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$i."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$from."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$to."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$trainId."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$carriageNo."号车厢".$seatNo."号座位&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$goDate." ".$arrTime."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$price."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo "<td>";
                
                   echo   "<input type='button' id='button2' value='继续支付'  onclick='Onsubmits()' ><script type='text/javascript'>";
                   echo   "function Onsubmits(){  window.location.href='pay.html?orderId='+$orderId;}</script>";

                   echo   "<input type='button' id='button2' value='取消订单'  onclick='Onsubmit()' >";  
                        echo   "<script type='text/javascript'>
                                function Onsubmit(){
                                    window.location.href='order_falseSQL.php?orderId='+$orderId;
                                }
                                </script>";
               
               echo "</td>";
                echo "</tr>";
              }
            ?>
      		</tbody>
    </table>
    </div>
</body>
</html>
