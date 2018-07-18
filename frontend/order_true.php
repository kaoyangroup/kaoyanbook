<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="history.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #CCC;
}
</style>

</head>

<body>
<table border="1" cellpadding="3" cellspacing="20">
<p>已完成订单：</p>
      <tbody>
        <tr> 
            <td>  <table>
            	<p>订单信息：</p>
                 <thead>
                    <tr>
                     <th width="60">序号</th>
                     <th width="72">出发站</th>
                     <th width="88">终点站</th>
                      <th width="72">车次信息</th>
                      <th width="220">席位信息</th>
                      <th width="100">旅客姓名</th>
                      <th width="250">出发时间</th>
                      <th width="72">张数</th>
                      <th width="72">金额</th>
                    </tr>
                   
              </thead>
                  <tbody>
                   <?php
                   ini_set('date.timezone','Asia/Shanghai');
                  
                  $uid = $_COOKIE["cur_uid"];
                  $i = 0;
                  require_once '../backend/includes/dbh.inc.php';

                  $sql = "select * from Myorder where userId='$uid'";
                  $result = mysqli_query($con,$sql);
				  if(!$result){
					  printf("Error: %s\n", mysqli_error($con));
					  exit();
                    }
                //   $toShowList = array();
                  while($row=mysqli_fetch_array($result))
                  {
					  
                     $orderId = $row["orderId"];
                     //Order
                     $sql_order = "select * from Order1 where orderId='$orderId' and orderType=1";
                     $res_order = mysqli_query($con,$sql_order);
                     if(mysqli_num_rows($res_order) == 0)
                     {
                      continue;
                     }
                     $row_order = mysqli_fetch_array($res_order);
                     $orderTime = $row_order["orderTime"];
                     $passengerId = $row_order["passengerId"];
                     $from = $row_order["start"];
                     $to = $row_order["end"];
                     /*if(大于半小时)
                     {
                        退票;
                        continue;
                     }*/
                     
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

                     $sql_price = "select * from Mileprice where start='$from' and end='$to' and lineType='$trainType' and seatType='$seatType'";
                     $res_price = mysqli_query($con,$sql_price);
                     $row_price = mysqli_fetch_array($res_price);
                     $price = $row_price["price"];

                     $sql_line = "select * from Line where lineId='$trainId' and station='$from'";
                     $res_line = mysqli_query($con,$sql_line);
                     $row_line = mysqli_fetch_array($res_line);
                     $arrTime = $row_line["arrTime"];
                     $arrDate = $row_line["arrDate"];
                     if($arrDate == "次日")
                     {
                      $goDate = $goDate+1;
                     }

                     $cur_time = date("y-m-d h:i:s");

                     echo "<tr>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$i."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$from."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$to."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$trainId."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$carriageNo."号车厢".$seatNo."号座位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$goDate." ".$arrTime."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     echo   "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$price."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                     if(strtotime($goDate."".$arrTime)-strtotime($cur_time) >= 60*30)
                     {
                      echo "<td>";
                        echo   "<input type='button' id='button2' value='退票'  onclick='Onsubmit()' >";  
                        echo   "<script type='text/javascript'>
                                function Onsubmit(){
                                    window.location.href='order_trueSQL.php?orderId='+$orderId;
                                }
                                </script>";
                        echo "</td>";
                    }
                     echo "<tr>";
                  }
                  ?>
                  </tbody>
            </table>
            </td>
        </tr>
        
        
        
        <tr>
            <td><table>
            </table></td>
        </tr>
      
      
   
    </table>
</body>
</html>
