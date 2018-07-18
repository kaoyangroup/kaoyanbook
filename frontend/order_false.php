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
<p>未完成订单：</p>
      <tbody>
        <tr> 
            <td>  <table>
            	<p>订单信息：</p>
                 <thead>
                    <tr>
                     <th width="60">序号</th>
                     <th width="72">出发站</th>
                     <th width="72">终点站</th>
                      <th width="72">车次信息</th>
                      <th width="72">席位信息</th>
                      <th width="80">旅客姓名</th>
                      <th width="64">出发时间</th>
                      
                      <th width="72">张数</th>
                      <th width="80">待支付金额</th>
                    </tr>
                </thead>
                  <tbody>
                  <?php
				  ini_set('date.timezone','Asia/Shanghai');
				  require_once '../backend/order_back.php';
				  
                  $uid = $_COOKIE["cur_uid"];
                  echo $uid."<br>";
                  $i = 0;
                  $con = mysqli_connect("localhost","root","zzzzzzwj","test");
                  if(!$con)
                  {
                    die('Count not connect');
                  }

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
					  if(!$row){
					  printf("Error: %s\n", mysqli_error($con));
					  exit();
                  }
                     $orderId = $row["orderId"];
                     echo $orderId."<br>";
                     //Order
                     $sql_order = "select * from Order1 where orderId='$orderId' and orderType=0";
                     $res_order = mysqli_query($con,$sql_order);
                     $num_order = mysqli_num_rows($res_order);
                     echo $num_order."<br>";
                     if($num_order == 0)
                     {
                      continue;
                     }
                     $row_order = mysqli_fetch_array($res_order);
                     $orderTime = $row_order["orderTime"];
                     $passengerId = $row_order["passengerId"];
                     $from = $row_order["start"];
                     $to = $row_order["end"];
                     echo $to."<br>";
                     $flag = 0;
                     $ttime = strtotime($cur_time)-strtotime($orderTime);
                     echo $ttime."<br>";
                     /*
                     
                     if( >= 60*120)
                     {
                        //退票
                        echo $flag."<br>";
                        update($con,$orderId,$uid,0);
                        $flag = 1;
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
                     echo $from." ".$to." ".$trainType." ".$seatType."<br>";

                     //Mileprice
                     $sql_price = "select * from Mileprice where start='$from' and end='$to' and lineType='$trainType' and seatType='$seatType'";
                     $res_price = mysqli_query($con,$sql_price);
                     $row_price = mysqli_fetch_array($res_price);
                     $price = $row_price["price"];
                     echo $price."<br>";

                     
                  }
                  
                 echo "</tbody>";
           echo "</table>";
          echo  "</td>";
      echo  "</tr>";
        
        
        
       echo  "<tr>";
           echo "<td><table>";
                
                echo "<tr>";
                echo   "<td>".$i."</td>";
                echo   "<td>".$from."</td>";
                echo   "<td>".$to."</td>";
                echo   "<td>".$trainId."</td>";
                echo   "<td>".$carriageNo."号车厢".$seatNo."号座位</td>";
                echo   "<td>".$name."</td>";
                echo   "<td>".$goDate."</td>";
                echo   "<td>1</td>";
                echo   "<td>".$price."</td>";
                if($flag == 0){
                   echo   "<input type='button' id='button2' value='继续支付'  onclick='Onsubmits()' ><script type='text/javascript'>";
                   echo   "function Onsubmits(){  window.location.href='pay.html?orderId='+$orderId;}</script>";

                   echo   "<input type='button' id='button2' value='取消订单'  onclick='Onsubmit()' >";  
                        echo   "<script type='text/javascript'>
                                function Onsubmit(){
                                    alert('取消订单成功！');
                                    var id = <?php echo ".'$orderId'."; ?>
                                    var uid = <?php echo ".'$uid'."; ?>
                                    <?php update(id,uid,0);?>
                                
                                }
                                </script>";
               }
                echo "</tr>";
            ?>
            </table></td>
        </tr>
      
      
   
    </table>
</body>
</html>
