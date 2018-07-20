<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>支付</title>
<link rel="stylesheet" type="text/css" href="css/pay.css">
   <SCRIPT type="text/javascript">        
            var maxtime = 30 * 60;
            function CountDown() {
                if (maxtime >= 0) {
                    minutes = Math.floor(maxtime / 60);
                    seconds = Math.floor(maxtime % 60);
                    msg =  minutes + "分" + seconds + "秒";
                    document.all["timer"].innerHTML = msg;
                     --maxtime;
                } else{
                    clearInterval(timer);
                    window.location.href='Index.html';
                }
            }
            timer = setInterval("CountDown()", 1000);                
        </SCRIPT>

</head>

<body>
<div class="container">	
<content>
<div id=title>
      
   座位已锁定，请在30分钟内进行支付，完成购票。支付剩余时间：
		<span id="timer"   style="color:red;font-size:80px;" ></span>
    
    
</div>
<div id=info>
	<p>订单信息：</p>
    <table border="1" cellpadding="3" cellspacing="20">
      <thead>
        <tr>
          <th>姓名</th>
          <th>身份类型</th>
          <th>证件号码</th>
          <th>车次</th>
          <th>车厢号</th>
          <th>座位类型</th>
          <th>座位号</th>
          <th>票价</th>
  
        </tr>
      </thead>
        
        
      <tbody>
        <?php 
           session_start();
           require_once '../backend/includes/dbh.inc.php';
           $uid = "marco";//$_COOKIE['cur_uid'];
           $lineId = $_SESSION["lineId"];
           $carriageNo = $_SESSION["carriageNo"];
           $sql = "select * from user where uid = '$uid'";
           $re = mysqli_query($con,$sql);
           $price = $_SESSION["price"];
           $row = mysqli_fetch_array($re);
           $name = $row["name"];
           $cardId = $row["cardNo"];
           $type = $row["userType"];
           $seatType = $_SESSION["seatType"];
           $seatNo = $_SESSION["seatNo"]; 
           if($type == 0)
            $tt = "普通";
           else $tt = "学生";
           echo "<tr>
                  <td>$name</td>
                  <td>$tt</td>
                  <td>$cardId</td>
                  <td>$lineId</td>
                  <td>$carriageNo</td>
                  <td>$seatType</td>
                  <td>$seatNo</td>                  
                  <td>$price</td>
          </tr>";
        ?>
        
      </tbody>
     
    </table>
   		 <div id="stt">
    		<form id="click" method="post" action="">
    		 <div id="btn1"><input type="submit" id="button1" value="取消订单"  onclick="Onsubmits()" ><script type="text/javascript">function Onsubmits(){  window.location.href='index.html'}</script></div>
    		 <div id="btn2"><input type="submit" id="button2" value="确认支付"  onclick="Onsubmits2()" ><script type="text/javascript">function Onsubmits2(){  window.location.href='paysuccess.html'}</script> </div>
              </form>
			</div>
	</div>
     </content></div>
</body>
